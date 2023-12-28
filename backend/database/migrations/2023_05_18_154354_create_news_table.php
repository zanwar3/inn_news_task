<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableName = 'news';
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->string('source')->nullable();
                $table->string('author')->nullable();
                $table->string('title')->nullable();
                $table->longText('description')->nullable();
                $table->longText('url')->nullable();
                $table->string('url_hash', 64)->nullable();
                $table->string('url_to_image')->nullable();
                $table->longText('content')->nullable();
                $table->string('category')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
                $table->unique(['url_hash', 'category']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
