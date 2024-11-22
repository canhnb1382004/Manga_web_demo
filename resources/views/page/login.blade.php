@extends('page.layout')

@section('content')
<style>
        /* Thiết lập flex cho toàn bộ trang */
        body, html {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        /* Đặt khoảng trắng cho nội dung chính */
        
        .layout_content {
            flex: 1; /* Để layout_content chiếm không gian còn lại */
            padding-bottom: 50px; /* Khoảng cách dưới cùng */
        }
        
        /* Khoảng trắng cố định dưới nội dung */
        .spacer {
            height: 200px; /* Điều chỉnh chiều cao khoảng trắng */
        }
        .text-right {
        text-align: right;
        }
    </style>
<section class="content">
      <div class="container">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Login Account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="{{ route('login') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="email">Account's Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Account's Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                  </div>
                  <div class="text-right">
                      <a href="{{route('check_info')}}" class="forgot-password">Forgot Password ?</a>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </form>
              <!-- Display login errors if they exist -->
              @if ($errors->has('login_error'))
                <div class="alert alert-danger mt-2">
                  {{ $errors->first('login_error') }}
                </div>
              @endif
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          <div class="col-md-6">
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      
</section>
<div class="spacer"></div>
@endsection
