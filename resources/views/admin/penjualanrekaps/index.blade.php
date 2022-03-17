@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Penjualan Rekap Fakultas
    </div>
    <div>
        <form action="{{ route('admin.penjualanrekaps.show_range') }}" method="POST">
        @csrf
        <div class="card-header">
            <div class="box-body no-padding">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="">Tanggal Awal</label>
                        <input type="date" class="form-control" name="tanggalawal" value="{{$tanggalawal ?? ''}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="tanggalakhir" value="{{$tanggalakhir ?? ''}}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group {{ $errors->has('id_fakultas') ? 'has-error' : '' }}">
                        <label for="id_fakultas">Fakultas</label>
                        <select class="form-control select2 {{ $errors->has('id_fakultas') ? 'is-invalid' : '' }}" name="id_fakultas" id="id_fakultas" required>
                            <option value {{ old('id_fakultas', null) === null ? 'selected' : '' }}>Pilih Fakultas</option>
                        @foreach($fakultas_select as $key => $label)
                            <option value="{{ $key }}" {{ old('id_fakultas', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                        </select>                   
                        @if($errors->has('id_fakultas'))
                            <p class="help-block">
                            {{ $errors->first('id_fakultas') }}
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
    </div>
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
                            Nama Fakultas
                            &nbsp;
                        </th>
                        <th>
                            Pendapatan
                            &nbsp;
                        </th>
                        <th>
                            Waktu
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($rekap as $rekap)
                    <tr data-entry-id="{{ $rekap->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$rekap->Pengguna->nama}}
                    </td>
                    <td>
                        {{$rekap->Request_Penjual->Fakultas->nama}}
                    </td>
                    <td>
                        {{$rekap->total_keuntungan}}
                    </td>
                    <td>
                        {{$rekap->updated_at}}
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