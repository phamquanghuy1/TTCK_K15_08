@extends('layout.user_layout')
@section('title', 'Đặt lại mật khẩu')
@section('content')
    <div class="flex-container">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-center mb-6">
                <img alt="Company logo" class="rounded-full" height="100"
                    src="https://cdn.haitrieu.com/wp-content/uploads/2021/12/Logo-DH-Kinh-te-Ky-thuat-Cong-nghiep-UNETI.png"
                    width="100" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-6">Đặt Lại Mật Khẩu</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="email" name="email" placeholder="Nhập email của bạn" type="email" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password">Mật khẩu mới</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="password" name="password" placeholder="Nhập mật khẩu mới" type="password" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password_confirmation">Xác nhận mật khẩu</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu mới" type="password" required />
                </div>
                <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200"
                    type="submit">Đặt lại mật khẩu
                </button>
            </form>
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
