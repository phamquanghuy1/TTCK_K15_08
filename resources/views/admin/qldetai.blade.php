@extends('layout.admin_layout')
@section('title', 'Quản lý đề tài')
@section('content')
    <!-- Tìm kiếm đề tài -->
    <form class="mb-6 flex justify-center items-center space-x-4" method="GET" action="{{ route('admin.qldetai') }}">
        <div class="relative w-3/4">
            <input type="text" name="search"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Tìm kiếm đề tài theo tên, trạng thái..." value="{{ request('search') }}" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
        </div>
        <select name="status" class="p-3 border rounded">
            <option value="">Tất cả trạng thái</option>
            <option value="activate" {{ request('status') == 'activate' ? 'selected' : '' }}>Đang diễn ra</option>
            <option value="deactivate" {{ request('status') == 'deactivate' ? 'selected' : '' }}>Đã kết thúc</option>
        </select>
        <button
            class="flex items-center bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm whitespace-nowrap">
            Tìm kiếm
        </button>
    </form>
    <!-- Bảng Quản lý đề tài -->
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Danh sách đề tài</h2>
            <button
                class="bg-blue-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                onclick="openAddTopicModal()">
                Thêm đề tài
            </button>
        </div>
        <div class="overflow-x-auto w-auto">
            <div class="overflow-y-auto max-h-[400px] border border-gray-300 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse text-sm">
                        <thead class="bg-blue-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-3 text-left font-medium border border-gray-300">STT</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Tên đề tài</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Kinh phí</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Nội dung nghiên
                                    cứu</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Từ ngày</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Đến ngày</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Danh mục</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Trạng thái</th>
                                <th class="px-6 py-3 text-center font-medium border border-gray-300 truncate">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deTais as $index => $deTai)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="px-5 py-3 text-gray-700 border border-gray-300">
                                        {{ ($deTais->currentPage() - 1) * $deTais->perPage() + $index + 1 }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $deTai->ten_de_tai }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ number_format($deTai->kinh_phi, 0, ',', '.') }} VND</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $deTai->noi_dung_nghien_cuu }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $deTai->tu_ngay }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $deTai->den_ngay }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $deTai->danhMuc ? $deTai->danhMuc->ten_danh_muc : 'Không có danh mục' }}</td>
                                    <td class="px-6 py-3 text-gray-700 border border-gray-300 truncate">
                                        @if ($deTai->trang_thai == 'activate')
                                            <span class="text-green-600">Đang diễn ra</span>
                                        @elseif($deTai->trang_thai == 'deactivate')
                                            <span class="text-red-600">Đã kết thúc</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 text-center border border-gray-300 truncate">
                                        @if ($deTai->trang_thai == 'activate')
                                            <form action="{{ route('update_topic_status', $deTai->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="deactivate">
                                                <button type="submit"
                                                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Đóng đăng ký
                                                </button>
                                            </form>
                                        @elseif ($deTai->trang_thai == 'deactivate')
                                            <form action="{{ route('update_topic_status', $deTai->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="activate">
                                                <button type="submit"
                                                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Mở đăng ký
                                                </button>
                                            </form>
                                        @endif
                                        <button
                                            class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                            onclick="openEditTopicModal({{ $deTai->id }})">
                                            Cập nhật
                                        </button>
                                        <form action="{{ route('delete_topic', $deTai->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa đề tài này?');">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
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
            <div class="flex justify-between items-center mt-6">
                {{ $deTais->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Thêm đề tài -->
    <div id="AddModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Thêm đề tài</h2>
            <form method="POST" action="{{ route('add_topic') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Tên đề tài</label>
                    <input name="ten_de_tai" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Kinh phí</label>
                    <input name="kinh_phi" type="number" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nội dung nghiên cứu</label>
                    <textarea name="noi_dung_nghien_cuu" class="p-2 border rounded w-full" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Từ ngày</label>
                    <input name="tu_ngay" type="date" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Đến ngày</label>
                    <input name="den_ngay" type="date" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Danh mục</label>
                    <select name="ma_danh_muc" class="p-2 border rounded w-full" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($danhMucs as $danhMuc)
                            <option value="{{ $danhMuc->id }}">{{ $danhMuc->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Thêm</button>
                    <button type="button" onclick="closeAddTopicModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal sửa đề tài -->
    <div id="EditModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Cập nhật đề tài</h2>
            <form id="editForm" method="POST" action="{{ route('update_topic') }}">
                @csrf
                <input type="hidden" name="id" id="editTopicId">
                <div class="mb-4">
                    <label class="block text-gray-700">Tên đề tài</label>
                    <input name="ten_de_tai" id="editTenDeTai" type="text" class="p-2 border rounded w-full"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Kinh phí</label>
                    <input name="kinh_phi" id="editKinhPhi" type="number" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nội dung nghiên cứu</label>
                    <textarea name="noi_dung_nghien_cuu" id="editNoiDungNghienCuu" class="p-2 border rounded w-full" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Từ ngày</label>
                    <input name="tu_ngay" id="editTuNgay" type="date" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Đến ngày</label>
                    <input name="den_ngay" id="editDenNgay" type="date" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Danh mục</label>
                    <select name="ma_danh_muc" id="editDanhMuc" class="p-2 border rounded w-full" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($danhMucs as $danhMuc)
                            <option value="{{ $danhMuc->id }}">{{ $danhMuc->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Cập
                        nhật</button>
                    <button type="button" onclick="closeEditTopicModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddTopicModal() {
            document.getElementById("AddModal").classList.remove("hidden");
        }

        function closeAddTopicModal() {
            document.getElementById("AddModal").classList.add("hidden");
        }

        function openEditTopicModal(id) {
            fetch(`/admin/topics/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editTopicId').value = data.id;
                    document.getElementById('editTenDeTai').value = data.ten_de_tai;
                    document.getElementById('editKinhPhi').value = data.kinh_phi;
                    document.getElementById('editNoiDungNghienCuu').value = data.noi_dung_nghien_cuu;
                    document.getElementById('editTuNgay').value = data.tu_ngay;
                    document.getElementById('editDenNgay').value = data.den_ngay;
                    document.getElementById('editDanhMuc').value = data.ma_danh_muc;
                    document.getElementById('EditModal').classList.remove('hidden');
                });
        }

        function closeEditTopicModal() {
            document.getElementById('EditModal').classList.add('hidden');
        }
    </script>
@endsection
