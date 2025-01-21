<?php
// app/Http/Controllers/SiteController.php
namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Header;
use App\Models\LienKetSite;
use App\Models\ThongBao;

class SiteController extends Controller
{
    public static function getLienKetSites()
    {
        return LienKetSite::where('trang_thai', 'activate')
        ->get();
    }

    public static function getThongBaos()
    {
        return ThongBao::where('trang_thai', 'activate')
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public static function getBanner()
    {
        return Header::where('trang_thai', 'activate')
        ->take(1)
        ->get();
    }

}
