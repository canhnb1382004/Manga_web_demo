<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Truyện Của Tom</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<style>
    .avatar {
        width: 40px; /* Điều chỉnh kích thước theo nhu cầu */
        height: 40px;
        border-radius: 50%; /* Bo tròn ảnh */
        object-fit: cover; /* Đảm bảo ảnh vừa khít vào khung */
    }
    /* Điều chỉnh chiều rộng tối thiểu cho dropdown */
    .dropdown-menu {
        min-width: 800px !important; /* Điều chỉnh kích thước theo nhu cầu */
        background-color: greenyellow!important;
    }

    /* Căn chỉnh các mục bên trong theo dạng lưới */
    .dropdown-menu .container .row {
        display: flex;
        flex-wrap: wrap;
    }

    .dropdown-menu .dropdown-item {
        flex: 1 1 45%; /* Điều chỉnh tỷ lệ để các mục bên trong vừa đủ không gian */
        padding: 5px; /* Thêm khoảng cách giữa các item */
    }

    .dropdown-menu {
        min-width: 300px; /* Điều chỉnh kích thước theo nhu cầu */
        display: none; /* Ẩn menu theo mặc định */
        position: absolute;
    }

    .dropdown-hover {
        cursor: pointer;
    }

    /* Vòng tròn ấn vào */
    .chat-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        padding: 15px;
        cursor: pointer;
        font-size: 24px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    /* Phần chat */
    #chat {
        position: fixed;
        bottom: 0;
        right: 0;
        width: 300px;
        height: 400px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 10px 10px 0 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
    }

    #messages {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    #message-input {
        width: 100%;
        padding: 10px;
        border: none;
        border-top: 1px solid #ccc;
    }
</style>

<header>
    <div class="container mt-3 mb-4">
        <div class="row align-items-center">
            <div class="col-1 logo_header text-center">
                <a href="{{ asset('/') }}"><img src="{{ asset('images/logo.jpg') }}" alt="Company Logo" class="img-fluid"></a>
            </div>
            <div class="col-7 search_header">
                <form action="{{ route('search_manga') }}" method="GET">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm manga...">
                </form>
            </div>
            <div class="col-4 button_header">
                <div class="d-flex align-items-center justify-content-end">
                    @if(Auth::check())
                        <!-- Hiển thị tên người dùng và nút logout -->
                        <span class="mx-2"><strong>Xin Chào :</strong> {{ Auth::user()->name }}</span>
                        <img src="{{ asset('public/images/user/' . Auth::user()->avatar) }}" class="avatar">
                        <!-- Kiểm tra vai trò của người dùng -->
                        @if(Auth::user()->role == '1')
                        <button class="btn btn-success mx-2">
                            <a href="{{ url('/admin') }}" style="color: white; text-decoration: none;">Admin</a>
                        </button>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-info mx-2">Logout</button>
                        </form>
                    @else
                        <!-- Hiển thị nút đăng nhập và đăng ký nếu chưa đăng nhập -->
                        <button type="button" class="btn btn-info mx-2">
                            <a href="{{ asset('/login') }}" style="color: white; text-decoration: none;">Đăng Nhập</a>
                        </button>
                        <button type="button" class="btn btn-info mx-2">
                            <a href="{{ asset('/register') }}" style="color: white; text-decoration: none;">Đăng Kí</a>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid title_header">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-2 text-center"><a href="{{ asset('/') }}">Home</a></div>

                    <!-- Dropdown Menu -->
                    <div class="col-1 text-center">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="menuDropdown">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($cate as $category1)
                                            <a class="col-3 dropdown-item" href="{{ route('category_detail', [$category1->category_id] ) }}">
                                                {{ $category1->category_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 text-center"><a href="https://www.facebook.com/truyenqqq">Fanpage</a></div>
                </div>                  
            </div>                    
        </div>
    </div>
</header>

<div class="layout_content">
    @yield('content')
</div>

<!-- Vòng tròn ấn vào để mở chat -->
<div id="chat-toggle" class="chat-toggle">
    <i class="fa fa-comments"></i> <!-- Biểu tượng chat -->
</div>

<!-- Phần chat -->
<div id="chat">
    <div id="messages">
        <!-- Tin nhắn sẽ được thêm vào đây -->
    </div>
    <input type="text" id="message-input" placeholder="Nhập tin nhắn...">
    <button onclick="sendMessage()">Gửi</button>
</div>

<script>
    // Hàm hiển thị/ẩn phần chat
    document.getElementById('chat-toggle').addEventListener('click', function() {
        const chatDiv = document.getElementById('chat');
        if (chatDiv.style.display === 'none' || chatDiv.style.display === '') {
            chatDiv.style.display = 'block';
        } else {
            chatDiv.style.display = 'none';
        }
    });

    // Lấy tin nhắn từ API và hiển thị chúng
    function fetchMessages() {
        fetch('/chat')
            .then(response => response.json())
            .then(data => {
                const messagesDiv = document.getElementById('messages');
                messagesDiv.innerHTML = ''; // Xóa tin nhắn cũ
                data.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.textContent = `${message.user.name}: ${message.message}`;
                    messagesDiv.appendChild(messageElement);
                });
            });
    }

    // Gửi tin nhắn mới
    function sendMessage() {
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value;
        messageInput.value = '';

        fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        });
    }

    // Lắng nghe các tin nhắn mới từ Pusher và cập nhật giao diện
    const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        encrypted: true
    });

    const channel = pusher.subscribe('chat');
    channel.bind('MessageSent', function(data) {
        const messagesDiv = document.getElementById('messages');
        const messageElement = document.createElement('div');
        messageElement.textContent = `${data.message.user.name}: ${data.message.message}`;
        messagesDiv.appendChild(messageElement);
    });

    // Lấy tin nhắn ngay khi tải trang
    fetchMessages();
</script>

<footer style="padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row footer_color"></div>
        <div class="row mb-3">
            <div class="col-6"><a href="{{ asset('/') }}"><img src="{{ asset('images/logo.jpg') }}" alt="Company Logo" class="img-fluid"></a></div>
            <div class="col-6 ">
                <div class="container">
                    <div class="row mt-3 mb-3">
                        <div class="col ">
                            @foreach ($cate as $category1)
                                <a href="{{ route('category_detail', [$category1->category_id] ) }}">
                                    <button type="button" class="btn btn-outline-warning">{{ $category1->category_name }}</button>
                                </a>
                            @endforeach   
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
</footer>

<script>
    window.Echo.channel('chat')
    .listen('MessageSent', (event) => {
        console.log(event.message);
        // Hiển thị tin nhắn trong giao diện
    });
</script>

<!-- Bootstrap JS + Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
