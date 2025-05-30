@extends('layouts.app')


@section('content')
    @php
        $jsReports = $reports->map(function ($report) {
            return [
                'id' => $report->id,
                'name' => $report->nama_barang_temuan,
                'url' => asset('storage/' . $report->foto_url[0]),
                'category' => $report->kategori,
                'description' => $report->deskripsi_umum,
                'date' => $report->waktu_temuan,
                'lokasi_temuan' => $report->lokasi_temuan,
                'region' => $report->region_kampus,
            ];
        });
        //dd($reports);
    @endphp
    <script>
        const reports = @json($jsReports);
        console.log(reports);
    </script>
    {{-- Hero section --}}
    <section id="hero" class="pb-8 pt-32 lg:pb-[70px] lg:pt-[120px]">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4 lg:w-2/3">
                    <div class="mb-12  lg:mb-0">
                        <h2
                            class="mb-5 text-3xl  font-bold leading-tight text-dark dark:text-primary sm:text-[40px] sm:leading-[1.2]">
                            @if (auth()->user())
                                Hai, {{ auth()->user()->name }}!
                            @else
                                Hai, warga Gundar!
                            @endif
                        </h2>
                        <p class=" text-xl font-medium leading-none">
                            Apa yang Anda ingin lakukan?
                        </p>
                        <div class="flex flex-col lg:flex-row gap-4 mt-5 items-center">
                            <a href="#catalog"
                                class="group transition-all duration-300 hover:bg-primary flex items-center justify-between p-6 rounded-xl shadow-lg bg-white max-w-md cursor-pointer">
                                <div>
                                    <h2
                                        class="text-xl font-bold text-primary mb-1  group-hover:text-white transition-all duration-300">
                                        Cari
                                    </h2>
                                    <p
                                        class="text-hitam text-sm  font-medium group-hover:text-white transition-all duration-300">
                                        Lihat katalog barang hilang <br />
                                        untuk menemukan barang Anda
                                    </p>
                                </div>
                                <img src="{{ asset('storage/hero-search.svg') }}" alt="Need Help Illustration"
                                    class="w-24 h-24 object-contain" />
                            </a>
                            <a href="{{ route('report.showForm') }}"
                                class="group transition-all duration-300 hover:bg-primary flex items-center justify-between p-6 rounded-xl gap-2 shadow-lg bg-white max-w-md cursor-pointer">
                                <div>
                                    <h2
                                        class="text-xl font-bold text-primary mb-1  group-hover:text-white transition-all duration-300">
                                        Lapor</h2>
                                    <p
                                        class="text-hitam text-sm  font-medium group-hover:text-white transition-all duration-300">
                                        Buat laporan terhadap barang <br />
                                        temuan dan pantau statusnya
                                    </p>
                                </div>
                                <img src="{{ asset('storage/hero-report.svg') }}" alt="Need Help Illustration"
                                    class="w-24 h-24 object-contain" />
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-full px-4 lg:w-1/3 h-full flex items-center justify-center">
                    <div class="flex flex-wrap items-center -mx-4 h-full">
                        <img src="{{ asset('storage/hero-section.svg') }}" class="w-96" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Catalog section --}}
    <section id="catalog" class="py-8 lg:py-[70px]">
        <div class="container px-4 mx-auto flex flex-col sm:flex-row gap-8 items-center">
            <!-- Search area -->
            <div class="relative w-full">
                <input type="text" id="search"
                    class="bg-white  text-base font-medium rounded-full border p-2 pl-10 transition-all ease-in duration-300 w-full focus:outline-primary"
                    placeholder="Search here..." />
                <svg class="absolute left-3 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                </svg>
            </div>

            <!-- Sort button -->
            <span class="relative text-center">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                    class="text-white text-base  font-semibold bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-secondary rounded-lg px-4 py-2.5 text-center inline-flex items-center"
                    type="button">
                    Urutkan
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown"
                    class="absolute left-0 top-full mt-3 z-50 hidden w-32 p-3 bg-white rounded-lg shadow-md">
                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                        <li class="flex items-center">
                            <input type="radio" name="sort" id="sort-none" value="none"
                                class="w-4 h-4 accent-primary" {{ request('sort') == 'none' ? 'checked' : '' }}>
                            <label for="sort-none" class="ml-2 font-medium text-hitam text-base">
                                Semua
                            </label>
                        </li>

                        <li class="flex items-center">
                            <input type="radio" name="sort" id="sort-category" value="category"
                                class="w-4 h-4 accent-primary" {{ request('sort') == 'category' ? 'checked' : '' }}>
                            <label for="sort-category" class="ml-2 font-medium text-hitam text-base">
                                Kategori
                            </label>
                        </li>

                        <li class="flex items-center">
                            <input type="radio" name="sort" id="sort-date" value="date"
                                class="w-4 h-4 accent-primary" {{ request('sort') == 'date' ? 'checked' : '' }}>
                            <label for="sort-date" class="ml-2 text-base font-medium text-hitam">
                                Tanggal
                            </label>
                        </li>

                        <li class="flex items-center">
                            <input type="radio" name="sort" id="sort-region" value="region"
                                class="w-4 h-4 accent-primary" {{ request('sort') == 'region' ? 'checked' : '' }}>
                            <label for="sort-region" class="ml-2 text-base font-medium text-hitam">
                                Region
                            </label>
                        </li>
                    </ul>
                </div>


            </span>
        </div>

        <main class="flex flex-col md:flex-row container mx-auto mt-10">
            <!-- Filters -->
            <div class="space-y-4 w-full md:w-1/5 px-4">
                <h2 class="text-2xl  font-bold">Filter</h2>
                {{-- Kategori --}}
                <h3 class="text-xl mb-2 font-semibold">Kategori</h3>
                <div id="filters-category" class="text-lg font-regular space-y-2">
                    @foreach ($categories as $category)
                        <div>
                            <input type="checkbox" class="text-lg check accent-primary" id="{{ $category }}"
                                name="categories[]" value="{{ $category }}" />
                            <label for="{{ $category }}">{{ ucfirst($category) }}</label>
                        </div>
                    @endforeach
                </div>
                {{-- Region --}}
                <h3 class="text-xl mb-2 font-semibold">Region</h3>
                <div id="filters-region" class="text-lg font-regular space-y-2">
                    @foreach ($regions as $region)
                        <div>
                            <input type="checkbox" class="text-lg check accent-primary" id="{{ $region }}"
                                name="regions[]" value="{{ $region }}" />
                            <label for="{{ $region }}">{{ ucfirst($region) }}</label>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Products wrapper -->
            <div id="products-wrapper"
                class="w-full md:w-4/5 grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-6 place-content-center p-4">
            </div>

            <div id="not-found" class="flex flex-col items-center justify-center min-h-[50vh] py-8">
                <a href="/" class="w-80 sm:w-96">
                    <img src="{{ asset('storage/not-found-report.svg') }}" alt="logo" class="w-96" />
                </a>
                <p class="mt-4 text-gray-500 text-center">Tidak ada barang yang ditemukan.</p>
            </div>
        </main>

    </section>
