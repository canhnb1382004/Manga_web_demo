@extends('admin.layout')

@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Manga</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action='{{route('manga.store')}}' method="POST" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's name</label>
                    <input type="text" name="manga_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Manga's name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's other name</label>
                    <input type="text" name="manga_othername" class="form-control" id="exampleInputEmail1" placeholder="Enter Manga's other name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's image</label>
                    <input type="file" name="manga_img" class="form-control" id="exampleInputEmail1" placeholder="Enter Manga's image">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's author</label>
                    <input type="text" name="manga_author" class="form-control" id="exampleInputEmail1" placeholder="Enter Manga's author">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's description</label>
                    <input type="text" name="manga_description" class="form-control" id="exampleInputEmail1" placeholder="Enter Manga's description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's status</label>
                    <select name="manga_status" type="text" class="form-control">
                      <option value="" disabled selected>Choose Manga's status</option>
                      <option>Đang Cập Nhật</option>
                      <option>Hoàn Thành</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Manga's category</label>
                      <select name="category_id[]" id="category_id" class="form-control selectpicker" multiple data-live-search="true" data-selected-text-format="count > 3">
                          @foreach ($category as $cate)
                              <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                          @endforeach
                      </select>
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


@endsection