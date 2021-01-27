<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration {

    public function up(){
        Schema::create("site_settings", function (Blueprint $table) {

            $table->integer('id');			$table->integer('user_id');			$table->integer('garden_id');

        });
    }

    public function down(){
        Schema::dropIfExists("site_settings");
    }

}

