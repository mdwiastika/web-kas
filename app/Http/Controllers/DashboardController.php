<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function main()
    {
        $kas_masuk = Kas::where('kondisi_kas', 'Masuk')->sum('nominal');

        $kas_keluar = Kas::where('kondisi_kas', 'Keluar')->sum('nominal');
        $total_kas = ($kas_masuk - $kas_keluar);
        return view('admin.dashboard.main', [
            'title' => 'Dashboard Kas',
            'active' => '',
            'act' => '',
            'kas_masuk' => $kas_masuk,
            'kas_keluar' => $kas_keluar,
            'total_kas' => $total_kas,
        ]);
    }
}
