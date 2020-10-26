<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsidiaryGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidiary_group_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_id')->index();
            $table->unsignedBigInteger('group_id')->index();
            $table->foreign('sub_id')->on('subsidiaries')->references('id')->cascadeOnDelete();
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
        Schema::dropIfExists('subsidiary_group_members');
    }
}
