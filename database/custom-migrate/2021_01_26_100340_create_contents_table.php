<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration {

    public function up(){
        Schema::create("contents", function (Blueprint $table) {

            $table->integer('id');			$table->text('content');			$table->integer('user_id');			$table->integer('garden_id');			$table->integer('active');			$table->integer('for_parents');

        });
    }

    public function down(){
        Schema::dropIfExists("contents");
    }

}

