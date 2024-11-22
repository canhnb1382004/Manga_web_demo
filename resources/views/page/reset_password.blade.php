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
        height: 100px; /* Điều chỉnh chiều cao khoảng trắng */
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
                        <h3 class="card-title">Hello {{$user->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" action="{{ route('reset_password', ['user_id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Enter New Password" value="{{ old('new_password') }}" required>
                            </div>
                            <div class="form-group">
                                <label>New Password Again</label>
                                <input type="password" name="new_password_again" class="form-control" placeholder="Enter New Password Again" value="{{ old('new_password_again') }}" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                    <!-- Display errors if any -->
                    
                    @if ($errors->has('password_error'))
                        <div class="alert alert-danger mt-2">
                            {{ $errors->first('password_error') }}
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
