<!DOCTYPE html>
<html lang="en">
<head>
    <title>Klaim - LostNFound</title>
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
<body>
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

    <section id="hero" class="pb-8 pt-32 lg:pb-[70px] lg:pt-[120px] font-poppins">
      <div class="container px-4 mx-auto font-poppins">
          <!-- Back Button -->
          <div class="flex flex-col pb-12">
            <a href="/beranda">
              <button class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7m0 0l7-7"></path>
                </svg>
              </button>
            </a>
          </div>

          <!-- Form Start -->
          <form action="#" method="POST">
            <!-- Contact Info -->
            <div class="mt-3">
              <h2 class="text-3xl font-semibold text-left">Laporkan Barang</h2>
              <p class="text-base font-regular text-left text-gray-500">Laporkan barang yang Anda temukan di sekitar kampus</p>

              <label class="block mt-10 text-lg font-medium text-left" for="nama-barang">Apa yang Anda temukan?*</label>
              <input
                type="text"
                id="nama-barang"
                name="nama-barang"
                class="mt-1 px-3 py-2 border rounded-lg w-96 outline-none focus:ring-2 focus:ring-primary"
                placeholder="Botol Tuppleware Ungu"
                required
              />

              <label class="block mt-10 text-lg font-medium text-left" for="category">Pilih Kategori</label>
              <select
                id="kategori"
                name="kategori"
                class="mt-1 px-3 py-2 border rounded-lg w-96 outline-none focus:ring-2 focus:ring-primary"
                required
              >
                <option value="" disabled selected>Kategori Barang</option>
                <option value="stationery">Alat Tulis</option>
                <option value="elektronik">Elektronik</option>
                <option value="tableware">Alat Makan & Minum</option>
                <option value="aksesoris">Aksesoris</option>
              </select>

              <label class="block mt-10 text-lg font-medium text-left" for="nama-barang">Upload Foto</label>
              <div class="flex flex-col w-full mt-1">
                <label for="dropzone-file" id="select-button" class="flex flex-col items-center justify-center w-full h-50 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-transparent hover:bg-purple-50">
                  <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-primary"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-primary">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                  </div>
                  <input id="dropzone-file" type="file" class="hidden" multiple accept="image/*" />
                </label>
                <div id="selected-files-count" class="text-primary text-sm font-medium mt-4"></div>
                <div id="selected-images" class="flex flex-wrap -mx-2 mt-6"></div>
              </div>
            </div>

            <div class="flex flex-col md:flex-row md:gap-10 mt-10">
              <div>
                <label class="block text-lg font-medium text-left" for="tanggal">Kapan Anda menemukannya?</label>
                <input
                  type="date"
                  id="tanggal"
                  name="tanggal"
                  class="mt-1 px-3 py-2 border rounded-lg w-96 outline-none focus:ring-2 focus:ring-primary"
                  required
                />
              </div>
              <div class="mt-6 md:mt-0">
                <label class="block text-lg font-medium text-left" for="region">Dimana Anda menemukannya?</label>
                <select
                  id="region"
                  name="region"
                  class="mt-1 px-3 py-2 border rounded-lg w-96 outline-none focus:ring-2 focus:ring-primary"
                  required
                >
                  <option value="" disabled selected>Region</option>
                  <option value="depok">Depok</option>
                  <option value="kalimalang">Kalimalang</option>
                  <option value="karawaci">Karawaci</option>
                  <option value="cengkareng">Cengkareng</option>
                  <option value="salemba">Salemba</option>
                </select>
              </div>
            </div>

            <label class="block mt-10 text-lg font-medium text-left" for="deskripsi">Deskripsi barang</label>
            <textarea
              id="deskripsi"
              name="deskripsi"
              class="mt-1 px-3 py-2 border rounded-lg w-full outline-none focus:ring-2 focus:ring-primary"
              placeholder="Ditemukan di tangga E-Lounge Kampus E"
              rows="4"
              required
            ></textarea>

            <!-- Button Actions -->
            <div class="mt-10 flex justify-end">
              <a href="/complete-checkout">
                <button
                  type="button"
                  class="rounded-lg py-3 px-10 text-center bg-primary font-semibold text-lg text-white hover:bg-secondary transition-all duration-300"
                >
                  Kirim
                </button>
              </a>
            </div>
          </form>

      </div>
    </section>

  <script>
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
  </script>

</body>
</html>