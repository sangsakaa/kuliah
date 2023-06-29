<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Supervisi') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/laporan-supervisi-dosen/{{$supervisi->id}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class=" grid grid-cols-1 text-left">
            <label for="">1. Kondisi Umum</label>
            <input type="hidden" name="supervisi_id" value="{{$supervisi->id}}" class=" py-1">
            @foreach($lapSupervisi as $super)
            <input required type="text" value="{{$super->kondisi_umum}}" name="kondisi_umum" class=" py-1">
            <label for="">2. Kegiatan Kelompok</label>
            <div>
              <img class=" p-2" src="{{ asset('storage/' . $super->bukti_laporan_supervisi) }}" alt="" width="500" height="600">
            </div>
            <div class=" grid grid-cols-1 sm:grid-cols-2 gap-1">
              <div class=" grid grid-cols-1">
                <label for="">a. Realisasi Kegiatan Sesuai Program</label>
                <textarea required name="realisasi_kegiatan" id="" class="w-full    " cols="30" rows="10">{{$super->realisasi_kegiatan}}</textarea>
              </div>
              <div class=" text-left grid grid-cols-1">
                <label for="">b. Program yang belum terlaksana</label>
                <textarea required name="tidak_realisasi_kegiatan" id="" class="w-full text-left  " cols="30" rows="10"><?php echo !empty($super->tidak_realisasi_kegiatan) ? $super->tidak_realisasi_kegiatan : ""; ?></textarea>
              </div>
              <div class=" grid grid-cols-1">
                <label for="">3. Kendala</label>
                <textarea required name="kendala" id="" class="w-full  " cols="30" rows="5">{{$super->kendala}}</textarea>
              </div>
              <div class=" grid grid-cols-1">
                <label for="">4. Rencana Tidak Lanjut</label>
                <textarea required name="rencana_tindak_lanjut" id="" class="w-full   " cols="30" rows="5">{{$super->rencana_tindak_lanjut}}</textarea>
              </div>
            </div>
          </div>
          <input type="file" id="fileInput" accept="image/*" name="bukti_laporan_supervisi" value="{{ asset($super->bukti_laporan_supervisi) }}">
          @endforeach
          <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>