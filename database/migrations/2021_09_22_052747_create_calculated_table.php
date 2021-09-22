<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculated', function (Blueprint $table) {
            $table->id();
            $table->decimal('ipn', $precision = 8, $scale = 2)->default(0);
            $table->decimal('opv', $precision = 8, $scale = 2)->default(0);
            $table->decimal('osms', $precision = 8, $scale = 2)->default(0);
            $table->decimal('vosms', $precision = 8, $scale = 2)->default(0);
            $table->decimal('so', $precision = 8, $scale = 2)->default(0);
            $table->decimal('salary', $precision = 8, $scale = 2)->default(0);
            $table->decimal('total', $precision = 8, $scale = 2)->default(0);
            $table->integer('vacation')->default(0);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('calculated');
    }
}
