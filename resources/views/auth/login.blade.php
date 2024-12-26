@extends('layout.user_layout')
@section('title', 'Đăng nhập')
@section('content')
    <div class="flex-container">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <div class="flex justify-center mb-6">
                <img alt="Company logo" class="rounded-full" height="100"
                    src="https://cdn.haitrieu.com/wp-content/uploads/2021/12/Logo-DH-Kinh-te-Ky-thuat-Cong-nghiep-UNETI.png"
                    width="100" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-6">Đăng Nhập</h2>
            <form method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="email" name="email" placeholder="Nhập email của bạn" type="email" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password">Mật khẩu</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="password" name="password" placeholder="Nhập mật khẩu của bạn" type="password" required />
                </div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input class="mr-2" id="remember" type="checkbox" />
                        <label class="text-gray-700" for="remember">Nhớ mật khẩu</label>
                    </div>
                    <a class="text-blue-500 hover:underline" href="#">Quên mật khẩu?</a>
                </div>
                <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200"
                    type="submit">Đăng Nhập
                </button>
            </form>
            <div class="text-center mt-6">
                <p class="text-gray-700">
                    Chưa có tài khoản?
                    <a class="text-blue-500 hover:underline" href="/reg">Đăng Ký</a>
                </p>
            </div>
            <div class="flex flex-col items-center mt-6">
                <button
                    class="w-full bg-blue-600 text-white py-2 rounded-lg flex items-center justify-center hover:bg-blue-700 transition duration-200 mb-4">
                    <i class="fab fa-facebook-f mr-2"></i> Đăng Nhập với Facebook
                </button>
                <button
                    class="w-full bg-red-500 text-white py-2 rounded-lg flex items-center justify-center hover:bg-red-600 transition duration-200">
                    <i class="fab fa-google mr-2"></i> Đăng Nhập với Google
                </button>
            </div>
        </div>
    </div>
    <style>
        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
@endsection
