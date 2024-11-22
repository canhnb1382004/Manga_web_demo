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
                    <form id="quickForm" action="{{ route('chapter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chapter's name</label>
                                <input type="text" name="chapter_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Chapter's name">
                            </div>    
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chapter's manga</label>
                                <select name="manga_name" id="manga-select" class="form-control" onchange="updateMangaId()">
                                    <option value="" disabled selected>Chọn manga</option> <!-- Option mặc định -->
                                    @foreach ($manga as $man)
                                        <option value="{{ $man->manga_name }}" data-id="{{ $man->manga_id }}">{{ $man->manga_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Trường ẩn để lưu manga_id -->
                            <input type="hidden" name="manga_id" id="manga-id">
                            <div class="form-group">
                                <label for="gallery_images">Chapter's images</label>
                                <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple accept="image/*">
                            </div>
                            <div id="image-preview" class="mt-3">
                                <!-- Hình ảnh sẽ được hiển thị ở đây -->
                            </div>
                            <div id="image-modal" class="image-modal">
                                <span id="close-modal" class="close">&times;</span>
                                <img class="modal-content" id="modal-image">
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
            <div class="col-md-6">
                <!-- right column -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <!-- CSS cho phần xem trước và phóng to ảnh -->
    <style>
        /* CSS cho phần xem trước ảnh */
        .img-preview {
            width: 100px;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            border: 2px solid #ddd;
            border-radius: 4px;
            transition: transform 0.2s;
        }
        
        .img-preview:hover {
            transform: scale(1.05);
            border-color: #007bff;
        }

        /* CSS cho popup ảnh lớn */
        .image-modal {
            display: none; /* Ẩn modal mặc định */
            position: fixed;
            z-index: 1000;
            top: 70px;
            left: 400px;
            width: 70%;
            height: 70%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8); /* Làm tối nền */
        }

        .modal-content {
            transform: scale(0.8); /* Phóng to ảnh gấp 5 lần */
            max-width: none; /* Bỏ giới hạn chiều rộng để đảm bảo kích thước mở rộng */
            max-height: none; /* Bỏ giới hạn chiều cao để đảm bảo kích thước mở rộng */
            border: 5px solid #fff;
            border-radius: 10px;
        }

        .close {
            position: absolute; /* Sử dụng fixed để nút đóng luôn nằm cố định */
            top: 20px;
            right: 35px;
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001; /* Đảm bảo nút nằm trên ảnh */
        }
    </style>

    <!-- JavaScript hiển thị xem trước ảnh và modal -->
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
