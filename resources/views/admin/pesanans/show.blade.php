@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">Detail Pesanan</div>
            <div class="col-md-6 text-right">
                <form action="{{ route('admin.pesanans.update_detail_pesanan', $id_pesanan) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
                @foreach ($detail_pesanan as $detail_pesanan)
                <tr>
                    <th colspan="2" class="text-center bg-success">
                       Pesanan ke-{{$loop->iteration}}
                    </th>
                </tr>
                <tr>
                    <th>
                        ID Detail Pesanan
                    </th>
                    <td>
                        {{$detail_pesanan->id_detail}}
                    </td>
                </tr>
                <tr>
                    <th>
                        ID Pesanan
                    </th>
                    <td>
                        {{$detail_pesanan->id_pesanan}}
                    </td>
                </tr>
                <tr>
                    <th>
                        ID Penjual
                    </th>
                    <td>
                        {{$detail_pesanan->id_penjual}}
                    </td>
                </tr>
                <tr>
                    <th>
                        ID Pembeli
                    </th>
                    <td>
                        {{$detail_pesanan->id_pembeli}}
                    </td>
                </tr>
                <tr>
                    <th>
                        ID Produk
                    </th>
                    <td>
                        {{$detail_pesanan->id_produk}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Harga
                    </th>
                    <td>
                        {{$detail_pesanan->harga}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Ongkos Kirim
                    </th>
                    <td>
                        {{$detail_pesanan->ongkir}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Total Pembayaran
                    </th>
                    <td>
                        {{$detail_pesanan->total_keuntungan}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Jumlah Produk
                    </th>
                    <td>
                        {{$detail_pesanan->jumlah}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Alamat
                    </th>
                    <td>
                        {{$detail_pesanan->alamat_antar}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status Pembayaran
                    </th>
                    <td>
                        {{$detail_pesanan->status}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status Pesanan
                    </th>
                    <td>
                        {{$detail_pesanan->ambil}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection