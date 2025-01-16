@extends('layout.admin_layout')
@section('title', 'Quản lý tác giả')
@section('content')
    <!-- Tìm kiếm người dùng -->
    <form class="mb-6 flex justify-center items-center space-x-4" method="GET" action="{{ route('admin.qltacgia') }}">
        <div class="relative w-3/4">
            <input type="text" name="search"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Tìm kiếm tác giả theo tên, email..." value="{{ $search }}" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
        </div>
        <select name="status" class="p-3 border rounded">
            <option value="">Tất cả trạng thái</option>
            <option value="activate" {{ $status == 'activate' ? 'selected' : '' }}>Hoạt động</option>
            <option value="deactivate" {{ $status == 'deactivate' ? 'selected' : '' }}>Vô hiệu hóa</option>
        </select>
        <button type="submit"
            class="flex items-center bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm whitespace-nowrap">
            Tìm kiếm
        </button>
    </form>
    <!-- Bảng Quản lý tác giả -->
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Danh sách tác giả</h2>
            <button
                class="bg-green-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                onclick="openAddUserForm()">
                Thêm tác giả
            </button>
        </div>

        <div class="overflow-x-auto w-auto">
            <div class="overflow-y-auto max-h-[400px] border border-gray-300 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse text-sm">
                        <thead class="bg-blue-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-3 text-left font-medium border border-gray-300">STT</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Họ và Tên</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300">Email</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Số điện thoại
                                </th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Giới tính</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Đơn vị công tác
                                </th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Trạng thái</th>
                                <th class="px-6 py-3 text-center font-medium border border-gray-300 ">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $index => $author)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="px-5 py-3 text-gray-700 border border-gray-300">
                                        {{ ($authors->currentPage() - 1) * $authors->perPage() + $index + 1 }}</td>
                                    <td class="px-6 py-4 text-gray-700 border border-gray-300 truncate">{{ $author->ten }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 border border-gray-300">{{ $author->email }}</td>
                                    <td class="px-6 py-4 text-gray-700 border border-gray-300">{{ $author->dien_thoai }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 border border-gray-300 ">{{ $author->gioi_tinh }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 border border-gray-300 truncate">
                                        {{ $author->donVi->ten_don_vi }}</td>
                                    <td class="px-6 py-4 text-gray-700 border border-gray-300 truncate">
                                        @if ($author->trang_thai == 'activate')
                                            <span class="text-green-600">Đã kích hoạt</span>
                                        @else
                                            <span class="text-red-600">Vô hiệu hóa</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center border border-gray-300 truncate">
                                        <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600"
                                            onclick="openUpdateForm({{ $author->id }}, '{{ $author->ten }}', '{{ $author->email }}', '{{ $author->dien_thoai }}', '{{ $author->trang_thai }}')">Cập
                                            nhật</button>
                                        <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600"
                                            onclick="deleteAuthor({{ $author->id }})">Xóa</button>
                                        <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600"
                                            onclick="viewDetails('{{ $author->id }}',
                                                    '{{ $author->ten }}',
                                                    '{{ $author->email }}',
                                                    '{{ $author->dien_thoai }}',
                                                    '{{ $author->gioi_tinh }}',
                                                    '{{ $author->donVi->ten_don_vi }}',
                                                    '{{ $author->trang_thai }}',
                                                    '{{ $author->created_at->format('d/m/Y') }}')">Chi
                                            tiết </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Phân trang -->
            <div class="flex justify-between items-center mt-6">
                {{ $authors->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Thêm tác giả -->
    <div id="addUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h3 class="text-xl font-semibold mb-4">Thêm người tác giả</h3>
            <form method="POST" action="{{ route('add_tac_gia') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Họ và Tên</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded"
                        placeholder="Nhập họ và tên tác giả" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Giới tính</label>
                    <select name="gender" class="w-full px-4 py-2 border rounded" placeholder="Nhập họ và tên tác giả"
                        required>
                        <option value="">Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded"
                        placeholder="Nhập email tác giả" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Số điện thoại</label>
                    <input type="tel" name="tel" class="w-full px-4 py-2 border rounded"
                        placeholder="Nhập số điện thoại" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Vai trò</label>
                    <select name="role" class="w-full px-4 py-2 border rounded" required>
                        <option value="">Chọn vai trò</option>
                        <option value="SinhVien">Sinh Viên</option>
                        <option value="CanBo">Giảng viên</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Đơn vị công tác</label>
                    <select name="don_vi" class="w-full px-4 py-2 border rounded" required>
                        <option value="">Chọn đơn vị</option>
                        @foreach ($donVis as $donVi)
                            <option value="{{ $donVi->id }}">{{ $donVi->ten_don_vi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Trạng thái tài khoản</label>
                    <select name="status" class="w-full px-4 py-2 border rounded" required>
                        <option value=""></option>
                        <option value="deactivate">Vô hiệu hóa</option>
                        <option value="activate">Hoạt động</option>
                    </select>
                </div>
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Thêm</button>
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 ml-2"
                        onclick="closeAddUserForm()">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal update-->
    <div id="updateForm" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-4">Cập nhật thông tin tác giả</h2>
            <form method="POST" action="{{ route('update_tac_gia') }}" id="formUpdate">
                @csrf
                <label for="name" class="block mb-2">Họ và tên:</label>
                <input readonly type="text" id="name" name="name" class="border p-2 w-full mb-4" />

                <label for="email" class="block mb-2">Email:</label>
                <input readonly type="email" id="email" name="email" class="border p-2 w-full mb-4" />

                <label for="phone" class="block mb-2">Số điện thoại:</label>
                <input readonly type="text" id="phone" name="phone" class="border p-2 w-full mb-4" />

                <label for="status" class="block mb-2">Trạng thái:</label>
                <select id="status" name="status" class="border p-2 w-full mb-4">
                    <option value="activate">Hoạt động</option>
                    <option value="deactivate">Vô hiệu hóa</option>
                </select>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Lưu thay
                        đổi</button>
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded   hover:bg-gray-600 ml-2"
                        onclick="closeUpdateForm()">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Author Details Modal -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-2xl font-semibold mb-4">Chi tiết tác giả</h2>
            <div id="authorDetails" class="space-y-3">
                <!-- Details will be injected here -->
            </div>
            <div class="flex justify-end mt-4">
                <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600"
                    onclick="closeDetails()">Đóng</button>
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

        function openUpdateForm(id, name, email, phone, status) {
            // Fill the form with the current author details
            document.getElementById("name").value = name;
            document.getElementById("email").value = email;
            document.getElementById("phone").value = phone;
            document.getElementById("status").value = status;

            // Show the form
            document.getElementById("updateForm").classList.remove("hidden");
        }

        function closeUpdateForm() {
            // Hide the form
            document.getElementById("updateForm").classList.add("hidden");
        }

        function viewDetails(id, name, email, phone, gender, unit, status, joinDate) {
            // Format status text and color
            const statusText = status === 'activate' ? 'Hoạt động' : 'Vô hiệu hóa';
            const statusColor = status === 'activate' ? 'text-green-600' : 'text-red-600';

            // Inject the author details into the modal
            document.getElementById("authorDetails").innerHTML = `
                <p class="border-b pb-2"><strong>Họ và tên:</strong> ${name}</p>
                <p class="border-b pb-2"><strong>Email:</strong> ${email}</p>
                <p class="border-b pb-2"><strong>Số điện thoại:</strong> ${phone}</p>
                <p class="border-b pb-2"><strong>Giới tính:</strong> ${gender}</p>
                <p class="border-b pb-2"><strong>Đơn vị:</strong> ${unit}</p>
                <p class="border-b pb-2"><strong>Trạng thái:</strong> <span class="${statusColor}">${statusText}</span></p>
                <p class="border-b pb-2"><strong>Ngày tham gia:</strong> ${joinDate}</p>
            `;

            // Show the modal
            document.getElementById("detailsModal").classList.remove("hidden");
        }

        function closeDetails() {
            document.getElementById("detailsModal").classList.add("hidden");
        }

        function deleteAuthor(id) {
            if (confirm('Bạn có chắc chắn muốn xóa tác giả này?')) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('delete_tac_gia') }}';

                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                // Add author ID
                const authorId = document.createElement('input');
                authorId.type = 'hidden';
                authorId.name = 'id';
                authorId.value = id;

                form.appendChild(csrfToken);
                form.appendChild(authorId);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
