<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetaniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPetani = User::where('role', 'Petani')->get();
        return view('petani.index', compact('dataPetani'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petani.add');
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
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'lokasi' => ['required', 'string', 'max:255'],
            ],
            [
                'name.required' => 'Data tidak boleh kosong, harap diisi',
                'lokasi.required' => 'Data tidak boleh kosong, harap diisi',
                'username.required' => 'Data tidak boleh kosong, harap diisi',
            ]
        );
        User::create([
            'name' => $request->name,
            'lokasi' => $request->lokasi,
            'username' => $request->username,
            'password' => Hash::make(12345678),
            'role' => 'Petani'
        ]);
        return redirect()->route('petani.index')->with('success', 'Data petani berhasil ditambah');
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
    public function edit(User $petani)
    {
        return view('petani.edit', [
            'petani' => $petani
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
            ],
            [
                'name.required' => 'Data tidak boleh kosong, harap diisi',
            ]
        );
        User::where('id', $id)->update([
            'name' => $request->name,
            'lokasi' => $request->lokasi,
        ]);
        return redirect()->route('petani.index')->with('success', 'Data petani berhasil diedit');
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
