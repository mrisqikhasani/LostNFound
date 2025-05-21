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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->string("nama_barang_temuan");
            $table->enum("kategori", ['Alat Tulis','Elektronik', 'Alat Makan & Minum', 'Aksesoris', 'Lainnya'])-> default('Lainnya');
            $table->dateTime("waktu_temuan");
            $table->string("lokasi_temuan");
            $table->enum('region_kampus', ['Depok', 'Kalimalang', 'Karawaci', 'Cengkareng', 'Salemba'])->default('Depok');
            $table->text("deskripsi_umum");
            $table->text("deskripsi_khusus");
            $table->enum('status',['menunggu', 'disetujui', 'ditolak', 'diklaim'])->default('menunggu');
            $table->json('foto_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
