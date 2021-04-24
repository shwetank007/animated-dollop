@extends('master')

@section('content')
    <div id="loader"></div>
    <div class="center block-1">
        <label>Enter the URL</label>
        <input type="text" name="url-1">
    </div>
    <div class="result center">
        <p></p>
    </div>
    <div class="center">
        <button id="add-url" onclick="addAnotherBlock()">Add Another URL</button>
        <button id="crawling-btn" onclick="startCrawling()">Start Crawling URL</button>
    </div>
@endsection