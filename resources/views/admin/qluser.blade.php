@extends('layout.admin_layout')
@section('title', 'Quản lý người dùng')
@section('content')
    <!-- Tìm kiếm người dùng -->
    <form class="mb-6 flex justify-center items-center space-x-4" method="GET" action="{{ route('admin.qluser') }}">
        <div class="relative w-3/4">
            <input type="text" name="search"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Tìm kiếm người dùng..." value="{{ request('search') }}" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
        </div>
        <select name="status" class="p-3 border rounded">
            <option value="">Tất cả trạng thái</option>
            <option value="deactivate" {{ request('status') == 'deactivate' ? 'selected' : '' }}>Vô hiệu hóa</option>
            <option value="activate" {{ request('status') == 'activate' ? 'selected' : '' }}>Kích hoạt</option>
        </select>
        <button
            class="flex items-center bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm whitespace-nowrap">
            Tìm kiếm
        </button>
    </form>
    <!-- Bảng Quản lý người dùng -->
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Danh sách người dùng</h2>
            @if (Auth::user()->phan_quyen == 'admin')
                <button
                    class="bg-blue-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onclick="openAddUserModal()">
                    Thêm người dùng
                </button>
            @else
                <button
                    class="bg-blue-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onclick="showToast()">
                    Thêm người dùng
                </button>
            @endif
        </div>
        <div class="overflow-x-auto w-auto">
            <div class="overflow-y-auto max-h-[400px] border border-gray-300 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse text-sm">
                        <thead class="bg-blue-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-3 text-left font-medium border border-gray-300">STT</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Tên người dùng
                                </th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Email</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Số điện thoại</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300">Đơn vị</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Chức vụ</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Phân quyền</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Trạng thái</th>
                                <th class="px-6 py-3 text-center font-medium border border-gray-300">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="px-5 py-2 text-gray-700 border border-gray-300 truncate">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $user->ten_nguoi_dung }}</td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300">
                                        @if (Auth::user()->phan_quyen == 'admin')
                                            {{ $user->email }}
                                        @else
                                            {{ substr($user->email, 0, 3) . str_repeat('*', strlen($user->email) - 6) . substr($user->email, -3) }}
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300 truncate">
                                        @if (Auth::user()->phan_quyen == 'admin')
                                            {{ $user->so_dien_thoai }}
                                        @else
                                            {{ substr($user->so_dien_thoai, 0, 3) . str_repeat('*', strlen($user->so_dien_thoai) - 5) . substr($user->so_dien_thoai, -2) }}
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $user->donVi ? $user->donVi->ten_don_vi : 'Chưa có đơn vị' }}</td>
                                    <td class="px-3 py-3 text-gray-600 border border-gray-300 text-center truncate">
                                        {{ $user->chuc_vu }}
                                    </td>
                                    <td class="px-3 py-3 text-yellow-500 border border-gray-300 text-center truncate">
                                        @if ($user->phan_quyen == 'admin')
                                            <span class="text-red-600">Quản trị viên</span>
                                        @elseif($user->phan_quyen == 'editor')
                                            <span class="">Biên tập viên</span>
                                        @elseif($user->phan_quyen == 'editorialdirector')
                                            <span class="text-green-600">Tổng biên tập</span>
                                        @else
                                            <span class="text-gray-600">Người dùng</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 border border-gray-300 truncate">
                                        @if ($user->trang_thai == 'activate')
                                            <span class="text-green-600">Kích hoạt</span>
                                        @elseif($user->trang_thai == 'deactivate')
                                            <span class="text-red-600">Vô hiệu hóa</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->phan_quyen == 'admin')
                                        <td class="px-3 py-3 text-center border border-gray-300 truncate">
                                            @if ($user->trang_thai == 'deactivate')
                                                <form action="{{ route('update_user_status') }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="status" value="activate">
                                                    <button type="submit"
                                                        class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                        Kích hoạt
                                                    </button>
                                                </form>
                                            @elseif ($user->trang_thai == 'activate')
                                                <form action="{{ route('update_user_status') }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="status" value="deactivate">
                                                    <button type="submit"
                                                        class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                        Vô hiệu hóa
                                                    </button>
                                                </form>
                                            @endif
                                            <button
                                                class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                                onclick="openEditUserModal({{ $user->id }})">
                                                Cập nhật
                                            </button>
                                            <form action="{{ route('delete_user', $user->id) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                    Xóa
                                                </button>
                                            </form>
                                        </td>
                                    @else
                                    <td class="px-3 py-3 text-center border border-gray-300 truncate"> Bạn không có quyền chỉnh sửa người dùng </td>
                                    @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-between items-center mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Thêm người dùng -->
    <div id="AddModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Thêm người dùng</h2>
            <form method="POST" action="{{ route('add_user') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Tên người dùng</label>
                    <input name="ten_nguoi_dung" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input name="email" type="email" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Số điện thoại</label>
                    <input name="so_dien_thoai" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Đơn vị</label>
                    <select name="ma_don_vi" class="p-2 border rounded w-full" required>
                        <option value="">Chọn đơn vị</option>
                        @foreach ($donVis as $donVi)
                            <option value="{{ $donVi->id }}">{{ $donVi->ten_don_vi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Chức vụ</label>
                    <select name="chuc_vu" class="p-2 border rounded w-full" required>
                        <option value="CanBo">Cán bộ</option>
                        <option value="SinhVien">Sinh viên</option>
                        <option value="Không">Không</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Phân quyền</label>
                    <select name="phan_quyen" id="addPhanQuyen" class="p-2 border rounded w-full" required>
                        <option value="user">Người dùng</option>
                        <option value="editor">Biên tập viên</option>
                        <option value="editorialdirector">Tổng biên tập</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Mật khẩu</label>
                    <input name="mat_khau" type="password" class="p-2 border rounded w-full" required />
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Thêm</button>
                    <button type="button" onclick="closeAddModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal sửa người dùng -->
    <div id="EditModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Cập nhật người dùng</h2>
            <form id="editForm" method="POST" action="{{ route('update_user') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="editUserId">
                <div class="mb-4">
                    <label class="block text-gray-700">Tên người dùng</label>
                    <input name="ten_nguoi_dung" id="editTenNguoiDung" type="text" class="p-2 border rounded w-full"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input name="email" id="editEmail" type="email" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Số điện thoại</label>
                    <input name="so_dien_thoai" id="editSoDienThoai" type="text" class="p-2 border rounded w-full"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Đơn vị</label>
                    <select name="ma_don_vi" id="editDonVi" class="p-2 border rounded w-full" required>
                        <option value="">Chọn đơn vị</option>
                        @foreach ($donVis as $donVi)
                            <option value="{{ $donVi->id }}">{{ $donVi->ten_don_vi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Chức vụ</label>
                    <select name="chuc_vu" id="editChucVu" class="p-2 border rounded w-full" required>
                        <option value="CanBo">Cán bộ</option>
                        <option value="SinhVien">Sinh viên</option>
                        <option value="Không">Không</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Phân quyền</label>
                    <select name="phan_quyen" id="editPhanQuyen" class="p-2 border rounded w-full" required>
                        <option value="user">Người dùng</option>
                        <option value="editor">Biên tập viên</option>
                        <option value="editorialdirector">Tổng biên tập</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Mật khẩu</label>
                    <input name="mat_khau" id="editMatKhau" type="password" class="p-2 border rounded w-full" />
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập
                        nhật</button>
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
                </div>
            </form>
        </div>
    </div>
<style>
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem;
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 0.25rem;
        z-index: 1000;
    }
</style>
    <script>
        function showToast() {
            alert('Tài khoản của bạn không có quyền thực hiện chức năng này');
        }

        function openEditUserModal(id) {
            fetch(`/admin/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editUserId').value = data.id;
                    document.getElementById('editTenNguoiDung').value = data.ten_nguoi_dung;
                    document.getElementById('editEmail').value = data.email;
                    document.getElementById('editSoDienThoai').value = data.so_dien_thoai;
                    document.getElementById('editDonVi').value = data.ma_don_vi;
                    document.getElementById('editChucVu').value = data.chuc_vu;
                    document.getElementById('editPhanQuyen').value = data.phan_quyen;
                    document.getElementById('EditModal').classList.remove('hidden');
                });
        }

        function closeEditModal() {
            document.getElementById('EditModal').classList.add('hidden');
        }

        function openAddUserModal() {
            document.getElementById("AddModal").classList.remove("hidden");
        }

        function closeAddModal() {
            document.getElementById("AddModal").classList.add("hidden")
        }
    </script>
@endsection
