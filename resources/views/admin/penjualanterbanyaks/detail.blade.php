@extends('layouts.admin')
@section('content')
<?php 
$sum_saldo = 0;
$saldo_pendapatan_total = 0;
?>
<div class="card">
    <div class="card-header">
        Penjualan {{$fakultas->nama}}
    </div>
    <div>
        <form action="{{ route("admin.penjualanterbanyaks.show_range", [$fakultas->id]) }}" method="POST">
        @csrf
            <div class="col-md-3">
              <div class="form-group">
              <label for="">Start Date</label>
              <input type="date" class="form-control" name="tanggalawal" value="{{$tanggalawal ?? ''}}">
            </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
              <label for="">End Date</label>
              <input type="date" class="form-control" name="tanggalakhir" value="{{$tanggalakhir ?? ''}}">
            </div>
            </div>

            <div class="col-md-2" style="margin-top: 24px;">
               <div class="form-group">
                 <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </form>
    </div>
    <div class="card-header" style="color: green;">
        <strong> </strong>
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
                            Nama Penjual
                            &nbsp;
                        </th>
                        <th>
                            Fakultas
                            &nbsp;
                        </th>
                        <th>
                            Pendapatan
                            &nbsp;
                        </th>
                        <th>
                            Tanggal
                            &nbsp;
                        </th>
                        <th>
                            Aksi
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mitra as $mitra)
                    <tr data-entry-id="{{ $mitra->id_detail }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$mitra->Pengguna->nama}}
                    </td>
                    <td>
                        {{$mitra->Fakultas->nama}}
                    </td>
                    <td>
                        {{$mitra->total_keuntungan}}
                    </td>
                    <td>
                        {{$mitra->created_at}}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.penjualanterbanyaks.detail',$fakultas->id) }}">Detail
                        </a>
                    </td>
                    </tr>
                    <?php $sum_saldo = $sum_saldo + $mitra->total_keuntungan?>
                    <?php $saldo_pendapatan_total = $saldo_pendapatan_total + $sum_saldo ?>
                    <?php $sum_saldo = 0?>
                    @endforeach
                </tbody>
            </table>
            <table class=" table table-bordered table-striped table-hover datatable">
              <tbody>
              <tr>
                      <td colspan="3">
                        <label>Total Pendapatan {{App\Pengguna::showRupiah($saldo_pendapatan_total) }}</label>
                      </td>
                    </tr>
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