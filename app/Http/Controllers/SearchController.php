<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Rap2hpoutre\RemoveStopWords\remove_stop_words;
use App\Models\Search;

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
        // return view('content.index');
        /*
        // Remove Stop Words
        $xyz = remove_stop_words('Some person have, curly black hair, tightly pulled back');
        // Remove full stop and commas.
        $in = str_replace(array('.', ','), '' , $xyz);
        // Remove extra spaces
        $input = trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $in)));
        
        dd($input);
        */
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
        //
    }

    /**
     * Show search result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchList(Request $request)
    {
        return view('content.search-page');
    }
}
