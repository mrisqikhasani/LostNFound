@extends('layouts.app')

@section('content')
  {{-- Details section --}}
  <div class="pb-8 pt-32 lg:pb-[70px] lg:pt-[120px]">
    <div class="container mx-auto px-4 py-8">

    <div class="flex flex-wrap -mx-4">
      @if (session('error'))
      <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
      {{ session('error') }}
      </div>
    @endif
      <!-- Product Images -->
      <div class="w-full md:w-1/2 px-4 mb-8">
      @if (!empty($reportById->foto_url) && is_array($reportById->foto_url))
      <img src="{{ asset('storage/' . $reportById->foto_url[0]) }}" alt="Product"
        class="w-full h-auto rounded-lg border mb-4" id="mainImage">
      <div class="flex gap-4 py-4 justify-center overflow-x-auto">
        @foreach ($reportById->foto_url as $foto)
      <img src="{{ asset('storage/' . $foto) }}" alt="Thumbnail"
      class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
      onclick="changeImage(this.src)">
      @endforeach
      @else
      <span class="text-gray-400 text-sm">Tidak ada foto tambahan</span>
      @endif
        <!-- <img src="{{ asset('storage/botol-minum-2.jpg') }}" alt="Thumbnail 2"
                    class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                    onclick="changeImage(this.src)">
              <img src="{{ asset('storage/botol-minum-1.jpeg') }}" alt="Thumbnail 3"
                    class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                    onclick="changeImage(this.src)">
              <img src="{{ asset('storage/botol-minum-2.jpg') }}" alt="Thumbnail 4"
                    class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                    onclick="changeImage(this.src)"> -->
      </div>
      </div>


      <!-- Product Details -->
      <div class="w-full md:w-1/2 px-4">
      <div class="px-4 w-36 my-3 py-1 border-2 border-primary text-primary rounded-full text-xl font-medium">
        Ditemukan
      </div>
      <h2 class="text-3xl font-bold mb-2">{{ $reportById->nama_barang_temuan }}</h2>

      <div class="mb-4 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 text-hitam mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span class="text-slate-400 text-sm font-medium">{{ $reportById->waktu_temuan }}</span>
      </div>
      <div class="mb-4 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 text-hitam mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
        </svg>
        <span class="text-hitam text-lg font-medium">{{ $reportById->lokasi_temuan }}</span>
      </div>
      <div class="mb-4 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 text-hitam mr-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
        </svg>
        <span class="text-hitam text-lg font-medium">{{ $reportById->region_kampus }}</span>
      </div>
      <h3 class="text-2xl font-bold mb-2">Informasi Tambahan</h3>
      <p class="text-gray-900 mb-2">Botol minum ini ditemukan di wastafel kamar mandi lantai 2 kampus F4,
        memiliki
        merk Lock & Lock</p>
      <p class="text-gray-500 mb-6">Ditemukan oleh {{ $reportById->user->name }}</p>
      <div class="flex space-x-4 mb-6">
        <button onclick="openModal('modelConfirm')"
        class="bg-primary flex gap-2 items-center border-2 border-primary text-white font-semibold transition-all ease-in duration-300 px-6 py-2 rounded-md hover:bg-primary hover:outline-none hover:border-primary hover:text-primary hover:bg-transparent hover:border-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
          stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
          d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
        </svg>
        Klaim
        </button>
      </div>
      </div>
    </div>
    </div>
  </div>

  {{-- Modal --}}
  <div id="modelConfirm" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
    <div class="relative top-10 mx-auto shadow-xl rounded-lg bg-white max-w-md">
    <div class="flex justify-end p-2">
      <button onclick="closeModal('modelConfirm')" type="button"
      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
        clip-rule="evenodd"></path>
      </svg>
      </button>
    </div>

    <form action="{{ route('claim.submit') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h1 class="text-center items-center font-semibold text-xl">Klaim Barang</h1>

      <div class="p-6">
      {{-- textarea --}}
      <label class="block text-lg font-medium text-left" for="deskripsi_verifikasi">Bukti Kepemilikan</label>
      <textarea type="text" id="deskripsi_verifikasi" name="deskripsi_verifikasi"
        class="mt-1 px-3 py-2 border rounded-lg w-full outline-none focus:ring-2 focus:ring-primary"
        placeholder="Saya memiliki barang ini. Saya membelinya di toko ..." required></textarea>

      {{-- photo --}}
      <label class="block mt-5 text-lg font-medium text-left" for="nama-barang">Upload Bukti</label>
      <div class="flex flex-col w-full mt-1">
        <label for="dropzone-file" id="select-button"
        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-transparent hover:bg-purple-50">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
          <svg class="w-8 h-8 mb-4 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 20 16">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
          </svg>
          <p class="mb-2 text-sm text-primary"><span class="font-semibold">Click to upload</span> or
          drag and drop</p>
          <p class="text-xs text-primary">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
        </div>
        <input id="dropzone-file" type="file" name="foto_verifikasi" class="hidden" multiple accept="image/*" />
        </label>
        <div id="selected-files-count" class="text-primary text-sm font-medium mt-4"></div>
        <div id="selected-images" class="flex flex-wrap -mx-2 mt-6"></div>
      </div>

      <label class="block mt-5 text-lg font-medium text-left" for="nama-pemilik">Nama</label>
      <input type="text" id="nama-pemilik" name="nama-pemilik"
        class="mt-1 px-3 py-2 border rounded-lg w-full outline-none focus:ring-2 focus:ring-primary"
        placeholder="Masukkan Nama Anda" value="{{ auth()->user()->name }}" required />

      <input type="hidden" id="report_id" name="report_id"
        class="mt-1 px-3 py-2 border rounded-lg w-full outline-none focus:ring-2 focus:ring-primary"
        placeholder="Masukkan Nama Anda" value="{{ $reportById->id }}" required />


      <label class="block mt-5 text-lg font-medium text-left" for="notelp-pemilik">Nomor Telepon</label>
      <input type="text" id="notelp-pemilik" name="notelp-pemilik"
        class="mt-1 px-3 py-2 border rounded-lg w-full outline-none focus:ring-2 focus:ring-primary"
        value="{{ auth()->user()->phone_number }}" placeholder="Masukkan Nomor Telepon Anda" required />

      <button type="submit"
        class="text-white mt-10 bg-primary hover:bg-secondary focus:ring-4 focus:ring-primary font-medium rounded-lg text-base inline-flex items-center px-5 py-2.5 text-center mr-2">
        Submit
      </button>
      </div>

    </form>
    </div>
  </div>

  </div>

