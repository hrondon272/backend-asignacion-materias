<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Estudiante;
use DB;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $estudiantes = Estudiante::get();
            echo json_encode(['response' => $estudiantes]);
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
            $dataEstudiante = $request->all();

            // Se verifica que no existan estudiantes con los mismos documentos o email
            if (!DB::table('estudiante')->where('documento', $dataEstudiante['documento'])->exists()) {
                if (!DB::table('estudiante')->where('email', $dataEstudiante['email'])->exists()) {
                    $estudiante = new Estudiante;
                    $estudiante->documento = $dataEstudiante['documento'];
                    $estudiante->nombres = $dataEstudiante['nombres'];
                    $estudiante->telefono = $dataEstudiante['telefono'];
                    $estudiante->email = $dataEstudiante['email'];
                    $estudiante->direccion = $dataEstudiante['direccion'];
                    $estudiante->ciudad = $dataEstudiante['ciudad'];
                    $estudiante->semestre = $dataEstudiante['semestre'];
                    $estudiante->creditos_acumulados = $dataEstudiante['creditos_acumulados'];
                    $estudiante->created_at = now();
                    $insercion = $estudiante->save();
                }else{
                    $insercion = "Ya existe un estudiante con este email";
                }
            }else{
                $insercion = "Ya existe un estudiante con este documento";
            }
            echo json_encode(['response' => $insercion]);
        } catch (QueryException $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function show($estudianteId)
    {
        try {
            $datosEstudiante = Estudiante::find($estudianteId);
            echo json_encode(['response' => $datosEstudiante]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function edit(Estudiante $estudiante)
    {
        //
    }

    public function update(Request $request, $idEstudiante)
    {
        try {
            $nuevaInfoEstudiante = $request->all();
            $estudiante = Estudiante::find($idEstudiante);

            if (!DB::table('estudiante')->where('id', '<>', $idEstudiante)->where('documento', $nuevaInfoEstudiante['documento'])->exists()) {
                if (!DB::table('estudiante')->where('id', '<>', $idEstudiante)->where('email', $nuevaInfoEstudiante['email'])->exists()) {
                    $estudiante->documento = $nuevaInfoEstudiante['documento'];
                    $estudiante->nombres = $nuevaInfoEstudiante['nombres'];
                    $estudiante->telefono = $nuevaInfoEstudiante['telefono'];
                    $estudiante->email = $nuevaInfoEstudiante['email'];
                    $estudiante->direccion = $nuevaInfoEstudiante['direccion'];
                    $estudiante->ciudad = $nuevaInfoEstudiante['ciudad'];
                    $estudiante->semestre = $nuevaInfoEstudiante['semestre'];
                    $estudiante->creditos_acumulados = $nuevaInfoEstudiante['creditos_acumulados'];
                    $estudiante->updated_at = now();
                    $actualizacion = $estudiante->update();
                }else{
                    $actualizacion = "Ya existe un estudiante con este email";
                }
            }else{
                $actualizacion = "Ya existe un estudiante con este documento";
            }
            echo json_encode(['response' => $actualizacion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function destroy($idEstudiante)
    {
        try {
            $response = estudiante::destroy($idEstudiante);
            echo json_encode(['response' => $response]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }
}
