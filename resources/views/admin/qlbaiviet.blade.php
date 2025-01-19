@extends('layout.admin_layout')
@section('title', 'Quản lý bài viết')
@section('content')
    <!-- Tìm kiếm người dùng -->
    <form class="mb-6 flex justify-center items-center space-x-4" method="GET" action="{{ route('admin.qlbaiviet') }}">
        <div class="relative w-3/4">
            <input type="text" name="search"
                class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                placeholder="Tìm kiếm bài viết..." value="{{ request('search') }}" />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
        </div>
        <select name="status" class="p-3 border rounded">
            <option value="">Tất cả trạng thái</option>
            <option value="deactivate" {{ request('status') == 'deactivate' ? 'selected' : '' }}>Chờ duyệt</option>
            <option value="activate" {{ request('status') == 'activate' ? 'selected' : '' }}>Đã duyệt</option>
            <option value="cancel" {{ request('status') == 'cancel' ? 'selected' : '' }}>Từ chối</option>
        </select>
        <button
            class="flex items-center bg-blue-500 text-white py-3 px-6 rounded-md shadow-md hover:bg-blue-600 transform transition-all duration-300 ease-in-out focus:outline-none text-sm whitespace-nowrap">
            Tìm kiếm
        </button>
    </form>
    <!-- Bảng Quản lý người dùng -->
    <div class="bg-white p-8 rounded-lg shadow-2xl max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Danh sách bài viết</h2>
            <button
                class="bg-blue-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                onclick="openAddArticleModal()">
                Thêm bài viết
            </button>
        </div>
        <div class="overflow-x-auto w-auto">
            <div class="overflow-y-auto max-h-[400px] border border-gray-300 rounded-lg shadow-md">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse text-sm">
                        <thead class="bg-blue-100 text-gray-700">
                            <tr>
                                <th class="px-3 py-3 text-left font-medium border border-gray-300">STT</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Tiêu đề</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300">Mô tả</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300">Tác giả</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300">Danh mục</th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Ngày phát hành
                                </th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Ảnh bìa
                                </th>
                                <th class="px-6 py-3 text-left font-medium border border-gray-300 truncate">Trạng thái</th>
                                <th class="px-6 py-3 text-center font-medium border border-gray-300">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($baiBaoKhoaHocs as $baiBao)
                                <tr class="bg-white hover:bg-gray-50">
                                    <td class="px-5 py-2 text-gray-700 border border-gray-300 truncate">
                                        {{ ($baiBaoKhoaHocs->currentPage() - 1) * $baiBaoKhoaHocs->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $baiBao->tieu_de }}</td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300">
                                        {{ $baiBao->mo_ta }}</td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $baiBao->tac_gia }}</td>
                                    <td class="px-3 py-3 text-gray-700 border border-gray-300 truncate">
                                        {{ $baiBao->danhMuc->ten_danh_muc }}</td>
                                    <td class="px-3 py-3 text-gray-600 border border-gray-300 text-center truncate">
                                        {{ $baiBao->ngay_phat_hanh }}
                                    </td>
                                    <td class="px-3 py-3 text-gray-600 border border-gray-300 text-center">
                                        <img class="w-20 h-20 object-cover" src="{{ $baiBao->img }}" alt="Hình ảnh">
                                    </td>
                                    <td class="px-3 py-3 border border-gray-300 truncate">
                                        @if ($baiBao->trang_thai == 'activate')
                                            <span class="text-green-600">Đã phê duyệt</span>
                                        @elseif($baiBao->trang_thai == 'deactivate')
                                            <span class="text-yellow-600">Chờ phê duyệt</span>
                                        @elseif($baiBao->trang_thai == 'cancel')
                                            <span class="text-red-600">Đã hủy</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-center border border-gray-300 truncate">
                                        @if ($baiBao->trang_thai == 'deactivate')
                                            <form action="{{ route('update_article_status') }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <input type="hidden" name="article_id" value="{{ $baiBao->id }}">
                                                <input type="hidden" name="status" value="activate">
                                                <button type="submit"
                                                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Hiển thị
                                                </button>
                                            </form>
                                        @elseif ($baiBao->trang_thai == 'activate')
                                            <form action="{{ route('update_article_status') }}" method="POST"
                                                class="inline">
                                                @csrf
                                                <input type="hidden" name="article_id" value="{{ $baiBao->id }}">
                                                <input type="hidden" name="status" value="deactivate">
                                                <button type="submit"
                                                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Ẩn bài viết
                                                </button>
                                            </form>
                                        @endif
                                        <button
                                            class="bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                            onclick="openEditArticleModal({{ $baiBao->id }})">
                                            Cập nhật
                                        </button>
                                        <form action="{{ route('delete_article', $baiBao->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                                Xóa
                                            </button>
                                        </form>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex justify-between items-center mt-6">
                {{ $baiBaoKhoaHocs->links() }}
            </div>
        </div>
    </div>
    <!-- Modal Thêm bài viết -->
    <div id="AddModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Thêm bài viết</h2>
            <form method="POST" action="{{ route('add_bai_viet') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Tiêu đề</label>
                    <input name="tieu_de" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tóm tắt</label>
                    <textarea name="mo_ta" class="p-2 border rounded w-full" required></textarea>
                </div>
                <div class="mb-4 relative">
                    <label class="block text-gray-700">Tác giả</label>
                    <input type="text" id="search_author" class="p-2 border rounded w-full"
                        placeholder="Tìm kiếm tác giả..." />
                    <input type="hidden" name="tac_gia" id="selected_author" />
                    <div id="author_suggestions" class="hidden absolute z-10 w-full bg-white border rounded-lg shadow-lg">
                    </div>
                </div>
                <div class="mb-4 relative">
                    <label class="block text-gray-700">Tên đề tài</label>
                    <input type="text" id="search_topic" class="p-2 border rounded w-full"
                        placeholder="Tìm kiếm đề tài..." />
                    <input type="hidden" name="ma_de_tai" id="selected_topic" />
                    <div id="topic_suggestions" class="hidden absolute z-10 w-full bg-white border rounded-lg shadow-lg">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Loại danh mục</label>
                    <select name="ma_danh_muc" class="p-2 border rounded w-full" required>
                        <option value="">Chọn danh mục</option>
                        @foreach ($danhMucs as $danhMuc)
                            <option value="{{ $danhMuc->id }}">{{ $danhMuc->ten_danh_muc }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ngày phát hành</label>
                    <input name="ngay_phat_hanh" type="date" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ảnh bìa</label>
                    <input name="img" type="file" accept="image/*" class="p-2 border rounded w-full" />
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
    <!-- Modal sửa bài viết -->
    <div id="EditModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Cập nhật bài viết</h2>
            <form id="editForm" method="POST" action="{{ route('update_article') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="editArticleId">
                <div class="mb-4">
                    <label class="block text-gray-700">Tiêu đề</label>
                    <input name="tieu_de" id="editTieuDe" type="text" class="p-2 border rounded w-full" required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tóm tắt</label>
                    <textarea name="mo_ta" id="editMoTa" class="p-2 border rounded w-full" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tác giả</label>
                    <input name="tac_gia" id="editTacGia" type="text" class="p-2 border rounded w-full" required />
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
                    <label class="block text-gray-700">Ngày phát hành</label>
                    <input name="ngay_phat_hanh" id="editNgayPhatHanh" type="date" class="p-2 border rounded w-full"
                        required />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Ảnh bìa</label>
                    <input name="img" id="editImg" type="file" class="p-2 border rounded w-full" />
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

    <script>
        function openEditArticleModal(id) {
            fetch(`/admin/articles/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editArticleId').value = data.id;
                    document.getElementById('editTieuDe').value = data.tieu_de;
                    document.getElementById('editMoTa').value = data.mo_ta;
                    document.getElementById('editTacGia').value = data.tac_gia;
                    document.getElementById('editDanhMuc').value = data.ma_danh_muc;
                    document.getElementById('editDonVi').value = data.ma_don_vi;
                    document.getElementById('editNgayPhatHanh').value = data.ngay_phat_hanh;
                    document.getElementById('EditModal').classList.remove('hidden');
                });
        }

        function closeEditModal() {
            document.getElementById('EditModal').classList.add('hidden');
        }
        // Author search
        let authorTimeout;
        document.getElementById('search_author').addEventListener('input', function(e) {
            clearTimeout(authorTimeout);
            const searchText = e.target.value.trim();
            const suggestions = document.getElementById('author_suggestions');

            // Hide suggestions if search text is empty
            if (!searchText) {
                suggestions.classList.add('hidden');
                return;
            }

            authorTimeout = setTimeout(() => {
                fetch(`/api/search-authors?search=${searchText}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestions.innerHTML = '';

                        if (data.length > 0) {
                            suggestions.classList.remove('hidden');
                            data.forEach(author => {
                                const div = document.createElement('div');
                                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                                div.textContent = `${author.ten} (${author.email})`;
                                div.onclick = () => {
                                    document.getElementById('search_author').value = author
                                        .ten;
                                    document.getElementById('selected_author').value =
                                        author.ten;
                                    suggestions.classList.add('hidden');
                                };
                                suggestions.appendChild(div);
                            });
                        } else {
                            suggestions.classList.add('hidden');
                        }
                    });
            }, 300);
        });

        // Topic search
        let topicTimeout;
        document.getElementById('search_topic').addEventListener('input', function(e) {
            clearTimeout(topicTimeout);
            const searchText = e.target.value.trim();
            const suggestions = document.getElementById('topic_suggestions');

            // Hide suggestions if search text is empty
            if (!searchText) {
                suggestions.classList.add('hidden');
                return;
            }

            topicTimeout = setTimeout(() => {
                fetch(`/api/search-topics?search=${searchText}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestions.innerHTML = '';

                        if (data.length > 0) {
                            suggestions.classList.remove('hidden');
                            data.forEach(topic => {
                                const div = document.createElement('div');
                                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                                div.textContent = topic.ten_de_tai;
                                div.onclick = () => {
                                    // Set both display text and hidden ID value
                                    document.getElementById('search_topic').value = topic
                                        .ten_de_tai;
                                    document.getElementById('selected_topic').value = topic
                                        .id; // Set ma_de_tai
                                    suggestions.classList.add('hidden');
                                };
                                suggestions.appendChild(div);
                            });
                        } else {
                            suggestions.classList.add('hidden');
                        }
                    });
            }, 300);
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.matches('#search_author, #search_topic')) {
                document.getElementById('author_suggestions').classList.add('hidden');
                document.getElementById('topic_suggestions').classList.add('hidden');
            }
        });

        function openAddArticleModal() {
            document.getElementById("AddModal").classList.remove("hidden");
        }

        function closeAddModal() {
            document.getElementById("AddModal").classList.add("hidden")
        }
    </script>
@endsection
