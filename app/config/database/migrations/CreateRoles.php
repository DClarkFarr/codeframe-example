<?php 
namespace Migrations;

use Codeframe\Schema;

class CreateRoles {
    public function run() {
        Schema::dropIfExists('roles');
        Schema::create('roles', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
}