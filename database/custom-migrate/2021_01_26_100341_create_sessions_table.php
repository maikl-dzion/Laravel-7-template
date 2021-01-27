<?php 

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration {

    public function up(){
        Schema::create("sessions", function (Blueprint $table) {

            $table->integer('session_id');

        });
    }

    public function down(){
        Schema::dropIfExists("sessions");
    }

}
