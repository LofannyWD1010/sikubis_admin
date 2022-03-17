@extends('layouts.admin')
@section('content')
<?php 
$sum_saldo = 0;

?>
<div class="card">
    <div class="card-header">
        Laporan Transaksi
    </div>
    <div>
        <form action="{{ route('admin.laporanjurnals.show_range') }}" method="POST">
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
                            Jenis
                            &nbsp;
                        </th>
                        <th>
                            Keterangan
                            &nbsp;
                        </th>
                        <th>
                            Kategori
                            &nbsp;
                        </th>
                        <th>
                            Saldo Masuk
                            &nbsp;
                        </th><th>
                            Saldo Keluar
                            &nbsp;
                        </th>
                        <th>
                            AKSI
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $laporan)
                        <tr>
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $laporan->created_at ?? '' }} 
                    </td>
                    <td>
                        @if($laporan->status != "sudah cair" && $laporan->status != "belum cair")
                        Pemasukan
                        @else
                        Pengeluaran
                        @endif
                    </td>
                    <td>
                        {{ $laporan->status ?? '' }} 
                    </td>
                    <td>
                        @if($laporan->status != "sudah cair" && $laporan->status != "belum cair")
                        Pesanan
                        @else
                        Pencairan
                        @endif
                    </td>  
                    <td>
                        {{ $laporan->saldo_masuk ?? '' }} 
                    </td>
                    <td>
                        {{ $laporan->saldo_cair ?? '' }}
                    </td>
                    <td>
                        <form action="{{ route('admin.fakultass.destroy', $laporan->created_at) }}" method="POST" onsubmit="return confirm('Anda yakin?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Hapus">
                                    </form>
                    </td>
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