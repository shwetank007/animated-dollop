@extends('master')

@section('content')
    <div class="center block-1">
        <label>Enter the URL</label>
        <input type="text" name="url-1">
    </div>
    <div class="center">
        <button id="addURL" onclick="addAnotherBlock()">Add Another URL</button>
        <button>Start Crawling URL</button>
    </div>
@endsection    