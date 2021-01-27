<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicrefbookTable extends Migration {

    public function up(){
        Schema::create("basicrefbook", function (Blueprint $table) {

            $table->integer('id');			$table->text('text');			$table->text('article');			$table->text('params');			$table->integer('user_id');			$table->integer('garden_id');			$table->integer('active');			$table->integer('unique_material_status');

        });
    }

    public function down(){
        Schema::dropIfExists("basicrefbook");
    }

}

