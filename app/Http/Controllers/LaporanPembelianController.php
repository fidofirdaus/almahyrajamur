<?php

namespace App\Http\Controllers;

use App\Panen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class LaporanPembelianController extends Controller
{
    public function index()
    {
        $dataPetani = Panen::join('users', 'id_petani', '=', 'users.id')->distinct()->get('users.*');
        return view('laporan.formPembelian', compact('dataPetani'));
    }

    public function printPembelian(Request $request)
    {
        switch ($request->input('aksi')) {
            case 'cetak':
                $dataPanen = Panen::join('users', 'id_petani', '=', 'users.id')->where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get(['users.*', 'panens.*']);
                $total = Panen::where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('hasil_penjualan');
                $petani = User::where('id', $request->id_petani)->first();
    
                $data = ['dataPanen' => $dataPanen, 'petani' => $petani, 'total' => $total];
    
                foreach ($dataPanen as $panen) {
                    $panen->status = 'Sudah Dibayar';
                    $panen->update();
                }

                return view('laporan.laporanPembelian', $data);
                break;
    
            case 'cetak2':
                $dataPanen = Panen::join('users', 'id_petani', '=', 'users.id')->where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get(['users.*', 'panens.*']);
                $total = Panen::where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('hasil_penjualan');
                $petani = User::where('id', $request->id_petani)->first();
    
                $data = ['dataPanen' => $dataPanen, 'petani' => $petani, 'total' => $total];
    
                foreach ($dataPanen as $panen) {
                    $panen->status = 'Sudah Dibayar';
                    $panen->update();
                }

                return view('laporan.laporanPembelian2', $data);
                break;
        }
    }
}
