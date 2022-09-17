<?php

namespace App\Http\Controllers;

use App\Penjualansortir;
use App\Sortirpanen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanSortirController extends Controller
{
    public function index()
    {
        $dataPenjualan = Penjualansortir::get();
        return view('penjualanSortir.index', compact('dataPenjualan'));
    }
    
    public function create()
    {
        // $dataPanen = Sortirpanen::where('tanggal', Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->get();
        $dataPanen = Sortirpanen::get();
        $dataPembeli = User::where('role', 'Langganan')->orWhere('role', 'Umum')->orWhere('role', 'Pembeli')->get();
        return view('penjualanSortir.add', compact(['dataPanen', 'dataPembeli']));
    }

    public function store(Request $request)
    {
        $tgl_sekarang = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $penjualan_exist = Penjualansortir::where([
            ['tanggal', '=', $tgl_sekarang],
            ['id_panen', '=', $request->id_panen],
            // ['id_pembeli', '=', $request->id_pembeli],
        ])->get();
        if (count($penjualan_exist) > 0) {
            return redirect()->route('penjualanSortir.index')->with('warning', 'Data penjualan sudah ada, silakan tambah data panen yang lain.');
        } else {
            Penjualansortir::create([
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'id_panen' => $request->id_panen,
                'id_pembeli' => $request->id_pembeli,
                'berat_awal' => $request->berat_awal,
                'berat_terjual' => 0,
                'total_harga' => 0,
                'status' => 'Belum Bayar',
            ]);
            return redirect()->route('penjualanSortir.index')->with('success', 'Data penjualan sortir berhasil ditambah');
        }
    }

    public function detail($id)
    {
        $dataPenjualan = Penjualansortir::where('id', $id)->get();
        return view('penjualanSortir.detail', compact('dataPenjualan'));
    }
    
    public function editHarga($id)
    {
        $dataPenjualan = Penjualansortir::where('id', $id)->first();
        return view('penjualanSortir.editHarga', compact('dataPenjualan'));
    }

    public function updateHarga(Request $request, $id)
    {
        $dataPenjualan = Penjualansortir::where('id', $id)->get();
        
        foreach ($dataPenjualan as $panen)
        {
            $panen->total_harga = $request->total_harga;
            $panen->update();
        }
        return redirect()->route('penjualanSortir.index')->with('success', 'Harga penjualan sortir berhasil ditambah/edit');
    }

    public function editStatus($id)
    {
        $dataPenjualan = Penjualansortir::where('id', $id)->first();
        return view('penjualanSortir.editStatus', [
            'dataPenjualan' => $dataPenjualan
        ]);
    }

    public function updateStatus($id)
    {
        $dataPenjualan = Penjualansortir::where('id', $id)->get();
        
        foreach ($dataPenjualan as $penjualan)
        {
            $penjualan->status = 'Sudah Bayar';
            $penjualan->update();
        }
        return redirect()->route('penjualanSortir.index')->with('success', 'Status pembayaran berhasil diubah');
    }
}
