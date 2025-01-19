@extends('layout.user_layout')
@section('title', 'Đăng ký đề tài')
@section('content')

<div class="content_main flex-1 p-4 overflow-y-auto max-h-full">
    {{-- Search Form --}}
    <div class="mb-6 bg-white p-4 rounded-md shadow">
        <form action="{{ route('dkdetai') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input
                    type="text"
                    name="search_title"
                    placeholder="Tìm kiếm theo tên đề tài..."
                    value="{{ request('search_title') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>
            <div class="w-48">
                <select
                    name="search_year"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Chọn năm</option>
                    @for($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ request('search_year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Tìm kiếm
            </button>
            @if(request('search_title') || request('search_year'))
                <a href="{{ route('dkdetai') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Xóa bộ lọc
                </a>
            @endif
        </form>
    </div>

    {{-- Results List --}}
    @if ($deTais->isEmpty())
        <p class="text-center text-gray-700">Không tìm thấy đề tài nào</p>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach($deTais as $deTai)
                <div class="bg-white p-4 rounded-md shadow hover:shadow-lg transition-shadow">
                    <h3 class="text-lg font-bold mb-2">{{ $deTai->ten_de_tai }}</h3>
                    <p class="text-gray-600 mb-2">{{ $deTai->noi_dung_nghien_cuu }}</p>
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <p>Kinh phí: {{ number_format($deTai->kinh_phi, 0, ',', '.') }} VND</p>
                            <p>Thời gian: {{ $deTai->tu_ngay }} - {{ $deTai->den_ngay }}</p>
                        </div>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Đăng ký
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $deTais->links() }}
        </div>
    @endif
</div>

@endsection
