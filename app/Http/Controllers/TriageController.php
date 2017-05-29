<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

use App\Http\Requests;
use App\Models\Triage;
use Illuminate\Support\Facades\Input;
use \Validator,\Hash, \Response, \DB;

class TriageController extends Controller
{
     public function index()
    {
    	$parametros = Input::all();
    	if(isset($parametros['triage_id']))
    	{
			$items = Triage::where("id", $parametros['triage_id'])->get();    		
    	}else
    	  	$items = Triage::all();

        return Response::json([ 'data' => $items],200);
    }
}
