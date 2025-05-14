<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riwayat - LostNFound</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
              },
              colors: {
                primary: '#773b97',
                secondary: '#a868cb',
                hitam: '1b1b1b',
                oren: '#f05a26',
                kuning: '#fbbc2a',
              },
            }
          }
        }
    </script>
</head>
<body class="font-poppins">
    {{-- Navbar --}}
    <div class="absolute top-0 left-0 z-40 w-full bg-transparent">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="/beranda" class="w-48">
                    <img src="{{ asset('storage/logo-lostnfound.svg') }}" alt="logo" class="w-full" />
                </a>
                <!-- User Icon -->
                <div class="group relative flex items-center">
                  <img src="{{ asset('storage/logo-user.svg') }}" class="w-12 cursor-pointer" />

                  <div class="absolute top-full right-0 mt-2 w-40 bg-white rounded-lg shadow-2xl origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-200">
                    <a href="/riwayat" class="block px-4 py-2 text-hitam hover:bg-gray-100 font-medium">Riwayat Klaim</a>
                    <a href="/logout" class="block px-4 py-2 text-hitam hover:bg-gray-100 font-medium">Keluar</a>
                  </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Klaim --}}
    <section class="bg-white pb-8 pt-32 lg:pb-[70px] lg:pt-[120px]">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h2 class="text-2xl font-semibold text-gray-900 sm:text-2xl">Riwayat Klaim</h2>

                <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                <div>
                    <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900">Select order type</label>
                    <select id="order-type" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 outline-none focus:ring-2 focus:ring-primary">
                    <option selected>Semua Klaim</option>
                    <option value="proses">Diproses</option>
                    <option value="setuju">Disetujui</option>
                    <option value="tolak">Ditolak</option>
                    </select>
                </div>

                <span class="inline-block"> dari </span>

                <div>
                    <label for="duration" class="sr-only mb-2 block text-sm font-medium">Select duration</label>
                    <select id="duration" class="block w-full rounded-lg border border-gray-300 p-2.5 text-sm outline-none focus:ring-2 focus:ring-primary">
                    <option selected>Minggu ini</option>
                    <option value="this month">Bulan ini</option>
                    <option value="last 3 months">3 bulan terakhir</option>
                    <option value="lats 6 months">6 bulan terakhir</option>
                    <option value="this year">Tahun ini</option>
                    </select>
                </div>
                </div>
            </div>

            <div class="mt-6 flow-root sm:mt-8">
                <div class="divide-y divide-gray-200">
                <div class="flex flex-wrap items-center gap-y-4 py-6">
                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Gambar</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                        <img src="{{ asset('storage/botol-minum-1.jpeg') }}" class="w-16"/>
                    </dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Nama:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900">Botol Minum Putih</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Tanggal Klaim:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-90">2025-05-14</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Status:</dt>
                    <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-base font-medium bg-yellow-100 text-yellow-800">
                        <svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                        </svg>
                        Diproses
                    </dd>
                    </dl>
                </div>

                <div class="flex flex-wrap items-center gap-y-4 py-6">
                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Gambar</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                        <img src="{{ asset('storage/botol-minum-1.jpeg') }}" class="w-16"/>
                    </dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Nama:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900">Botol Minum Putih</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Tanggal Klaim:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-90">2025-05-14</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Status:</dt>
                    <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-base font-medium bg-green-100 text-green-800">
                        <svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                        </svg>
                        Disetujui
                    </dd>
                    </dl>
                </div>
                
                <div class="flex flex-wrap items-center gap-y-4 py-6">
                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Gambar</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900">
                        <img src="{{ asset('storage/botol-minum-1.jpeg') }}" class="w-16"/>
                    </dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Nama:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900">Botol Minum Putih</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Tanggal Klaim:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-90">2025-05-14</dd>
                    </dl>

                    <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500">Status:</dt>
                    <dd class="me-2 mt-1.5 inline-flex items-center rounded px-2.5 py-0.5 text-base font-medium bg-red-100 text-red-800">
                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        Ditolak
                    </dd>
                    </dl>
                </div>
                </div>
            </div>

            <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                <ul class="flex h-8 items-center -space-x-px text-sm">
                <li>
                    <a href="#" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Previous</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">1</a>
                </li>
                <li>
                    <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">2</a>
                </li>
                <li>
                    <a href="#" aria-current="page" class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700">3</a>
                </li>
                <li>
                    <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">...</a>
                </li>
                <li>
                    <a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">100</a>
                </li>
                <li>
                    <a href="#" class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    <span class="sr-only">Next</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                    </a>
                </li>
                </ul>
            </nav>
            </div>
        </div>
</section>                            
</body>
</html>