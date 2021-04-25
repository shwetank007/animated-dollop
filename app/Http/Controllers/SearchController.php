<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Rap2hpoutre\RemoveStopWords\remove_stop_words;
use App\Models\Search;
use Exception;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchURL = Search::all();

        return view('content.index', ['searchURL' => $searchURL]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $urlArray = explode(",", $request->url);
        
        foreach($urlArray as $url) {
            /* 
            Addition of User-Agent helps crawl the page as lot of the site prevent
            their site by the script crawler. This trick the site in letting them
            know that a human is surfing their site not a script.
            */ 
            $context = stream_context_create(
                [
                    "http" => [
                        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                    ]
                ]
            );
            
            $content = file_get_contents($url, false, $context);
            preg_match('/<title[^>]*>(.*?)<\/title>/s', $content, $title);
            preg_match("/<body[^>]*>(.*?)<\/body>/is", $content, $body);

            try {
                Search::create([
                    'title' => $title[1],
                    'description' => $body[1],
                    'url' => $url,
                ]);
            } catch(Exception $e) {
                DB::rollBack();

                return response()->json(['status' => '400']);
            }
    
            DB::commit();
            sleep(1);
        }

        return response()->json(['status' => '200']);
    }

    /**
     * Show search Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchPage()
    {
        return view('content.search-page');
    }

    /**
     * Show search Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchResult(Request $request)
    {
        // Remove Stop Words
        $searchStopWordRemove = remove_stop_words($request->search);
        // Remove full stop and commas.
        $searchFullStopAndCommaRemove = str_replace(array('.', ','), '' , $searchStopWordRemove);
        // Remove extra spaces
        $searchExtraSpaceRemove = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $searchFullStopAndCommaRemove)));
        // Explode the sentence to get array of word
        $explodeSearchWord = explode(" ", $searchExtraSpaceRemove);

        $searchLinkQuery = Search::query();

        foreach($explodeSearchWord as $word) {
            $searchLinkQuery->orWhere('description', 'LIKE', '%'.$word.'%');
        }

        $searchResult = $searchLinkQuery->select('title', 'url')->get();

        return response()->json(['status' => '200', 'data' => $searchResult]);
    }
}
