<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contribuyentes;
use App\Imports\ContribuyentesImport;
use DB;
use Auth;

class CalendarioController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function iva(){
    	return view('admin.iva.calendario');
    }
    
}