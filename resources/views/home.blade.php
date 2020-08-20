@extends('layouts.app')
@section('title')Dashboard @endsection
@section('informasi')
Information User Login
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <span class="text-bold text-lg"><i class="fa fa-user"></i> {{Auth::user()->name}}</span>
        </div>
    </div>
</div>
@endsection