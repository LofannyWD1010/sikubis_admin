@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">Detail Request Penjual</div>
            <div class="col-md-6 text-right">
                <form action="{{ route('admin.requests.update_request_penjual', $id_pengguna) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-sm btn-danger" value="Konfirmasi">
                </form>
            </div>
        </div>
        
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                @foreach ($request_mitra as $request_mitra)
                <tr>
                    <th>
                        ID Pengguna
                    </th>
                    <td>
                        {{$request_mitra->id_pengguna}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Fakultas
                    </th>
                    <td>
                        {{$request_mitra->Fakultas->nama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Jurusan
                    </th>
                    <td>
                        {{$request_mitra->Jurusan->nama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Civitas Akademika
                    </th>
                    <td>
                        {{$request_mitra->Civitas_Akademika->nama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status
                    </th>
                    <td>
                        {{$request_mitra->status}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Waktu
                    </th>
                    <td>
                        {{$request_mitra->created_at}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Bukti
                    </th>
                    <td>
                        <img width="100" height="100" src="{{ asset("gambar/".$request_mitra->foto) }}"/>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection