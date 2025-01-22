@extends('layout.user_layout')
@section('title', 'Trang chủ')
@section('content')
<!-- Main Content -->
<h2 class="text-2xl font-bold mb-3">Tìm kiếm</h2>
<form action="{{ route('home') }}" method="GET" class="space-y-2 border-b border-gray-300 pb-2">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="tenDeTai" class="block text-gray-700 font-semibold">Từ khóa</label>
            <input
            id="tenDeTai"
            name="tenDeTai"
            value="{{ request('tenDeTai') }}"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="text"
            />
        </div>
        <div>
            <label for="khoaDonVi" class="block text-gray-700 font-semibold">Khoa/Đơn vị</label>
            <input
            id="khoaDonVi"
            name="khoaDonVi"
            value="{{ request('khoaDonVi') }}"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="text" />
        </div>
        <div>
            <label for="khoaDonVi" class="block text-gray-700 font-semibold">Tác giả</label>
            <input
            id="tacGia"
            name="tacGia"
            value="{{ request('tacGia') }}"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="text" />
        </div>
        <div>
            <label for="namXuatBan" class="block text-gray-700 font-semibold">Năm xuất bản</label>
            <select
                name="namXuatBan"
                id="namXuatBan"
                class="w-full px-4 py-2.5 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn năm</option>
                    @for($year = date('Y'); $year >= 2010; $year--)
                        <option value="{{ $year }}" {{ request('namXuatBan') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
            </select>
        </div>
    </div>
    <div>
        <label class="block text-gray-700 font-semibold">Tùy chọn</label>
        <div class="flex items-center space-x-4">
            <label class="flex items-center">
                <input
                    id="soHuuUNETI"
                    name="soHuuUNETI"
                    class="mr-2"
                    type="checkbox" {{ request('soHuuUNETI') ? 'checked' : '' }} />
                <span>Thuộc sở hữu UNETI</span>
            </label>
            <label class="flex items-center">
                <input
                    id="sohuuQuocTe"
                    name="sohuuQuocTe"
                    class="mr-2"
                    type="checkbox" {{ request('sohuuQuocTe') ? 'checked' : '' }} />
                <span>Thuộc sở hữu quốc tế</span>
            </label>
        </div>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Tìm kiếm</button>
    @if(request('tenDeTai') || request('khoaDonVi') || request('tacGia') || request('namXuatBan') || request('soHuuUNETI') || request('sohuuQuocTe'))
        <a href="{{ route('home') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
            Xóa bộ lọc
        </a>
    @endif
</form>
@if ($articles->isEmpty())
    <p class="text-center text-gray-700">Không tìm thấy bài báo nào</p>
@else
<div class="content_main flex-1 p-4 overflow-y-auto max-h-full">
    <div class="grid grid-cols-1 gap-6">
        @foreach($articles as $article)
            <a href="#" class="bg-white p-4 rounded-md shadow hover:shadow-lg transition-shadow w-full">
                <div class="flex items-center">
                    <img src="{{ $article->img }}" alt="Item" class="rounded-md mb-4 w-1/4">
                    <div class="ml-4 w-3/4">
                        <h3 class="text-lg font-bold mb-2">
                            {{ $article->tieu_de }}
                        </h3>
                        <p class="text-gray-700 text-sm mb-2">{{ $article->mo_ta }}</p>
                        <p class="text-gray-700 text-sm"><strong>Tổ chức:</strong>
                            {{ $article->donVi->ten_don_vi }}
                        </p>
                        <p class="text-gray-700 text-sm"><strong>Danh mục:</strong>
                            {{ $article->danhMuc ? $article->danhMuc->ten_danh_muc : 'Không có danh mục' }}
                        </p>
                        <p class="text-gray-700 text-sm"><strong>Tác giả:</strong>
                            {{ $article->tac_gia }}
                        </p>
                        <p class="text-gray-700 text-sm"><strong>Thời gian xuất bản:</strong>
                            {{ $article->ngay_phat_hanh }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    @foreach($articles as $article)
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
    @endforeach
</div>
@endif
@endsection
