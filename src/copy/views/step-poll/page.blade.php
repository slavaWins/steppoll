@extends('layouts.center-mini')

@section('content')
    <style>
        .navbar-brand, .btn-round-back{
            display: none !important;
        }
        h3{
            width: 100%;
            font-size: 24px;
            display: block;
        }
    </style>
    @include('steppoll::render', ['poll'=>$poll])
@endsection

