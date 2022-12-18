<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use DB;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idEstudiante)
    {
        try {
            $asignaciones = DB::select('SELECT ae.id, e.nombres AS "estudiante", a.nombre AS "asignatura", a.creditos, p.nombres AS "profesor"
                                        FROM asignatura a 
                                            INNER JOIN asignacion_estudiante ae ON a.id = ae.asignatura_id 
                                            INNER JOIN profesor p ON ae.profesor_id = p.id 
                                            INNER JOIN estudiante e ON ae.estudiante_id = e.id
                                        WHERE e.id = ?', [$idEstudiante]);
            echo json_encode(['response' => $asignaciones]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function assign(Request $request, $ind)
    {
        try {
            $dataAsignatura = $request->all();
            $idAsignatura = $dataAsignatura["asignatura_id"];
            $idProfesor = $dataAsignatura["profesor_id"];

            if ($ind == 1) { // Para asignar profesores
                // Verificamos que no se haya asignado este profesor a esta asignatura
                // Nota: el profesor puede impartir varias asignaturas pero no la misma
                if (!DB::table('asignacion_profesor')->where("asignatura_id", $idAsignatura)->where("profesor_id", $idProfesor)->exists()) {
                    $asignacion = DB::table('asignacion_profesor')->insert([
                        "asignatura_id" => $idAsignatura,
                        "profesor_id" => $idProfesor
                    ]);
                }else{
                    $asignacion = "El profesor ya fue asignado a esta materia";
                }
            }else if($ind == 2){ // Para asignar estudiantes
                $idEstudiante = $dataAsignatura["estudiante_id"];
                if (!DB::table('asignacion_estudiante')->where("asignatura_id", $idAsignatura)->where("estudiante_id", $idEstudiante)->exists()) {
                    
                    $estudiante = Estudiante::find($idEstudiante);
                    $credAcumulados = $estudiante->creditos_acumulados;

                    // Se valida que el estudiante tenga como mínimo 7 créditos
                    if ($credAcumulados >= 7) {
                        $asignacion = DB::table('asignacion_estudiante')->insert([
                            "asignatura_id" => $idAsignatura,
                            "profesor_id" => $idProfesor,
                            "estudiante_id" => $idEstudiante
                        ]);
                    }else{
                        $asignacion = "Créditos insuficientes";
                    }
                }else{
                    $asignacion = "El estudiante ya fue asignado a esta materia";
                }
            }
            echo json_encode(['response' => $asignacion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $ind)
    {
        try {
            $data = $request->all();
            $idAsignacion = $data["asignatura_id"];
            
            if ($ind == 1) { // Para cambiar asignaturas de un profesor
                $idProfesor = $data["profesor_id"];
                $idNuevaAsig = $data["nueva_asignatura_id"];
                
                $actualizacion = DB::table('asignacion_profesor')
                                    ->where('asignatura_id', $idAsignacion)
                                    ->where('profesor_id', $idProfesor)->update([
                                        "asignatura_id" => $idNuevaAsig
                                    ]);
            }else if($ind == 2){ // Para cambiar el profesor asignado a determinada materia de un estudiante
                $idEstudiante = $data["estudiante_id"];
                $idAntiguoProf = $data["antiguo_profesor_id"];
                $idNuevoProf = $data["nuevo_profesor_id"];
                
                $actualizacion = DB::table('asignacion_estudiante')
                                    ->where('asignatura_id', $idAsignacion)
                                    ->where('profesor_id', $idAntiguoProf)
                                    ->where('estudiante_id', $idEstudiante)
                                    ->update([
                                        "profesor_id" => $idNuevoProf
                                    ]);
            }
            echo json_encode(['response' => $actualizacion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $ind)
    {
        try {
            $data = $request->all();
            $idAsignacion = $data["idAsignacion"];
            
            if ($ind == 1) { // Para eliminar asignaturas de un profesor   
                $eliminacion = DB::table('asignacion_profesor')
                                    ->where('id', $idAsignacion)
                                    ->delete();
            }else if($ind == 2){ // Para eliminar estudiantes con materias asignadas
                $eliminacion = DB::table('asignacion_estudiante')
                                    ->where('id', $idAsignacion)
                                    ->delete();
            }
            echo json_encode(['response' => $eliminacion]);
        } catch (Exception $e) {
            echo json_encode(['response' => $e->getMessage()]);
        }
    }
}
