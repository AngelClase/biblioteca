<?php

namespace App\Http\Controllers;

use App\Models\Sancion;
use Illuminate\Http\Request;
use App\Models\Prestamo;
use Illuminate\Support\Facades\DB;

class SancionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        GestionController::isAuth();
        $sanciones = Sancion::all();
        

        return view('sancion.index', compact('sanciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {

        $prestamo = DB::table('prestamos')->where('id',$id)->first();
        GestionController::isAdmin();
        return view('sancion.create', compact('prestamo'));
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
            'user_id' => 'required|min:1|max:17',
            'fecha_inicio' => 'required',
            'retraso' => 'required|min:1|max:255',
        ]);    

        $input = $request->all();        
        Sancion::create($input);       
        return redirect()->route('sancion.index')->with('success','Sancion created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function show(Sancion $sancion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sancion $sancion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sancion $sancion)
    {
        $input = $request->validate([
            'user_id' => 'required|min:17|max:17',
            'retraso' => 'required|min:1|max:255',
        ]);    
                  
        $sancion->update($input);      
        return redirect()->route('sancion')->with('success','Sancion updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sancion $sancion)
    {
        //
    }
}
