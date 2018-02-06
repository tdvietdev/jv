<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Input;
//use PhpXmlRpc;
//use PhpXmlRpc\Value;
use Enl\MosesClient\Client;
use Enl\MosesClient\Transport;

class Translate extends Controller
{


    public function translate(Request $request)
    {


        $text = $request->text;
        $input = $request->input;
        $transport = new Transport('http://103.92.28.246:8080/RPC2');
        $client = new Client($transport);


        $list_paragraph = array();
        if ($request->segmentor == "false") {
            $mListParagraph = explode("\n", $text);
//            var_dump($mListParagraph);
            foreach ($mListParagraph as $key => $value) {
                $mListSentence = explode("。", $value, 1);
                $list_sentence = array();
                foreach ($mListSentence as $key1 => $value1) {

                    $command = "python /var/www/html/jpvn/public/py/JP_Segmenter.py $value1";
                    $mstr = shell_exec($command);
                    $list_sentence[] = $mstr;
                }
                $list_paragraph[] = $list_sentence;
            }

            $resultStr = "";

            if ($input == 'ja') {

                $text = $request->text;


                foreach ($list_paragraph as $mPara){
                    foreach ($mPara as $mSen){
                        // foreach ($mSen as $mWord){
                        //     if ($mWord != "")
                            $resultStr .= $client->translate($mSen);
                        // }
                    }
                    $resultStr .= "\n";
                }


//                $translation = $client->translate($text);
                echo $resultStr;
            } else if ($input == 'vi') {
                echo "Ngôn ngữ chưa được hỗ trợ";
            }
        }else{

            if ($input == 'ja') {
                $translation  = $client->translate($text);


                 echo $translation;

            } else if ($input == 'vi') {
                echo "Ngôn ngữ chưa được hỗ trợ";
            }
        }


    }
}
//	    $server = "http://dictmachine.dev";
//	    $req = new PhpXmlRpc\Request('server.translate', array(
//			    new PhpXmlRpc\Value($lang),
//			    new PhpXmlRpc\Value($text)
//		    )
//	    );
//
//	    $client = new PhpXmlRpc\Client($server);
////	    $client->setDebug(2);
//	    $resp = $client->send($req);
//
//	    if (!$resp->faultCode()) {
//
//		    $value = $resp->value();
//		    echo ($value->scalarval());
//
//
//
//	    } else {
//		    echo "ERR";
//	    }
