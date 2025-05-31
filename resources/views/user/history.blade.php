@extends('layouts.app')

@section('content')
    {{-- Tabel Klaim --}}
    <section class="bg-white pb-8 pt-32 lg:pb-[70px] lg:pt-[120px]">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl pt-10">
                <div class="mb-6 flex border-b">
                    <a href="?tab=claim"
                        class="mr-4 pb-2 {{ request('tab') == 'claim' ? 'border-b-2 border-primary text-primary' : 'text-gray-500' }}">Riwayat
                        Klaim</a>
                    <a href="?tab=laporan"
                        class="pb-2 {{ request('tab') == 'laporan' ? 'border-b-2 border-primary text-primary' : 'text-gray-500' }}">Riwayat
                        Laporan</a>
                </div>
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">

                    <h2 class="text-2xl font-semibold text-gray-900 sm:text-2xl">
                        Riwayat
                        @if (request('tab') == 'claim')
                            Klaim
                        @elseif (request('tab') == 'laporan')
                            Laporan
                        @else
                        @endif
                    </h2>

                    @php
                        $tab = request('tab') ?? 'claim';

                        // Tentukan status options sesuai tab
                        if ($tab == 'claim') {
                            $statusOptions = [
                                '' => 'Semua Klaim',
                                'diproses' => 'Diproses',
                                'disetujui' => 'Disetujui',
                                'ditolak' => 'Ditolak',
                            ];

                            $formAction = route('history'); // route claim
                        } elseif ($tab == 'laporan') {
                            $statusOptions = [
                                '' => 'Semua Laporan',
                                'menunggu' => 'Menunggu',
                                'disetujui' => 'Disetujui',
                                'ditolak' => 'Ditolak',
                                'diklaim' => 'Diklaim',
                            ];

                            $formAction = route('history'); // route laporan
                        } else {
                        }
                    @endphp

                    <form method="GET" action="{{ $formAction }}"
                        class="sm:flex sm:items-center sm:justify-between gap-4">

                        {{-- Input hidden tab biar tetap tahu tab aktif --}}
                        <input type="hidden" name="tab" value="{{ $tab }}">

                        <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">

                            <div>
                                <label for="status" class="sr-only">Status</label>
                                <select id="status" name="status"
                                    class="block w-full min-w-[8rem] rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 outline-none focus:ring-2 focus:ring-primary">
                                    @foreach ($statusOptions as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ request('status') === $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <span class="inline-block"> dari </span>

                            <div>
                                <label for="duration" class="sr-only">Durasi</label>
                                <select id="duration" name="duration"
                                    class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm outline-none focus:ring-2 focus:ring-primary">
                                    <option value="all" {{ request('duration') == 'all' ? 'selected' : '' }}>
                                        Semua Tanggal</option>
                                    <option value="this_week" {{ request('duration') == 'this_week' ? 'selected' : '' }}>
                                        Minggu ini</option>
                                    <option value="this_month" {{ request('duration') == 'this_month' ? 'selected' : '' }}>
                                        Bulan ini</option>
                                    <option value="last_3_months"
                                        {{ request('duration') == 'last_3_months' ? 'selected' : '' }}>3 Bulan Terakhir
                                    </option>
                                    <option value="last_6_months"
                                        {{ request('duration') == 'last_6_months' ? 'selected' : '' }}>6 Bulan Terakhir
                                    </option>
                                    <option value="this_year" {{ request('duration') == 'this_year' ? 'selected' : '' }}>
                                        Tahun Ini</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary transition-all duration-300 ease-in">Filter</button>
                        </div>
                    </form>


                </div>

                <!-- notif success -->
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if (request('tab') == 'claim')
                    @if (is_countable($claimsUser) && count($claimsUser) == 0)
                        <div class="flex flex-col items-center justify-center min-h-[50vh] py-8">
                            <a href="/" class="w-80 sm:w-96">
                                <img src="{{ asset('storage/not-found.svg') }}" alt="logo" class="w-full" />
                            </a>
                            <p class="mt-4 text-gray-500 text-center">Data masih kosong.</p>
                        </div>
                    @elseif (is_countable($claimsUser) && count($claimsUser) > 0)
                        @foreach ($claimsUser as $claimUser)
                            <div class="mt-6 flow-root sm:mt-8">
                                <div class="divide-y divide-gray-200">
                                    <div class="flex flex-wrap items-center gap-y-4 py-6">
                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Bukti Kepemilikan</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                                @if ($claimUser->foto_verifikasi)
                                                    <img src="{{ asset('storage/' . $claimUser->foto_verifikasi) }}"
                                                        class="w-16 rounded-md" />
                                                @else
                                                    <img src="{{ asset('storage/botol-minum-1.jpeg') }}" class="w-16"
                                                        alt="No Image" />
                                                @endif
                                            </dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Nama:</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                                {{ $claimUser->report->nama_barang_temuan }}</dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Tanggal Klaim:</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-90">
                                                {{ $claimUser->tanggal_klaim }}</dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Status:</dt>
                                            <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-base font-medium
                                            @if ($claimUser->status_klaim == 'diproses') bg-yellow-100 text-yellow-800" @elseif($claimUser->status_klaim == 'disetujui') bg-green-100 text-green-800"
                                            @elseif($claimUser->status_klaim == 'ditolak') bg-red-100 text-red-800" @else bg-gray-100 text-gray-800" @endif <svg class="me-1
                                                h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                                </svg>
                                                {{ $claimUser->status_klaim }}
                                            </dd>
                                        </dl>
                                        <dl>
                                            <button class="open-modal-btn bg-primary px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary transition-all duration-300 ease-in"
                                                data-claimId="{{ $claimUser->id }}"
                                                data-namabarangtemuan="{{ $claimUser->report->nama_barang_temuan }}"
                                                data-deksripsiVerifikasi="{{ $claimUser->deskripsi_verifikasi }}"
                                                data-statusKlaim="{{ $claimUser->status_klaim }}"
                                                data-tanggalKlaim="{{ $claimUser->tanggal_klaim }}"
                                                data-fotoVerifikasi="{{ $claimUser->foto_verifikasi }}"
                                                data-userReportFoundname = "{{ $claimUser->report->user->name }}"
                                                data-userReportFoundPhoneNumber = "{{ $claimUser->report->user->phone_number }}"
                                                data-reasonApproveRejectClaim= "{{ $claimUser->approve_reject_reason }}"
                                                onclick="openModalDetailClaim(this)">Detail</button>
                                        </dl>
                                    </div>
                        @endforeach
                    @endif
                @elseif (request('tab') == 'laporan')
                    @if (is_countable($reportsUser) && count($reportsUser) == 0)
                        <div class="flex flex-col items-center justify-center min-h-[50vh] py-8">
                            <a href="/" class="w-80 sm:w-96">
                                <img src="{{ asset('storage/not-found.svg') }}" alt="logo" class="w-full" />
                            </a>
                            <p class="mt-4 text-gray-500 text-center">Data masih kosong.</p>
                        </div>
                    @elseif (is_countable($reportsUser) && count($reportsUser) > 0)
                        @foreach ($reportsUser as $reportUser)
                            <div class="mt-6 flow-root sm:mt-8">
                                <div class="divide-y divide-gray-200">
                                    <div class="flex flex-wrap items-center gap-y-4 py-6">
                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Bukti Penemuan</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                                @if ($reportUser->foto_url[0])
                                                    <img src="{{ asset('storage/' . $reportUser->foto_url[0]) }}"
                                                        class="w-16 rounded-md" />
                                                @else
                                                    <img src="{{ asset('storage/botol-minum-1.jpeg') }}" class="w-16"
                                                        alt="No Image" />
                                                @endif
                                            </dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Nama:</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                                {{ $reportUser->nama_barang_temuan }}</dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Waktu Temuan:</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-90">
                                                {{ \Carbon\Carbon::parse($reportUser->waktu_temuan)->format('j F Y, G:i') }}</dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Lokasi Temuan :</dt>
                                            <dd class="mt-1.5 text-base font-semibold text-gray-90">
                                                {{ $reportUser->lokasi_temuan }} </dd>
                                        </dl>

                                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                            <dt class="text-base font-medium text-gray-500">Status:</dt>
                                            <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-base font-medium
                                            @if ($reportUser->status == 'menunggu') bg-yellow-100 text-yellow-800"
                                            @elseif ($reportUser->status == 'disetujui')
                                                bg-green-100 text-green-800"
                                            @elseif ($reportUser->status == 'ditolak')
                                                bg-red-100 text-red-800"
                                            @elseif ($reportUser->status == 'diklaim')
                                                bg-blue-100 text-blue-800"
                                            @else
                                                bg-gray-100 text-gray-800" @endif
                                            <svg class="me-1
                                                h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                                </svg>
                                                {{ $reportUser->status }}
                                            </dd>
                                        </dl>
                                        <dl>
                                            <button class="open-modal-btn bg-primary px-4 py-2 rounded-lg bg-primary text-white text-sm font-semibold hover:bg-secondary transition-all duration-300 ease-in"
                                                data-reportId="{{ $reportUser->id }}"
                                                data-namabarangtemuan="{{ $reportUser->nama_barang_temuan }}"
                                                data-kategori="{{ $reportUser->kategori }}"
                                                data-waktuTemuan="{{ $reportUser->waktu_temuan }}"
                                                data-lokasiTemuan="{{ $reportUser->lokasi_temuan }}"
                                                data-regionKampus="{{ $reportUser->region_kampus }}"
                                                data-deskripsiUmum="{{ $reportUser->deskripsi_umum }}"
                                                data-deskripsiKhusus="{{ $reportUser->deskripsi_khusus }}"
                                                data-status="{{ $reportUser->status }}"
                                                data-fotoReport = "{{ json_encode($reportUser->foto_url) }}"
                                                data-reasonapproveorrejectreport= "{{ $reportUser->approve_reject_reason }}"
                                                onclick="openModalDetailReport(this)">Detail</button>
                                        </dl>
                                    </div>
                        @endforeach
                    @endif
                @else
                    <div class="flex flex-col items-center justify-center min-h-[50vh] py-8">
                        <a href="/" class="w-80 sm:w-96">
                            <img src="{{ asset('storage/not-found.svg') }}" alt="logo" class="w-full" />
                        </a>
                        <p class="mt-4 text-gray-500 text-center">Silakan pilih salah satu tab.</p>
                    </div>
                @endif

            </div>
        </div>

        <!-- Modal Report-->
        <div id="modalDetailsReport"
            class="fixed hidden z-50 inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full px-4 py-10">
            <div class="relative mx-auto max-w-2xl bg-white rounded-2xl shadow-lg">
                <!-- Close Button -->
                <div class="flex justify-end p-4">
                    <button onclick="closeModal('modalDetailsReport')" type="button"
                        class="text-gray-500 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Form Content -->
                <form action="{{ route('claim.submit') }}" method="POST" enctype="multipart/form-data"
                    class="px-6 pb-8">
                    @csrf

                    <h2 class="text-2xl font-bold text-center text-primary mb-6">Detail Barang Temuan</h2>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2 text-gray-700">Foto Barang</h3>
                        <div id="fotoReports" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <!-- JS akan inject <img> di sini -->
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                        <div>
                            <label for="namaBarangTemuanModal" class="block font-medium">Nama Barang</label>
                            <input type="text" id="namaBarangTemuanModal" name="namaBarangTemuanModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800"
                                readonly />
                        </div>

                        <div>
                            <label for="waktuTemuanModal" class="block font-medium">Waktu Temuan</label>
                            <input type="text" id="waktuTemuanModal" name="waktuTemuanModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800"
                                readonly />
                        </div>

                        <div>
                            <label for="kategoriModal" class="block font-medium">Kategori</label>
                            <input type="text" id="kategoriModal" name="kategoriModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800" />
                        </div>

                        <div>
                            <label for="lokasiTemuanModal" class="block font-medium">Lokasi Temuan</label>
                            <input type="text" id="lokasiTemuanModal" name="lokasiTemuanModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800" />
                        </div>

                        <div>
                            <label for="regionKampusModal" class="block font-medium">Region Kampus</label>
                            <input type="text" id="regionKampusModal" name="regionKampusModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800" />
                        </div>

                        <div>
                            <label for="statusReportModal" class="block font-medium">Status Report</label>
                            <input type="text" id="statusReportModal" name="statusReportModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800" />
                        </div>

                        <div>
                            <label for="deskripsiUmumModal" class="block font-medium">Deskripsi Umum</label>
                            <textarea id="deskripsiUmumModal" name="deskripsiUmumModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800 resize-none"
                                rows="3" required></textarea>
                        </div>


                        <div>
                            <label for="deskripsiKhususBarang" class="block font-medium">Deskripsi Khusus</label>
                            <textarea id="deskripsiKhususBarang" name="deskripsiKhususBarang"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800 resize-none"
                                rows="3" required></textarea>
                        </div>

                        <div id="reasonApproveOrRejectReportModal" class="md:col-span-2 hidden" >
                            <label class="block font-medium">Alasan Approval / Penolakan</label>
                            <textarea id="approvalReasonReportModalText" readonly rows="3"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-300 text-gray-800 resize-none"></textarea>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Claim -->
        <div id="modalDetailsClaims"
            class="fixed hidden z-50 inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full px-4 py-10">
            <div class="relative mx-auto max-w-2xl bg-white rounded-2xl shadow-lg">
                <!-- Close Button -->
                <div class="flex justify-end p-4">
                    <button onclick="closeModal('modalDetailsClaims')" type="button"
                        class="text-gray-500 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Form Content -->
                <form action="{{ route('claim.submit') }}" method="POST" enctype="multipart/form-data"
                    class="px-6 pb-8">
                    @csrf

                    <h2 class="text-2xl font-bold text-center text-primary mb-6">Detail Claim</h2>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2 text-gray-700">Bukti Kepemilikan</h3>
                        <div id="fotoClaimsModal" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <!-- JS akan inject <img> di sini -->
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 text-sm text-gray-700">
                        <div>
                            <label for="namaBarangTemuanClaimModal" class="block font-medium">Nama Barang</label>
                            <input type="text" id="namaBarangTemuanClaimModal" name="namaBarangTemuanClaimModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800"
                                readonly />
                        </div>

                        <div>
                            <label for="tanggalKlaimModal" class="block font-medium">Tanggal Klaim</label>
                            <input type="text" id="tanggalKlaimModal" name="tanggalKlaimModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800"
                                readonly />
                        </div>

                        <div>
                            <label for="statusKlaimModal" class="block font-medium">Status Claim</label>
                            <input type="text" id="statusKlaimModal" name="statusKlaimModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800" />
                        </div>


                        <div class="md:col-span-2">
                            <label for="deskripsiVerifikasiModal" class="block font-medium">Deskripsi Umum</label>
                            <textarea id="deskripsiVerifikasiModal" name="deskripsiVerifikasiModal"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-200 focus:outline-none text-gray-800 resize-none"
                                rows="3" required></textarea>
                        </div>
                        
                        <div id="reasonApproveOrRejectClaims" class="md:col-span-2 hidden">
                            <label class="block font-medium">Alasan Approval / Penolakan</label>
                            <textarea id="approvalReasonClaimModalText" readonly rows="3"
                                class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-300 text-gray-800 resize-none"></textarea>
                        </div>

                        <div id="sectionApprovedContactReport" class="mt-1 hidden">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 pb-2">Informasi Pelapor</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                                <div>
                                    <label class="block font-medium">Nama Pelapor</label>
                                    <input type="text" id="reportUserName" readonly
                                        class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-300 text-gray-800" />
                                </div>
                                <div>
                                    <label class="block font-medium">Number Phone</label>
                                    <input type="text" id="reportUserPhoneNumber" readonly
                                        class="w-full bg-gray-100 px-4 py-2 rounded-md border border-gray-300 text-gray-800" />
                                </div>

                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>

        </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', (event) => {
                event.target.form.submit();
            });
        });

        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = 'block'
            document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
        }

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = 'none'
            document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
        }

        // Close all modals when press ESC
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
                let modals = document.getElementsByClassName('modal');
                Array.prototype.slice.call(modals).forEach(i => {
                    i.style.display = 'none'
                })
            }
        };

        function openModalDetailReport(button) {
            const reportId = button.getAttribute('data-reportId');
            const namaBarangTemuan = button.getAttribute('data-namabarangtemuan');
            const kategori = button.getAttribute('data-kategori');
            const waktuTemuan = button.getAttribute('data-waktuTemuan');
            const lokasiTemuan = button.getAttribute('data-lokasiTemuan');
            const regionKampus = button.getAttribute('data-regionKampus');
            const deksripsiUmum = button.getAttribute('data-deskripsiUmum');
            const deksripsiKhusus = button.getAttribute('data-deskripsiKhusus');
            const status = button.getAttribute('data-status');
            const fotoUrl = button.getAttribute('data-fotoReport');
            const reasonApproveOrRejectReport = button.getAttribute('data-reasonapproveorrejectreport')


            // document.getElementById('reportId').value = id;
            document.getElementById('namaBarangTemuanModal').value = namaBarangTemuan;
            // Format waktuTemuan to "j F Y, G:i"
            if (waktuTemuan) {
                const date = new Date(waktuTemuan);
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                const dateStr = date.toLocaleDateString('id-ID', options);
                const timeStr = date.getHours() + ':' + String(date.getMinutes()).padStart(2, '0');
                document.getElementById('waktuTemuanModal').value = `${dateStr}, ${timeStr} WIB`;
            } else {
                document.getElementById('waktuTemuanModal').value = '';
            }
            document.getElementById('kategoriModal').value = kategori;
            document.getElementById('lokasiTemuanModal').value = lokasiTemuan;
            document.getElementById('regionKampusModal').value = regionKampus;
            document.getElementById('deskripsiUmumModal').value = deksripsiUmum;
            document.getElementById('deskripsiKhususBarang').value = deksripsiKhusus;
            document.getElementById('statusReportModal').value = status;
            document.getElementById('approvalReasonReportModalText').value = reasonApproveOrRejectReport;

            const reasonApproveOrRejectReportModal = document.getElementById('reasonApproveOrRejectReportModal');

            if( status === 'Disetujui' || status === 'Ditolak' ){
                reasonApproveOrRejectReportModal.classList.remove('hidden');
            } 


            const imageData = fotoUrl;
            const urls = imageData ? JSON.parse(imageData) : [];
            showImagesReport(urls);

            // console.log(urls);

            openModal('modalDetailsReport');
        }

        function openModalDetailClaim(button) {
            const claimId = button.getAttribute('data-claimId');
            const namaBarangTemuan = button.getAttribute('data-namabarangtemuan');
            const deskripsiVerifikasi = button.getAttribute('data-deksripsiVerifikasi');
            const statusKlaim = button.getAttribute('data-statusKlaim');
            const tanggalKlaim = button.getAttribute('data-tanggalKlaim');
            const fotoVerifikasi = button.getAttribute('data-fotoVerifikasi');
            const dataUserReportFoundName = button.getAttribute('data-userReportFoundname');
            const dataUserReportFoundPhoneNumber = button.getAttribute('data-userReportFoundPhoneNumber');
            const dataReasonApproveRejectClaim = button.getAttribute('data-reasonApproveRejectClaim');

            document.getElementById('namaBarangTemuanClaimModal').value = namaBarangTemuan;
            document.getElementById('tanggalKlaimModal').value = tanggalKlaim;
            document.getElementById('statusKlaimModal').value = statusKlaim;
            document.getElementById('deskripsiVerifikasiModal').value = deskripsiVerifikasi;
            document.getElementById('reportUserName').value = dataUserReportFoundName;
            document.getElementById('reportUserPhoneNumber').value = dataUserReportFoundPhoneNumber;
            document.getElementById('approvalReasonClaimModalText').value = dataReasonApproveRejectClaim;


            const reasonApproveOrRejectClaims = document.getElementById('reasonApproveOrRejectClaims');
            const sectionApprovedContactReport = document.getElementById('sectionApprovedContactReport');

            console.log(reasonApproveOrRejectClaims);

            if(statusKlaim === 'Disetujui' || statusKlaim === 'Ditolak'){
                reasonApproveOrRejectClaims.classList.remove('hidden');
            }

            if(statusKlaim === 'Disetujui'){
                sectionApprovedContactReport.classList.remove('hidden');
            }

            const imagesData = [];
            imagesData.push(fotoVerifikasi);
            showImagesClaim(imagesData);

            openModal('modalDetailsClaims');
        }

        // display images
        function showImagesReport(imageUrls) {
            const container = document.getElementById("fotoReports");
            container.innerHTML = ""; // Kosongkan dulu
            imageUrls.forEach(url => {
                const img = document.createElement("img");
                img.src = `storage/${url}`;
                img.alt = "Foto Barang";
                img.className = "w-full h-48 object-cover rounded-md border";
                container.appendChild(img);
            });
        }

        function showImagesClaim(imageUrls) {
            const container = document.getElementById("fotoClaimsModal");
            container.innerHTML = ""; // Kosongkan dulu
            imageUrls.forEach(url => {
                const img = document.createElement("img");
                img.src = `storage/${url}`;
                img.alt = "Foto verifikasi";
                img.className = "w-full h-48 object-cover rounded-md border";
                container.appendChild(img);
            });
        }
    </script>
@endsection
