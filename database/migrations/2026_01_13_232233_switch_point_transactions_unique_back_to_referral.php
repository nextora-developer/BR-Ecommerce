<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('point_transactions', function (Blueprint $table) {
            // drop order unique
            $table->dropUnique('ptx_unique_source_order');

            // add referral unique
            $table->unique(['source', 'referral_log_id'], 'ptx_unique_source_referral');
        });
    }

    public function down(): void
    {
        Schema::table('point_transactions', function (Blueprint $table) {
            $table->dropUnique('ptx_unique_source_referral');
            $table->unique(['source', 'order_id'], 'ptx_unique_source_order');
        });
    }
};
