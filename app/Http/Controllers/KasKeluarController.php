<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\User;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $kass = Kas::where('kondisi_kas', 'Keluar')->orderByRaw('updated_at - created_at DESC')->get();
        return view('admin.table.kas-keluar.main', [
            'title' => 'Table Kas Keluar',
            'active' => 'table',
            'act' => 'tablekaskeluar',
            'users' => $users,
            'kass' => $kass,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $kas_masuk = Kas::where('kondisi_kas', 'Masuk')->sum('nominal');
            $kas_keluar = Kas::where('kondisi_kas', 'Keluar')->sum('nominal');
            $total_kas = ($kas_masuk - $kas_keluar);
            if ($request->nominal > $total_kas) {
                return back()->with('status', 'error')->with('message', 'Jumlah kas tidak mencukupi untuk diambil');
            }
            $validatedData = $request->validate([
                'jenis' => 'required',
                'nominal' => 'required',
                'tanggal_kas' => 'required',
                'user_id' => 'required',
            ]);
            if (!empty($request->keterangan)) {
                $validatedData['keterangan'] = $request->keterangan;
            }
            if ($request->user_id == 'none') {
                $validatedData['user_id'] = 1;
            }
            $validatedData['kondisi_kas'] = 'Keluar';
            $validatedData['tanggal_kas'] = str_replace('T', ' ', $request->tanggal_kas);
            $kas = Kas::create($validatedData);
            if ($kas) {
                return back()->with('status', 'success')->with('message', 'Berhasil tambah kas keluar');
            } else {
                return back()->with('status', 'error')->with('message', 'Gagal tambah kas keluar');
            }
        } catch (\Throwable $th) {
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $kas_masuk = Kas::where('kondisi_kas', 'Masuk')->sum('nominal');
            $kas_keluar = Kas::where('kondisi_kas', 'Keluar')->sum('nominal');
            $total_kas = ($kas_masuk - $kas_keluar);
            $total_kas_update = $total_kas + $request->kas_keluar_old;
            if ($request->nominal > $total_kas_update) {
                return back()->with('status', 'error')->with('message', 'Jumlah kas tidak mencukupi untuk diambil');
            }
            $kas = Kas::where('id_kas', $id);
            $validatedData = $request->validate([
                'jenis' => 'required',
                'nominal' => 'required',
                'tanggal_kas' => 'required',
                'user_id' => 'required',
            ]);
            if (!empty($request->keterangan)) {
                $validatedData['keterangan'] = $request->keterangan;
            }
            if ($request->user_id == 'none') {
                $validatedData['user_id'] = 1;
            }
            $validatedData['kondisi_kas'] = 'Keluar';
            $validatedData['tanggal_kas'] = str_replace('T', ' ', $request->tanggal_kas);
            $kas->update($validatedData);
            if ($kas) {
                return back()->with('status', 'success')->with('message', 'Berhasil update kas masuk');
            } else {
                return back()->with('status', 'error')->with('message', 'Gagal update kas masuk');
            }
        } catch (\Throwable $th) {
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kas = Kas::where('id_kas', $id)->first();
            $kas->delete();
            return back()->with('status', 'success')->with('message', 'Berhasil hapus kas keluar');
        } catch (\Throwable $th) {
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
