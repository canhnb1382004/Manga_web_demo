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
                <h3 class="card-title">Create New Chapter</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action='{{route('chapter.update',[$chapter->chapter_id])}}' method="POST" enctype="multipart/form-data">
                @csrf
                @method ('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chapter's name</label>
                    <input type="text" name="chapter_name" class="form-control" id="exampleInputEmail1" value="{{$chapter->chapter_name}}">
                  </div>
                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Chapter's manga</label>
                      <select name="manga_name" id="manga-select" class="form-control" onchange="updateMangaId()">
                            <option >{{$chapter->manga_name}}</option>
                          @foreach ($manga as $man)
                              <option >{{ $man->manga_name }}</option>
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
      <script>
        function updateMangaId() {
            const select = document.getElementById('manga-select');
            const selectedOption = select.options[select.selectedIndex];
            const mangaId = selectedOption.getAttribute('data-id');
            document.getElementById('manga-id').value = mangaId;
        }

        document.getElementById('gallery_images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Xóa nội dung trước đó

            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-preview');
                        previewContainer.appendChild(img);

                        img.addEventListener('click', function() {
                            const modal = document.getElementById('image-modal');
                            const modalImg = document.getElementById('modal-image');
                            modal.style.display = 'block';
                            modalImg.src = e.target.result;
                        });
                    };

                    reader.readAsDataURL(file);
                }
            }
        });

        document.getElementById('close-modal').onclick = function() {
            document.getElementById('image-modal').style.display = 'none';
        };
    </script>

      
</section>


@endsection