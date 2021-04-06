@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">Error has occured!</h1>
@stop

@section('content')
  {{ $errors }}
@stop
