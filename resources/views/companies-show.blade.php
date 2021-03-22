@extends('adminlte::page')

@section('title', config('app.name', 'AdminLTE'))

@section('content_header')
  <h1 class="m-0 text-dark">{{ __('companies.details', ['name' => $company->name]) }}</h1>
@stop

@section('content')
  <div class="form-group">
    <label for="name">{{ __('companies.name') }}</label>
    <input type="text" name="name" id="name" class="form-control-plaintext" readonly value="{{ $company->name }}">
  </div>
  <div class="form-group">
    <label for="email">{{ __('companies.email') }}</label>
    <input type="email" name="email" id="email" class="form-control-plaintext" readonly value="{{ $company->email }}">
  </div>
  <div class="form-group">
    <label for="logo">{{ __('companies.logo') }}</label>
    <img src="{{ asset('/storage/' . $company->logo ) }}" alt="Logo" width="200" height="200" class="d-block">
  </div>
  <div class="form-group">
    <label for="website">{{ __('companies.website') }}</label>
    <a href="{{ $company->website }}" class="form-control-plaintext">{{ $company->website }}</a>
  </div>

  <label for="employees-table">{{ __('companies.employees') }}</label>
  <table class="table table-bordered" id="employees-table">
      <thead>
      <tr>
          <th>{{ __('employees.first_name') }}</th>
          <th>{{ __('employees.last_name') }}</th>
          <th>{{ __('employees.email') }}</th>
          <th>{{ __('employees.phone') }}</th>
      </tr>
      </thead>
  </table>
  @if (auth()->user()->isAdmin())
    <a href="{{ route('companies.edit', ['company' => $company->id ]) }}" class="btn btn-warning">{{ __('companies.update') }} </a>
    <form action="{{ route('companies.destroy', ['company' => $company->id ]) }}" class="d-inline-block" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" id="btnDelete">{{ __('companies.delete') }}</button>
    </form>
  @endif
@stop

@section('adminlte_js')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $.ajax({
              url: '/locale',
              method: 'GET',
              success: function (data) {
                let message = '';
                let url = '';
                if(data == 'id') {
                  url = '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json'
                  message = 'Apakah kamu yakin ingin menghapus perusahaan ini?'
                } else {
                  url = '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'
                  message = 'Are you sure deleting this company?'
                }

                $('#employees-table').DataTable({
                  processing: true,
                  serverSide: false,
                  ajax: '{{ route('employees-json', ['company' => $company->id ]) }}',
                  language: {
                    url: url
                  },
                  columns: [
                      { data: 'first_name', name: 'first_name' },
                      { data: 'last_name', name: 'last_name' },
                      { data: 'email', name: 'email' },
                      { data: 'phone', name: 'phone' }
                  ]
                });

                $("#btnDelete").on('click', function() {
                  return confirm(message);
                });
              }
            });
        });
    </script>
@stop
