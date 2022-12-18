<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asignatura;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $asignaturas = Asignatura::get();
            echo json_encode(['response' => $asignaturas]);
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
            $dataAsignatura = $request->all();
            $asignatura = new Asignatura;
            $asignatura->nombre = $dataAsignatura['nombre'];
            $asignatura->descripcion = $dataAsignatura['descripcion'];
            $asignatura->creditos = $dataAsignatura['creditos'];
            $asignatura->area = $dataAsignatura['area'];
            $asignatura->obligatoria = $dataAsignatura['obligatoria'] == '' ? false : true;
            $asignatura->created_at = now();
            $insercion = $asignatura->save();
            echo json_encode(['response' => $insercion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function show($asignaturaId)
    {
        try {
            $datosAsignatura = Asignatura::find($asignaturaId);
            echo json_encode(['response' => $datosAsignatura]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function edit(Asignatura $asignatura)
    {
        //
    }

    public function update(Request $request, $idAsignatura)
    {
        try {
            $nuevaInfoProfesor = $request->all();
            $asignatura = Asignatura::find($idAsignatura);
            $asignatura->nombre = $nuevaInfoProfesor['nombre'];
            $asignatura->descripcion = $nuevaInfoProfesor['descripcion'];
            $asignatura->creditos = $nuevaInfoProfesor['creditos'];
            $asignatura->area = $nuevaInfoProfesor['area'];
            $asignatura->obligatoria = $nuevaInfoProfesor['obligatoria'];
            $asignatura->updated_at = now();
            $actualizacion = $asignatura->update();
            echo json_encode(['response' => $actualizacion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function destroy($idAsignatura)
    {
        try {
            $response = Asignatura::destroy($idAsignatura);
            echo json_encode(['response' => $response]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }
}
