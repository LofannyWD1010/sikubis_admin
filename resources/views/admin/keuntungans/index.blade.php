@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Saldo Keuntungan Sikubis
    </div>
    <div class="card-header" style="color: green;">
    <strong>Rp. {{ $total*5/100 ?? '' }}</strong>
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
                            Nama Produk
                            &nbsp;
                        </th>
                        <th>
                            Jumlah Barang
                            &nbsp;
                        </th>
                        <th>
                            Keuntungan
                            &nbsp;
                        </th>
                        <th>
                            Waktu
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($keuntungan as $keuntungan)
                        <tr data-entry-id="{{ $keuntungan->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $keuntungan->Produk->nama ?? '' }}
                    </td>
                    <td>
                        {{ $keuntungan->jumlah ?? '' }}
                    </td>
                    <td>
                        {{ $keuntungan->total_keuntungan*5/100 ?? '' }}

                    </td>
                    <td>
                        {{ $keuntungan->created_at ?? '' }}
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