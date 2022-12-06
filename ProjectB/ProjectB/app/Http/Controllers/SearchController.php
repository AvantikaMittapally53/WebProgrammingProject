<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Documents;
use App\Models\EdtAccessToken;
use Illuminate\Support\Str;

use Elasticsearch;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

function genrateToken(){
    $randomString = Str::random(20);
    $edtaccessToken = new EdtAccessToken();
    $edtaccessToken->token = $randomString;
    $edtaccessToken->save();
    $tokens= EdtAccessToken::where('id', '1')->get();
    return [
        "status" => 200,
        "token" => $randomString
    ];
}


    public function serchapi(Request $request)
    {
        $incommingToken = $request->get('token');
        $token_datas = EdtAccessToken::orderBy('created_at', 'desc')->first();
        if($token_datas['token'] != $incommingToken) {
            return [
                "status" => 401,
                "message" => "invalid Token"
            ];

        }


        $q = $request->get('query');
        if ($q) {
            $response = Elasticsearch::search([
                'index' => 'documents',
                'body'  => [
                    "size" => 500,

                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => [
                                'title',
                                'degree',
                                "author",
                                "text_data"
                            ]
                        ]
                    ]
                ]
            ]);

            $postIds = array_column($response['hits']['hits'], '_id');
            $documents = Documents::whereIn('id', $postIds)->get();

        } else {
            $documents = Documents::all();
        }


        return [
            "status" => 200,
            "documents" => $documents
        ];
    }

    public function getdetailsbyid(Request $request,$id ){


        $incommingToken = $request->get('token');
        $token_datas = EdtAccessToken::orderBy('created_at', 'desc')->first();
        if($token_datas['token'] != $incommingToken) {
            return [
                "status" => 401,
                "message" => "invalid Token"
            ];

        }

        $document = Documents::find($id);
        return [
            "status" => 200,
            "document" => $document
        ];
    }






    public function index(Request $request)
    {

     $q = $request->get('q');
    if ($q) {
        $response = Elasticsearch::search([
            'index' => 'documents',
            'body'  => [
                "size" => 500,

                'query' => [
                    'multi_match' => [
                        'query' => $q,
                        'fields' => [
                            'title',
                            'degree',
                            "author",
                            "text_data"
                        ]
                    ]
                ]
            ]
        ]);

        $postIds = array_column($response['hits']['hits'], '_id');
        // print_r($postIds);
        $documents = Documents::whereIn('id', $postIds)->paginate(2);
    //   print_r($documents);
    //   die();
    } else {
        $documents = Documents::paginate(10);
    }

    // $documents = Documents::paginate(10);

    return view('search', compact('documents'));



        // return view('home');
    }
    public function show(Request $request,$id ){
        $document = Documents::find($id);
        return view('search_details', compact('document'));



    }



    public function get_data(Request $request){
        $documentDb = new Documents();
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
            $documentDb->where('id', $request['data_id'])->update(['wikifier_terms' => $wikifier_data]);
        return $data_response;
    }





}
