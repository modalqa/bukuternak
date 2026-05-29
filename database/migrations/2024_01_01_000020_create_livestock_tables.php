<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feed_logs', function (Blueprint $table) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            }
            $table->uuid('cycle_id');
            $table->uuid('user_id');
            $table->date('date');
            $table->decimal('quantity', 10, 2);
            $table->enum('unit', ['kg', 'karung', 'sak'])->default('kg');
            $table->decimal('cost', 15, 2);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('cycle_id')->references('id')->on('cycles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('mortality_logs', function (Blueprint $table) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            }
            $table->uuid('cycle_id');
            $table->uuid('user_id');
            $table->date('date');
            $table->integer('count');
            $table->string('cause')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('cycle_id')->references('id')->on('cycles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('expenses', function (Blueprint $table) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            }
            $table->uuid('cycle_id');
            $table->uuid('user_id');
            $table->date('date');
            $table->enum('category', ['obat_vitamin', 'listrik', 'air', 'transport', 'pekerja', 'lain_lain']);
            $table->decimal('amount', 15, 2);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('cycle_id')->references('id')->on('cycles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('sales', function (Blueprint $table) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            }
            $table->uuid('cycle_id');
            $table->uuid('user_id');
            $table->date('date');
            $table->decimal('quantity', 10, 2);
            $table->enum('quantity_unit', ['ekor', 'kg'])->default('ekor');
            $table->decimal('total_price', 15, 2);
            $table->string('buyer_name')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('cycle_id')->references('id')->on('cycles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('mortality_logs');
        Schema::dropIfExists('feed_logs');
    }
};
