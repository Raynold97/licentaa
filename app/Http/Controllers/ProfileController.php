<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use Image;
use Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile(){
        return view('profile', array('user' => Auth::user()));
    }

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
    public function updateAvatar(Request $request)
    {//handle upload imagine
       
        if($request->has('imagine')){
                $imagine = $request->file('imagine');
                $filename = time() . '.' . $imagine->getClientOriginalExtension();
                 Image::make($imagine)->resize(300, 300)->save( public_path('/images/' . $filename));
        }  
                 $user = Auth::user();
                 $user->imagine = $filename;
                 $user->save();
                //  return view('profile', array('user' => Auth::user()));
                 return redirect('/profile');
        
        
    }
    
    
    public function update_avatar(Request $request){

        $this->validate($request, [
                        'Nume_Utilizator' => 'required',
                        'Nume' => 'required',
                        'Prenume' => 'required',
                         'Email' => 'required',
                        //  'Parola' => 'required',
           
                   ]);

                // if($request->has('imagine')){
                //     $imagine = $request->file('imagine');
                //     $filename = time() . '.' . $imagine->getClientOriginalExtension();
                //     Image::make($imagine)->resize(300, 300)->save( public_path('/images/' . $filename));
        
                //     $user = Auth::user();
                //     $user->imagine = $filename;
                //     $user->save();
                // }

       
       $user = Auth::user();
       $user->UserName = $request->input('Nume_Utilizator');
       $user->Nume = $request->input('Nume');
       $user->Prenume = $request->input('Prenume');
       $user->email = $request->input('Email');
    //    $user->password = $request->input('Parola');

       $user->save();

       
       return view('profile', array('user' => Auth::user()));
   }

   public function updatePassword(Request $request)
    {//handle upload profile
        $this->validate($request,[
            'password'=>'required|min:8',
            'ParolaNoua'=>'required|min:8',
            'ParolaNoua_confirm'=>'required|min:8',
        ]);


        $user=Auth::user();
        if(Hash::check($request['password'],Auth::user()->password) && ($request['ParolaNoua']==$request['ParolaNoua_confirm']))
        {$user->password=Hash::make($request['ParolaNoua']);
        $user->save();
        return redirect('/profile')->with('success','Parola actualizata cu succes.');
        }
        else return redirect('/profile')->with('error','Parolele nu corespund.');
        
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
