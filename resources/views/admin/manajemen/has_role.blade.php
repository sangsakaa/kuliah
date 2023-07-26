<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Manajemen Has Role') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2 grid grid-cols-1 sm:grid sm:grid-cols-2 gap-2">
        <div>
          <div>
            <span class=" text-red-700">
              @if(Session::has('success'))
              <div id="notification" class="alert alert-success">
                {{ Session::get('success') }}
              </div>
              @endif

              @if(Session::has('error'))
              <div id="" class="alert alert-danger">
                {{ Session::get('error') }}
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
          <div>
            <span>Has Dosen</span>
            <form action="/has-role" method="post">
              @csrf
              <div class=" grid grid-cols-1 gap-2">
                <label for="">Role : </label>
                <select name="role_id" id="" class=" py-1 w-full">
                  <option value="">Pilih Role</option>
                  @foreach($role as $list)
                  <option value="{{$list->id}}">{{$list->name}}</option>
                  @endforeach
                </select>
                <select name="model_id" id="" class=" py-1 w-full capitalize">
                  <option value="">Pilih User</option>
                  @foreach($user as $list)
                  <option value="{{$list->dosen_id}}">{{strtolower($list->name)}}</option>
                  @endforeach
                </select>
                <input type="hidden" name="model_type" value="App\Models\User">
                <small>@error('name')
                  <div id="notification" class=" text-red-700">{{ $message }}</div>
                  @enderror
                </small>

                <button class=" bg-blue-700 px-1 py-1 text-white w-fit">Create Role</button>
              </div>
            </form>
          </div>
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

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>