@extends('layout.admin_layout')
@section('title', 'Quản lý loại đề tài')
@section('content')
    <!-- Tìm kiếm loại đề tài -->
    <form class="mb-6 flex justify-center items-center space-x-4" method="GET" action="{{ route('admin.qlloaidetai') }}">
        <div class="relative w-3/4">
            <input type="text" name="search"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Tìm kiếm loại đề tài..." value="{{ request('search') }}" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
        </div>
        <button type="submit"
            class="flex items-center bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm whitespace-nowrap">
            Tìm kiếm
        </button>
    </form>
    <!-- Bảng Quản lý loại đề tài -->
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Danh sách loại đề tài</h2>
            <button
                class="bg-green-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                onclick="openAddModal()">
                Thêm loại đề tài
            </button>
        </div>
        <div class="overflow-x-auto w-auto">
            <div class="overflow-y-auto max-h-[400px] border border-gray-300 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse text-sm">
                        <thead class="bg-blue-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-3 text-left font-medium border border-gray-300">STT</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Tên loại đề tài</th>
                                <th class="px-6 py-3 text-center font-medium border border-gray-300">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loaiDeTais as $index => $loaiDeTai)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="px-5 py-3 text-gray-700 border border-gray-300">
                                        {{ ($loaiDeTais->currentPage() - 1) * $loaiDeTais->perPage() + $index + 1 }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $loaiDeTai->ten_danh_muc }}</td>
                                    <td class="px-6 py-3 text-center border border-gray-300 truncate">
                                        <button class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600"
                                            onclick="openEditModal({{ $loaiDeTai->id }}, '{{ $loaiDeTai->ten_danh_muc }}')">Cập nhật</button>
                                        <form action="{{ route('delete_loai_de_tai', $loaiDeTai->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại đề tài này?');">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Phân trang -->
            <div class="flex justify-between items-center mt-6">
                {{ $loaiDeTais->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Thêm loại đề tài -->
    <div id="AddModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Thêm loại đề tài</h2>
            <form method="POST" action="{{ route('add_loai_de_tai') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Tên loại đề tài</label>
                    <input name="ten_danh_muc" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Thêm</button>
                    <button type="button" onclick="closeAddModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal sửa loại đề tài -->
    <div id="EditModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Cập nhật loại đề tài</h2>
            <form id="editForm" method="POST" action="{{ route('update_loai_de_tai') }}">
                @csrf
                <input type="hidden" name="id" id="editLoaiDeTaiId">
                <div class="mb-4">
                    <label class="block text-gray-700">Tên loại đề tài</label>
                    <input name="ten_danh_muc" id="editTenLoaiDeTai" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập nhật</button>
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById("AddModal").classList.remove("hidden");
        }

        function closeAddModal() {
            document.getElementById("AddModal").classList.add("hidden");
        }

        function openEditModal(id, tenLoaiDeTai) {
            document.getElementById('editLoaiDeTaiId').value = id;
            document.getElementById('editTenLoaiDeTai').value = tenLoaiDeTai;
            document.getElementById('EditModal').classList.remove("hidden");
        }

        function closeEditModal() {
            document.getElementById('EditModal').classList.add("hidden");
        }
    </script>
@endsection
