<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role; 
use Spatie\Permission\Models\Permission; 
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    # Para proteger las rutas
    public function __construct(){

        $this->middleware('can:roles.index')->only('index'); 
        $this->middleware('can:roles.create')->only('create', 'store'); 
        $this->middleware('can:roles.edit')->only('edit', 'update'); 
        $this->middleware('can:roles.destroy')->only('destroy'); 
    }
    
    public function index()
    {
        $roles = Role::simplePaginate(10); 

        return view('admin.roles.index', compact('roles')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all(); 

        return view('admin.roles.create', compact('permissions')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]); 

        $role = Role::create([
            'name' => $request->name
        ]); 

        $role->permissions()->sync($request->permissions); 

        return redirect()->action([RoleController::class, 'index'])
                        ->with('success-create', 'Rol creado con éxito'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all(); 

        return view('admin.roles.edit', compact('permissions', 'role')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]); 

        $role->update([
            'name' => $request->name
        ]); 

        $role->permissions()->sync($request->permissions); 

        return redirect()->action([RoleController::class, 'index'])
                        ->with('success-update', 'Rol modificado con éxito'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $role->delete(); 

        return redirect()->action([RoleController::class, 'index'])
                        ->with('success-delete', 'Rol eliminado con éxito'); 

    }
}
