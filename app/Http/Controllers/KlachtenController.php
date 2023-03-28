<?php

namespace App\Http\Controllers;

use App\Models\Klacht;
use Illuminate\Http\Request;

class KlachtenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $klachten = Klacht::orderBy('klacht')->get();
        return view('klachten.klachten')->with('klachten', $klachten);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('klachten.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'klacht'    => 'required',
        ]);

        if (!Klacht::where('klacht', $request->klacht)->exists()) {
            Klacht::create([
                'klacht' => $request->klacht,
            ]);

            return redirect('/klachten')->with('message', 'Klacht is toegevoegd.');
         }
         else {
            return redirect()->back()->with('err', 'Deze klacht bestaat al.');
         }
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
    public function edit($id)
    {
        $klacht = Klacht::where('id', $id)->first();
        return view('klachten.edit')
        ->with('klacht', $klacht);
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
        $request->validate([
            'klacht'         => 'required',
        ]);

        Klacht::where('id', $id)->update([
            'klacht'         => $request->klacht,
        ]);

        return redirect('/klachten')->with('message', 'Uw wijzigingen zijn succesvol opgeslagen.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Klacht::where('id', $id)->delete();
        return redirect('/klachten')->with('message', 'Klacht is verwijderd');
    }
}
