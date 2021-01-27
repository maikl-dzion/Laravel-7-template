<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksboardTable extends Migration {

    public function up(){
        Schema::create("tasksboard", function (Blueprint $table) {

            $table->integer('id');			$table->integer('prj_id');			$table->text('text');			$table->text('comment');			$table->integer('status');			$table->integer('worker_id');			$table->integer('admin_id');			$table->integer('user_id');			$table->integer('garden_id');			$table->integer('active');

        });
    }

    public function down(){
        Schema::dropIfExists("tasksboard");
    }

}

