@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Pesanan
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
                            ID Pesanan
                            &nbsp;
                        </th>
                        <th>
                            Foto
                            &nbsp;
                        </th>
                        <th>
                            Upload Bukti
                            &nbsp;
                        </th>
                        <th>
                            Total Pembayaran
                            &nbsp;
                        </th>
                        <th>
                            AKSI
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan as $pesanan)
                        <tr data-entry-id="{{ $pesanan->id_pesanan }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $pesanan->id_pesanan ?? '' }}
                    </td>
                    <td>
                        <img width="100" height="100" src="{{ asset("gambar/".$pesanan->foto) }}"/>
                    </td>
                    <td>
                        <span class="badge badge-success">{{ $pesanan->status ?? '' }}</span>
                    </td>
                    <td>
                    {{App\Pengguna::showRupiah($pesanan->total_bayar ?? '') }}
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.pesanans.show', $pesanan->id_pesanan) }}">
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