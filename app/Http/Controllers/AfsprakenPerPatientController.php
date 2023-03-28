<?php

namespace App\Http\Controllers;

use App\Models\Afspraak;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AfsprakenPerPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patienten = User::where('is_employee', 0);
        $afspraken = Afspraak::orderBy('user_id')->get();

        return view('employee/afsprakenPerPatient')
        ->with('afspraken', $afspraken)
        ->with('patienten', $patienten);
    }
}
