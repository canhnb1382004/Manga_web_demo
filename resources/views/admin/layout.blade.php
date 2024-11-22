<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
      <!-- CSS cho Bootstrap Select -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
   </head>
   <style>
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
   <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
      <div class="wrapper">
         <!-- Preloader -->
         <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
         </div>
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
               </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  @if(Auth::check())
                     <!-- Hiển thị tên người dùng và nút logout -->
                     <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                         @csrf
                         <button type="submit" class="btn btn-info mx-2">Logout</button>
                     </form>
                  @else
                     <!-- Hiển thị nút đăng nhập và đăng ký nếu chưa đăng nhập -->
                     <button type="button" class="btn btn-info mx-2"><a href="{{asset('/login')}}">Đăng Nhập</a></button>
                     <button type="button" class="btn btn-info mx-2"><a href="{{asset('/register')}}">Đăng Kí</a></button>
                  @endif
               </li>
               <li>
                  <button class="btn btn-success mx-2">
                     <a href="{{ url('/') }}" style="color: white; text-decoration: none;">Giao Diện</a>
                  </button>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                     <i class="fas fa-expand-arrows-alt"></i>
                  </a>
               </li>
            </ul>
         </nav>

         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
               <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
               <span class="brand-text font-weight-light">Trang Admin</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="{{ asset('public/images/user/' . Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                  </div>
               </div>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <li class="nav-item">
                        <a href="#" class="nav-link active">
                           <i class="fa-solid fa-list"></i>
                           <p>Category <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{route('category.index')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Index</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{route('category.create')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link active">
                           <i class="fa-solid fa-book"></i>
                           <p>Manga <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{route('manga.index')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Index</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{route('manga.create')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link active">
                           <i class="fa-regular fa-copy"></i>
                           <p>Chapter <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{route('chapter.index')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Index</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{route('chapter.create')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link active">
                           <i class="fa-regular fa-user"></i>
                           <p>User <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{route('user.index')}}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Index</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </nav>
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
            </script>
         </aside>

         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            @yield('content')
         </div>

         <!-- Main Footer -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
         </footer>
      </div>

      <!-- REQUIRED SCRIPTS -->
      <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
      <script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- Real-time Chat JavaScript -->
   </body>
</html>
