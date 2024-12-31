<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PortafolioController extends Controller
{
/**
* Handle the incoming request.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function __invoke(Request $request)
{
$proyectos = DB::table('proyectos')->get();
return view('portafolio',['proyectos'=>$proyectos]);
//return view('portafolio');
}
}