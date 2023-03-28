<?php

namespace App\Http\Controllers;

use App\Models\Afspraak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patienten = User::where('is_employee', 0)->get();
        return view('patienten/patienten')->with('patienten', $patienten);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patienten/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max: 255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday' => ['required', 'max: 14'],
            'phone_number' => ['required', 'string', 'min:10', 'max: 10'],
            'is_employee' => ['required', 'max: 1'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_employee' => $request->is_employee,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('message', 'Account is succesvol aangemaakt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('/patienten/edit')->with('user', $user);
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max: 255'],
            'birthday' => ['required', 'max: 14'],
            'phone_number' => ['required', 'string', 'min:10', 'max: 10'],
            'is_employee' => ['required', 'max: 1'],
            ]);

            if (!empty($request->password)) {
                $request->validate([
                    'password' => ['string', 'min:8', 'confirmed'],
                ]);
            }

            $user = User::where('id', $id)->first();
            $email = $user->email;

            if ($request->email != $email) {
                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }

            $new_password = $request->password;
            $old_password = $request->old_password;
            $password = "";
            if (!empty($new_password)) {
                $password = $new_password;
            } else {
                $password = $old_password;
            }


        User::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_employee' => $request->is_employee,
            'password' => Hash::make($password),
        ]);

        return redirect('/patienten')->with('message', 'Account is succesvol bewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('message', 'Account is verwijderd');
    }

    //Display Klachten Per Patient.
    public function klachtenPerPatient()
    {
        $patienten = User::where('is_employee', 0);
        $afspraken = Afspraak::orderBy('user_id')->get();
        $first = Afspraak::orderby('user_id')->first();
        if ($first) {
            $first = $first->user_id;
        }
        return view('employee/klachtenPerPatient')
        ->with('afspraken', $afspraken)
        ->with('patienten', $patienten)
        ->with('first', $first);
    }

    //Display Patienten Per Klacht
    public function patientenPerKlacht()
    {
        $patienten = User::where('is_employee', 0);
        $afspraken = Afspraak::orderBy('klacht_id')->get();
        $first = Afspraak::orderby('klacht_id')->first();
        if ($first) {
        $first = $first->klacht_id;
        }

        return view('employee/patientenPerKlacht')
        ->with('afspraken', $afspraken)
        ->with('patienten', $patienten)
        ->with('first', $first);
    }


}
