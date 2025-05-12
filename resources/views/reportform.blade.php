@extends('layouts.app')


@section('content')
<div class="flex items-center justify-center h-screen bg-gray-100">

    <form method="POST" action="" class="bg-white p-6 rounded shadow-md w-80">
        @csrf
        <h1 class="text-xl font-bold mb-4">Form Penemuan Barang</h1>

        @if ($errors->any())
            <div class="text-red-500 mb-2 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label>Nama Barang</label>
            <input name="nama_barang_temuan" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label>Lokasi Penemuan</label>
            <input type="text" name="lokasi_temuan" class="w-full border p-2 rounded" required autofocus>
        </div>

        <div class="mb-4">
            <label>Region Kampus</label>
            <select name="region_kampus" class="w-full border p-2 rounded" required>
            <option value="Depok" selected>Depok</option>
            <option value="Kalimalang">Kalimalang</option>
            <option value="Karawaci">Karawaci</option>
            <option value="Cengkareng">Cengkareng</option>
            <option value="Salemba">Salemba</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Waktu Penemuan Barang</label>
            <input type="datetime-local" name="deskripsi_umum" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label>Deskripsi Umum</label>
            <span class="text-xs block">Deskripsi yang akan di tampilkan public</span>
            <input type="text" name="deskripsi_khusus" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label>Deskripsi Khusus</label>
            <span class="text-xs block">Deskripsi Khusus hanya dapat dilihat oleh pelapor & admin untuk kebutuhan verifikasi barang</span>
            <input type="text" name="deskripsi_khusus" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Foto Barang</label>
        <input type="file" name="foto" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
    </div>


        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Register</button>
    </form>
</div>
@endsection