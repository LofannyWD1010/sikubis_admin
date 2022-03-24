@extends('layouts.admin')
@section('content')
<?php 
$sum_saldo_cair = 0;
$saldo_cair_total = 0;
?>
<div class="card">
    <div class="card-header">
        Saldo Cair
    </div>
    <div>
        <form action="{{ route('admin.saldocairs.show_range') }}" method="POST">
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
                    <div class="col-md-2" style="margin-top: 35px;">
                        <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-primary" value="Cari">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="card-header">
        <strong>Total Semua {{App\Pengguna::showRupiah($total ?? '') }}</strong>
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
                            Jenis
                            &nbsp;
                        </th>
                        <th>
                            Keterangan
                            &nbsp;
                        </th>
                        <th>
                            Pengeluaran
                            &nbsp;
                        </th>
                        <th>
                            Waktu
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($saldo_cair as $saldo_cair)
                        <tr data-entry-id="{{ $saldo_cair->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $saldo_cair->Pengguna->nama ?? '' }}
                    </td>
                    <td>
                        Saldo Cair
                    </td>
                    <td>
                        {{ $saldo_cair->status ?? '' }}
                    </td>
                    <td>
                        {{App\Pengguna::showRupiah($saldo_cair->saldo ?? '') }}
                    </td>
                    <td>
                        {{ $saldo_cair->created_at ?? '' }}
                    </td>
                    <?php $sum_saldo_cair = $sum_saldo_cair + $saldo_cair->saldo?>
                    <?php $saldo_cair_total = $saldo_cair_total + $sum_saldo_cair ?>
                    <?php $sum_saldo_cair = 0?>
                    @endforeach
                    <tfoot>
                    <tr>
                      <td colspan="3">
                        <label>Total Saat ini {{App\Pengguna::showRupiah($saldo_cair_total) }}</label>
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