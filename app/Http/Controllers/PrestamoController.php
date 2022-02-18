<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Preset;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamo::all();

        return view('prestamo.index', compact('prestamos'));
    }

    public function devolver()
    {
        print_r("aaa");
    }

    /**
     * Presta un Libro
     *
     * @param  \App\Models\Libro  $id
     * @return \Illuminate\Http\Response
     */
    public function prestar(int $id)
    { 
        
        $libro = Libro::all()->where('id','=',$id)[$id - 1];
        $puedePedir = $this->cuantosPrestados($libro) < 2;
        $mensaje = ($this->cuantosPrestados($libro) == 100) ? "El usuario ya ha pedido este libro" : ((!$puedePedir) ? "El usuario tiene mas de dos prestamos activos." : "");
        
        return view('prestamo.prestar', compact('libro', 'puedePedir', 'mensaje'));
    }

    private function cuantosPrestados(Libro $id){
        $prestados = 0;
        foreach (Prestamo::all() as $key => $prestamo) {
            if ($prestamo->user_id == Auth::user()->id) {
                $prestados += 1;
                if ($prestamo->libro_id == $id->id) {
                    return 100;
                }
            }
        }
        return $prestados;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prestamo.create');
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
            'libro_id' => 'required|min:1|max:255',
            'user_id' => 'required|min:1|max:255',
        ]);        
        $input = $request->all();
        Prestamo::create($input);       
        return redirect()->route('prestamos')->with('success','Prestamo created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->prestar($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        return view('prestamo.edit',compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'libro_id' => 'required|min:1|max:255',
            'user_id' => 'required|min:1|max:255'
        ]);

        $input = $request->all();
        $prestamo->update($input);       
        return redirect()->route('prestamos')->with('success','Prestamo updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamos')
        ->with('success','Prestamo deleted successfully');
    }
}
