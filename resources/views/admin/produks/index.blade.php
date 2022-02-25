@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
    <div class="row">
            <div class="col-md-6">Produk</div>
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
                            Nama
                            &nbsp;
                        </th>
                        <th>
                            Foto
                            &nbsp;
                        </th>
                        <th>
                            Foto 2
                            &nbsp;
                        </th>
                        <th>
                            Foto 3
                            &nbsp;
                        </th>
                        <th>
                            Nama Penjual
                            &nbsp;
                        </th>
                        <th>
                            Harga
                            &nbsp;
                        </th>
                        <th>
                            Stok
                            &nbsp;
                        </th>
                        <th>
                            AKSI
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $produk)
                        <tr data-entry-id="{{ $produk->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $produk->nama ?? '' }}
                    </td>
                    <td>
                        <img width="100" height="100" src="{{ asset("http://inkubator.sigerdev.com/uploads/file/".$produk->foto) }}"/>
                    </td><td>
                        <img width="100" height="100" src="{{ asset("http://inkubator.sigerdev.com/uploads/file/".$produk->foto2) }}"/>
                    </td>
                    <td>
                        <img width="100" height="100" src="{{ asset("http://inkubator.sigerdev.com/uploads/file/".$produk->foto3) }}"/>
                    </td>
                    <td>
                        {{$produk->Pengguna->nama}}
                    </td>
                    <td>
                    {{App\Pengguna::showRupiah($produk->harga ?? '') }}
                    </td>
                    <td>
                        {{$produk->stok}}
                    </td>
                    <td>
                    <form action="{{ route('admin.produks.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Anda yakin?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Hapus">
                                    </form>
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