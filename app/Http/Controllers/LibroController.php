<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(String $search = null)
    {
        $libros = Libro::all();
        if($search != null){
            $libros = Libro::where('nombre','like', $search);
        }
        if(Auth::user() != null){
            if(GestionController::isPenalizado(Auth::user()->id)){
                return view('libro.index', compact('libros'))->with('danger','Estás sancionado, por favor, revisa tus sanciones. No podrás prestar libros hasta que se pase la sanción.');
            }
        }
        
        return view('libro.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        GestionController::isAdmin();
        return view('libro.create');
        
    }

    public function buscar(String $search){
        
  
        
        /*
        if(GestionController::isPenalizado(Auth::user()->id)){
            return view('libro.index', compact('libros'))->with('danger','Estás sancionado, por favor, revisa tus sanciones. No podrás prestar libros hasta que se pase la sanción.');
        }
        return view('libro.index', compact('libros'));
        */
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
            'isbn' => 'required|min:17|max:17',
            'nombre' => 'required|min:3|max:255',
            'categoria_id' => 'required|min:1|max:255',
            'editorial' => 'required|min:3|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);        
        $input = $request->all();        
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        }

        Libro::create($input);       
        return redirect()->route('libros')->with('success','Libro created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        return view('libro.show',compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        $categorias = Categoria::all();
        GestionController::isAdmin();
        return view('libro.edit',compact('libro'),compact('categorias'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'isbn' => 'required|min:17|max:17',
            'nombre' => 'required|min:3|max:255',
            'categoria_id' => 'required|min:1|max:255',
            'editorial' => 'required|min:3|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);        
        $input = $request->all();        
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $input['image'] = "$postImage";
        } else {
            unset($input['image']);
        }

        $libro->update($input);    
        return redirect()->route('libros')->with('success','Libro updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        GestionController::isAdmin();

        $libro->delete();
        return redirect()->route('libro')->with('success','Libro deleted successfully');
        
    }
}
