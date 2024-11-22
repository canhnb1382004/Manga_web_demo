@extends('admin.layout')

@section('content')

<div class="container mt-3">
<br>    
  <h3 class="mx-3">Manga List</h3>
  <br>     
  <table class="table table-hover text-center">
    <thead>
      <tr>
        <th>No.</th>
        <th>Manga's name</th>
        <th>Manga's othername</th>
        <th>Manga's image</th>
        <th>Manga's author</th>
        <th>Manga's description</th>
        <th>Manga's status</th>
        <th>Category name</th>
        
      </tr>
    </thead>
    @foreach ($manga as $key => $man )
    <tbody>
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $man->manga_name }}</td>
        <td>{{ $man->manga_othername }}</td>
        <td><img height="80" width="80" src="{{ asset('public/images/manga/' . $man->manga_img) }}"></td>
        <td>{{ $man->manga_author }}</td>
        <td>{{ $man->manga_description }}</td>
        <td>{{ $man->manga_status }}</td>
        <td>
            @foreach ($man->categories as $category)
                <div>{{ $category->category_name }}</div>
            @endforeach
        </td>
        <td>
            <a href="{{ route('manga.edit', [$man->manga_id]) }}">
                <button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button>
            </a>
            <form action="{{ route('manga.destroy', [$man->manga_id]) }}" method="POST" style="display: inline-block;">
                @method('DELETE')
                @csrf 
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
            </form>
        </td>
    </tr>
    </tbody>
@endforeach


    
    
  </table>

  <!-- Hiển thị phân trang -->
  <div class="d-flex justify-content-center">
    {{ $manga->links('pagination::bootstrap-4') }}
  </div>
@endsection