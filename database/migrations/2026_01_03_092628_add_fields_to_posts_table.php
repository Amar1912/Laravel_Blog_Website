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
        Schema::table('posts', function (Blueprint $table) {
            // Add missing columns that were added to the original migration after it already ran
            $table->string('title')->nullable()->after('id');
            $table->longText('description')->nullable()->after('title');
            $table->string('image')->nullable()->after('description');
            $table->string('name')->nullable()->after('image');
            $table->unsignedBigInteger('user_id')->nullable()->after('name');
            $table->string('post_status')->nullable()->after('user_id');
            $table->string('usertype')->nullable()->after('post_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description',
                'image',
                'name',
                'user_id',
                'post_status',
                'usertype',
            ]);
        });
    }
};
