@extends('master')

@section('content')
    <div id="loader"></div>
    <div class="center">
        <label>Search</label>
        <input id="search-word" type="text" name="search-word">
    </div>
    <div class="center">
        <button id="search-btn" class="search-btn" onclick="search()">Search</button>
    </div>
    <div id="result" class="result center">
    </div>
@endsection    