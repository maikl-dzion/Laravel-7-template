<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPropsTable extends Migration {

    public function up(){
        Schema::create("user_props", function (Blueprint $table) {

            $table->integer('prop_id');			$table->integer('user_id');

        });
    }

    public function down(){
        Schema::dropIfExists("user_props");
    }

}

