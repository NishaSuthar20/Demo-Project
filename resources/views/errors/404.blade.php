@extends('layouts.app')

@section('content')
<div style="text-align: center; margin-top: 50px;">
    <h1>404 - Page Not Found</h1>
    <p>Sorry, this side is not exist</p>
    <a href="{{ url('/userlisting') }}">Go to Homepage</a>
</div>
@endsection
