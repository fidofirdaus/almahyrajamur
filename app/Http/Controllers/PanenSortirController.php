<?php

namespace App\Http\Controllers;

use App\Sortirpanen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PanenSortirController extends Controller
{
    public function index()
    {
        $dataPanen = Sortirpanen::where('status', 'Belum Dibayar')->get();
        return view('panenSortir.index', compact('dataPanen'));
    }

    public function create()
    {
        $dataPetani = User::where('role', 'Petani')->get();
        return view('panenSortir.add', compact('dataPetani'));
    }

    public function store(Request $request)
    {
        $tgl_sekarang = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d');
        $panen_exist = Sortirpanen::where([
            ['tanggal', '=', $tgl_sekarang],
            ['id_petani', '=', $request->id_petani]
        ])->get();
        if (count($panen_exist) > 0) {
            return redirect()->route('panenSortir.index')->with('warning', 'Data panen sudah ada, silakan tambah data panen yang lain atau edit data yang ada.');
        } else {
            Sortirpanen::create([
                'tanggal' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'id_petani' => $request->id_petani,
                'berat' => $request->berat,
                'total_harga' => $request->total_harga,
                'status' => 'Belum Dibayar',
            ]);
            return redirect()->route('panenSortir.index')->with('success', 'Data panen berhasil ditambah');
        }
    }

    public function detail($id)
    {
        $dataPanen = Sortirpanen::where('id', $id)->get();
        return view('panenSortir.detail', compact('dataPanen'));
    }

    public function editHarga($id)
    {
        $dataPanen = Sortirpanen::where('id', $id)->first();
        return view('panenSortir.editHarga', compact('dataPanen'));
    }
    
    public function updateHarga(Request $request, $id)
    {
        $dataPanen = Sortirpanen::where('id', $id)->get();
        
        foreach ($dataPanen as $panen)
        {
            $panen->total_harga = $request->total_harga;
            $panen->update();
        }
        return redirect()->route('panenSortir.index')->with('success', 'Harga panen sortir berhasil ditambah/edit');
    }
}
