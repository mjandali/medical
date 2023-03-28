<?php

namespace App\Http\Controllers;

use App\Models\Klacht;
use App\Models\Doctor;
use App\Models\Afspraak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $now = Carbon::today()->toDateString();

            $klachten = Klacht::all();
            $doctors = Doctor::all();
            $checkUser = Afspraak::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
            $withDr = '';
            if ($checkUser) {
            $withDr = Doctor::where('id', $checkUser->doctor_id)->first();
            }

                return view('home')
                ->with(Auth::user()->username)
                ->with('klachten', $klachten)
                ->with('doctors', $doctors)
                ->with('checkUser', $checkUser)
                ->with('withDr', $withDr)
                -> with('now', $now);
        } else {
            return view ('home');
        }

    }


    public function employeeHome()
    {
        return view('employee/Home');
    }

}
