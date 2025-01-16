<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 h-screen">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white h-screen p-5 fixed">
            <h2 class="text-3xl font-bold text-center mb-6">NCKH Admin</h2>
            <ul>
                <li class="mb-4">
                    <a href="/admin/dashboard" class="flex items-center space-x-3 hover:bg-blue-700 p-2 rounded">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/admin/qluser" class="flex items-center space-x-3 hover:bg-blue-700 p-2 rounded">
                        <i class="fas fa-users"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/admin/qltacgia" class="flex items-center space-x-3 hover:bg-blue-700 p-2 rounded">
                        <i class="fas fa-user-tie"></i>
                        <span>Quản lý tác giả</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/admin/qlbaiviet" class="flex items-center space-x-3 hover:bg-blue-700 p-2 rounded">
                        <i class="fas fa-file-alt"></i>
                        <span>Quản lý bài viết</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/admin/qldetai" class="flex items-center space-x-3 hover:bg-blue-700 p-2 rounded">
                        <i class="fas fa-project-diagram"></i>
                        <span>Quản lý đề tài</span>
                    </a>
                </li>
                <li class="mb-4">
                    <a href="/admin/qldanhmuc" class="flex items-center space-x-3 hover:bg-blue-700 p-2 rounded">
                        <i class="fas fa-list"></i>
                        <span>Quản lý loại đề tài</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6 ml-64 overflow-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold">@yield('title')</h1>
                <div class="flex items-center space-x-4">
                    <button class="relative focus:outline-none">
                        <i class="fas fa-bell text-gray-700 text-xl"></i>
                        <span
                            class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold rounded-full px-1">3</span>
                        <div class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border"
                            id="notificationMenu">
                            <ul>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer">
                                    Phê duyệt tác giả
                                </li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer">
                                    Phê duyệt bài báo
                                </li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer">
                                    Phê duyệt đề tài
                                </li>
                            </ul>
                        </div>
                    </button>
                    @if(Auth::check() && Auth::user()->phan_quyen == 'admin')
                    <button id="userMenuButton" class="focus:outline-none flex items-center space-x-2">
                        <span class="text-gray-700">Xin chào, {{ Auth::User()->ten_nguoi_dung }}</span>
                        <img class="w-7 h-7 rounded-full cursor-pointer"
                            src="{{ Auth::User()->avatar }}"
                            alt="Avatar" />
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="userMenu"
                        class="mt-6 hidden absolute right-0 top-12 bg-white rounded-lg shadow-lg border w-40 transition-all duration-300 transform scale-95 origin-top-right">
                        <ul>
                            <li class="p-2 hover:bg-gray-100 cursor-pointer flex items-center space-x-2 transition-colors duration-200">
                                <i class="fas fa-door-open text-gray-600"></i>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="font-medium text-gray-700">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Content -->
            @yield('content')
    </div>
    <style>
        #notificationMenu {
            z-index: 50; /* Đảm bảo menu thông báo luôn hiển thị trên các phần tử khác */
        }
    </style>
<script>
    const bell = document.querySelector("button");
    const notificationMenu = document.getElementById("notificationMenu");
    bell.addEventListener("click", () => {
        notificationMenu.classList.toggle("hidden");
    });

    const userMenuButton = document.getElementById("userMenuButton");
    const userMenu = document.getElementById("userMenu");

    // Toggle hiển thị menu khi nhấn vào "Xin chào, Admin" hoặc avatar
    userMenuButton.addEventListener("click", () => {
        userMenu.classList.toggle("hidden");
        userMenu.classList.toggle("scale-100");
    });

    // Đóng menu khi click ra ngoài
    document.addEventListener("click", (event) => {
        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add("hidden");
            userMenu.classList.remove("scale-100");
        }
    });
</script>
</body>

</html>
