<html lang="vi">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Agu+Display&display=swap" rel="stylesheet">
    <link rel="icon"
        href="{{ asset('https://cdn.haitrieu.com/wp-content/uploads/2021/12/Logo-DH-Kinh-te-Ky-thuat-Cong-nghiep-UNETI.png') }}"
        type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            <a class="flex items-center" href="{{ Auth::check() ? '/user' : '/' }}">
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
                    <div id="dropdownMenu" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden z-50">
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                            href="{{ Auth::check() ? '/user' : '/' }}">
                            Công bố khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/detai">
                            Đề tài khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/giaithuong">
                            Giải thưởng khoa học
                        </a>
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="/hoithao">
                            Hội thảo - Hội nghị
                        </a>
                    </div>
                </div>
                @if (Auth::check() && Auth::user()->phan_quyen == 'user')
                    <div class="relative">
                        <button id="dropdownButton1"
                            class="font-bold text-gray-700 hover:text-blue-500 focus:outline-none z-10">
                            Đăng ký khoa học
                        </button>
                        <div id="dropdownMenu1" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden z-50">
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
                @if (Auth::check() && Auth::user()->phan_quyen == 'user')
                    <div class="relative">
                        <button id="userDropdownButton" class="flex items-center focus:outline-none">
                            <span class="text-gray-700">Xin chào, {{ Auth::user()->ten_nguoi_dung }}</span>
                            <img class="ml-2 rounded-full" src="{{ Auth::user()->avatar }}" alt="Avatar"
                                width="40" height="40">
                        </button>
                        <div id="userDropdownMenu"
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden z-50">
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">
                                Thông tin cá nhân
                            </a>
                            <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="">
                                Đổi mật khẩu
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
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
    <!-- Banner Section -->
    @if (Route::currentRouteName() !== 'login' && Route::currentRouteName() !== 'reg')
    <div class="container mx-auto mt-4">
        @foreach (\App\Http\Controllers\SiteController::getBanner() as $banner)
            <div class="relative w-full h-64">
                <img src="{{$banner->banner}}" alt="Banner Image" class="w-full h-full object-cover rounded-t-md">
            </div>
            <div class="w-full text-red-600 py-2 rounded-b-md">
                <marquee behavior="scroll" direction="left" class="text-lg font-bold">
                    {{$banner->text}}
                </marquee>
            </div>
        @endforeach
    </div>
    @endif

    <div class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-12 gap-4">
        <!-- Left Content -->
        <div class="content_left col-span-12 md:col-span-2 bg-white p-4 shadow rounded">
            <h2 class="text-xl font-bold mb-4">
                <i class="fas fa-list"></i>
                Loại đề tài
            </h2>
            <ul class="space-y-2">
                @foreach ($categories as $category)
                    <li class="border-b border-gray-500">
                        <a class="text-gray-700 hover:text-blue-500"
                            href="{{ route('user.index', ['danhMucDeTai' => $category->id]) }}">
                            {{ $category->ten_danh_muc }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <h2 class="text-xl font-bold mt-4 mb-4">
                <i class="fas fa-link"></i>
                Liên kết site
            </h2>
            <ul class="space-y-4">
                @foreach (\App\Http\Controllers\SiteController::getLienKetSites() as $lienKetSite)
                    <li class="flex flex-col items-center">
                        <a href="{{ $lienKetSite->lien_ket }}" target="_blank"
                            class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                            <img src="{{ $lienKetSite->img }}" alt="" class="w-full h-20 rounded-md">
                            {{ $lienKetSite->tieu_de }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- content --}}
        <div class="content_main col-span-12 md:col-span-8 bg-white p-6 shadow rounded">
            @yield('content')
        </div>

        <!-- Right Content -->
        <div class="content_right col-span-12 md:col-span-2 bg-white p-4 shadow rounded">
            <h2 class="text-xl font-bold mb-4">
                Giới thiệu khoa</h2>
            <iframe class="w-full border-b border-gray-300 pb-2" src="https://www.youtube.com/embed/M0Rx-ONjNWY"
                title="KHOA CÔNG NGHỆ THÔNG TIN - Trường Đại học Kinh tế - Kỹ thuật Công nghiệp" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <h2 class="text-xl font-bold mb-4 mt-4">
                <i class="far fa-bell"></i>
                Thông báo
            </h2>
            <ul class="space-y-4">
                @foreach (\App\Http\Controllers\SiteController::getThongBaos() as $thongBao)
                    <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                        <img src="{{ $thongBao->img }}" alt="Notification Image" class="w-16 h-16 rounded-md">
                        <a href="{{ $thongBao->lien_ket }}" target="_blank"
                            class="text-gray-700 hover:text-blue-500"
                            style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $thongBao->tieu_de }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- footer --}}
    <footer class="bg-white shadow mt-8">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="col-span-12 md:col-span-3">
                    <h5 class="text-xl font-bold mb-4">
                        Về chúng tôi
                    </h5>
                    @foreach ($thanhViens as $thanhVien)
                        <p class="text-gray-700">
                            <strong>
                                Thành viên:
                            </strong>
                            {{ $thanhVien->thanh_vien }},
                        </p>
                    @endforeach
                </div>
                <div class="col-span-12 md:col-span-5">
                    <h5 class="text-xl font-bold mb-4">
                        Liên hệ
                    </h5>
                    @if (count($thanhViens) > 0)
                        @php $thanhVien = $thanhViens[0]; @endphp

                        @if (!empty($thanhVien->khoa))
                            <p class="text-black-900">
                                Đơn vị: <a class="text-gray-700 hover:text-blue-500"
                                    href="">{{ $thanhVien->khoa }}</a>
                            </p>
                        @endif

                        @if (!empty($thanhVien->dia_chi))
                            <p class="text-black-900">
                                Địa chỉ: <a class="text-gray-700 hover:text-blue-500"
                                    href="">{{ $thanhVien->dia_chi }}</a>
                            </p>
                        @endif

                        @if (!empty($thanhVien->email))
                            <p class="text-black-900">
                                Email: <a class="text-gray-700 hover:text-blue-500"
                                    href="mailto:{{ $thanhVien->email }}">{{ $thanhVien->email }}</a>
                            </p>
                        @endif

                        @if (!empty($thanhVien->so_dien_thoai))
                            <p class="text-black-900">
                                Điện thoại: <a class="text-gray-700 hover:text-blue-500"
                                    href="tel:{{ $thanhVien->so_dien_thoai }}">{{ $thanhVien->so_dien_thoai }}</a>
                            </p>
                        @endif
                    @endif
                </div>
                <div class="col-span-12 md:col-span-4">
                    <h5 class="text-xl font-bold mb-4">
                        Xem trên bản đồ
                    </h5>
                    <div class="mt-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.3063140004333!2d105.87322541110561!3d20.980354980576248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135afd765487289%3A0x21bd5839ba683d5f!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBLaW5oIFThur8gS-G7uSBUaHXhuq10IEPDtG5nIE5naGnhu4dw!5e0!3m2!1svi!2sus!4v1737168059081!5m2!1svi!2sus"
                            class="w-full h-48 rounded-lg" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
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
