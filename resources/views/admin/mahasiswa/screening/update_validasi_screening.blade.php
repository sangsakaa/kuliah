<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      @section('title', ' | Update Validasi Screening ')
    </h2>
  </x-slot>
  <div class=" w-full p-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-6 sm:flex grid grid-cols-1 sm:grid-cols-2">
        <div class=" w-1/3">
          <form action="/update-validasi-pendaftaran/{{$file_screenig->id}}" method="post">
            @csrf
            @method('patch')
            <input hidden type="text" name="mahasiswa_id" class=" py-1" value="{{$file_screenig->mahasiswa_id}}">
            <input hidden type="text" name="file" class=" py-1" value="{{$file_screenig->file}}">
            <label for="">Status file</label> <br>
            <select name="status_file" id="" class="py-1  w-full mb-2">
              <option value="">-- Pilih Status Validasi Dokumen --</option>
              <option value="Valid" {{ old('status_file', $file_screenig->status_file) == 'Valid' ? 'selected' : '' }}>
                Valid
              </option>
              <option value="Invalid" {{ old('status_file', $file_screenig->status_file) == 'Invalid' ? 'selected' : '' }}>
                Invalid
              </option>
            </select> <br>
            <button class="  bg-purple-700 px-2 py-1 text-white">Update</button>
            <a href="/daftar-screening-mahasiswa" class="  bg-purple-700 px-2 py-1 text-white">Kembali</a>
          </form>
        </div>
        <div class=" w-full">
          <iframe src="{{ Storage::url('screenings/' . $file_screenig->file) }}" style="width: 100%; height: 600px;" class=" w-full px-2 py-1 text-white">
            Your browser does not support iframes.
          </iframe>
        </div>
      </div>

    </div>
  </div>
</x-app-layout>