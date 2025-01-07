@extends('layout.user_layout')
@section('title', 'Trang chủ')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <form action="{{ route('user.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="tenDeTai" class="block text-gray-700">Tiêu đề</label>
                        <input id="tenDeTai"
                               name="tenDeTai"
                               class="border border-gray-300 p-2 rounded-md w-full"
                               type="text"
                               value="{{ request('tenDeTai') }}" />
                    </div>
                    <div>
                        <label for="khoaDonVi" class="block text-gray-700">Khoa/Đơn vị</label>
                        <input id="khoaDonVi"
                               name="khoaDonVi"
                               class="border border-gray-300 p-2 rounded-md w-full"
                               type="text"
                               value="{{ request('khoaDonVi') }}" />
                    </div>
                    <div>
                        <label for="danhMucDeTai" class="block text-gray-700">Danh mục</label>
                        <select id="danhMucDeTai"
                                name="danhMucDeTai"
                                class="border border-gray-300 p-2 rounded-md w-full">
                            <option selected="" value="">Danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('danhMucDeTai') == $category->id ? 'selected' : '' }}>
                                    {{ $category->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="namXuatBan" class="block text-gray-700">Năm xuất bản</label>
                        <input id="namXuatBan"
                               name="namXuatBan"
                               class="border border-gray-300 p-2 rounded-md w-full"
                               type="number"
                               value="{{ request('namXuatBan') }}" />
                    </div>
                    <div>
                        <label for="tacGia" class="block text-gray-700">Tác giả</label>
                        <input id="tacGia"
                               name="tacGia"
                               class="border border-gray-300 p-2 rounded-md w-full"
                               type="text"
                               value="{{ request('tacGia') }}" />
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center mb-1 mt-5">
                            <input id="soHuuUNETI" name="soHuuUNETI" class="mr-2" type="checkbox" {{ request('soHuuUNETI') ? 'checked' : '' }} />
                            <label for="soHuuUNETI" class="text-gray-700">Những bài báo thuộc sở hữu của UNETI</label>
                        </div>
                        {{-- <div class="flex items-center mb-1">
                            <input id="baiBaoQuocTe" name="baiBaoQuocTe" class="mr-2" type="checkbox" {{ request('baiBaoQuocTe') ? 'checked' : '' }} />
                            <label for="baiBaoQuocTe" class="text-gray-700">Những bài báo quốc tế</label>
                        </div> --}}
                    </div>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="submit">
                    Tìm kiếm
                </button>
            </form>
        </div>
        @if ($articles->isEmpty())
            <p class="text-center text-gray-700">Không tìm thấy bài báo nào</p>
        @else
        <div class="flex justify-end mb-4">
            <div class="flex items-center justify-center w-32 h-10 rounded-lg overflow-hidden">
                <button id="toggleView"
                    class="w-1/2 h-full rounded-md bg-blue-500 flex items-center justify-center cursor-pointer">
                    <i id="icon" class="fas fa-th text-white"></i>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6" id="researchContainer">
            @foreach($articles as $article)
            <a class="bg-white p-2 rounded-md shadow-md hover:shadow-lg transition-shadow flex flex-col" href="#">
                @if($article->img)
                    <img alt="Hình ảnh minh họa nghiên cứu khoa học" class="rounded-md mb-4 object-cover"
                        src="{{ $article->img }}" />
                @endif
                <div>
                    <h5 class="text-xl font-bold mb-2 text-center">
                        {{ $article->tieu_de }}
                    </h5>
                    <p class="text-gray-700">
                        <strong>
                            Danh mục:
                        </strong>
                        {{ $article->danhMuc ? $article->danhMuc->ten_danh_muc : 'Không có danh mục' }}
                    </p>
                    <p class="text-gray-700 ">
                        <strong>
                            Tổ chức:
                        </strong>
                        {{ $article->donVi->ten_don_vi }}
                    </p>
                    <p class="text-gray-700 ">
                        <strong>
                            Tác giả:
                        </strong>
                        {{ $article->tac_gia }}
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Thời gian xuất bản:
                        </strong>
                        {{ $article->ngay_phat_hanh }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
@endsection
