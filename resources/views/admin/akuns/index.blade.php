@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Akun Penjual
    </div>
    <form action="{{ route('admin.akuns.show_civitas') }}" method="POST">
    @csrf
    <div class="card-header">
      <div class="box-body no-padding">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group {{ $errors->has('id_civitas_akademika') ? 'has-error' : '' }}">
                <label for="id_civitas_akademika">Civitas Akademika</label>
                <select class="form-control select2 {{ $errors->has('id_civitas_akademika') ? 'is-invalid' : '' }}" name="id_civitas_akademika" id="id_civitas_akademika" required>
                    <option value {{ old('id_civitas_akademika', null) === null ? 'selected' : '' }}>Pilih Civitas Akademika</option>
                    @foreach($civitas_select as $key => $label)
                        <option value="{{ $key }}" {{ old('id_civitas_akademika', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>                   
                @if($errors->has('id_civitas_akademika'))
                    <p class="help-block">
                        {{ $errors->first('id_civitas_akademika') }}
                    </p>
                @endif
                </div>
            </div>
                <div class="col-md-2" style="margin-top: 34px;">
                    <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-primary" value="Cari">
                    </div>
                </div>
            </div>
        </div>
    </div>        
    </form>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            No
                            &nbsp;
                        </th>
                        <th>
                            Nama
                            &nbsp;
                        </th>
                        <th>
                            Jurusan
                            &nbsp;
                        </th>
                        <th>
                            Fakultas
                            &nbsp;
                        </th>
                        <th>
                            Civitas Akademika
                            &nbsp;
                        </th>
                        <th>
                            Produk
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pengguna as $pengguna)
                    <tr data-entry-id="{{ $pengguna->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                    {{ $pengguna->Pengguna->nama ?? '' }}
                    </td>
                    <td>
                    {{ $pengguna->Jurusan->nama ?? '' }}
                    </td>
                    <td>
                    {{ $pengguna->Fakultas->nama ?? '' }}
                    </td>
                    <td>
                    {{ $pengguna->Civitas_Akademika->nama ?? '' }}
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.akuns.show', $pengguna->id_pengguna) }}">
                        Detail
                        </a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection