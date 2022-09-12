<?php

namespace App\Http\Controllers;

use App\Beli;
use App\Panen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanenController extends Controller
{
    public function index()
    {
        $dataPanen = Panen::join('users', 'id_petani', '=', 'users.id')->orderBy('created_at', 'desc')->get(['panens.*', 'users.name', 'users.lokasi']);
        $dataPanen2 = Panen::where('id_petani', '=', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('panen.index', compact('dataPanen', 'dataPanen2'));
    }

    public function create()
    {
        $dataPetani = User::where('role', 'Petani')->get();
        return view('panen.add', compact('dataPetani'));
    }

    public function store(Request $request)
    {
        $tgl_sekarang = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $panen_exist = Panen::where([
            ['tanggal', '=', $tgl_sekarang],
            ['id_petani', '=', $request->id_petani]
        ])->get();
        if (count($panen_exist) > 0) {
            return redirect()->route('panen.index')->with('warning', 'Data panen sudah ada, silakan tambah data panen yang lain.');
        } else {
            Panen::create([
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'id_petani' => $request->id_petani,
                'berat' => $request->berat,
                'hasil_penjualan' => $request->hasil_penjualan
            ]);
            return redirect()->route('panen.index')->with('success', 'Data panen berhasil ditambah');
        }
    }

    public function edit($id)
    {
        $detailPanen = Panen::where('id', '=', $id)->get();
        return view('panen.edit', compact('detailPanen'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'berat' => ['required', 'integer'],
            ],
            [
                'berat.required' => 'Data tidak boleh kosong, harap diisi',
            ]
        );

        Panen::where('id', $id)->update([
            'berat' => $request->berat,
        ]);
        return redirect()->route('panen.index')->with('success', 'Data panen berhasil diedit');
    }

    public function createPembelian()
    {
        return view('panen.beli');
    }

    public function storePembelian(Request $request)
    {
        $tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $dataPanen = Panen::where('tanggal', '=', $tanggal)->get();
        foreach ($dataPanen as $panen) {
            $panen->hasil_penjualan = $request->harga * $panen->berat;
            $panen->update();
        }
        Beli::create([
            'tanggal' => $tanggal,
            'harga' => $request->harga
        ]);
        return redirect()->route('panen.index')->with('success', 'Data harga pembelian/kulak berhasil ditambah');
    }

    public function hargaBeli()
    {
        $dataHarga = Beli::orderBy('created_at', 'desc')->get()->all();
        return view('panen.harga', compact('dataHarga'));
    }

    public function detailPanen($id)
    {
        $dataPanen = Panen::join('users', 'id_petani', '=', 'users.id')->where('panens.id', $id)->get(['panens.*', 'users.name', 'users.lokasi']);
        return view('panen.detail', compact('dataPanen'));
    }

    public function laporanPenjualan($tglAwal, $tglAkhir)
    {
        $penjualan = Panen::join('users', 'id_petani', '=', 'users.id')->whereBetween('tanggal', [$tglAwal, $tglAkhir]);
    }
}
