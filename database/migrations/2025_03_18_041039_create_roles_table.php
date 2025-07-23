<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Role ID (Primary Key)
            $table->string('name')->unique(); // Role name (e.g., Admin, User)
            $table->text('description')->nullable(); // Description for the role
            $table->timestamps(); // Created_at & Updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
