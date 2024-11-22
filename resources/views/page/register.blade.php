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
</style>
<section class="content">
      <div class="container">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm"  action='{{route('user.store')}}' method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Account's name</label>
                    <input type="text" name="account_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Account's name">
                  </div>           
                  <div class="form-group">
                    <label for="exampleInputEmail1">Account's image</label>
                    <input type="file" name="account_avatar" class="form-control" id="exampleInputEmail1" placeholder="Enter Account's image">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Account's email</label>
                    <input type="email" name="account_email" class="form-control" id="exampleInputEmail1" placeholder="Enter Account's email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Account's password</label>
                    <input type="password" name="account_password" class="form-control" id="exampleInputEmail1" placeholder="Enter Account's password">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <script>
          $(document).ready(function() {
              $('.selectpicker').selectpicker();
          });
      </script>

      
</section>

<div class="spacer"></div>
@endsection