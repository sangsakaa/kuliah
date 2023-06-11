<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div>
        @role('super admin')
        <form action="/create-user" method="post">
          @csrf
          <button>coba</button>
        </form>
        @endrole
      </div>
      <div class="p-4 bg-white  border-gray-200">
        <div class=" w-full grid grid-cols-1 sm:grid-cols-4">

          <div>NIM</div>
          <div class="hidden sm:block">
            : {{$data->nim}}
          </div>
          <div>Pembimbing</div>
          <div> : {{$data->nama_dosen}}</div>
          <div>Nama Mahasiswa</div>
          <div> : {{$data->nama_mhs}}</div>
          <div>Nama Kelompok</div>
          <div> : Kelompok {{$data->nama_kelompok}}</div>
        </div>
      </div>
      <div>
        <!DOCTYPE html>
        <html>

        <head>
          <title>Unggah Gambar dengan Kamera</title>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        </head>

        <body>
          <h1>Unggah Gambar dengan Kamera</h1>

          <form id="uploadForm" method="post" enctype="multipart/form-data">
            <input type="file" id="fileInput" accept="image/*" capture="camera">
            <button type="submit">Unggah</button>
          </form>

          <script>
            $(document).ready(function() {
              $('#fileInput').on('change', function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                  $('#preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
              });

              $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                var file = $('#fileInput')[0].files[0];
                var formData = new FormData();
                formData.append('file', file);

                // Kirim formData ke server (Anda dapat menggunakan Ajax atau teknik lainnya untuk mengirim data ke server)

                // Contoh menggunakan Ajax untuk mengirim formData ke server
                $.ajax({
                  url: 'server_upload_script.php', // Ganti dengan URL ke skrip server yang akan menghandle unggahan gambar
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    // Tanggapan dari server setelah berhasil mengunggah gambar
                    alert('Gambar berhasil diunggah!');
                  },
                  error: function(xhr, status, error) {
                    // Tanggapan dari server jika terjadi kesalahan
                    alert('Terjadi kesalahan saat mengunggah gambar: ' + error);
                  }
                });
              });
            });
          </script>
        </body>

        </html>

      </div>
    </div>
  </div>





</x-app-layout>