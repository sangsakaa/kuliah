<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Manajemen Role') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2 grid grid-cols-1 sm:grid sm:grid-cols-2 gap-2">
        <div>
          <div>
            <span class=" text-red-700">
              @if(Session::has('message'))
              <div id="notification" class="alert {{ Session::get('alert-class', 'alert-info') }}">
                {{ Session::get('message') }}
              </div>
              @endif
              <script>
                // Fungsi untuk menghilangkan notifikasi setelah 5 detik
                setTimeout(function() {
                  var notification = document.getElementById('notification');
                  if (notification) {
                    notification.style.display = 'none';
                  }
                }, 5000); // 5000 milidetik = 5 detik
              </script>

            </span>
          </div>
          <form action="/role-management" method="post">
            @csrf
            <div class=" grid grid-cols-1 gap-2">
              <label for="">Name : </label>
              <input type="text" name="name" class=" py-1 sm:w-full" placeholder="contoh :  super admin">
              <small>@error('name')
                <div id="notification" class=" text-red-700">{{ $message }}</div>
                @enderror
              </small>
              <label for="">Guard Name : </label>
              <input type="text" name="guard_name" class=" py-1 w-full" placeholder="contoh :  super admin" value="web" readonly>
              <button class=" bg-blue-700 px-1 py-1 text-white w-fit">Create Role</button>
            </div>
          </form>
        </div>
        <div>
          <div>
            <div>
              <span>Role</span>
            </div>
            <table class=" w-full">
              <thead>
                <tr class=" border">
                  <th class=" border ">Name</th>
                  <th class=" border ">Guard Name</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $role)
                <tr class=" border">
                  <td class=" border px-1">{{ $role->name }}</td>
                  <td class=" border px-1 text-center">{{ $role->guard_name }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>