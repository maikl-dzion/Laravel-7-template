<?php
/**
 * Created by PhpStorm.
 * User: maikl
 * Date: 07.09.2020
 * Time: 17:07
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MakeMigrateWorkerController extends Controller
{

    protected $_db;
	protected $_driver;

    public function run() {

        $schema = '';

		$this->_db     = env('DB_DATABASE', false);
		$this->_driver = env('DB_CONNECTION', false);

		switch($this->_driver) {
			case 'mysql' :
			      $schema = $this->_db;
			      $tName = 'TABLE_NAME';
			      break;

			case 'pgsql' :
			      $schema = 'public';
                  $tName = 'table_name';
				  break;
		}

        $migrateFiles = array();

        // lg($schema);

        $tableList    = $this->getTableList($schema);

		// lg($tableList);

        foreach ($tableList as $tKey => $table) {

            $tableName = $table->$tName;
            $fields    = $this->getTableFields($tableName, $schema);

            // lg($fields);
            // if($tableName == 'send_food') lg($fields);

            $migrateFields = array();

            foreach ($fields as $fKey => $field) {
                $fLine = $this->createFieldMigrate((array)$field, $tableName);
                if($fLine)
                  $migrateFields[] = $fLine;
            }

            if(!empty($migrateFields)) {

                $fieldLines   = implode("\r\t\t\t", $migrateFields);
                $migrateLines = $this->createTableMigrate($tableName, $fieldLines);
                $migrateLines = "<?php \r" . $migrateLines;
                $fileName   = $this->createMigrateFileName($tableName);
                $migrateDirName = __DIR__ . '/migrate';
                if(!file_exists($migrateDirName))
                    mkdir($migrateDirName, 0777);

                $migrateDir = $migrateDirName . '/' . $fileName;

                file_put_contents($migrateDir, $migrateLines);
                $migrateFiles[$fileName] = $fileName;

            }
        }

        echo '---ok---';

        print_r($migrateFiles);

    }

    public function getTableList($schema = 'public') {

        $query = "SELECT * FROM INFORMATION_SCHEMA.TABLES
                  WHERE TABLE_SCHEMA='{$schema}'";
        return $this->makeQuery($query);
    }

    public function getTableFields($tableName, $schema = 'public') {
        // $fields = 'column_name, data_type, udt_name, character_octet_length, dtd_identifier, column_default';
        $fields = '*';
        $query = "SELECT {$fields} FROM INFORMATION_SCHEMA.COLUMNS
                  WHERE  TABLE_SCHEMA='{$schema}'
                  AND    TABLE_NAME='{$tableName}'";
        return $this->makeQuery($query);
    }

    protected function makeQuery($query, $param = array()) {
        $result = DB::select($query);
        // lg($result);
        return $result;
    }

    protected function getColumnData($field) {

		// pgsql
        $fColType  = 'data_type';
        $fColName  = 'column_name';
        $fColDef   = 'column_default';
        $fColLen   = 'character_octet_length';

        $fieldType = $fieldName = $fieldDefault = $fLength = '';

	    switch($this->_driver) {
			case 'mysql' :

			      $fColType  = 'DATA_TYPE';
                  $fColName  = 'COLUMN_NAME';
                  $fColDef   = 'COLUMN_DEFAULT';

			      break;

			// case 'pgsql' : break;
		}

        /////////////////////////
        if(!empty($field[$fColType]))
           $fieldType = $field[$fColType];
	    elseif(!empty($field['DATA_TYPE']))
		   $fieldType = $field['DATA_TYPE'];

	    ///////////////////////
	    if(!empty($field[$fColName]))
           $fieldName    = $field[$fColName];

	    ////////////////////////
	    if(!empty($field[$fColDef]))
           $fieldDefault = $field[$fColDef];

	    ////////////////////////
	    if(!empty($field[$fColLen]))
           $fLength = $field[$fColLen];

		return [
		   'type' => $fieldType,
		   'name' => $fieldName,
		   'default' => $fieldName,
		   'length'  => $fLength,
		];
	}


    protected function createFieldMigrate($field, $tableName) {

        $fLength   = '';
        $fColType  = 'data_type';
        $fColName  = 'column_name';
        $fColDef   = 'column_default';
        $fColLen   = 'character_octet_length';

        // lg($field);
        $fieldType = $fieldName = $fieldDefault = '';

        $resp = $this->getColumnData($field);

		$fieldType = $resp['type'];
		$fieldName = $resp['name'];
		$fieldDefault = $resp['default'];
		$fLength = $resp['length'];

        $result  = $funcName = $args = '';

        $nextval = $tableName . '_' . $fieldName;

        $autoIdName = $this->checkAutoIdName($fieldDefault, $nextval);

        if($autoIdName)
            $fieldType = 'auto_increment_type';

        switch ($fieldType) {

            case 'auto_increment_type' :
                $funcName = "bigIncrements";
                break;

            case 'character varying' :
                $funcName = "string";
                $args = $fLength;
                break;

			case 'char' :
                $funcName = "string";
                $args = $fLength;
                break;

            case 'boolean' : $funcName = "boolean";    break;
            case 'bigint'  : $funcName = "bigInteger"; break;
            case 'integer' : $funcName = "integer";    break;
            case 'int'     : $funcName = "integer";    break;
            case 'text'    : $funcName = "text";       break;
            case 'bytea'   : $funcName = "binary";     break;
            case 'date'    : $funcName = "date";       break;
            case 'json'    : $funcName = "json";       break;
            case 'jsonb'   : $funcName = "jsonb";      break;
            case 'uuid'    : $funcName = "uuid";       break;

            case 'double precision' :
                $funcName = "float"; break;

            case 'timestamp without time zone' :
                $funcName = "timestamp"; break;

            case 'time without time zone' :
                $funcName = "time"; break;

            case 'character'   :
                $funcName = "char";
                $args = $fLength;
                break;
        }

        if($funcName) {
            $result   = '$table->' . $funcName;
            $argumets = "('{$fieldName}');";
            if($args)
               $argumets = "('{$fieldName}', $args);";
            $result = $result . $argumets;
        }

        return $result;
    }

    protected function createMigrateFileName($tableName) {
        $name = date("Y_m_d_His") . '_create_' . $tableName . '_table.php';
        return $name;
    }

    protected function checkAutoIdName($columnDefault, $currentLine) {
        $nextval = "nextval('{$currentLine}_seq'::regclass)";
        $pos = strrpos(trim($columnDefault), $nextval);
        if ($pos === false)
           return false;
        return true;
    }


    protected function createTableMigrate($tableName, $fields) {

        $tabName = ucfirst($tableName);

        $tArr = explode('_', trim($tableName));
        if(!empty($tArr[1])) {
            $tabName = '';
            foreach ($tArr as $k => $v) {
                $tabName .= ucfirst($v);
            }
        }

        $migrateContent = '

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create'.$tabName.'Table extends Migration {

    public function up(){
        Schema::create("'.$tableName.'", function (Blueprint $table) {

            ' .$fields. '

        });
    }

    public function down(){
        Schema::dropIfExists("'.$tableName.'");
    }

}

';
        return $migrateContent;
    }

}
