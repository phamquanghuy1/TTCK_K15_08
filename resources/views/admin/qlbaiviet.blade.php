@extends('layout.admin_layout')
@section('title', 'Quản lý bài viết')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Danh sách người dùng</h2>
        <form class="flex items-center space-x-4">
            <div class="relative w-64">
                <input type="text"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                    placeholder="Tìm kiếm người dùng" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
            </div>
            <button
                class="bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm">
                Tìm kiếm
            </button>
        </form>
    </div>
    <div class="overflow-y-scroll scroll-hidden max-h-[calc(7*2.5rem)] border border-gray-300 rounded">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300">ID</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300">Họ và Tên</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300">Email</th>
                    <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300">Trạng thái</th>
                    <th class="px-4 py-2 text-center font-medium text-gray-700 border border-gray-300">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 text-gray-700 border border-gray-300">1</td>
                    <td class="px-4 py-2 text-gray-700 border border-gray-300">Cấn Đình Duy</td>
                    <td class="px-4 py-2 text-gray-700 border border-gray-300">duy@gmail.com</td>
                    <td class="px-4 py-2 text-green-600 border border-gray-300">Hoạt động</td>
                    <td class="px-4 py-2 text-center border border-gray-300">
                        <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">Sửa</button>
                        <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Xóa</button>
                        <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Vô hiệu hóa</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-700 border border-gray-300">2</td>
                    <td class="px-4 py-2 text-gray-700 border border-gray-300">Phạm Quang Huy</td>
                    <td class="px-4 py-2 text-gray-700 border border-gray-300">huy@gmail.com</td>
                    <td class="px-4 py-2 text-red-600 border border-gray-300">Đã vô hiệu hóa</td>
                    <td class="px-4 py-2 text-center border border-gray-300">
                        <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">Sửa</button>
                        <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Xóa</button>
                        <button class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Kích hoạt</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Modal Thêm người dùng -->
        <div id="addUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                <h3 class="text-xl font-semibold mb-4">Thêm người dùng mới</h3>
                <form>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Họ và Tên</label>
                        <input type="text" id="name" class="w-full p-2 border rounded"
                            placeholder="Nhập họ tên" />
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" class="w-full p-2 border rounded"
                            placeholder="Nhập email" />
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Mật khẩu</label>
                        <input type="password" id="password" class="w-full p-2 border rounded"
                            placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700">Vai trò</label>
                        <select id="role" class="w-full p-2 border rounded">
                            <option value="admin">Admin</option>
                            <option value="giangvien">Giảng viên</option>
                            <option value="sinhvien">Sinh viên</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Thêm</button>
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 ml-2"
                            onclick="closeAddUserForm()">Hủy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        <script>
            function openAddUserForm() {
                document.getElementById('addUserModal').classList.remove('hidden');
            }

            function closeAddUserForm() {
                document.getElementById('addUserModal').classList.add('hidden');
            }
        </script>
@endsection
