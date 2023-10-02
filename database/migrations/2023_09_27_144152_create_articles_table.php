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
        Schema::create('articles', function (Blueprint $table) {
            /*Config */
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('thumbnail_path', 2048)->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->nullable();
            $table->integer('views')->nullable();
            /*End Config */
            /*Custom */
            $table->boolean('highlighted')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_tags')->nullable();
                /*images */
                $table->string('image')->nullable();
            /*End Custom */
            /*Log */
            $table->timestamps();
            $table->string('updated_by',50)->nullable();
            $table->string('created_by',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
