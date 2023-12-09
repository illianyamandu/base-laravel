<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('identifier_name', 255)->unique();
            $table->string('name', 255);
            $table->string('description', 255)->nullable();

            $table->softDeletes();
            $table->timestamps();
            $table->createdUpdatedBy();
        });

        Schema::create('group_permission', function (Blueprint $table) {
            $table->uuid('group_id');
            $table->uuid('permission_id');

            $table->softDeletes();
            $table->timestamps();
            $table->createdUpdatedBy();

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
