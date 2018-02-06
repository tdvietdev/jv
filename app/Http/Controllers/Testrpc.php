<?php

namespace App\Http\Controllers;
//include_once __DIR__ . "..../vendor/autoload.php";
use Illuminate\Http\Request;
use PhpXmlRpc;
use Enl\MosesClient\Client;
use Enl\MosesClient\Transport;
class Testrpc extends Controller
{


	public function translate(Request $request){
		$text = $request->text;
		$transport = new Transport('http://112.137.130.53:8080/RPC2');
		$client = new Client($transport);

		$translation = $client->translate($text);
		echo $translation;




	}


}
