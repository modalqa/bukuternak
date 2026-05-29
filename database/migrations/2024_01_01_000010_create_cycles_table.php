<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cycles', function (Blueprint $table) {
            if (Schema::getConnection()->getDriverName() === 'pgsql') {
                $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            } else {
                $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            }
            $table->uuid('user_id');
            $table->string('name');
            $table->string('livestock_type');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('initial_count');
            $table->decimal('initial_capital', 15, 2)->default(0);
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
