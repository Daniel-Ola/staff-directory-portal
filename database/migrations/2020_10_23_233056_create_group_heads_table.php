<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_heads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->unsignedBigInteger('role_id')->index();
            $table->unsignedBigInteger('assigned_by')->index();
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete(); 
            $table->foreign('role_id')->on('group_head_roles')->references('id')->cascadeOnDelete(); 
            $table->foreign('group_id')->on('subsidiary_groups')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_heads');
    }
}
