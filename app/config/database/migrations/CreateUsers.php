<?php 
namespace Migrations;

use Codeframe\Schema;

class CreateUsers {
    public function run() {
        Schema::dropIfExists('users');
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->integer('role_id');
            $table->timestamps();
        });
    }
}