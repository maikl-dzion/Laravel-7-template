<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenGroupsTable extends Migration {

    public function up(){
        Schema::create("children_groups", function (Blueprint $table) {

            $table->integer('group_id');			$table->integer('user_id');			$table->text('note');			$table->integer('educator_id');			$table->integer('garden_id');

        });
    }

    public function down(){
        Schema::dropIfExists("children_groups");
    }

}

