@extends('layout.user_layout')
@section('title', 'Trang chủ')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="tenDeTai" class="block text-gray-700">Tiêu đề</label>
                        <input id="tenDeTai" class="border border-gray-300 p-2 rounded-md w-full" type="text" />
                    </div>
                    <div>
                        <label for="khoaDonVi" class="block text-gray-700">Khoa/Đơn vị</label>
                        <input id="khoaDonVi" class="border border-gray-300 p-2 rounded-md w-full" type="text" />
                    </div>
                    <div>
                        <label for="danhMucDeTai" class="block text-gray-700">Loại công trình</label>
                        <select id="danhMucDeTai" class="border border-gray-300 p-2 rounded-md w-full">
                            <option selected="">
                                Loại công trình
                            </option>
                            <option value="1">
                                Danh mục 1
                            </option>
                            <option value="2">
                                Danh mục 2
                            </option>
                            <option value="3">
                                Danh mục 3
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="namXuatBan" class="block text-gray-700">Năm xuất bản</label>
                        <input id="namXuatBan" class="border border-gray-300 p-2 rounded-md w-full" type="text" />
                    </div>
                    <div>
                        <label for="tacGia" class="block text-gray-700">Tác giả</label>
                        <input id="tacGia" class="border border-gray-300 p-2 rounded-md w-full" type="text" />
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center mb-1 mt-5">
                            <input id="soHuuUNETI" class="mr-2" type="checkbox" />
                            <label for="soHuuUNETI" class="text-gray-700">Những bài báo thuộc sở hữu của UNETI</label>
                        </div>
                        <div class="flex items-center mb-1">
                            <input id="baiBaoQuocTe" class="mr-2" type="checkbox" />
                            <label for="baiBaoQuocTe" class="text-gray-700">Những bài báo quốc tế</label>
                        </div>
                    </div>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" type="submit">
                    Tìm kiếm
                </button>
            </form>
        </div>
        <div class="flex justify-end mb-4">
            <div class="flex items-center justify-center w-32 h-10 rounded-lg overflow-hidden">
                <button id="toggleView"
                    class="w-1/2 h-full rounded-md bg-blue-500 flex items-center justify-center cursor-pointer">
                    <i id="icon" class="fas fa-th text-white"></i>
                </button>
            </div>
        </div>
        {{-- <div class="grid grid-cols-1 md:grid-cols-4 gap-6" id="researchContainer">
            @foreach($articles as $article)
            <a class="bg-white p-2 rounded-md shadow-md hover:shadow-lg transition-shadow flex flex-col" href="#">
                @if($article->img)
                <img alt="Hình ảnh minh họa nghiên cứu khoa học" class="rounded-md mb-4 object-cover"
                    src="{{ $article->img }}" />
                @endif
                <div>
                    <h5 class="text-xl font-bold mb-2 text-center">
                        {{ $article->title }}
                    </h5>
                    <p class="text-gray-700 mb-2 text-justify">
                        {{ $article->description }}
                    </p>
                    <p class="text-gray-700 ">
                        <strong>
                            Tác giả:
                        </strong>
                        {{ $article->creator->name }}
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Thời gian xuất bản:
                        </strong>
                        {{ $article->publication_date }}
                    </p>
                </div>
            </a>
            @endforeach
        </div> --}}
    </div>
@endsection
