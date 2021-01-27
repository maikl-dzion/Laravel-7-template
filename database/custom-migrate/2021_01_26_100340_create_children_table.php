<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildrenTable extends Migration {

    public function up(){
        Schema::create("children", function (Blueprint $table) {

            $table->integer('child_id');

        });
    }

    public function down(){
        Schema::dropIfExists("children");
    }

}
