<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->string('nama', 255);
            $table->char('nrp', 14)->unique()->nullable();
            $table->string('no_keputusan_pengangkatan')->nullable();
            $table->string('tgl_pengangkatan')->nullable();
            $table->string('tgl_masuk', 100)->nullable();
            $table->string('tgl_lahir', 100)->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('bank', 10)->nullable();
            $table->string('no_rek', 20)->nullable();
            $table->text('foto')->nullable();
            $table->string('jabatan', 191)->nullable();
            $table->string('password');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
