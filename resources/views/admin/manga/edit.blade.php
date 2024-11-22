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
              <form id="quickForm" action='{{route('manga.update',[$manga->manga_id])}}' method="POST" enctype="multipart/form-data">
                @csrf
                @method ('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's name</label>
                    <input type="text" name="manga_name" class="form-control" id="exampleInputEmail1" value="{{$manga->manga_name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's other name</label>
                    <input type="text" name="manga_othername" class="form-control" id="exampleInputEmail1" value="{{$manga->manga_othername}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's image</label>
                    <input type="file" name="manga_img" class="form-control" id="exampleInputEmail1" value="{{$manga->manga_img}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's author</label>
                    <input type="text" name="manga_author" class="form-control" id="exampleInputEmail1" value="{{$manga->manga_author}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Manga's description</label>
                    <input type="text" name="manga_description" class="form-control" id="exampleInputEmail1" value="{{$manga->manga_description}}">
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
                    <select name="category_id[]" class="form-control" multiple>
                        <option value="" disabled>Choose Manga's category</option>
                        @foreach ($category as $key => $cate)
                        <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
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
</section>


@endsection