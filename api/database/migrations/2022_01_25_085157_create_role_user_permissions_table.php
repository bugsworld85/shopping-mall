<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user_permissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_user_id')->index()->unsigned();
            $table->bigInteger('permission_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('role_user_id')->references('id')->on('role_users')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user_permissions');
    }
}
