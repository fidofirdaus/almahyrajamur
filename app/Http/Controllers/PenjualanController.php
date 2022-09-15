<?php

namespace App\Http\Controllers;

use App\Jual;
use App\Penjualan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function indexKeseluruhan()
    {
        $dataPenjualan = Penjualan::join('users', 'id_pembeli', '=', 'users.id')->orderBy('tanggal', 'desc')->get(['penjualans.*', 'users.name', 'users.lokasi', 'users.role']);
        // dd($dataPenjualan);
        return view('penjualan.indexKeseluruhan', compact('dataPenjualan'));
    }

    public function indexHarian()
    {
        $tgl_sekarang = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $dataPenjualan = Penjualan::join('users', 'id_pembeli', '=', 'users.id')->where('tanggal', $tgl_sekarang)->orderBy('tanggal', 'desc')->get(['penjualans.*', 'users.name', 'users.lokasi', 'users.role']);
        // dd($dataPenjualan);
        return view('penjualan.indexHarian', compact('dataPenjualan'));
    }

    public function create()
    {
        $dataPembeli = User::where('role', 'Langganan')->orWhere('role', 'Umum')->get();
        return view('penjualan.add', compact('dataPembeli'));
    }

    public function store(Request $request)
    {
        $tgl_sekarang = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $penjualan_exist = Penjualan::where([
            ['tanggal', '=', $tgl_sekarang],
            ['id_pembeli', '=', $request->id_pembeli]
        ])->get();
        if (count($penjualan_exist) > 0) {
            return redirect()->route('penjualan.index')->with('warning', 'Data penjualan sudah ada, silakan tambah data penjualan yang lain.');
        } else {
            Penjualan::create([
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'id_pembeli' => $request->id_pembeli,
                'berat' => $request->berat,
                'total_harga' => $request->total_harga,
                'status' => 'Belum Bayar',
            ]);
            return redirect()->route('penjualan.indexHarian')->with('success', 'Data penjualan berhasil ditambah');
        }
    }

    public function createHarga()
    {
        return view('penjualan.jual');
    }
    
    public function storeHarga(Request $request)
    {
        $tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $dataPenjualan = Penjualan::where('tanggal', $tanggal)->get();
        foreach ($dataPenjualan as $penjualan) {
            $penjualan->total_harga = $request->harga * $penjualan->berat;
            $penjualan->update();
        }
        Jual::create([
            'tanggal' => $tanggal,
            'harga' => $request->harga
        ]);
        return redirect()->route('penjualan.indexKeseluruhan')->with('success', 'Data harga penjualan berhasil ditambah');
    }

    public function editHarga($id)
    {
        $dataPenjualan = Penjualan::where('id', $id)->get();
        return view('penjualan.editHarga', compact('dataPenjualan'));
    }
    
    public function updateHarga(Request $request, $id)
    {
        $tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $dataPenjualan = Penjualan::join('users', 'id_pembeli', '=', 'users.id')->where('penjualans.id', $id)->where('tanggal', $tanggal)->get(['penjualans.*', 'users.name', 'users.lokasi', 'users.role']);
        foreach ($dataPenjualan as $penjualan) {
            $penjualan->total_harga = $request->harga * $penjualan->berat;
            $penjualan->update();
        }
        return redirect()->route('penjualan.indexKeseluruhan')->with('success', 'Data harga penjualan berhasil diubah');
    }

    public function detailPenjualan($id)
    {
        $dataPenjualan = Penjualan::join('users', 'id_pembeli', '=', 'users.id')->where('penjualans.id', $id)->get(['penjualans.*', 'users.name', 'users.lokasi', 'users.role']);
        return view('penjualan.detail', compact('dataPenjualan'));
    }

    public function hargaJual()
    {
        $dataHarga = Jual::orderBy('created_at', 'desc')->get()->all();
        return view('penjualan.harga', compact('dataHarga'));
    }

    public function editStatus(Request $request, $id)
    {
        $dataPenjualan = Penjualan::where('penjualans.id', $id)->update([
            'status' => $request->status
        ]);
        
        return redirect()->route('penjualan.indexKeseluruhan')->with('success', 'Status penjualan berhasil diubah');
    }

    public function updateStatus(Request $request, $id)
    {
        $dataPenjualan = Penjualan::where('penjualans.id', $id)->get(['penjualans.*']);
        
        foreach ($dataPenjualan as $penjualan)
        {
            $penjualan->status = 'Sudah Bayar';
            $penjualan->update();
        }
        return redirect()->route('penjualan.indexKeseluruhan')->with('success', 'Status penjualan berhasil diubah');
    }
}
