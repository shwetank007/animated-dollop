@extends('master')

@section('content')
    @if(count($searchURL) > 0)
        <div>
            <p>URL are crawled and present over database. Please click on <a href="{{ route('search.index') }}">Search</a> to search.</p>
        </div>
    @else
    <div>
        <p>No URL are crawled. Please click on <a href="{{ route('search.create') }}">Add URL</a> to crawl.</p>
    </div>
    @endif
@endsection    