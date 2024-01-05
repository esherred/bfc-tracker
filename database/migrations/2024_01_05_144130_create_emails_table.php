<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('from_email');
            $table->string('from_name');
            $table->string('subject');
            $table->timestamps();
        });

        Schema::create('recipiants', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->index()->constrained();
            $table->foreignId('recipiant_id')->index()->constrained();
            $table->string('type');
            $table->string('url')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
        Schema::dropIfExists('emails');
        Schema::dropIfExists('recipiants');
    }
};
