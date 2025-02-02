@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-top: 50px;">
    <h1>500 - Internal Server Error</h1>
    <p>Something went wrong! Please try again later.</p>
    <a href="{{ url('/userlisting') }}">Go to Homepage</a>
</div>
@endsection
