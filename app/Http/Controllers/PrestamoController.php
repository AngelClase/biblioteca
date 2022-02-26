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
        GestionController::isAuth();
        $prestamos = Prestamo::all();

        return view('prestamo.index', compact('prestamos'));
    }

    public function devolver(int $id)
    {
        GestionController::isAdmin();
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
        GestionController::isAdmin();
        $users = User::all();
        $libro = Libro::where('id','=',$id)->first();
        
        if($libro->disponible == true){
            return view('prestamo.prestar', compact('libro','users'));
        }else{
            return redirect()->route('prestamo.index')->with('danger','Este libro ya está prestado.');
        }
        
    }

    private function cuantosPrestados(int $user_id){
        $prestados = 0;
        foreach (Prestamo::all() as $key => $prestamo) {
            if ($prestamo->user_id == $user_id && $prestamo->fecha_entrega == null) {
                $prestados += 1;
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
        GestionController::isAdmin();
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
        if($this->cuantosPrestados($request->user_id) < 2){
            $input = $request->validate([
                'libro_id' => 'required|min:1|max:255',
                'user_id' => 'required|min:1|max:255',
                'fecha_plazo' => 'required|date',
            ]);        
            
            
            DB::table('libros')->where('id',$input['libro_id'])->update(['disponible' => '0']);
            
            Prestamo::create($input); 

            return redirect()->route('libros')->with('success','Prestamo created successfully.');
        }else{
            return redirect()->route('libros')->with('danger','El usuario ha prestado mas de dos libros.');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        GestionController::isAuth();
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
        GestionController::isAdmin();
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
        GestionController::isAdmin();
        $input = $request->validate([
            'libro_id' => 'required|min:1|max:255',
            'user_id' => 'required|min:1|max:255',
            'fecha_entrega' => 'required|date'
        ]);;
        
        $prestamo->update($input);
        DB::table('libros')->where('id',$input['libro_id'])->update(['disponible' => '1']);
        return redirect()->route('libros')->with('success','Prestamo updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        
        GestionController::isAdmin();
        $prestamo->delete();
        return redirect()->route('prestamo')
        ->with('success','Prestamo deleted successfully');
        
    }
}
