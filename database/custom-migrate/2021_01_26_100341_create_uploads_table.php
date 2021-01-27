<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration {

    public function up(){
        Schema::create("uploads", function (Blueprint $table) {

            $table->integer('id');

        });
    }

    public function down(){
        Schema::dropIfExists("uploads");
    }

}
