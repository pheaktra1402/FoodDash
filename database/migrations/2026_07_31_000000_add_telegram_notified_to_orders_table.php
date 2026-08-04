<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'telegram_notified')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->boolean('telegram_notified')->default(false);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'telegram_notified')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('telegram_notified');
            });
        }
    }
};