<?php
namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreIngreso extends BaseModel
{
     use SoftDeletes;
    
    protected $generarID = true;
    protected $guardarIDServidor = true;
    protected $guardarIDUsuario = true;
    
    protected $table = 'pre_ingreso';  
    protected $fillable = ["paciente_id","referida","unidad_referida","urgencia_calificada", "responsable"];

    /*public function Ingreso(){
      return $this->hasOne('App\Models\Ingreso','pre_ingreso_id');
    }*/
}
