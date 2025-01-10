@extends('layout.admin_layout')
@section('title', 'Quản lý tác giả')
@section('content')
    <!-- Tìm kiếm người dùng -->
    <form class="mb-6 flex justify-center items-center space-x-4">
        <div class="relative w-3/4">
            <input type="text"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Tìm kiếm tác giả theo tên, email hoặc trạng thái..." />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
        </div>
        <button
            class="bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm">
            Tìm kiếm
        </button>
    </form>
    <!-- Bảng Quản lý người dùng -->
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-full overflow-hidden">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Danh sách tác giả</h2>
            <button class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600" onclick="openAddUserForm()">
                Thêm tác giả
            </button>
        </div>
        <div class="overflow-y-scroll scroll-hidden max-h-[calc(7*2.5rem)] border border-gray-300 rounded">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300 sticky left-0 bg-blue-100">STT</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300 sticky left-0 bg-blue-100">Họ và Tên</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300 sticky left-0 bg-blue-100">Email</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300 truncate">Số điện thoại</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300 truncate">Giới tính</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300 truncate">Đơn vị công tác</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-700 border border-gray-300">Trạng thái</th>
                        <th class="px-4 py-2 text-center font-medium text-gray-700 border border-gray-300">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $index => $author)
                    <tr>
                        <td class="px-4 py-2 text-gray-700 border border-gray-300 sticky left-0 overflow-x-auto truncate">{{$index + 1}}</td>
                        <td class="px-4 py-2 text-gray-700 border border-gray-300 sticky left-0 truncate">{{$author->ten}}</td>
                        <td class="px-4 py-2 text-gray-700 border border-gray-300 sticky left-0 truncate">{{ $author->email }}</td>
                        <td class="px-4 py-2 text-gray-700 border border-gray-300 truncate">{{ $author->dien_thoai }}</td>
                        <td class="px-4 py-2 text-gray-700 border border-gray-300 truncate">{{ $author->gioi_tinh }}</td>
                        <td class="px-4 py-2 text-gray-700 border border-gray-300 truncate">{{ $author->donVi->ten_don_vi }}</td>
                        <td class="px-4 py-2 border border-gray-300 truncate">
                            @if($author->trang_thai == 'activate')
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
                                onclick="{{ $author->id }}">Xóa</button>
                            <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600"
                                onclick="{{ $author->id }}">Chi tiết</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        <!-- Modal Thêm người dùng -->
        <div id="addUserModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                <h3 class="text-xl font-semibold mb-4">Thêm người tác giả</h3>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700">Họ và Tên</label>
                        <input type="text" class="w-full px-4 py-2 border rounded"
                            placeholder="Nhập họ và tên tác giả" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" class="w-full px-4 py-2 border rounded" placeholder="Nhập email tác giả" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Mật khẩu</label>
                        <input type="password" class="w-full px-4 py-2 border rounded" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Vai trò</label>
                        <select class="w-full px-4 py-2 border rounded">
                            <option>Tác giả</option>
                            <option>Giảng viên</option>
                            <option>Nghiên cứu viên</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Trạng thái tài khoản</label>
                        <select class="w-full px-4 py-2 border rounded">
                            <option>Hoạt động</option>
                            <option>Vô hiệu hóa</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Thêm</button>
                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 ml-2"
                            onclick="closeAddUserForm()">Hủy</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Modal cập nhập người dùng -->
    <div id="updateForm" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-2xl font-semibold mb-4">Cập nhật thông tin tác giả</h2>
            <form id="formUpdate">
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
                    <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                        onclick="submitUpdate()">Lưu thay đổi</button>
                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 ml-2"
                        onclick="closeUpdateForm()">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Author Details Modal (Hidden by default) -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-2xl font-semibold mb-4">Chi tiết tác giả</h2>
            <div id="authorDetails">
                <!-- Author details will be injected here -->
            </div>
            <button class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600"
                onclick="closeDetails()">Đóng</button>
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

        function viewDetails(id) {
            // Example data for author details
            const details = {
                1: {
                    name: "Cấn Đình Duy",
                    email: "duy@gmail.com",
                    posts: 4,
                    topics: ["Đề tài 4", "Đề tài 5"],
                    description: "Đây là tác giả Cấn Đình Duy, một tác giả nổi bật trong lĩnh vực nghiên cứu khoa học.",
                    contactInfo: "Số điện thoại: 0123456789"
                },
                2: {
                    name: "Phạm Quang Huy",
                    email: "huy@gmail.com",
                    posts: 5,
                    topics: ["Đề tài 3"],
                    description: "Phạm Quang Huy là giảng viên tại trường đại học UNETI, tham gia nhiều dự án nghiên cứu.",
                    contactInfo: "Số điện thoại: 0987654321"
                }
            };

            const author = details[id];

            // Inject the author details into the modal
            document.getElementById("authorDetails").innerHTML = `
            <p><strong>Họ và tên:</strong> ${author.name}</p>
            <p><strong>Email:</strong> ${author.email}</p>
            <p><strong>Số bài viết:</strong> ${author.posts}</p>
            <p><strong>Đề tài tham gia:</strong> ${author.topics.join(", ")}</p>
            <p><strong>Mô tả:</strong> ${author.description}</p>
            <p><strong>Thông tin liên hệ:</strong> ${author.contactInfo}</p>
        `;

            // Show the modal
            document.getElementById("detailsModal").classList.remove("hidden");
        }

        function closeDetails() {
            // Hide the details modal
            document.getElementById("detailsModal").classList.add("hidden");
        }

        function confirmDelete(id) {
            if (confirm("Bạn có chắc chắn muốn xóa tác giả này?")) {
                console.log("Xóa tác giả với ID:", id);
            }
        }
    </script>
@endsection
