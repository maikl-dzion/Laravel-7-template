<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    public function up(){
        Schema::create("users", function (Blueprint $table) {

            $table->integer('user_id');			$table->integer('role_id');			$table->text('note');			$table->integer('active');			$table->integer('garden_id');

        });
    }

    public function down(){
        Schema::dropIfExists("users");
    }

}

