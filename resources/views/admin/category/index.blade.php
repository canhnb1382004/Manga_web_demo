@extends('admin.layout')

@section('content')

<div class="container mt-3">
  <h2>Category List</h2>
         
  <table class="table table-hover text-center">
    <thead>
      <tr>
        <th>No</th>
        <th>Category</th>
        <th>Manage</th>
        
      </tr>
    </thead>
    @foreach ($categories as $key => $cate )
        <tbody >
        <tr >
            <td>{{ $key + 1 }}</td>
            <td>{{$cate->category_name}}</td>
            <td><a href="{{route('category.edit',[$cate->category_id])}}"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
            <form action="{{route('category.destroy',[$cate->category_id])}}" method="POST">
              @method('DELETE')
              @csrf 
              <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></i></button>
            </form>
        </td>
        </tr>
        </tbody>
    @endforeach
    
    
  </table>

  <!-- Hiển thị phân trang -->
  <div class="d-flex justify-content-center">
    {{ $categories->links('pagination::bootstrap-4') }}
  </div>
@endsection