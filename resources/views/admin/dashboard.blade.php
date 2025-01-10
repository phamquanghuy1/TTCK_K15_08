@extends('layout.admin_layout')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">
        Số lượng nghiên cứu
      </h3>
      <div class="text-3xl font-bold text-blue-600">25</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">
        Người dùng đăng ký
      </h3>
      <div class="text-3xl font-bold text-blue-600">150</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">
        Báo cáo gần đây
      </h3>
      <div class="text-3xl font-bold text-blue-600">10</div>
    </div>
  </div>
    <div class="bg-white p-6 mt-8 rounded-lg shadow-lg">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">
        Nghiên cứu gần đây
      </h2><br>
      <table class="min-w-full table-auto">
        <thead>
          <tr class="border-b">
            <th class="px-4 py-2 text-left">Tên Nghiên Cứu</th>
            <th class="px-4 py-2 text-left">Người thực hiện</th>
            <th class="px-4 py-2 text-left">Ngày bắt đầu</th>
            <th class="px-4 py-2 text-left">Trạng thái</th>
            <th class="px-4 py-2 text-left">Hành động</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="px-4 py-2">Nghiên cứu về AI</td>
            <td class="px-4 py-2">Cấn Đình Duy</td>
            <td class="px-4 py-2">27/02/2003</td>
            <td class="px-4 py-2 text-blue-600">Đang tiến hành</td>
            <td class="px-4 py-2">
              <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">
                Xem
              </button>
            </td>
          </tr>
          <tr>
            <td class="px-4 py-2">Nghiên cứu về Blockchain</td>
            <td class="px-4 py-2">Phạm Quang Huy</td>
            <td class="px-4 py-2">15/12/2003</td>
            <td class="px-4 py-2 text-green-600">Hoàn thành</td>
            <td class="px-4 py-2">
              <button class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">
                Xem
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
@endsection
