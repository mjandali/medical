<?php

namespace App\Http\Controllers;

use App\Mail\AfspraakBevestigen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Afspraak;
use App\Models\Doctor;
use App\Models\Klacht;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AfspraakenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $afspraken = Afspraak::where('user_id', Auth::user()->id)->get();
        return view('afspraak/afspraken')->with('afspraken', $afspraken);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $checkUser = Afspraak::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        $doctor = Doctor::where('id', $request->doctor)->first();
        $afspraakDr = Afspraak::where('date', $request->date)->where('period', $request->period)->where('doctor_id', $request->doctor)->exists();

        if (!$checkUser) {
            if($doctor->free_day == $request->day) {
                return redirect('/home')->with('err', 'De geselecteerde dokter is vandaag vrij, selecteer een andere dokter.');
            } else {
                if ($afspraakDr) {
                    return redirect('/home')->with('err', 'De geselecteerde dokter heeft een afspraak, selecteer een andere dokter of een andere periode.');
                } else {
                    Afspraak::create([
                        'date' => $request->date,
                        'day' =>$request->day,
                        'period' =>$request->period,
                        'user_id' =>auth()->user()->id,
                        'klacht_id' =>$request->klacht,
                        'doctor_id' =>$request->doctor,
                    ]);

                    $details = [
                        'title' => 'Afspraak Bevestigen',
                        'body' => 'U heeft met succes een afspraak gemaakt.'
                    ];
                    Mail::to(Auth::user()->email)->send(new AfspraakBevestigen($details));

                    return redirect('/home')->with('message', 'Afspraak is aangemaakt.');
                }
            }
        }
        else {
            if ($checkUser->status == true) {
                if($doctor->free_day == $request->day) {
                    return redirect('/home')->with('err', 'De geselecteerde dag is een vrije dag voor deze arts, selecteer een andere dokter of een andere dag.');
                } else {
                    if ($afspraakDr) {
                        return redirect('/home')->with('err', 'De geselecteerde dokter heeft een afspraak, selecteer een andere dokter of een andere periode.');
                    } else {
                        Afspraak::create([
                        'date' => $request->date,
                        'day' =>$request->day,
                        'period' =>$request->period,
                        'user_id' =>auth()->user()->id,
                        'klacht_id' =>$request->klacht,
                        'doctor_id' =>$request->doctor,
                    ]);

                    $details = [
                        'title' => 'Afspraak Bevestigen',
                        'body' => 'U heeft met succes een afspraak gemaakt.'
                    ];
                    Mail::to(Auth::user()->email)->send(new AfspraakBevestigen($details));

                    return redirect('/home')->with('message', 'Afspraak is aangemaakt.');
                    }
                }
            } else {
            return redirect()->back()->with('err', 'U heeft al een afspraak.');
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

        return view('afspraak/edit')
        ->with('klachten', $klachten)
        ->with('doctors', $doctors)
        ->with('afspraak', $afspraak);
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
            return redirect('/home')->with('err', 'De geselecteerde dag is een vrije dag voor deze arts, selecteer een andere dokter of een andere dag.');
        } else {
            if ($afspraakDr & $request->doctor != $afspraak->doctor_id) {
                return redirect('/home')->with('err', 'De geselecteerde dokter heeft een afspraak, selecteer een andere dokter of een andere periode.');
            } else {
                if (!$request->day) {
                    $day = $afspraak->day;
                } else {
                    $day = $request->day;
                }
                Afspraak::where('id', $id)->update([
                    'date' => $request->date,
                    'period' =>$request->period,
                    'day' => $day,
                    'user_id' =>auth()->user()->id,
                    'klacht_id' =>$request->klacht,
                    'doctor_id' =>$request->doctor,
                ]);
                return redirect('/home')->with('message', 'Afspraak is gewijzigd.');
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
        Afspraak::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Afspraak geannuleerd');
    }
}
