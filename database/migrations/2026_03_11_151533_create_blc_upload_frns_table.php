<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('blc_upload_frns', function (Blueprint $table) {
    $table->id();
    $table->string('kp', 10);
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('style', 50);
    $table->string('country', 5);
    $table->string('item', 50);
    $table->string('color', 50);
    $table->string('relax');
    $table->integer('qty_request');
    $table->decimal('blc', 12, 1)->default(0);
    $table->date('podo')->nullable();
    $table->string('kendala')->nullable();
    $table->string('keterangan')->nullable();
    $table->timestamps();

    $table->unique(['kp', 'style', 'color', 'item', 'country']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blc_upload_frns');
    }
};
