<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Article;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* Si el usuario no ha iniciado sesión e intenta ingresar a la vista de editar perfil, el método lo
    lo enviará de vuelta a la vista de iniciar sesión */
    public function __construct(){

        $this->middleware('auth'); 
        
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $articles = Article::where([
            ['user_id', $profile->user_id], 
            ['status', '1']
        ])
        ->simplePaginate(8); 


        return view('subscriber.profiles.show', compact('profile', 'articles')); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {

        $this->authorize('view', $profile); 

        return view('subscriber.profiles.edit', compact('profile')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $this->authorize('update', $profile); 

        $user = Auth::user(); 

        if($request->hasFile('photo')){
            File::delete(public_path('storage/'. $profile->photo)); 
            $photo = $request['photo']->store('profiles'); 
        }else{
            $photo = $user->profile->photo; 
        }

        # Asignar nombre y correo
        $user->full_name = $request->full_name; 
        $user->email = $request->email; 

        # Ingresar datos adicionales 
        $user->profile->profession = $request->profession; 
        $user->profile->about = $request->about; 
        $user->profile->twitter = $request->twitter; 
        $user->profile->linkedin = $request->linkedin; 
        $user->profile->facebook = $request->facebook; 


        # Asignar la foto
        $user->profile->photo = $photo; 

        # Guardar los campos de usuario
        $user->save(); 

        # Guardar los campos de perfil
        $user->profile->save(); 

        return redirect()->route('profiles.edit', $user->profile->id); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
