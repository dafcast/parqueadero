<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use App\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::with('propietario')->get();

        $vehiculosMarca = [];
        foreach ($vehiculos as $vehiculo) {
            $vehiculosMarca[ucfirst($vehiculo->marca)][] = $vehiculo;
        }
        return response()->json($vehiculosMarca);
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
        $validator = Validator::make($request->all(), [ 
            'placa'=>'required|max:6|unique:App\Vehiculo,placa',
            'marca'=>'required',
            'tipo'=>'required',
            'nombre'=>'required',
            'cedula'=>'required|numeric|unique:App\Propietario,cedula',
        ]);

        if ($validator->fails()){ 
            $message = $validator->messages();
            return response()->json(['created' => false, 'message' => $message], 200);
        }else{
            

            $propietario = new Propietario;

            $propietario->nombre = $request->nombre;
            $propietario->cedula = $request->cedula;
            $propietario->save();

            $vehiculo = new Vehiculo;

            $vehiculo->placa = $request->placa;
            $vehiculo->marca = $request->marca;
            $vehiculo->tipo = $request->tipo;
            $vehiculo->propietario_id = $propietario->id;
            $vehiculo->save();



            return response()->json(['created'=>true], 201);
        }
    }


    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        if($request->placa){
            $vehiculo = Vehiculo::where('placa', 'like','%'.$request->placa.'%')->with('propietario')->get();
            if(count($vehiculo) == 0){
                return response()->json(['error' => 'No se encuentra el vehiculo']);
            }else{
                return response()->json($vehiculo);
            }            
        }elseif($request->nombre){
            
            $propietarios = Propietario::where('nombre', 'like','%'.$request->nombre.'%')->get();
            $vehiculo = [];
            foreach ($propietarios as $propietario) {
                $vehiculo[] = Vehiculo::where('propietario_id', '=', $propietario->id)->with('propietario')->get()[0];
            }
            if(count($vehiculo) == 0){
                return response()->json(['error' => 'No se encuentra el vehiculo']);
            }else{
                return response()->json($vehiculo);
            }  

        }elseif($request->cedula){
            
            $propietarios = Propietario::where('cedula', 'like','%'.$request->cedula.'%')->get();
            $vehiculo = [];
            foreach ($propietarios as $propietario) {
                $vehiculo[] = Vehiculo::where('propietario_id', '=', $propietario->id)->with('propietario')->get()[0];
            }
            if(count($vehiculo) == 0){
                return response()->json(['error' => 'No se encuentra el vehiculo']);
            }else{
                return response()->json($vehiculo);
            }

        }else{
            return response()->json(['error' => 'parametro de busqueda invalido']);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
