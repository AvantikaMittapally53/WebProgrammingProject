<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Documents;
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
    public function index(Request $request)
    {

     $q = $request->get('q');
    if ($q) {
        $response = Elasticsearch::search([
            'index' => 'documents',
            'body'  => [
                "size" => 600,

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
        return $data_response;
    }



}
