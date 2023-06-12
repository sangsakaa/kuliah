<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div>
        @role('dosen')
        <form action="/create-user" method="post">
          @csrf
          <button>coba</button>
        </form>
        @endrole
      </div>
    </div>
  </div>
</x-app-layout>