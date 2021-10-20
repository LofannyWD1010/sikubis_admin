@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">Detail Produk</div>
            <div class="col-md-6 text-right">
                <a class="btn btn-xs btn-info" href="{{ route('admin.akuns.index')}}">
                Kembali
                </a>
            </div>
        </div>
        
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                @foreach ($produk as $produk)
                <tr>
                    <th colspan="2" class="text-center bg-success">
                       Produk ke-{{$loop->iteration}}
                    </th>
                </tr>
                <tr>
                    <th>
                        ID Produk
                    </th>
                    <td>
                        {{$produk->id}}
                    </td>
                </tr>
                <tr>
                    <th>
                        ID Pengguna
                    </th>
                    <td>
                        {{$produk->id_pengguna}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Foto Produk
                    </th>
                    <td>
                        <img width="100" height="100" src="{{ asset("gambar/".$produk->foto) }}"/>

                    </td>
                </tr>
                <tr>
                    <th>
                        Nama Produk
                    </th>
                    <td>
                        {{$produk->nama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Jenis Produk
                    </th>
                    <td>
                        {{$produk->jenis}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Harga
                    </th>
                    <td>
                        Rp. {{$produk->harga}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Satuan
                    </th>
                    <td>
                        {{$produk->satuan}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status
                    </th>
                    <td>
                        {{$produk->status}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Kategori
                    </th>
                    <td>
                        {{$produk->kategori}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Lokasi
                    </th>
                    <td>
                        {{$produk->lokasi}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Deskripsi
                    </th>
                    <td>
                        {{$produk->deskripsi}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Iklan
                    </th>
                    <td>
                        {{$produk->iklan}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Minimum Pembelian
                    </th>
                    <td>
                        {{$produk->minimum}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Berat Produk
                    </th>
                    <td>
                        {{$produk->berat}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Stok
                    </th>
                    <td>
                        {{$produk->stok}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection