@extends('layouts.admin')
@section('content')
<?php 
$sum_saldo_masuk = 0;
$saldo_masuk_total = 0;
?>
<div class="card">
    <div class="card-header">
        Saldo Masuk
    </div>
    <div>
        <form action="{{ route('admin.saldomasuks.show_range') }}" method="POST">
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
        <strong>{{App\Pengguna::showRupiah($total ?? '') }}</strong>
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
                            Pemasukan
                            &nbsp;
                        </th>
                        <th>
                            Waktu
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($saldo_masuk as $saldo_masuk)
                        <tr data-entry-id="{{ $saldo_masuk->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $saldo_masuk->Pengguna->nama ?? '' }}
                    </td>
                    <td>
                        Saldo Masuk
                    </td>
                    <td>
                        Pemasukan
                    </td>
                    <td>
                    {{App\Pengguna::showRupiah($saldo_masuk->total_keuntungan ?? '') }}
                    </td>
                    <td>
                        {{ $saldo_masuk->created_at ?? '' }}
                    </td>
                    <?php $sum_saldo_masuk = $sum_saldo_masuk + $saldo_masuk->total_keuntungan?>
                    <?php $saldo_masuk_total = $saldo_masuk_total + $sum_saldo_masuk ?>
                    <?php $sum_saldo_masuk = 0?>
                    @endforeach
                    <tfoot >
                    <tr>
                      <td colspan="3">
                        <label>Total Saat ini {{App\Pengguna::showRupiah($saldo_masuk_total) }}</label>
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