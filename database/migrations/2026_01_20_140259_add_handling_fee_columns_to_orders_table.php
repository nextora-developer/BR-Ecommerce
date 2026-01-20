<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('handling_fee', 10, 2)->default(0)->after('shipping_fee');
            $table->decimal('handling_fee_percent', 6, 2)->default(0)->after('handling_fee');
            $table->boolean('handling_fee_enabled')->default(false)->after('handling_fee_percent');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['handling_fee', 'handling_fee_percent', 'handling_fee_enabled']);
        });
    }
};
