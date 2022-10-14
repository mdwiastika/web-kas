<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function masuk(Request $request)
    {
        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {
            $kass = Kas::where('kondisi_kas', 'Masuk')->whereBetween('tanggal_kas', [$request->tanggal_awal, $request->tanggal_akhir])->orderByRaw('updated_at - created_at DESC')->get();
        } else {
            $kass = Kas::where('kondisi_kas', 'Masuk')->orderByRaw('updated_at - created_at DESC')->get();
        }
        $users = User::all();
        return view('admin.laporan.laporan-masuk', [
            'title' => 'Laporan Kas Masuk',
            'active' => 'laporan',
            'act' => 'laporanmasuk',
            'users' => $users,
            'kass' => $kass,
        ]);
    }
    public function keluar(Request $request)
    {
        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {
            $kass = Kas::where('kondisi_kas', 'Keluar')->whereBetween('tanggal_kas', [$request->tanggal_awal, $request->tanggal_akhir])->orderByRaw('updated_at - created_at DESC')->get();
        } else {
            $kass = Kas::where('kondisi_kas', 'Keluar')->orderByRaw('updated_at - created_at DESC')->get();
        }
        $users = User::all();
        return view('admin.laporan.laporan-keluar', [
            'title' => 'Laporan Kas Keluar',
            'active' => 'laporan',
            'act' => 'laporankeluar',
            'users' => $users,
            'kass' => $kass,
        ]);
    }
    public function printMasuk(Request $request)
    {
        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {
            $kass = Kas::where('kondisi_kas', 'Masuk')->whereBetween('tanggal_kas', [$request->tanggal_awal, $request->tanggal_akhir])->orderByRaw('updated_at - created_at DESC')->get();
        } else {
            $kass = Kas::where('kondisi_kas', 'Masuk')->orderByRaw('updated_at - created_at DESC')->get();
        }
        $users = User::all();
        return view('admin.laporan.print.print-laporan-masuk', [
            'title' => 'Print Kas Masuk',
            'active' => 'laporan',
            'act' => 'laporanmasuk',
            'users' => $users,
            'kass' => $kass,
        ]);
    }
    public function printKeluar(Request $request)
    {
        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {
            $kass = Kas::where('kondisi_kas', 'Keluar')->whereBetween('tanggal_kas', [$request->tanggal_awal, $request->tanggal_akhir])->orderByRaw('updated_at - created_at DESC')->get();
        } else {
            $kass = Kas::where('kondisi_kas', 'Keluar')->orderByRaw('updated_at - created_at DESC')->get();
        }
        $users = User::all();
        return view('admin.laporan.print.print-laporan-keluar', [
            'title' => 'Print Kas Keluar',
            'active' => 'laporan',
            'act' => 'laporankeluar',
            'users' => $users,
            'kass' => $kass,
        ]);
    }
}
