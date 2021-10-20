@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.civitasakademikas.create") }}">
                Tambah Data Civitas Akademika
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">Civitas Akademika</div>
            <div class="col-md-6 text-right">
                <a class="btn btn-xs btn-info" href="{{ route('admin.fakultass.index')}}">
                Kembali
                </a>
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
                            Nama
                            &nbsp;
                        </th>
                        <th>
                            Aksi
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($civitas_akademika as $civitas_akademika)
                    <tr data-entry-id="{{ $civitas_akademika->id }}">
                    <td>
                    
                    </td>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                    {{ $civitas_akademika->nama ?? '' }}
                    </td>
                    <td>
                    <a class="btn btn-xs btn-info" href="{{ route('admin.civitasakademikas.edit', $civitas_akademika->id) }}">
                        Edit
                        </a>
                    <form action="{{ route('admin.civitasakademikas.destroy', $civitas_akademika->id) }}" method="POST" onsubmit="return confirm('Anda yakin?');" style="display: inline-block;">
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