@extends('admin.layout')

@section('content')

<div class="container mt-3">
<br>    
  <h3 class="mx-3">Manga List</h3>
  <br>     
  <table class="table table-hover table-responsive text-center">
    <thead>
      <tr>
        <th>No.</th>
        <th>User's name</th>
        <th>User's avatar</th>
        <th>User's email</th>
        <th>User's password</th>
        <th>User's role</th>
        <th>Edit role</th>
        <th>Manage</th>
      </tr>
    </thead>
    @foreach ($users as $key => $user )
    <tbody>
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $user->name }}</td>
        <td><img height="80" width="80" src="{{ asset('public/images/user/' . $user->avatar) }}"></td>               
        <td>{{ $user->email }}</td>
        <td style="width:200px !important;">
          <!-- Mật khẩu được ẩn mặc định -->
          <span id="password-{{ $user->id }}" class="password-text">********</span>
          <button type="button" class="btn btn-info btn-sm" onclick="togglePasswordVisibility('{{ $user->id }}')">Hiện</button>
        </td>
        <td>
          @if($user->role == 1)
            <p>Admin</p>
          @else
            <p>Member</p>
          @endif
        </td>
        <td>
        <form action="{{ route('user.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="container">
            <div class="row">
              <select class='col-7' name="role" id="role">
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Member</option>
              </select>
              <button type="submit" class="col-5 btn btn-primary">Cập nhật</button>
            </div>
          </div>        
        </form>  
        </td>
        <td>
            <form action="{{ route('manga.destroy', [$user->id]) }}" method="POST" style="display: inline-block;">
                @method('DELETE')
                @csrf 
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
            </form>
        </td>
    </tr>
    </tbody>
    @endforeach
  </table>

  <!-- JavaScript để ẩn và hiện mật khẩu -->
  <script>
    function togglePasswordVisibility(userId) {
        var passwordElement = document.getElementById("password-" + userId);
        var buttonElement = passwordElement.nextElementSibling; // nút bên cạnh mật khẩu

        // Kiểm tra xem mật khẩu hiện tại có bị ẩn không
        if (passwordElement.innerText === '********') {
            // Nếu mật khẩu đang bị ẩn, hiển thị mật khẩu
            passwordElement.innerText = '{{ $user->password }}'; // Thay {{ $user->password }} bằng mật khẩu thực tế
            buttonElement.innerText = 'Ẩn';
        } else {
            // Nếu mật khẩu đang hiển thị, ẩn mật khẩu
            passwordElement.innerText = '********';
            buttonElement.innerText = 'Hiện';
        }
    }
  </script>
  <!-- Hiển thị phân trang -->
  <div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-4') }}
  </div>
@endsection
