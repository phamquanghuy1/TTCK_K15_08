@extends('layout.user_layout')
@section('title', 'Đăng ký')
@section('content')
    <div class="flex-container mt-6">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-center mb-6">
                <img alt="Company logo" class="rounded-full" height="100"
                    src="https://cdn.haitrieu.com/wp-content/uploads/2021/12/Logo-DH-Kinh-te-Ky-thuat-Cong-nghiep-UNETI.png"
                    width="100" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-6">Đăng Ký</h2>
            <form method="POST" action="{{ route('reg') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Họ tên</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="name" name="name"
                        placeholder="Nhập họ và tên của bạn"
                        type="text"
                        value="{{old('name')}}" />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Số điện thoại</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="tel" name="tel"
                        placeholder="Nhập số điện thoại của bạn"
                        type="tel"
                        value="{{old('tel')}}" />
                    @error('tel')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="email" name="email" placeholder="Nhập email của bạn" type="email"
                        value="{{old('email')}}" />
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 relative">
                    <label class="block text-gray-700" for="password">Mật khẩu</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="password" name="password"
                        placeholder="Nhập mật khẩu của bạn"
                        type="password"
                         />
                    <span class="absolute mt-3 right-0 pr-4 password-icon-container cursor-pointer" onclick="togglePasswordVisibility('password', 'password-icon')">
                        <i id="password-icon" class="fas fa-eye text-gray-500"></i>
                    </span>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 relative">
                    <label class="block text-gray-700" for="password">Nhập lại mật khẩu</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="password_confirmation" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu của bạn"
                        type="password"
                         />
                    <span class="absolute mt-3 right-0 pr-4 password-icon-container cursor-pointer" onclick="togglePasswordVisibility('password_confirmation', 'password-confirmation-icon')">
                            <i id="password-icon" class="fas fa-eye text-gray-500"></i>
                    </span>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200"
                    type="submit">Đăng Ký
                </button>
            </form>
            <div class="text-center mt-6">
                <p class="text-gray-700">
                    Bạn đã tài khoản?
                    <a class="text-blue-500 hover:underline" href="/login">Đăng Nhập</a>
                </p>
            </div>
            <div class="flex flex-col items-center mt-6">
                <button
                    class="w-full bg-blue-600 text-white py-2 rounded-lg flex items-center justify-center hover:bg-blue-700 transition duration-200 mb-4">
                    <i class="fab fa-facebook-f mr-2"></i> Đăng ký với Facebook
                </button>
                <button
                    class="w-full bg-red-500 text-white py-2 rounded-lg flex items-center justify-center hover:bg-red-600 transition duration-200">
                    <i class="fab fa-google mr-2"></i> Đăng ký với Google
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
    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            }else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

    </script>
@endsection
