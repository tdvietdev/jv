<?php

namespace App\Http\Controllers;
//include_once __DIR__ . "..../vendor/autoload.php";
use Illuminate\Http\Request;
use PhpXmlRpc;
use Config;
use Enl\MosesClient\Client;
use Enl\MosesClient\Transport;
class Testrpc extends Controller
{


	public function translate(Request $request){
		
		echo Config::get('configserver.japan_vietnam');




	}


}
