<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiBaoKhoaHoc;
use App\Models\SinhVien;
use App\Models\CanBo;
use App\Models\DeTai;
use App\Models\DanhMuc;
use App\Models\DonVi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function __construct() {}
    public function qlbaiviet(Request $request)
    {
        $danhMucs = DanhMuc::all();
        $donVis = DonVi::all();
        $query = BaiBaoKhoaHoc::query();

        if ($request->filled('search')) {
            $query->where('tieu_de', 'like', '%' . $request->search . '%')
                ->orWhere('tac_gia', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('trang_thai', $request->status);
        }

        $baiBaoKhoaHocs = $query->orderByRaw("FIELD(trang_thai, 'deactivate', 'activate', 'cancel')")->paginate(6);

        return view('admin.qlbaiviet', compact('baiBaoKhoaHocs', 'danhMucs', 'donVis'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:bai_bao_khoa_hocs,id',
            'status' => 'required|in:activate,deactivate',
        ]);

        $article = BaiBaoKhoaHoc::find($request->article_id);
        $article->trang_thai = $request->status;
        $article->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái bài báo thành công');
    }

    public function destroy($id)
    {
        $article = BaiBaoKhoaHoc::find($id);
        $article->delete();
        return redirect()->back()->with('success', 'Xóa bài viết thành công');
    }

    public function searchAuthors(Request $request)
    {
        $search = $request->search;

        $sinhViens = SinhVien::where('trang_thai', 'activate')
            ->where(function ($query) use ($search) {
                $query->where('ten_sinh_vien', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get(['ten_sinh_vien as ten', 'email']);

        $canBos = CanBo::where('trang_thai', 'activate')
            ->where(function ($query) use ($search) {
                $query->where('ten_can_bo', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->get(['ten_can_bo as ten', 'email']);

        return response()->json($sinhViens->concat($canBos));
    }

    public function searchTopics(Request $request)
    {
        $search = $request->search;

        $deTais = DeTai::where('ten_de_tai', 'LIKE', "%{$search}%")
            ->get(['id', 'ten_de_tai']);

        return response()->json($deTais);
    }

    public function addArticle(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string',
            'mo_ta' => 'required|string',
            'tac_gia' => 'required|string',
            'ma_de_tai' => 'required',
            'ma_danh_muc' => 'required',
            'ngay_phat_hanh' => 'required|date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $fileName = $this->handleImageUpload($request->file('img'));
            BaiBaoKhoaHoc::create([
                'tieu_de' => $request->tieu_de,
                'mo_ta' => $request->mo_ta,
                'tac_gia' => $request->tac_gia,
                'ma_de_tai' => $request->ma_de_tai,
                'ma_danh_muc' => $request->ma_danh_muc,
                'ngay_phat_hanh' => $request->ngay_phat_hanh,
                'img' => $fileName,
                'trang_thai' => 'deactivate'
            ]);
            return redirect()->back()->with('success', 'Thêm bài báo thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi upload ảnh: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors(['img' => 'Không thể tải lên ảnh. Vui lòng thử lại! Lỗi: ' . $e->getMessage()]);
        }
    }
    public function getArticle($id)
    {
        $article = BaiBaoKhoaHoc::find($id);
        return response()->json($article);
    }
    public function updateArticle(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bai_bao_khoa_hocs,id',
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'required|string',
            'tac_gia' => 'required|string|max:255',
            'ma_danh_muc' => 'required|exists:danh_mucs,id',
            'ma_don_vi' => 'required|exists:don_vis,id',
            'ngay_phat_hanh' => 'required|date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $article = BaiBaoKhoaHoc::find($request->id);
        $fileName = "https://via.placeholder.com/300x200"; // URL ảnh mặc định
        // Giữ nguyên URL ảnh cũ nếu không có ảnh mới
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            try {
                $uploadedFileUrl = Cloudinary::upload($request->file('img')->getRealPath())->getSecurePath();
                $fileName = $uploadedFileUrl; // Gán URL nếu upload thành công
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['img' => 'Không thể tải lên ảnh. Vui lòng thử lại!']);
            }
        }

        $article->tieu_de = $request->tieu_de;
        $article->mo_ta = $request->mo_ta;
        $article->tac_gia = $request->tac_gia;
        $article->ma_danh_muc = $request->ma_danh_muc;
        $article->ma_don_vi = $request->ma_don_vi;
        $article->ngay_phat_hanh = $request->ngay_phat_hanh;
        $article->img = $fileName;

        $article->save();

        return redirect()->route('admin.qlbaiviet')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    private function handleImageUpload($imageFile, $existingUrl = null)
    {
        // Default image if no file provided
        if (!$imageFile) {
            return $existingUrl ?? "https://via.placeholder.com/300x200";
        }

        try {
            // If existing URL is from Cloudinary, extract public_id
            if ($existingUrl && str_contains($existingUrl, 'cloudinary')) {
                $parsedUrl = parse_url($existingUrl);
                $pathParts = explode('/', $parsedUrl['path']);
                // Find 'articles' folder index
                $folderIndex = array_search('articles', $pathParts);
                if ($folderIndex !== false) {
                    // Get filename without extension
                    $publicId = 'articles/' . pathinfo($pathParts[count($pathParts) - 1], PATHINFO_FILENAME);

                    // Try to get existing image
                    try {
                        $asset = Cloudinary::getAsset($publicId);
                        if ($asset) {
                            return $existingUrl; // Reuse existing image
                        }
                    } catch (\Exception $e) {
                        // Image doesn't exist, continue with upload
                    }
                }
            }

            // Upload new image
            $result = Cloudinary::upload($imageFile->getRealPath(), [
                'folder' => 'articles',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]
            ]);

            return $result->getSecurePath();
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());
            throw $e;
        }
    }
}
