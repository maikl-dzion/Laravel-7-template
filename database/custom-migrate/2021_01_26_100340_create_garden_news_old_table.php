<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGardenNewsOldTable extends Migration {

    public function up(){
        Schema::create("garden_news_old", function (Blueprint $table) {

            $table->integer('new_id');			$table->integer('user_id');			$table->integer('garden_id');			$table->text('content');

        });
    }

    public function down(){
        Schema::dropIfExists("garden_news_old");
    }

}

