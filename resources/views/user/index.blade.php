@extends('layout.user_layout')
@section('title', 'Trang chủ')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-md shadow-md mb-8">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <input class="border border-gray-300 p-2 rounded-md" placeholder="Tên đề tài" type="text" />
                    <select class="border border-gray-300 p-2 rounded-md">
                        <option selected="">
                            Danh mục đề tài
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
                    <input class="border border-gray-300 p-2 rounded-md" placeholder="Năm xuất bản" type="text" />
                    <input class="border border-gray-300 p-2 rounded-md" placeholder="Tác giả" type="text" />
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6" id="researchContainer">
            <a class="bg-white p-2 rounded-md shadow-md hover:shadow-lg transition-shadow flex flex-col" href="#">
                <img alt="Hình ảnh minh họa nghiên cứu khoa học" class="rounded-md mb-4 object-cover"
                    src="https://storage.googleapis.com/a1aa/image/trxlIqxBdtrzPNxOwh4C4mTYIk25fdnqUkuaOVTfueWwgl5nA.jpg" />
                <div>
                    <h5 class="text-xl font-bold mb-2">
                        Tiêu đề nghiên cứu khoa học 1
                    </h5>
                    <p class="text-gray-700 mb-2">
                        Mô tả tóm tắt đề tài nghiên cứu khoa học 1. Đây là phần mô tả ngắn gọn về nội dung và mục tiêu
                        của nghiên cứu.
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Tác giả:
                        </strong>
                        Tác giả 1
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Thời gian xuất bản:
                        </strong>
                        2023
                    </p>
                </div>
            </a>
            <a class="bg-white p-2 rounded-md shadow-md hover:shadow-lg transition-shadow flex flex-col" href="#">
                <img alt="Hình ảnh minh họa nghiên cứu khoa học" class="rounded-md mb-4 object-cover"
                    src="https://storage.googleapis.com/a1aa/image/trxlIqxBdtrzPNxOwh4C4mTYIk25fdnqUkuaOVTfueWwgl5nA.jpg" />
                <div>
                    <h5 class="text-xl font-bold mb-2">
                        Tiêu đề nghiên cứu khoa học 2
                    </h5>
                    <p class="text-gray-700 mb-2">
                        Mô tả tóm tắt đề tài nghiên cứu khoa học 2. Đây là phần mô tả ngắn gọn về nội dung và mục tiêu
                        của nghiên cứu.
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Tác giả:
                        </strong>
                        Tác giả 2
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Thời gian xuất bản:
                        </strong>
                        2022
                    </p>
                </div>
            </a>
            <a class="bg-white p-2 rounded-md shadow-md hover:shadow-lg transition-shadow flex flex-col" href="#">
                <img alt="Hình ảnh minh họa nghiên cứu khoa học" class="rounded-md mb-4 object-cover"
                    src="https://storage.googleapis.com/a1aa/image/trxlIqxBdtrzPNxOwh4C4mTYIk25fdnqUkuaOVTfueWwgl5nA.jpg" />
                <div>
                    <h5 class="text-xl font-bold mb-2">
                        Tiêu đề nghiên cứu khoa học 3
                    </h5>
                    <p class="text-gray-700 mb-2">
                        Mô tả tóm tắt đề tài nghiên cứu khoa học 3. Đây là phần mô tả ngắn gọn về nội dung và mục tiêu
                        của nghiên cứu.
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Tác giả:
                        </strong>
                        Tác giả 3
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Thời gian xuất bản:
                        </strong>
                        2021
                    </p>
                </div>
            </a>
            <a class="bg-white p-2 rounded-md shadow-md hover:shadow-lg transition-shadow flex flex-col" href="#">
                <img alt="Hình ảnh minh họa nghiên cứu khoa học" class="rounded-md mb-4 object-cover"
                    src="https://storage.googleapis.com/a1aa/image/trxlIqxBdtrzPNxOwh4C4mTYIk25fdnqUkuaOVTfueWwgl5nA.jpg" />
                <div>
                    <h5 class="text-xl font-bold mb-2">
                        Tiêu đề nghiên cứu khoa học 4
                    </h5>
                    <p class="text-gray-700 mb-2">
                        Mô tả tóm tắt đề tài nghiên cứu khoa học 3. Đây là phần mô tả ngắn gọn về nội dung và mục tiêu
                        của nghiên cứu.
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Tác giả:
                        </strong>
                        Tác giả 4
                    </p>
                    <p class="text-gray-700">
                        <strong>
                            Thời gian xuất bản:
                        </strong>
                        2021
                    </p>
                </div>
            </a>
        </div>
    </div>
@endsection
