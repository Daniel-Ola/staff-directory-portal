<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScopeColumnToFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->enum('scope', ['private', 'sub', 'dept'])->default('private')->after('path');
            $table->unsignedBigInteger('sub')->nullable()->after('scope');
            $table->unsignedBigInteger('dept')->nullable()->after('sub');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn(['scope', 'sub', 'dept']);
        });
    }
}
