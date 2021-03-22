@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('companies.createTitle') }}</h1>
@stop

@section('content')
  <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">{{ __('companies.name') }}</label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>  
    </div>
    @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="email">{{ __('companies.email') }}</label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>  
    </div>
    @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="logo">{{ __('companies.logo') }}</label>
      <input type="file" name="logo" id="logo" class="form-control-file @error('logo') is-invalid @enderror" value="{{ old('logo') }}" required>  
    </div>
    @error('logo')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <label for="website">{{ __('companies.website') }}</label>
      <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}" required>  
    </div>
    @error('website')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <div class="form-group">
      <button type="submit" class="btn btn-primary">{{ __('companies.save') }}</button>
    </div>
  </form>
@stop
