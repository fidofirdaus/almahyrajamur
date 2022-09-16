<?php

namespace App\Http\Controllers;

use App\Panen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function indexRekapPanen()
    {
        $dataPetani = Panen::join('users', 'id_petani', '=', 'users.id')->distinct()->get('users.*');
        return view('rekap.formPanen', compact('dataPetani'));
    }

    public function lihatRekapPanen(Request $request)
    {
        switch ($request->input('aksi')) {
            case 'cetak':
                $dataPanen = Panen::join('users', 'id_petani', '=', 'users.id')->where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get(['users.*', 'panens.*']);
                $total = Panen::where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('hasil_penjualan');
                $berat = Panen::where('id_petani', $request->id_petani)->where('hasil_penjualan', '!=', 0)->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('berat');
                $petani = User::where('id', $request->id_petani)->first();
                $tahun = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y');

                $data = ['dataPanen' => $dataPanen, 'petani' => $petani, 'total' => $total, 'tahun' => $tahun, 'berat' => $berat, 'tglAwal' => $request->tglAwal, 'tglAkhir' => $request->tglAkhir];

                return view('rekap.rekapPanen', $data);
                break;
    
            case 'download':
                dd('ini download');
                break;
        }
    }
}
