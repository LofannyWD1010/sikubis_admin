@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.laporans.create") }}">
                Tambah Data
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        Data Rekap
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
                            Kabupaten/Kota
                            &nbsp;
                        </th>
                        <th>
                            Penyakit
                            &nbsp;
                        </th>
                        <th>
                            ICD10
                            &nbsp;
                        </th>
                        <th>
                            Tahun
                            &nbsp;
                        </th>
                        <th>
                            Bulan
                            &nbsp;
                        </th>
                        <th>
                            Kasus
                            &nbsp;
                        </th>
                        <th>
                            JenisKelamin
                            &nbsp;
                        </th>
                        <th>
                            0-7 Hari
                        </th>
                        <th>
                            8-28 Hari
                        </th>
                        <th>
                            1-11 Bulan
                        </th>
                        <th>
                            1-4 Tahun
                        </th>
                        <th>
                            5-9 Tahun
                        </th>
                        <th>
                            10-14 Tahun
                        </th>
                        <th>
                            15-19 Tahun
                        </th>
                        <th>
                            20-44 Tahun
                        </th>
                        <th>
                            45-59 Tahun
                        </th>
                        <th>
                            >59 Tahun
                        </th>
                        <th>
                            Jumlah
                        </th>
                        <th>
                            AKSI
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tb_rekaps as $tb_rekap)
                        <tr data-entry-id="{{ $tb_rekap->id }}">
                            <td>

                            </td>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{ $tb_rekap->kota->nama_kab_kota ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->penyakit->nama_penyakit ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->id_penyakit ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->bulan ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->kasus ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->jenis_kelamin ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->hari_0_7 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->hari_8_28 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->bulan_1_11 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_1_4 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_5_9 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_10_14 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_15_19 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_20_44 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_45_59 ?? '' }}
                            </td>
                            <td>
                                {{ $tb_rekap->tahun_60 ?? '' }}
                            </td>
                            <td>
                                {{ $total=$tb_rekap->hari_0_7 + $tb_rekap->hari_8_28 + $tb_rekap->bulan_1_11 + $tb_rekap->tahun_1_4 + $tb_rekap->tahun_5_9 + $tb_rekap->tahun_10_14 + $tb_rekap->tahun_15_19 + $tb_rekap->tahun_20_44 + $tb_rekap->tahun_45_59 + $tb_rekap->tahun_60  }}
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.laporans.edit', $tb_rekap->id) }}">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('admin.laporans.destroy', $tb_rekap->id) }}" method="POST" onsubmit="return confirm('Anda yakin?');" style="display: inline-block;">
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