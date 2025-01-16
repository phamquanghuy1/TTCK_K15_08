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
                    <div id="dropdownMenu" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md hidden">
                        <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                            href="{{ Auth::check() ? '/user' : '/' }}">
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
                @if (Auth::check() && Auth::user()->phan_quyen == 'user')
                    <div class="relative">
                        <button id="dropdownButton1"
                            class="font-bold text-gray-700 hover:text-blue-500 focus:outline-none">
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
                @if (Auth::check() && Auth::user()->phan_quyen == 'user')
                    <div class="relative">
                        <button id="userDropdownButton" class="flex items-center focus:outline-none">
                            <span class="text-gray-700">Xin chào, {{ Auth::user()->ten_nguoi_dung }}</span>
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
                <li class="flex flex-col items-center">
                    <a href="https://congthuong.vn/" target="_blank" class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2022/09/z3682683099624_b8470248d9d432ed326c991e23a66fda.jpg" alt="" class="w-full h-20 rounded-md">
                        Báo công thương
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="https://moet.gov.vn/Pages/home.aspx" target="_blank" class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2019/11/x1.png" alt="Bộ Giáo dục - Đào tạo" class="w-full h-20 rounded-md">
                        Bộ Giáo dục - Đào tạo
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="https://moit.gov.vn/" target="_blank" class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2019/11/x1.png" alt="Bộ Công thương" class="w-full h-20 rounded-md">
                        Bộ Công thương
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="http://www.thanhdoanhanoi.gov.vn/" target="_blank" class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2019/11/x2.png" alt="Thanh Đoàn Hà Nội" class="w-full h-20 rounded-md">
                        Thanh Đoàn Hà Nội
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="http://khoacntt.uneti.edu.vn" target="_blank" class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2020/11/logo.jpg" alt="Khoa Công nghệ thông tin" class="w-full h-20 rounded-md">
                        Khoa Công nghệ thông tin
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="http://khoadientu.uneti.edu.vn/" target="_blank" class="text-gray-700 hover:text-blue-500 border-b border-gray-300 pb-1 text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2020/11/logo.jpg" alt="Khoa điện tử" class="w-full h-20 rounded-md">
                        Khoa điện tử
                    </a>
                </li>
                <li class="flex flex-col items-center">
                    <a href="https://example.com/ngan-hang-aribank" target="_blank" class="text-gray-700 hover:text-blue-500  text-center mt-1 w-full">
                        <img src="https://uneti.edu.vn/wp-content/uploads/2019/11/x5.png" alt="Ngân hàng Aribank" class="w-full h-20 rounded-md">
                        Ngân hàng Aribank
                    </a>
                </li>
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
                <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                    <img src="https://uneti.edu.vn/wp-content/uploads/2024/08/2-3.jpg" alt="Notification Image"
                        class="w-16 h-16 rounded-md">
                    <a href="https://uneti.edu.vn/bo-truong-bo-cong-thuong-trao-bang-khen-cho-truong-dai-hoc-kinh-te-ky-thuat-cong-nghiep-vi-co-thanh-tich-xuat-sac-trong-cong-tac-chi-dao-trien-khai-va-to-chuc-thuc-hien-cuoc-thi-vi/"
                        target="_blank" class="text-gray-700 hover:text-blue-500"
                        style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        Bộ trưởng Bộ Công Thương trao Bằng khen cho Trường Đại học Kinh tế – Kỹ thuật Công nghiệp
                    </a>
                </li>
                <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                    <img src="https://uneti.edu.vn/wp-content/uploads/2022/05/loa-thong-bao.jpg"
                        alt="Notification Image" class="w-16 h-16 rounded-md">
                    <a href="https://uneti.edu.vn/thong-bao-ve-viec-to-chuc-cac-lop-hoc-lai-hoc-cai-thien-trong-hk-ii-nam-hoc-2022-2023/"
                        target="_blank" class="text-gray-700 hover:text-blue-500"
                        style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        Thông báo về việc tổ chức các lớp học lại, học cải thiện trong HK II năm học 2022 – 2023
                    </a>
                </li>
                <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                    <img src="https://uneti.edu.vn/wp-content/uploads/2024/08/2-3.jpg" alt="Notification Image"
                        class="w-16 h-16 rounded-md">
                    <a href="https://uneti.edu.vn/bo-truong-bo-cong-thuong-trao-bang-khen-cho-truong-dai-hoc-kinh-te-ky-thuat-cong-nghiep-vi-co-thanh-tich-xuat-sac-trong-cong-tac-chi-dao-trien-khai-va-to-chuc-thuc-hien-cuoc-thi-vi/"
                        target="_blank" class="text-gray-700 hover:text-blue-500"
                        style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        Bộ trưởng Bộ Công Thương trao Bằng khen cho Trường Đại học Kinh tế – Kỹ thuật Công nghiệp
                    </a>
                </li>
                <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                    <img src="https://uneti.edu.vn/wp-content/uploads/2024/08/2-3.jpg" alt="Notification Image"
                        class="w-16 h-16 rounded-md">
                    <a href="https://uneti.edu.vn/bo-truong-bo-cong-thuong-trao-bang-khen-cho-truong-dai-hoc-kinh-te-ky-thuat-cong-nghiep-vi-co-thanh-tich-xuat-sac-trong-cong-tac-chi-dao-trien-khai-va-to-chuc-thuc-hien-cuoc-thi-vi/"
                        target="_blank" class="text-gray-700 hover:text-blue-500"
                        style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        Bộ trưởng Bộ Công Thương trao Bằng khen cho Trường Đại học Kinh tế – Kỹ thuật Công nghiệp
                    </a>
                </li>
                <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                    <img src="https://uneti.edu.vn/wp-content/uploads/2022/05/loa-thong-bao.jpg"
                        alt="Notification Image" class="w-16 h-16 rounded-md">
                    <a href="https://uneti.edu.vn/thong-bao-ve-viec-to-chuc-cac-lop-hoc-lai-hoc-cai-thien-trong-hk-ii-nam-hoc-2022-2023/"
                        target="_blank" class="text-gray-700 hover:text-blue-500"
                        style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        Thông báo về việc tổ chức các lớp học lại, học cải thiện trong HK II năm học 2022 – 2023
                    </a>
                </li>
                <li class="flex items-center space-x-4 border-b border-gray-300 pb-2">
                    <img src="https://uneti.edu.vn/wp-content/uploads/2021/11/Artboard-3-copy@3x-100.jpg"
                        alt="Notification Image" class="w-16 h-16 rounded-md">
                    <a href="https://uneti.edu.vn/ke-hoach-to-chuc-chuong-trinh-gap-mat-dau-nam-xuan-quy-mao-2023/"
                        target="_blank" class="text-gray-700 hover:text-blue-500"
                        style="max-width: calc(100% - 4rem); font-size: 0.875rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        Kế hoạch tổ chức chương trình gặp mặt đầu năm Xuân Quý Mão 2023
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- footer --}}
    <footer class="bg-white shadow mt-8">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <div class="col-span-12 md:col-span-6">
                    <h5 class="text-xl font-bold mb-4">
                        Về chúng tôi
                    </h5>
                    <p class="text-gray-700">
                        <strong>
                            Thành viên:
                        </strong>
                        @foreach ($thanhViens as $thanhVien)
                            {{ $thanhVien->thanh_vien }},
                        @endforeach
                    </p>
                </div>
                <div class="col-span-12 md:col-span-3">
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
                <div class="col-span-12 md:col-span-3">
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
