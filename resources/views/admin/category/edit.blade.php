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
                <h3 class="card-title">Create Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm"  action="{{route('category.update',[$category->category_id])}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method ('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Edit Category</label>
                    <input type="text" name="category_name" value='{{$category->category_name}}' class="form-control" id="exampleInputEmail1" placeholder="Enter New Category">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category's description</label>
                    <input type="text" name="category_description" class="form-control" id="exampleInputEmail1" placeholder="Enter Category's description">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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