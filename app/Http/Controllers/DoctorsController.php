<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id', 'desc')->get();
        return view('employee.doctors.doctors')->with('doctors', $doctors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Vrije Dagen
        $dagen = array(
            'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'
        );
        $doctors = User::where('is_employee', true)->get();
        return view('employee.doctors.add')
        ->with('doctors', $doctors)
        ->with('dagen', $dagen);
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
            'name'         => 'required',
        ]);

        if (!Doctor::where('name', $request->name)->exists()) {
            Doctor::create([
                'name' => $request->name,
                'free_day' =>$request->free_day,
            ]);

            return redirect('/doctors')->with('message', 'Dokter is toegevoegd.');
         }
         else {
            return redirect()->back()->with('err', 'Deze naam bestaat al.');
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
        $dagen = array(
            'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'
        );
        $doctor = Doctor::where('id', $id)->first();
        return view('employee.doctors.edit')
        ->with('doctor', $doctor)
        ->with('dagen', $dagen);
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
            'name'         => 'required',
        ]);

        Doctor::where('id', $id)->update([
            'name'         => $request->name,
            'free_day'   => $request->free_day,
        ]);

        return redirect('/doctors')->with('message', 'Uw wijzigingen zijn succesvol opgeslagen.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctor::where('id', $id)->delete();
        return redirect('/doctors')->with('message', 'Dokter is verwijderd');
    }
}
