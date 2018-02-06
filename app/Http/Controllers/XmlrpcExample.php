<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use PhpXmlRpc;
use Enl\MosesClient\Client;
use Enl\MosesClient\Transport;


class XmlrpcExample extends Controller
{

    public function test()
    {

        $inAr = array("Dave" => 24, "Edd" => 45, "Joe" => 37, "Fred" => 27);
        print "This is the input data:<br/><pre>";
        foreach($inAr as $key => $val) {
            print $key . ", " . $val . "\n";
        }
        print "</pre>";
// create parameters from the input array: an xmlrpc array of xmlrpc structs
        $p = array();
        foreach ($inAr as $key => $val) {
            $p[] = new PhpXmlRpc\Value(
                array(
                    "name" => new PhpXmlRpc\Value($key),
                    "age" => new PhpXmlRpc\Value($val, "int")
                ),
                "struct"
            );
        }
        $v = new PhpXmlRpc\Value($p, "array");
//        print "Encoded into xmlrpc format it looks like this: <pre>\n" . htmlentities($v->serialize()) . "</pre>\n";
// create client and message objects
        $req = new PhpXmlRpc\Request('examples.sortByAge', array($v));
        $client = new PhpXmlRpc\Client("http://phpxmlrpc.sourceforge.net/server.php");
// set maximum debug level, to have the complete communication printed to screen
//        $client->setDebug(2);
// send request
//        print "Now sending request (detailed debug info follows)";
        $resp = $client->send($req);
// check response for errors, and take appropriate action
        if (!$resp->faultCode()) {
            print "The server gave me these results:<pre>";
            $value = $resp->value();
            foreach ($value as $struct) {
                $name = $struct["name"];
                $age = $struct["age"];
                print htmlspecialchars($name->scalarval()) . ", " . htmlspecialchars($age->scalarval()) . "\n";
            }
            print "<hr/>For nerds: I got this value back<br/><pre>" .
                htmlentities($resp->serialize()) . "</pre><hr/>\n";
        } else {
            print "An error occurred:<pre>";
            print "Code: " . htmlspecialchars($resp->faultCode()) .
                "\nReason: '" . htmlspecialchars($resp->faultString()) . '\'</pre><hr/>';
        }


    }

    public function setCookie()
    {
        $response = new Response();
        $response->withCookie('name', 'Viet', 1);
        return $response;
    }

    public function getCookie(Request $request)
    {
        echo $request->cookie('name');
    }

    public function getFile(Request $request)
    {
        if ($request->hasFile('fileUpload')) {
//            echo Input::file('fileUpload')->getFileName();
//            echo '<br>';
//
//            echo Input::file('fileUpload')->getClientOriginalName();
//            echo '<br>';
//
//            echo Input::file('fileUpload')->getClientSize();
//            echo '<br>';
//
//            echo Input::file('fileUpload')->getMimeType();
//            echo '<br>';
//
//            echo Input::file('fileUpload')->guessExtension();
//            echo '<br>';
//
//            echo Input::file('fileUpload')->getRealPath();
//            echo '<br>';
//
//            echo Input::file('fileUpload')->move('destination/path');
            $file = $request->file('fileUpload');
            $file->move('destination/path', $file->getClientOriginalName());


        }

    }

    /*
     * JSON
     */

    public function getJSON()
    {
        $ar = array(
            'Toan' => 8,
            'Ly' => 7,
            'Hoa' => 9,
        );
        return \response()->json(
            $ar
        );
    }

    public function callView()
    {
        $arr = array(
            'Toan' => 8,
            'Ly' => 7,
            'Hoa' => 9,
        );
        return view('dataShow', ['arr' => $arr]);
    }

}
