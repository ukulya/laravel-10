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
        Schema::table('users', function (Blueprint $table) {
            // $table->addColumn('string','avatar'); // old way - type string,field name avatar
            // $table->string('avatar'); // new way - type string,field name avatar
            // $table->string('avatar')->before('email'); // we can also define the order
            // $table->string('avatar')->after('email'); // we can also define the order
            $table->string('avatar')->after('email')->nullable(); // we need to specify nullable to avoid error in migration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar'); // php artisan migrate
        });
    }

    
};
