@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Pencairan Dana
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
                            No Telpon
                            &nbsp;
                        </th>
                        <th>
                            Saldo Saat ini
                            &nbsp;
                        </th>
                        <th>
                            Saldo Request Pencairan
                            &nbsp;
                        </th>
                        <th>
                            Status
                            &nbsp;
                        </th>
                        <th>
                            AKSI
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($saldo_cair as $saldo_cair)
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
                        {{ $saldo_cair->Pengguna->no_telp ?? '' }}
                    </td>
                    <td>
                    {{App\Pengguna::showRupiah($saldo_cair->Pengguna->saldo ?? '') }}
                    </td>
                    <td>
                    {{App\Pengguna::showRupiah($saldo_cair->saldo ?? '') }}
                    </td>
                    <td>
                        {{ $saldo_cair->status ?? '' }}
                    </td>
                    <td>
                        <form action="{{ route('admin.pencairans.update_saldo_cair', $saldo_cair->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-xs btn-primary" value="Konfirmasi">
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