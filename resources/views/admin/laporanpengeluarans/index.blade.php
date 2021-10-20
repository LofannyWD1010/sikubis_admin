@extends('layouts.admin')
@section('content')
<?php 
$sum_saldo_keluar = 0;
$saldo_keluar_total = 0;
?>

<div class="card">
    <div class="card-header">
        Laporan Pengeluaran
    </div>
    <div class="card-header">
      <div class="box-body no-padding">
        <div class="row">
         <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading">        
              <form class="form-inline" action="{{route('admin.laporanpengeluarans.show_range')}}" method="get">
                <div class="form-group">
                  <div class="input-group">
                      <label for="">Dari tanggal&nbsp:&nbsp</label>
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" name="tanggalawal" class="form-control date" value="{{$tanggalawal ?? ''}}" placeholder="Tanggal">
                </div>
                <div class="form-group">
                  <div class="input-group">
                      <label for="">&nbspHingga&nbsp:&nbsp</label>
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" name="tanggalakhir" class="form-control date" value="{{$tanggalakhir ?? ''}}" placeholder="Tanggal">
                  </div>
                </div>  
                <div class="form-group ml-2">
                  <input type="submit" class="btn btn-primary" value="Cari">
                </div>
              </form>
              <form action="{{route('admin.laporanpengeluarans.show_weekly')}}" method="get">
                <div class="form-group ml-2">
                  <input type="hidden" name="range" class="btn btn-primary" value="weekly">
                  <input type="submit" class="btn btn-primary" value="Show Weekly">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
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
                            Tanggal
                            &nbsp;
                        </th>
                        <th>
                            Saldo Cair
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($period as $date)
                    <tr data-entry-id="{{ $date}}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                    {{App\Pengguna::hari_ini($date->format('D')) }}, {{App\Pengguna::tgl_indo($date->format('Y-m-d')) }}
                    </td>
                    <td>
                    <table>
                        <tbody>
                        @foreach(App\Saldo_Cair::getSaldoCair($date->format('Y-m-d')) as $saldo_cair)
                        <tr>
                          <td>{{App\Pengguna::showRupiah($saldo_cair->saldo ?? '') }}</td>
                          <td>{{ $saldo_cair->Pengguna->nama ?? ''}}</td>
                          <td>{{ $saldo_cair->Pengguna->Request_Penjual->Fakultas->nama ?? ''}}</td>
                        </tr>
                        <?php $sum_saldo_keluar = $sum_saldo_keluar + $saldo_cair->saldo?>
                        @endforeach 
                        <tr>
                          <td class="bg-success" colspan="3">Saldo Total : {{App\Pengguna::showRupiah($sum_saldo_keluar) }} </td>
                          <?php $saldo_keluar_total = $saldo_keluar_total + $sum_saldo_keluar ?>
                          <?php $sum_saldo_keluar = 0?>
                        </tr>                   
                      </tbody>
                    </table>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class=" table table-bordered table-striped table-hover datatable">
              <tbody>
              <tr>
                      <td colspan="3">
                        <label>Saldo keluar Total : {{App\Pengguna::showRupiah($saldo_keluar_total) }}</label>
                      </td>
                    </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
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