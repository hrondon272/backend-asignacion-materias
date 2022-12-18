<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profesor;
use DB;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $profesores = Profesor::get();
            echo json_encode(['response' => $profesores]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $dataProfesor = $request->all();

            if (!DB::table('profesor')->where('documento', $dataProfesor['documento'])->exists()) {
                if (!DB::table('profesor')->where('email', $dataProfesor['email'])->exists()) {
                    $profesor = new Profesor;
                    $profesor->documento = $dataProfesor['documento'];
                    $profesor->nombres = $dataProfesor['nombres'];
                    $profesor->telefono = $dataProfesor['telefono'];
                    $profesor->email = $dataProfesor['email'];
                    $profesor->direccion = $dataProfesor['direccion'];
                    $profesor->ciudad = $dataProfesor['ciudad'];
                    $profesor->created_at = now();
                    $insercion = $profesor->save();
                }else{
                    $insercion = "Ya existe un profesor con este email";
                }
            }else{
                $insercion = "Ya existe un profesor con este documento";
            }
            echo json_encode(['response' => $insercion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function show($profesorId)
    {
        try {
            $datosProfesor = Profesor::find($profesorId);
            echo json_encode(['response' => $datosProfesor]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function edit(Profesor $profesor)
    {
        //
    }

    public function update(Request $request, $idProfesor)
    {
        try {
            $nuevaInfoProfesor = $request->all();
            $profesor = Profesor::find($idProfesor);

            if (!DB::table('profesor')->where('id', '<>', $idProfesor)->where('documento', $nuevaInfoProfesor['documento'])->exists()) {
                if (!DB::table('profesor')->where('id', '<>', $idProfesor)->where('email', $nuevaInfoProfesor['email'])->exists()) {
                    $profesor->documento = $nuevaInfoProfesor['documento'];
                    $profesor->nombres = $nuevaInfoProfesor['nombres'];
                    $profesor->telefono = $nuevaInfoProfesor['telefono'];
                    $profesor->email = $nuevaInfoProfesor['email'];
                    $profesor->direccion = $nuevaInfoProfesor['direccion'];
                    $profesor->ciudad = $nuevaInfoProfesor['ciudad'];
                    $profesor->updated_at = now();
                    $actualizacion = $profesor->update();
                }else{
                    $actualizacion = "Ya existe un profesor con este email";
                }
            }else{
                $actualizacion = "Ya existe un profesor con este documento";
            }
            echo json_encode(['response' => $actualizacion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function destroy($idProfesor)
    {
        try {
            $response = Profesor::destroy($idProfesor);
            echo json_encode(['response' => $response]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }
}
