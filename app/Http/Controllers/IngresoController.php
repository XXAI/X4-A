<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Models\Ingreso;
use App\Models\PreIngreso;
use App\Models\AreaResponsable;
use App\Models\Usuario;


use Illuminate\Support\Facades\Input;
use \Validator,\Hash, \Response, DB;

use JWTAuth, JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingreso = Ingreso::all();
        return Response::json([ 'data' => $ingreso ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preingreso = PreIngreso::find($id)->with("Ingreso", "ingreso.Responsable", "ingreso.AreaResponsable", "ingreso.Traslado")->first();
        return Response::json([ 'data' => $preingreso ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensajes = [
            'required'      => "required",
        ];

        $reglas = [            
            "referida"              => 'required',
            "unidad_referida"       => 'required',
            "urgencia_calificada"   => 'required', 
            "registro_triage"   => 'required',
            "estado_triage_id"  => 'required',
            "grado_lesion_id"   => 'required', 
            "fecha_ingreso"   => 'required', 
            "hora_ingreso"   => 'required', 
        ];

        $inputs = Input::all();

        $v = Validator::make($inputs, $reglas, $mensajes);

        if ($v->fails()) {
            return Response::json(['error' => $v->errors()], HttpResponse::HTTP_CONFLICT);
        }

        try {
            DB::beginTransaction();
            
            $obj =  JWTAuth::parseToken()->getPayload();
            $usuario = Usuario::where("id", $obj->get('id'))->with("usuariounidad")->first();
            $clues = $usuario->usuariounidad->clues;  

            $inputs['paciente_id'] = $id;
            $inputs['clues'] = $clues;
            $inputs['fecha_hora_ingreso'] = $clues;
            unset($inputs['id']);

            $ingreso = Ingreso::create($inputs);
            
            
            DB::commit();
            return Response::json([ 'data' => $ingreso ],200);

        } catch (\Exception $e) {
            DB::rollBack();
            return Response::json(['error' => $e->getMessage()], HttpResponse::HTTP_CONFLICT);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $object = PreIngreso::find($id);
            $object->Ingreso->delete();
            $object->delete();

            return Response::json(['data'=>$object],200);
        } catch (Exception $e) {
           return Response::json(['error' => $e->getMessage()], HttpResponse::HTTP_CONFLICT);
        }
        
    }
}
