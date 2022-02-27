<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();

        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        GestionController::isAdmin();
        return view('categoria.create');
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
            'nombre' => 'required|min:3|max:255'
        ]);        
        $input = $request->all();        

        Categoria::create($input);       
        return redirect()->route('categoria.index')->with('success','Categoria created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        GestionController::isAdmin();
        $categoria = DB::table('categorias')->where('id',$id)->first();
        return view('categoria.edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'id' => 'required',
            'nombre' => 'required|min:3|max:255'
        ]);        
        $input = $request->all();        
        DB::table('categorias')->where('id',$input['id'])->update(['nombre' => $input['nombre']]);      
        return redirect()->route('categoria.index')->with('success','Categoria updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        GestionController::isAdmin();
        $categoria = DB::table('categorias')->where('id',$id)->delete();
        return redirect()->route('categoria.index')
        ->with('success','La categoría ha sido eliminada con exito');
    }
}