@endsection


@section('scripts')
  <script>
    function changeImage(src) {
    document.getElementById('mainImage').src = src;
    }

    window.openModal = function (modalId) {
    document.getElementById(modalId).style.display = 'block'
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
    }

    window.closeModal = function (modalId) {
    document.getElementById(modalId).style.display = 'none'
    document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
    }

    // Close all modals when press ESC
    document.onkeydown = function (event) {
    event = event || window.event;
    if (event.keyCode === 27) {
      document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
      let modals = document.getElementsByClassName('modal');
      Array.prototype.slice.call(modals).forEach(i => {
      i.style.display = 'none'
      })
    }
    };

    const fileInput = document.getElementById("dropzone-file");
    const selectedImages = document.getElementById("selected-images");
    const selectedFilesCount = document.getElementById("selected-files-count");

    fileInput.addEventListener("change", function () {
    const fileList = this.files;
    displayImages(fileList);
    });

    function displayImages(fileList) {
    selectedImages.innerHTML = "";
    for (const file of fileList) {
      const imageWrapper = document.createElement("div");
      imageWrapper.classList.add("relative", "mx-2", "mb-2");

      const image = document.createElement("img");
      image.src = URL.createObjectURL(file);
      image.classList.add("w-32", "h-32", "object-cover", "rounded-lg");

      const removeButton = document.createElement("button");
      removeButton.innerHTML = "&times;";
      removeButton.classList.add(
      "absolute", "top-1", "right-1", "h-6", "w-6",
      "bg-gray-700", "text-white", "text-xs", "rounded-full",
      "flex", "items-center", "justify-center", "opacity-50",
      "hover:opacity-100", "transition-opacity", "focus:outline-none"
      );

      removeButton.addEventListener("click", () => {
      imageWrapper.remove();
      updateSelectedFilesCount();
      });

      imageWrapper.appendChild(image);
      imageWrapper.appendChild(removeButton);
      selectedImages.appendChild(imageWrapper);
    }

    updateSelectedFilesCount();
    }

    function updateSelectedFilesCount() {
    const count = selectedImages.children.length;
    if (count > 0) {
      selectedFilesCount.textContent = `${count} file${count === 1 ? "" : "s"} selected`;
    } else {
      selectedFilesCount.textContent = "";
    }
    }

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
  </script>
@endsection