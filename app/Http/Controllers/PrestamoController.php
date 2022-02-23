<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\Preset;
use Illuminate\Support\Facades\DB;

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

    public function devolver(int $id)
    {  
        $prestamo = Prestamo::where('id','=',$id)->first();
        $tieneRetraso = $this->aplicarRetraso($prestamo);
        $libro = $libro = Libro::where('id','=',$prestamo->libro_id)->first();
        $user = User::where('id','=',$prestamo->user_id)->first();

        return view('prestamo.devolver', compact('prestamo', 'tieneRetraso', 'libro', 'user'));
    }

    private function aplicarRetraso(Prestamo $prestamo){
        $fecha_entrega = new DateTime(date("Y-m-d"));
        $fecha_plazo = new DateTime($prestamo->fecha_plazo);

        $dias = $fecha_plazo->diff($fecha_entrega);

        if ($fecha_entrega > $fecha_plazo) {
            DB::table('prestamos')
            ->where('id', $prestamo->id)
            ->update(['retraso' => $dias]);
        }
        return ($fecha_entrega > $fecha_plazo);

    }

    
    /**
     * Presta un Libro
     *
     * @param  \App\Models\Libro  $id
     * @return \Illuminate\Http\Response
     */
    public function prestar(int $id)
    { 
        
        $libro = Libro::where('id','=',$id)->first();
        $puedePedir = $this->cuantosPrestados($libro) < 2;
        $mensaje = ($this->cuantosPrestados($libro) == 100) ? "El usuario ya ha pedido este libro" : ((!$puedePedir) ? "El usuario tiene mas de dos prestamos activos." : "");
        
        return view('prestamo.prestar', compact('libro', 'puedePedir', 'mensaje'));
    }

    private function cuantosPrestados(Libro $id){
        $prestados = 0;
        foreach (Prestamo::all() as $key => $prestamo) {
            if ($prestamo->user_id == Auth::user()->id && $prestamo->fecha_entrega == null) {
                $prestados += 1;
                if ($prestamo->libro_id == $id->id && $prestamo->fecha_entrega == null) {
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
