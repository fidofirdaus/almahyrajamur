<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPembeli = User::where('role', 'Langganan')->orWhere('role', 'Umum')->get();
        return view('pembeli.index', compact('dataPembeli'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembeli.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'lokasi' => ['required', 'string', 'max:255'],
                'no_hp' => ['required', 'regex:/^(08)[0-9]*/', 'string', 'max:13', 'min:10'],
            ],
            [
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'lokasi.required' => 'Data tidak boleh kosong, harap diisi',
                'no_hp.required' => 'Data tidak boleh kosong, harap diisi',
                'no_hp.regex' => 'Nomor HP harus diawali dengan 08',
                'no_hp.min' => 'Nomor HP minimal 10 digit',
                'no_hp.max' => 'Nomor HP maksimal 13 digit',
            ]
        );
        User::create([
            'name' => $request->name,
            'lokasi' => $request->lokasi,
            'no_hp' => $request->no_hp,
            'username' => null,
            'password' => null,
            'role' => 'Pembeli'
        ]);
        return redirect()->route('pembeli.index')->with('success', 'Data pembeli berhasil ditambah');
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
    public function edit(User $pembeli)
    {
        return view('pembeli.edit', [
            'pembeli' => $pembeli
        ]);
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
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'lokasi' => ['required', 'string', 'max:255'],
                'no_hp' => ['required', 'regex:/^(08)[0-9]*/', 'string', 'max:13', 'min:10'],
            ],
            [
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'lokasi.required' => 'Data tidak boleh kosong, harap diisi',
                'no_hp.required' => 'Data tidak boleh kosong, harap diisi',
                'no_hp.regex' => 'Nomor HP harus diawali dengan 08',
                'no_hp.min' => 'Nomor HP minimal 10 digit',
                'no_hp.max' => 'Nomor HP maksimal 13 digit',
            ]
        );
        User::where('id', $id)->update([
            'name' => $request->name,
            'lokasi' => $request->lokasi,
            'no_hp' => $request->no_hp,
        ]);
        return redirect()->route('pembeli.index')->with('success', 'Data pembeli berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
