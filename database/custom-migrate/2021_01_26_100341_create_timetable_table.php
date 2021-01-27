<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetableTable extends Migration {

    public function up(){
        Schema::create("timetable", function (Blueprint $table) {

            $table->integer('id');			$table->text('params');			$table->integer('user_id');			$table->integer('garden_id');			$table->integer('active');

        });
    }

    public function down(){
        Schema::dropIfExists("timetable");
    }

}

