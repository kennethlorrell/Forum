<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThreadSubscriptionConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thread_subscriptions', function (Blueprint $table) 
        {
            $table->foreign(['thread_id'])->references('id')->on('threads')->onDelete('cascade');
            $table->unique(['user_id', 'thread_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thread_subscriptions', function (Blueprint $table) 
        {
            $table->dropForeign(['thread_id']);
            $table->dropUnique(['user_id', 'thread_id']);
        });
    }
}
