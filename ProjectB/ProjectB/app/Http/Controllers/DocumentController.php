<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Documents;
//use App\Models\Documents;

class DocumentController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('documentform');
    }


    public function save(Request $request)
    {


        $documentDb = new Documents();
        $documentDb->advisor = $request['advisor'];
        $documentDb->author = $request['author'];
        $documentDb->degree = $request['degree'];
        $documentDb->program = $request['program'];
        $documentDb->title = $request['title'];
        $documentDb->university = $request['university'];
        $documentDb->year = $request['year'];
        $documentDb->text_data = $request['text_data'];
        //dd($documentDb);
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://www.wikifier.org/annotate-article',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'userKey=mpxzyzcmslcwyjhixoefkyjxopmrua&text='.$request['text_data'].'&lang=auto&secondaryAnnotLanguage=en&extraVocabularies=false&wikiDataClasses=false&support=false&ranges=false&includeCosines=false&maxMentionEntropy=-1&maxTargetsPerMention=20&minLinkFrequency=1&pageRankSqThreshold=-1&applyPageRankSqThreshold=false&partsOfSpeech=false&verbs=false&nTopDfValuesToIgnore=0',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data_response = json_decode($response,true);
        $wikifier_data = '[';

    $i=0;
        foreach($data_response['annotations'] as $key=>$value){
          //  echo $value["title"];
          if($i == 0){
            $wikifier_data .= '{"term":'.$value["title"];
            $wikifier_data .= ',"url":'.$value["url"].'}';
            $i++;
          }
          else{
            $wikifier_data .= ',{"term":'.$value["title"];
                $wikifier_data .= ',"url":'.$value["url"].'}';
                $i++;
          }
        }
        $wikifier_data .= ']';
    // echo $wikifier_data;
    // return;
    $documentDb->wikifier_terms = $wikifier_data;
    $destinationPath = 'pdf';

    $documentDb->save();
    $request->image->move(public_path($destinationPath), $documentDb->id .'.pdf');

        return back()->with('success','Document Submitted');
        return view('documentform');
    }


}
