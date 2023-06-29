<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(1);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
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

        $campos=[
            'Nombres' => 'required|string|max:100',
            'PrimerApellido' => 'required|string|max:100',
            'SegundoApellido' => 'required|string|max:100',
            'Numerodoc' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Fotografia' => 'required|max:10000|mimes:jpeg,png,jpg',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Fotografia.required'=>'La :attribute es requerida',
            'Nombres.required'=>'Los :attribute son requeridos'
        ];

        $this->validate($request, $campos, $mensaje);

        // $datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if($request->hasFile('Fotografia')){
            $datosEmpleado['Fotografia']=$request->file('Fotografia')->store('uploads', 'public');
        }

        Empleado::insert($datosEmpleado);
        // return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje', 'Empleado agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $campos=[
            'Nombres' => 'required|string|max:100',
            'PrimerApellido' => 'required|string|max:100',
            'SegundoApellido' => 'required|string|max:100',
            'Numerodoc' => 'required|string|max:100',
            'Correo' => 'required|email',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Nombres.required'=>'Los :attribute son requeridos'
        ];

        if($request->hasFile('Fotografia')){
            $campos = ['Fotografia' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['Fotografia.required'=>'La :attribute es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except(['_token', '_method']);

        if($request->hasFile('Fotografia')){
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Fotografia);
            $datosEmpleado['Fotografia']=$request->file('Fotografia')->store('uploads', 'public');
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);
        // return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', 'Empleado modificado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $empleado=Empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Fotografia)){
            Empleado::destroy($id);
        }


        return redirect('empleado')->with('mensaje', 'Empleado borrado correctamente');
    }
}
