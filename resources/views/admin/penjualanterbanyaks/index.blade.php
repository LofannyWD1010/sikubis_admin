@extends('layouts.admin')
@section('content')
<?php 
$sum_saldo_penjualan = 0;
$saldo_penjualan_total = 0;
?>
<div class="card">
    <div class="card-header">
        Penjualan Terbanyak Fakultas
    </div>
    <div>
        <form action="{{ route('admin.penjualanterbanyaks.show_range') }}" method="POST">
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
                            Total Keuntungan
                            &nbsp;
                        </th>
                        <th>
                            Waktu
                            &nbsp;
                        </th>
                        <th>
                            Aksi
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($total_pendapatan as $total_pendapatan)
                    <tr data-entry-id="{{ $total_pendapatan->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$total_pendapatan->Pengguna->nama}}
                    </td>
                    <td>
                        {{$total_pendapatan->Fakultas->nama}}
                    </td>
                    <td>
                        {{$total_pendapatan->total_keuntungan}}
                    </td>
                    <td>
                        {{$total_pendapatan->Pengguna->created_at}}
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.penjualanterbanyaks.show', $total_pendapatan->id_pengguna) }}">
                        Detail
                        </a>        
                    </td>
                    </tr>
                    <?php $sum_saldo_penjualan = $sum_saldo_penjualan + $total_pendapatan->total_keuntungan?>
                    <?php $saldo_penjualan_total = $saldo_penjualan_total + $sum_saldo_penjualan ?>
                    <?php $sum_saldo_penjualan = 0?>
                    @endforeach
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <label>Total Saat ini {{App\Pengguna::showRupiah($saldo_penjualan_total) }}</label>
                            </td>
                        </tr>
                    </tfoot>
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