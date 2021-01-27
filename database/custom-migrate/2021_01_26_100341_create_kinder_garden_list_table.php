<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKinderGardenListTable extends Migration {

    public function up(){
        Schema::create("kinder_garden_list", function (Blueprint $table) {

            $table->integer('garden_id');			$table->text('note');

        });
    }

    public function down(){
        Schema::dropIfExists("kinder_garden_list");
    }

}

