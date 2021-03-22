@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('employees.details', ['name' => $employee->first_name . ' ' . $employee->last_name ]) }}</h1>
@stop

@section('content')
  <div class="form-group">
    <label for="first_name">{{ __('employees.first_name') }}</label>
    <input type="text" name="first_name" id="first_name" class="form-control-plaintext" readonly value="{{ $employee->first_name }}">  
  </div>
  <div class="form-group">
    <label for="last_name">{{ __('employees.last_name') }}</label>
    <input type="text" name="last_name" id="last_name" class="form-control-plaintext" readonly value="{{ $employee->last_name }}">  
  </div>
  <div class="form-group">
    <label for="company">{{ __('employees.company') }}</label>
    <input type="text" name="company" id="company" class="form-control-plaintext" readonly value="{{ $employee->companyRel->name }}">  
  </div>
  <div class="form-group">
    <label for="email">{{ __('employees.email') }}</label>
    <input type="email" name="email" id="email" class="form-control-plaintext" readonly value="{{ $employee->email }}">  
  </div>
  <div class="form-group">
    <label for="phone">{{ __('employees.phone') }}</label>
    <input type="text" name="phone" id="phone" class="form-control-plaintext" readonly value="{{ $employee->phone }}">  
  </div>
  @if (auth()->user()->isAdmin())
    <a href="{{ route('employees.edit', ['employee' => $employee->id ]) }}" class="btn btn-warning">{{ __('employees.update') }} </a>
    <form action="{{ route('employees.destroy', ['employee' => $employee->id ]) }}" class="d-inline-block" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" id="btnDelete">{{ __('employees.delete') }}</button>
    </form>
  @endif
@stop

@section('adminlte_js')
<script>
  $(function() {
      $.ajax({
        url: '/locale',
        method: 'GET',
        success: function (data) {
          let message = '';
          if(data == 'id') {
            message = 'Apakah kamu yakin ingin menghapus karyawan ini?'
          } else {
            message = 'Are you sure deleting this employee?'
          }

          $("#btnDelete").on('click', function() {
            return confirm(message);
          });
        }
      });
  });
</script>
@stop
