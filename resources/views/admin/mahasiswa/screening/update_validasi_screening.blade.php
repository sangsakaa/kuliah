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
            </select>
            <select name="kelompok" id="" class="py-1 w-full">
              <option value="">-- Pilih Kelompok --</option>
              <option value="1" @selected($file_screenig->kelompok == 1)>-- Kelompok 1 --</option>
              <option value="2" @selected($file_screenig->kelompok == 2)>-- Kelompok 2 --</option>
              <option value="3" @selected($file_screenig->kelompok == 3)>-- Kelompok 3 --</option>
              <option value="4" @selected($file_screenig->kelompok == 4)>-- Kelompok 4 --</option>
              <option value="5" @selected($file_screenig->kelompok == 5)>-- Kelompok 5 --</option>
              <option value="6" @selected($file_screenig->kelompok == 6)>-- Kelompok 6 --</option>
              <option value="7" @selected($file_screenig->kelompok == 7)>-- Kelompok 7 --</option>
              <option value="8" @selected($file_screenig->kelompok == 8)>-- Kelompok 8 --</option>
              <option value="9" @selected($file_screenig->kelompok == 9)>-- Kelompok 9 --</option>
            </select>

            <br>
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