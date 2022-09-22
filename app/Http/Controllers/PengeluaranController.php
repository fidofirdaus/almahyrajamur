<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function indexHarian()
    {
        $tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $dataPengeluaran = Pengeluaran::where('tanggal', $tanggal)->get()->all();

        return view('pengeluaran.indexHarian', compact('dataPengeluaran'));
    }
    
    public function indexKeseluruhan()
    {
        $dataPengeluaran = Pengeluaran::all();

        return view('pengeluaran.indexKeseluruhan', compact('dataPengeluaran'));
    }

    public function create()
    {
        return view('pengeluaran.add');
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $jumlah = $request->jumlah;
        $tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');

        for ($i=0; $i < count($nama); $i++) { 
            $pengeluaran_exist = Pengeluaran::where([
                ['tanggal', '=', $tanggal],
                ['nama', '=', $nama[$i]]
            ])->get();
            if (count($pengeluaran_exist) > 0) {
                return redirect()->route('pengeluaran.indexHarian')->with('warning', 'Data pengeluaran sudah ada, silakan tambah data pengeluaran yang lain.');
            } else {
                $data = [
                    'nama' => $nama[$i],
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah[$i],
                    'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                ];
                Pengeluaran::insert($data);
            }
        }
        return redirect()->route('pengeluaran.indexHarian')->with('success', 'Data pengeluaran berhasil ditambah');

    }

    public function createNew()
    {
        $dataKemarin = Pengeluaran::whereDate('tanggal', Carbon::yesterday()->setTimezone('Asia/Jakarta')->format('Y-m-d'))->get();
        
        return view('pengeluaran.addNew', compact('dataKemarin'));
    }

    public function edit($id)
    {
        $dataPengeluaran = Pengeluaran::where('id', $id)->get();
        return view('pengeluaran.edit', compact('dataPengeluaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'jumlah' => ['required', 'integer'],
                'nama' => ['required'],
            ],
            [
                'jumlah.required' => 'Data tidak boleh kosong, harap diisi',
                'nama.required' => 'Data tidak boleh kosong, harap diisi',
            ]
        );

        Pengeluaran::where('id', $id)->update([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
        ]);
        return redirect()->route('pengeluaran.indexHarian')->with('success', 'Data pengeluaran berhasil diedit');
    }

    public function storeTerlewat(Request $request)
    {
        $nama = $request->nama;
        $jumlah = $request->jumlah;
        $tanggal = $request->tanggal;

        for ($i=0; $i < count($nama); $i++) { 
            $pengeluaran_exist = Pengeluaran::where([
                ['tanggal', '=', $tanggal],
                ['nama', '=', $nama[$i]]
            ])->get();
            if (count($pengeluaran_exist) > 0) {
                return redirect()->route('pengeluaran.indexKeseluruhan')->with('warning', 'Data pengeluaran sudah ada, silakan tambah data pengeluaran yang lain.');
            } else {
                $data = [
                    'nama' => $nama[$i],
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah[$i],
                    'created_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Jakarta'),
                ];
                Pengeluaran::insert($data);
            }
        }
        return redirect()->route('pengeluaran.indexKeseluruhan')->with('success', 'Data pengeluaran berhasil ditambah');
    }
}
