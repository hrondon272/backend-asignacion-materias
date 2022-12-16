<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataPersonalProfesional = $request->all();
        $nombre = $dataPersonalProfesional["nombre"];
        $apellido = $dataPersonalProfesional["apellido"];
        $cedula = $dataPersonalProfesional["cedula"];
        $fecha_nacimiento = $dataPersonalProfesional["fecha_nacimiento"];
        $profesion = $dataPersonalProfesional["profesion"];
        $direccion = $dataPersonalProfesional["direccion"];
        $municipio = $dataPersonalProfesional["municipio"];
        $telefono = $dataPersonalProfesional["telefono"];
        $sexo = $dataPersonalProfesional["sexo"];
        $nombre_vehiculo = $dataPersonalProfesional["nombre_vehiculo"];
        $marca = $dataPersonalProfesional["marca"];
        $anio = $dataPersonalProfesional["año"];

        $fecha_nacimiento = date('Y-m-d H:i:s', strtotime($fecha_nacimiento));

        $dataProfesion = DB::select('select id from profesion where nombre = ?', [$profesion]);
        $idProfesion = $dataProfesion[0]->id;

        $dataVehiculo = DB::select('select id from vehiculo where nombre = ? and marca = ? and anio = ?', [$nombre_vehiculo, $marca, $anio]);
        $idVehiculo = $dataVehiculo[0]->id;

        try {
            $idNuevoUsuario = DB::table('users')->insertGetId([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'cedula' => $cedula,
                'fecha_nacimiento' => $fecha_nacimiento,
                'direccion' => $direccion,
                'municipio' => $municipio,
                'telefono' => $telefono,
                'sexo' => $sexo,
                'created_at' => now()
            ]);
    
            DB::table('usuario_profesion')->insert([
                'user_id' => $idNuevoUsuario,
                'profesion_id' => $idProfesion,
            ]);
            
            DB::table('usuario_vehiculo')->insert([
                'user_id' => $idNuevoUsuario,
                'vehiculo_id' => $idVehiculo
            ]);
            echo json_encode(['response' => true]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function show(prueba $prueba)
    {
        //
    }

    public function edit(prueba $prueba)
    {
        //
    }

    public function update(Request $request, prueba $prueba)
    {
        //
    }

    public function destroy(prueba $prueba)
    {
        //
    }
}
