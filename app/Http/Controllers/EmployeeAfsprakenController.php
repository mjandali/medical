<?php

namespace App\Http\Controllers;

use App\Models\Afspraak;
use App\Models\Doctor;
use App\Models\Klacht;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAfsprakenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::today()->toDateString();
        $vandaag = Afspraak::where('date', $date)->get();
        $afspraken = Afspraak::orderBy('user_id')->get();
        return view('employee/afspraak/afspraken')
        ->with('afspraken', $afspraken)
        ->with('vandaag', $vandaag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $klachten = Klacht::all();
        $doctors = Doctor::all();
        return view('/employee/afspraak/create')
        ->with('users', $users)
        ->with('klachten', $klachten)
        ->with('doctors', $doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkUser = Afspraak::where('user_id', $request->user)->orderBy('id', 'DESC')->first();
        $doctor = Doctor::where('id', $request->doctor)->first();
        $afspraakDr = Afspraak::where('date', $request->date)->where('period', $request->period)->where('doctor_id', $request->doctor)->exists();

        if (!$checkUser) {
            if($doctor->free_day == $request->day) {
                return redirect()->back()->with('err', 'De geselecteerde dokter is vandaag vrij, selecteer een andere dokter.');
            } else {
                if ($afspraakDr) {
                    return redirect()->back()->with('err', 'De geselecteerde dokter heeft een afspraak, selecteer een andere dokter of een andere periode.');
                } else {
                    Afspraak::create([
                        'date' => $request->date,
                        'day' =>$request->day,
                        'period' =>$request->period,
                        'user_id' =>$request->user,
                        'klacht_id' =>$request->klacht,
                        'doctor_id' =>$request->doctor,
                    ]);
                    return redirect('/employee/afspraaken')->with('message', 'Afspraak is aangemaakt.');
                }
            }
        }
        else {
            if ($checkUser->status == true) {
                if($doctor->free_day == $request->day) {
                    return redirect()->back()->with('err', 'De geselecteerde dag is een vrije dag voor deze arts, selecteer een andere dokter of een andere dag.');
                } else {
                    if ($afspraakDr) {
                        return redirect()->back()->with('err', 'De geselecteerde dokter heeft een afspraak, selecteer een andere dokter of een andere periode.');
                    } else {
                        Afspraak::create([
                        'date' => $request->date,
                        'day' =>$request->day,
                        'period' =>$request->period,
                        'user_id' =>$request->user,
                        'klacht_id' =>$request->klacht,
                        'doctor_id' =>$request->doctor,
                    ]);
                    return redirect('/employee/afspraaken')->with('message', 'Afspraak is aangemaakt.');
                    }
                }
            } else {
            return redirect()->back()->with('err', 'Deze patiënt heeft al een afspraak.');
            }
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
        $klachten = Klacht::all();
        $doctors = Doctor::all();
        $afspraak = Afspraak::where('id', $id)->first();
        return view('/employee/afspraak/edit')
        ->with('afspraak', $afspraak)
        ->with('klachten', $klachten)
        ->with('doctors', $doctors);
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
        $doctor = Doctor::where('id', $request->doctor)->first();
        $afspraakDr = Afspraak::where('date', $request->date)->where('period', $request->period)->where('doctor_id', $request->doctor)->exists();
        $afspraak = Afspraak::where('id', $id)->first();


        if($doctor->free_day == $request->day) {
            return redirect()->back()->with('err', 'De geselecteerde dag is een vrije dag voor deze arts, selecteer een andere dokter of een andere dag.');
        } else {
            if ($afspraakDr & $request->doctor != $afspraak->doctor_id) {
                return redirect()->back()->with('err', 'De geselecteerde dokter heeft een afspraak, selecteer een andere dokter of een andere periode.');
            } else {
                Afspraak::where('id', $id)->update([
                    'date' => $request->date,
                    'day' =>$request->day,
                    'period' =>$request->period,
                    'status' => $request->status,
                    'user_id' =>$afspraak->user_id,
                    'klacht_id' =>$request->klacht,
                    'doctor_id' =>$request->doctor,
                ]);
                return redirect('/employee/afspraaken')->with('message', 'Afspraak is gewijzigd.');
            }
        }
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
