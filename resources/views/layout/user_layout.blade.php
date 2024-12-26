<html lang="vi">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Agu+Display&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('https://cdn.haitrieu.com/wp-content/uploads/2021/12/Logo-DH-Kinh-te-Ky-thuat-Cong-nghiep-UNETI.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <title>@yield('title')</title>
</head>

<body class="bg-gray-100">
    {{-- nav-bar --}}
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a class="flex items-center" href="/">
                <img alt="Ảnh logo cá nhân" class="" height="40"
                    src="https://cdn.haitrieu.com/wp-content/uploads/2021/12/Logo-DH-Kinh-te-Ky-thuat-Cong-nghiep-UNETI.png"
                    width="40" />
                <span class="ml-2 text-3xl" style="font-family: 'Agu Display', serif;">
                    Trang chủ
                </span>
            </a>
            <div class="hidden md:flex space-x-10">
                <a class="font-bold text-gray-700 hover:text-blue-500" href="#">
                    Giới thiệu
                </a>
                <div class="relative">
                    <button id="dropdownButton" class="font-bold text-gray-700 hover:text-blue-500 focus:outline-none">
                        Nghiên cứu khoa học
                    </button>
                    <div id="dropdownMenu" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden">
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/">
                            Công bố khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/sanpham">
                            Sản phẩm khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/giaithuong">
                            Giải thưởng khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/detai">
                            Đề tài khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/hoithao">
                            Hội thảo - Hội nghị
                        </a>
                    </div>
                </div>
                @if (Auth::check())
                    <div class="relative">
                        <button id="dropdownButton1" class="font-bold text-gray-700 hover:text-blue-500 focus:outline-none">
                            Đăng ký khoa học
                        </button>
                        <div id="dropdownMenu1" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden">
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/dktacgia">
                                Đăng ký quyền tác giả
                            </a>
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/dkdetai">
                                Đăng ký đề tài
                            </a>
                        </div>
                    </div>
                @endif
                <a class="font-bold text-gray-700 hover:text-blue-500" href="#">
                    Liên Hệ
                </a>
            </div>
            <div class="flex space-x-4">
                @if (Auth::check())
                    <div class="relative">
                        <button id="userDropdownButton" class="flex items-center focus:outline-none">
                            <span class="text-gray-700">Xin chào, {{ Auth::user()->name }}</span>
                            <img class="ml-2 rounded-full" src="{{ Auth::user()->avatar }}" alt="Avatar"
                                width="40" height="40">
                        </button>
                        <div id="userDropdownMenu"
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden">
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">
                                Thông tin cá nhân
                            </a>
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">
                                Đổi mật khẩu
                            </a>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" href="/reg">
                        Đăng ký
                    </a>
                    <a class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" href="/login">
                        Đăng nhập
                    </a>
                @endif
            </div>
        </div>
    </nav>
    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    <footer class="bg-white shadow mt-8">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h5 class="text-xl font-bold mb-4">
                        Về chúng tôi
                    </h5>
                    <p class="text-gray-700">
                        Chúng tôi là một tổ chức nghiên cứu khoa học hàng đầu, cam kết mang lại những nghiên cứu
                        chất
                        lượng và có giá trị cho cộng đồng.
                    </p>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">
                        Liên hệ
                    </h5>
                    <p class="text-gray-700">
                        Email: <a class="text-gray-700 hover:text-blue-500"
                            href="mailto:huypham140103@gmail.com">huypham140103@gmail.com</a>
                    </p>
                    <p class="text-gray-700">
                        Điện thoại: <a class="text-gray-700 hover:text-blue-500" href="tel: +84 379 395 645">+84 379
                            395 645</a>
                    </p>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">
                        Theo dõi chúng tôi
                    </h5>
                    <div class="flex space-x-4">
                        <a class="text-gray-700 hover:text-blue-500" href="#">
                            <i class="fab fa-facebook fa-2x">
                            </i>
                        </a>
                        <a class="text-gray-700 hover:text-blue-500" href="#">
                            <i class="fab fa-twitter fa-2x">
                            </i>
                        </a>
                        <a class="text-gray-700 hover:text-blue-500" href="#">
                            <i class="fab fa-linkedin fa-2x">
                            </i>
                        </a>
                        <a class="text-gray-700 hover:text-blue-500" href="#">
                            <i class="fab fa-instagram fa-2x">
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleViewButton = document.getElementById('toggleView');
            const userDropdownButton = document.getElementById('userDropdownButton');

            if (toggleViewButton) {
                toggleViewButton.addEventListener('click', function() {
                    selectButton(); // Đổi icon
                    toggleLayout(); // Thay đổi layout
                });
            }

            if (userDropdownButton) {
                userDropdownButton.addEventListener('click', function() {
                    const dropdownMenu = document.getElementById('userDropdownMenu');
                    dropdownMenu.classList.toggle('hidden');
                });
            }
        });

        function toggleLayout() {
            const researchContainer = document.getElementById('researchContainer');
            const researchItems = researchContainer.querySelectorAll('a');
            if (researchContainer.classList.contains('md:grid-cols-3')) {
                researchContainer.classList.remove('md:grid-cols-3');
                researchContainer.classList.add('md:grid-cols-1');
                researchItems.forEach(item => {
                    item.classList.add('flex', 'flex-col', 'md:flex-row', 'md:p-2');
                    const img = item.querySelector('img');
                    img.classList.add('md:w-1/6', 'md:mr-4');
                });
            } else {
                researchContainer.classList.remove('md:grid-cols-1');
                researchContainer.classList.add('md:grid-cols-3');
                researchItems.forEach(item => {
                    item.classList.remove('flex', 'flex-col', 'md:flex-row', 'md:p-2');
                    const img = item.querySelector('img');
                    img.classList.remove('md:w-1/6', 'md:mr-4');
                });
            }
        }
        document.getElementById('dropdownButton').addEventListener('click', function() {
            var dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        });
        window.addEventListener('click', function(event) {
            var dropdownMenu = document.getElementById('dropdownMenu');
            if (!event.target.matches('#dropdownButton')) {
                dropdownMenu.classList.add('hidden');
            }
        });
        document.getElementById('dropdownButton1').addEventListener('click', function() {
            var dropdownMenu = document.getElementById('dropdownMenu1');
            dropdownMenu.classList.toggle('hidden');
        });
        window.addEventListener('click', function(event) {
            var dropdownMenu = document.getElementById('dropdownMenu1');
            if (!event.target.matches('#dropdownButton1')) {
                dropdownMenu.classList.add('hidden');
            }
        });

        let isIcon1 = true;

        function selectButton() {
            const icon = document.getElementById('icon');
            if (isIcon1) {
                icon.classList.remove('fas', 'fa-bars');
                icon.classList.add('fas', 'fa-th');
            } else {
                icon.classList.remove('fas', 'fa-th');
                icon.classList.add('fas', 'fa-bars');

            }
            isIcon1 = !isIcon1;
        }
    </script>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</html>
