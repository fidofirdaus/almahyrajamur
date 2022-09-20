<?php

namespace App\Http\Controllers;

use App\Panen;
use App\Pengeluaran;
use App\Penjualan;
use App\Penjualansortir;
use App\Sortirpanen;
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

    public function rekapKeuntungan()
    {
        return view('rekap.formKeuntungan');
    }

    public function printRekapKeuntungan(Request $request)
    {
        //Penjualan
        $dataPenjualan = Penjualan::where('status', 'Sudah Bayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get();
        $dataPenjualanSortir = Penjualansortir::where('status', 'Sudah Bayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get();

        $totalPenjualan = Penjualan::where('status', 'Sudah Bayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('total_harga');
        $totalPenjualanSortir = Penjualansortir::where('status', 'Sudah Bayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('total_harga');

        $beratPenjualan = Penjualan::where('status', 'Sudah Bayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('berat');
        $beratPenjualanSortir = Penjualansortir::where('status', 'Sudah Bayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('berat_awal');


        //Panen
        $dataPanen = Panen::where('status', 'Sudah Dibayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get();
        $dataPanenSortir = Sortirpanen::where('status', 'Sudah Dibayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get();

        
        $totalPanen = Panen::where('status', 'Sudah Dibayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('hasil_penjualan');
        $totalPanenSortir = Sortirpanen::where('status', 'Sudah Dibayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('total_harga');

        $beratPanen = Panen::where('status', 'Sudah Dibayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('berat');
        $beratPanenSortir = Sortirpanen::where('status', 'Sudah Dibayar')->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('berat');

        //Pengeluaran
        $dataPengeluaran = Pengeluaran::whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->get();
        $totalPengeluaran = Pengeluaran::whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])->sum('jumlah');

        //Data
        $data = ['dataPenjualan' => $dataPenjualan, 'dataPenjualanSortir' => $dataPenjualanSortir, 'dataPanen' => $dataPanen, 'dataPanenSortir' => $dataPanenSortir, 'totalPenjualan' => $totalPenjualan, 'totalPenjualanSortir' => $totalPenjualanSortir, 'totalPanen' => $totalPanen, 'totalPanenSortir' => $totalPanenSortir, 'beratPenjualan' => $beratPenjualan, 'beratPenjualanSortir' => $beratPenjualanSortir, 'beratPanen' => $beratPanen, 'beratPanenSortir' => $beratPanenSortir, 'dataPengeluaran' => $dataPengeluaran, 'totalPengeluaran' => $totalPengeluaran, 'tglAwal' => $request->tglAwal, 'tglAkhir' => $request->tglAkhir];

        return view('rekap.rekapKeuntungan', $data);
    }
}
