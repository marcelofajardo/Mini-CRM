@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
  <h1 class="m-0 text-dark">{{ $company->name }}'s details</h1>
@stop

@section('content')
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control-plaintext" readonly value="{{ $company->name }}">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control-plaintext" readonly value="{{ $company->email }}">
  </div>
  <div class="form-group">
    <label for="logo">Logo</label>
    <img src="{{ asset('/storage/' . $company->logo ) }}" alt="Logo" width="200" height="200" class="d-block">
  </div>
  <div class="form-group">
    <label for="website">Website</label>
    <a href="{{ $company->website }}" class="form-control-plaintext">{{ $company->website }}</a>
  </div>

  <label for="employees-table">Employees</label>
  <table class="table table-bordered" id="employees-table">
      <thead>
      <tr>
          <th>Id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
      </tr>
      </thead>
  </table>
  @if (auth()->user()->isAdmin())
    <a href="{{ route('companies.edit', ['company' => $company->id ]) }}" class="btn btn-warning">Update </a>
    <form action="{{ route('companies.destroy', ['company' => $company->id ]) }}" class="d-inline-block" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this company?')">Delete</button>
    </form>
  @endif
@stop

@section('adminlte_js')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#employees-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('employees-json', ['company' => $company->id ]) }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' }
                ]
            });
        });
    </script>
@stop
