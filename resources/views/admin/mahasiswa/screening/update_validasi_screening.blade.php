<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      @section('title', ' | Update Validasi Screening ')
    </h2>
  </x-slot>
  <div class=" w-full p-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-6">
        <form action="/update-validasi-pendaftaran/{{$file_screenig->id}}" method="post">
          @csrf
          @method('patch')
          <input hidden type="text" name="mahasiswa_id" class=" py-1" value="{{$file_screenig->mahasiswa_id}}">
          <input hidden type="text" name="file" class=" py-1" value="{{$file_screenig->file}}">
          <label for="">Status file</label>
          <select name="status_file" id="" class="py-1 w-1/3">
            <option value="">-- Pilih Status Anak --</option>
            <option value="Valid" {{ old('status_file', $file_screenig->status_file) == 'Valid' ? 'selected' : '' }}>
              diTerima
            </option>
            <option value="Invalid" {{ old('status_file', $file_screenig->status_file) == 'Invalid' ? 'selected' : '' }}>
              diTolak
            </option>
          </select>
          <button class=" bg-purple-700 px-2 py-1 text-white">Update</button>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>