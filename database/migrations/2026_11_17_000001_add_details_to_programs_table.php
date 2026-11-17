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
        Schema::table('programs', function (Blueprint $table) {
            $table->text('full_name')->nullable()->after('name');
            $table->text('objectives')->nullable()->after('description');
            $table->string('location')->nullable()->after('objectives');
            $table->json('commodities')->nullable()->after('location');
            $table->json('focus_activities')->nullable()->after('commodities');
            $table->json('student_needs')->nullable()->after('focus_activities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'objectives',
                'location',
                'commodities',
                'focus_activities',
                'student_needs',
            ]);
        });
    }
};
