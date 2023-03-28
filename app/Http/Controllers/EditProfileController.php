<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $user = User::all();
        return view('auth.edit')->with('user', $user);
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
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday' => ['required', 'max: 14'],
            'phone_number' => ['required', 'string', 'min:10', 'max: 10'],
            // 'password' => ['string', 'min:8', 'confirmed'],
        ]);

        if (!empty($request->password)) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
        }

        if ($request->email != Auth::user()->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        $new_password = $request->password;
        $old_password = auth()->user()->password;
        $password = "";
        if (!empty($new_password)) {
            $password = Hash::make($new_password);
        } else {
            $password = $old_password;
        }
        // dd($password);
        User::where('id', $id)->update([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'birthday'          => $request->birthday,
            'email'             => $request->email,
            'phone_number'      => $request->phone_number,
            'password'          => $password,
        ]);

        return redirect()->route('employee.afspraken')->with('message', 'Profiel is bijgewerkt.');
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
