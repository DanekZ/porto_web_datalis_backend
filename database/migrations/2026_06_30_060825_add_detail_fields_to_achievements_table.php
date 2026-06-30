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
        Schema::table('achievements', function (Blueprint $table) {
             $table->string('level')->nullable()->after('type');           // Beginner/Intermediate/Expert
            $table->string('credential_id')->nullable()->after('level');
            $table->date('issue_date')->nullable()->after('credential_id');
            $table->date('expiration_date')->nullable()->after('issue_date');
            $table->json('categories')->nullable()->after('expiration_date'); // ["Front End", "Backend"]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('achievements', function (Blueprint $table) {
        $table->dropColumn(['level', 'credential_id', 'issue_date', 'expiration_date', 'categories']);
    });
    }
};