@endsection

@section('scripts')
    <script>
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        // Vanilla for sorting
        window.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.querySelector('[data-dropdown-toggle="dropdown"]');
            const dropdown = document.getElementById("dropdown");

            toggleBtn.addEventListener("click", function() {
                dropdown.classList.toggle("hidden");
            });

            // Optional: klik di luar dropdown menutup menu
            document.addEventListener("click", function(e) {
                if (!dropdown.contains(e.target) && !toggleBtn.contains(e.target)) {
                    dropdown.classList.add("hidden");
                }
            });
        });

        // Get DOM elements
        const productsWrapper = document.getElementById('products-wrapper');
        const checkboxes = document.querySelectorAll('.check');
        const filtersCategory = document.getElementById('filters-category');
        const filtersRegion = document.getElementById('filters-region');
        const searchInput = document.getElementById('search');

        // Initialize products
        const productElements = [];

        // Loop over the products and create the product elements

        productsWrapper.innerHTML = '';
        productElements.length = 0;

        let hasValidProduct = false;

        reports.forEach((product) => {
            if (!product.url || !product.name) return;

            const productElement = createProductElement(product);
            productElements.push(productElement);
            productsWrapper.appendChild(productElement);
            hasValidProduct = true;
        });

        const notFound = document.getElementById('not-found');

        if (!hasValidProduct) {
            productsWrapper.classList.add('hidden');
            notFound.classList.remove('hidden');
        } else {
            productsWrapper.classList.remove('hidden');
            notFound.classList.add('hidden');
        }

        // Add filter event listeners
        filtersCategory.addEventListener('change', filterProducts);
        filtersRegion.addEventListener('change', filterProducts);
        searchInput.addEventListener('input', filterProducts);

        // Function time ago
        function timeAgo(dateString) {
            const now = new Date();
            const past = new Date(dateString);
            const diffTime = now - past;
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays === 0) return 'Hari ini';
            if (diffDays === 1) return '1 hari yang lalu';
            if (diffDays < 7) return `${diffDays} hari yang lalu`;

            const diffWeeks = Math.floor(diffDays / 7);
            if (diffWeeks === 1) return '1 minggu yang lalu';
            if (diffWeeks < 5) return `${diffWeeks} minggu yang lalu`;

            const diffMonths = Math.floor(diffDays / 30);
            if (diffMonths === 1) return '1 bulan yang lalu';
            return `${diffMonths} bulan yang lalu`;
        }

        // Create product element
        function createProductElement(product) {
            const productElement = document.createElement('div');

            productElement.className = 'item space-y-2';

            const claimButton = isAuthenticated ?
                `<a href="report/${product.id}" class="block font-semibold text-sm text-black text-center">
      Klaim Barang
      </a>` :
                `<a href="/login" class="block font-semibold text-sm text-black text-center">
      Login untuk Klaim
      </a>`;


            productElement.innerHTML =
                `<div class="bg-gray-100 flex justify-center relative overflow-hidden group cursor-pointer border rounded-xl overflow-hidden">
      <div class="w-full aspect-[1/1]">
      <img src="${product.url}" alt="${product.name}" class="w-full h-full object-cover object-center"/>
      </div>
      <div class="absolute z-10 bottom-3 left-0 mx-3 p-2 bg-white w-[calc(100%-24px)] rounded-xl shadow-md opacity-0 translate-y-2 scale-95 transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:translate-y-0 group-hover:scale-100 cursor-pointer">
      ${claimButton}
      </div>
      </div>
      <p class="text-lg  font-semibold">${product.name}</p>
      <p class="text-sm  font-regular text-gray-800">${product.lokasi_temuan}</p>
      <p class="text-sm  font-regular text-gray-600">${product.region}</p>
      <p class="text-sm text-gray-400 ">${timeAgo(product.date)}</p>`;

            productElement
                .querySelector('.status')

            return productElement;
        }

        // Filter products by search or checkbox
        function filterProducts() {
            // Get search term
            const searchTerm = searchInput.value.trim().toLowerCase();
            // Get checked categories

            const categories = ['Alat Tulis', 'Elektronik', 'Alat Makan & Minum', 'Aksesoris', 'Lainnya'];

            const checkedCategories = Array.from(checkboxes)
                .filter((check) => check.checked && categories.includes(check.value))
                .map((check) => check.value);

            const regions = ["Depok", "Kalimalang", "Karawaci", "Cengkareng", "Salemba"];

            const checkedRegions = Array.from(checkboxes)
                .filter((check) => check.checked && regions.includes(check.value))
                .map((check) => check.value);


            // Loop over products and check for matches
            productElements.forEach((productElement, index) => {
                const product = reports[index];

                const matchesSearchTerm = product.name.toLowerCase().includes(searchTerm);
                const matchesCategory = checkedCategories.length === 0 || checkedCategories.includes(product
                    .category);
                const matchesRegion = checkedRegions.length === 0 || checkedRegions.includes(product.region);

                if (matchesSearchTerm && matchesCategory && matchesRegion) {
                    productElement.classList.remove('hidden');
                } else {
                    productElement.classList.add('hidden');
                }
            });
        }

        const anyVisible = productElements.some(el => !el.classList.contains('hidden'));

        if (!anyVisible) {
            productsWrapper.classList.add('hidden');
            notFound.classList.remove('hidden');
        } else {
            productsWrapper.classList.remove('hidden');
            notFound.classList.add('hidden');
        }

        document.querySelectorAll('input[name="sort"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                const selectedSort = this.value;
                const url = new URL(window.location.href);
                url.searchParams.set('sort', selectedSort);
                window.location.href = url.toString();
            });
        });
    </script>
@endsection
