<?php

namespace App\Http\Controllers;

use App\Panen;
use App\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $panen = Panen::where('tanggal', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('berat');
        $uangPanen = Panen::where('tanggal', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('hasil_penjualan');
        $penjualan = Penjualan::where('tanggal', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('berat');
        $uangPenjualan = Penjualan::where('tanggal', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->where('status', 'Sudah Bayar')->sum('total_harga');
        $uangPenjualanBelum = Penjualan::where('tanggal', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->where('status', 'Belum Bayar')->sum('total_harga');

        $panenKemarin = Panen::where('tanggal', Carbon::yesterday()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('berat');
        $uangPanenKemarin = Panen::where('tanggal', Carbon::yesterday()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('hasil_penjualan');
        $penjualanKemarin = Penjualan::where('tanggal', Carbon::yesterday()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->sum('berat');
        $uangPenjualanKemarin = Penjualan::where('tanggal', Carbon::yesterday()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->where('status', 'Sudah Bayar')->sum('total_harga');
        $uangPenjualanBelumKemarin = Penjualan::where('tanggal', Carbon::yesterday()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->where('status', 'Belum Bayar')->sum('total_harga');

        return view('admin.index', ['panen' => $panen, 'panenKemarin' => $panenKemarin, 'uangPanen' => $uangPanen, 'uangPanenKemarin' => $uangPanenKemarin, 'penjualan' => $penjualan, 'uangPenjualan' => $uangPenjualan, 'penjualanKemarin' => $penjualanKemarin, 'uangPenjualanKemarin' => $uangPenjualanKemarin, 'uangPenjualanBelum' => $uangPenjualanBelum, 'uangPenjualanBelumKemarin' => $uangPenjualanBelumKemarin]);
    }
}
