<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

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
        $remove_list = Config::get('configserver.remove_symbol');
        $text = str_replace($remove_list, "", $text);
        if ($input == 'ja') {
            $transport_server = Config::get('configserver.japan_vietnam');
            $file_segment = Config::get('configserver.file_segment_jp');
        } else if ($input == 'vi') {
            $transport_server = Config::get('configserver.vietnam_japan');
            $file_segment = Config::get('configserver.file_segment_vn');
        }
        $transport = new Transport($transport_server);
        $client = new Client($transport);
        $list_paragraph = array();
        $mListParagraph = explode("\n", $text);
        foreach ($mListParagraph as $key => $value) {
            $mListSentence = array_filter(explode("。", $value));
            $list_sentence = array();
            foreach ($mListSentence as $key1 => $value1) {

                $command = "python $file_segment '$value1' ";
                $mstr = shell_exec($command);
                $list_sentence[] = $mstr;
            }
            $list_paragraph[] = $list_sentence;
        }

        $resultStr = "";
        foreach ($list_paragraph as $mPara) {
            foreach ($mPara as $mSen) {
                $resultStr .= $client->translate($mSen);
            }
            $resultStr .= "\n";
        }
        echo $resultStr;
    }

}
