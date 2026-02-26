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
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('role', ['satpam', 'pegawai', 'admin'])->default('satpam');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('petugas_qr', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')
                ->constrained('petugas')
                ->cascadeOnDelete();
            $table->string('qr_token')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique('petugas_id');

            Schema::create('kunjungan', function (Blueprint $table) {
                $table->id();
                $table->string('kode_kunjungan')->unique();
                $table->foreignId('petugas_id')
                    ->constrained('petugas')
                    ->cascadeOnDelete();
                $table->string('tujuan_kunjungan')->nullable();
                $table->enum('status', ['aktif', 'selesai', 'kadaluarsa'])->default('aktif');
                $table->timestamp('expired_at')->nullable();
                $table->timestamps();
            });
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')
                ->constrained('kunjungan')
                ->cascadeOnDelete();
            $table->string('rating'); // 1-5
            $table->string('kategori');
            $table->text('komentar')->nullable();
            $table->timestamps();
            $table->unique('kunjungan_id');
        });

        Schema::create('whatsapp_cs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->nullable(); // nomor WA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
        Schema::dropIfExists('petugas_qr');
        Schema::dropIfExists('kunjungan');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('whatsapp_cs');
    }
};
