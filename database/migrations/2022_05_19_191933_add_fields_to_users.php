<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('avatar');
            $table->string('confirmation_code')->nullable();
            $table->foreignId('rol_id')->default(2)->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign(['rol_id']);
            $table->string('name');
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'avatar',
                'validated'
            ]);
        });
    }
}
