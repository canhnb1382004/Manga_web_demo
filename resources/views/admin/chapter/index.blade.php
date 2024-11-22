@extends('admin.layout')

@section('content')

<div class="container mt-3">
  <h2>Chapter List</h2>

  <!-- Form tìm kiếm -->
  <form action="{{ route('chapter.index') }}" method="GET" class="mb-3">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search by chapter name" value="{{ request('search') }}">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>

  <!-- Bảng dữ liệu -->
  <table class="table table-hover">
    <thead>
      <tr>
        <th>No</th>
        <th>Chapter's name</th>
        <th>Manga</th>
        <th>Content</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($chapter as $key => $chap )
        <tr>
            <td>{{ $key + 1 + ($chapter->currentPage() - 1) * $chapter->perPage() }}</td>
            <td>{{ $chap->chapter_name }}</td>
            <td>{{ $chap->manga->manga_name ?? 'N/A' }}</td>
            <td>
                <div class="container">
                    <div class="row">
                        @foreach ($gallery->where('chapter_id', $chap->chapter_id) as $gall)
                            <div class="col-1 mt-1 mr-1">
                                <img height="40" width="40" src="{{ asset('images/chapter/' . $gall->gallery_name) }}" alt="Chapter Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </td>
            <td>
                <a href="{{ route('chapter.edit', [$chap->chapter_id]) }}">
                    <button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button>
                </a>
                <form action="{{ route('chapter.destroy', [$chap->chapter_id]) }}" method="POST" style="display: inline-block;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>

  <!-- Hiển thị phân trang -->
  <div class="d-flex justify-content-center">
    {{ $chapter->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
  </div>

</div>

@endsection
