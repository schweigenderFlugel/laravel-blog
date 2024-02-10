<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PetitionResource;
use App\Http\Resources\PetitionCollection;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\PetitionCollection
     */
    public function index()
    {
        $petitions = Petition::all(); 

        # @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
        # return view('petitions.index')->with('petitions', $petitions); 

        # Véase línea 15: debemos usar la colección anónima para poder retornar la petición en JSON

        # return new PetitionCollection($petitions); 

        return response()->json(new PetitionCollection($petitions), Response::HTTP_OK); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\PetitionResource
     */
    public function store(Request $request)
    {
        $petition = Petition::create($request->only([
            'title', 'description', 'category', 'author', 'signees'
        ])); 

        # return new PetitionResource($petition); 

        # El código 200 
        return response()->json(new PetitionResource($petition), 201); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petition  $petition
     * @return PetitionResource
     */
    public function show(Petition $petition)
    {
        return new PetitionResource($petition); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petition $petition)
    {
        $petition->update($request->only([
            'title', 'description', 'category', 'author', 'signees'
        ])); 

        # return new PetitionResource($petition); 

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        $petition->delete(); 

        /* Con esto no estamos retornando nada al cuerpo del response. El código más usado cuando un recurso es 
        es 204.  */
        # return response()->json(null, 204); 

        return response()->json(null, Response::HTTP_I_AM_A_TEAPOT); 

    }
}
