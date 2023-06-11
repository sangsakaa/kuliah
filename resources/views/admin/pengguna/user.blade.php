<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div>
        <form action="/create-user" method="post">
          @csrf
          <button>coba</button>
        </form>
      </div>
      <div class="p-4 bg-white  border-gray-200">
        <div>
          <table class=" w-full">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              @foreach($AdminUser as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>

                  <a href="/data-user">
                    {{$user->id}}
                  </a>

                  </form>

                </td>

              </tr>
              @endforeach
            </tbody>
          </table>



        </div>
      </div>
    </div>
  </div>





</x-app-layout>