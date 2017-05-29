<?php
namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingreso extends BaseModel
{
    use SoftDeletes;
    
    protected $generarID = true;
    protected $guardarIDServidor = true;
    protected $guardarIDUsuario = true;
    
    protected $table = 'ingreso';  
    protected $fillable = ["paciente_id","referida", "unidad_referida", "urgencia_calificada", "registro_triage","estado_triage_id","grado_lesion_id", "estatus_ingreso_id", "clues", "fecha_hora_ingreso"];

   
    public function Traslado(){
      return $this->hasOne('App\Models\Traslado','ingreso_id');
    }

   
    public function GradoLesion(){
      return $this->belongsTo('App\Models\GradoLesion','grado_lesion_id');
    }

    public function EstadoTriage(){
      return $this->belongsTo('App\Models\EstadoTriage','estado_triage_id');
    }

    public function MotivoEgreso(){
      return $this->hasOne('App\Models\MotivoEgreso','motivo_egreso_id');
    }

    public function Unidad(){
      return $this->belongsTo('App\Models\UnidadMedica','clues');
    }
}
