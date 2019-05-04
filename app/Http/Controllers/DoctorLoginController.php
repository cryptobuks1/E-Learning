<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Doctor;
use Validator;
use Auth;
use App\Http\Resources\Doctor as DoctorResource;

class DoctorLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors =  Doctor::paginate(5);
        return DoctorResource::collection($doctors);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor = new Doctor;
        $doctor->firstname = $request->input('firstname');
        $doctor->lastname = $request->input('lastname');
        $doctor->username = $request->input('username');
        $doctor->card_id = $request->input('card_id');
        $doctor->e_mail = $request->input('e_mail');
        $doctor->password = bcrypt($request->input('password'));
        $doctor->year_id = $request->input('year_id');
        $doctor->course_id = $request->input('course_id');

        $doctor->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return new DoctorResource($doctor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if($doctor->delete()){
        return new DoctorResource($doctor);
    }
    }

    // Doctor Login

function login()
{
     return view('login');
}


function checklogin(Request $request)
{

$this->validate($request , [
    'email' => 'required|email',
    'password' => 'required|alphaNum|min:3'

]);

$user_data = array(
    'email'  => $request->get('email'),
    'password' => $request->get('password')
   );

if(Auth::attempt($user_data))
    {
        return redirect()->away('https://www.google.com');
   // return'Successlogin';
   //  return redirect('/main/successlogin');
    // }
    // else
    // {
    //   return back()->with('error', 'Wrong Login Details');
    // }
}

}



function successlogin()
{

return redirect()->away('https://www.google.com');

}

function logout()
{
Auth::logout();
return redirect('login');
}


}
