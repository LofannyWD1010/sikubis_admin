@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Data
    </div>
    <div class="card-body">
        <form action="{{ route("admin.laporans.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('id_kab_kota') ? 'has-error' : '' }}">
                <label for="id_kab_kota">Kabupaten/Kota</label>
                <select class="form-control select2 {{ $errors->has('id_kab_kota') ? 'is-invalid' : '' }}" name="id_kab_kota" id="id_kab_kota" required>
                    <option value disabled {{ old('id_kab_kota', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($kab_kota_select as $key => $label)
                        <option value="{{ $key }}" {{ old('id_kab_kota', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>                   
                @if($errors->has('id_kab_kota'))
                    <p class="help-block">
                        {{ $errors->first('id_kab_kota') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('id_penyakit') ? 'has-error' : '' }}">
                <label for="id_penyakit">Penyakit*</label>
                <select class="form-control select2 {{ $errors->has('id_penyakit') ? 'is-invalid' : '' }}" name="id_penyakit" id="id_penyakit" required>
                    <option value disabled {{ old('id_penyakit', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach($id_penyakit_select as $key => $label)
                        <option value="{{ $key }}" {{ old('id_penyakit', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>                   
                @if($errors->has('id_penyakit'))
                    <p class="help-block">
                        {{ $errors->first('id_penyakit') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('tahun') ? 'has-error' : '' }}">
                <label for="tahun">Tahun</label>
                <input type="number" min="2000" max="3000" id="tahun" name="tahun" class="form-control" value="{{ old('tahun', isset($tb_rekap) ? $tb_rekap->tahun : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('bulan') ? 'has-error' : '' }}">
                <label for="bulan">Bulan</label>
                <select class="form-control select2 {{ $errors->has('bulan') ? 'is-invalid' : '' }}" name="bulan" id="bulan" required>
                    <option value disabled {{ old('bulan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\rekap::BULAN_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('bulan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>                   
                @if($errors->has('bulan'))
                    <p class="help-block">
                        {{ $errors->first('bulan') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('kasus') ? 'has-error' : '' }}">
                <label for="kasus">Kasus</label>
                <select class="form-control select2 {{ $errors->has('kasus') ? 'is-invalid' : '' }}" name="kasus" id="kasus" required>
                    <option value disabled {{ old('kasus', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\rekap::KASUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('kasus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>                   
                @if($errors->has('kasus'))
                    <p class="help-block">
                        {{ $errors->first('kasus') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control select2 {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value disabled {{ old('jenis_kelamin', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\rekap::JK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('jenis_kelamin', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>                   
                @if($errors->has('jenis_kelamin'))
                    <p class="help-block">
                        {{ $errors->first('jenis_kelamin') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('hari_0_7') ? 'has-error' : '' }}">
                <label for="hari_0_7">0 - 7 Hari</label>
                <input type="number" min="0" id="hari_0_7" name="hari_0_7" class="form-control" value="{{ old('hari_0_7', isset($tb_rekap) ? $tb_rekap->hari_0_7 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('hari_8_28') ? 'has-error' : '' }}">
                <label for="hari_8_28">8 - 28 Hari</label>
                <input type="number" min="0" id="hari_8_28" name="hari_8_28" class="form-control" value="{{ old('hari_8_28', isset($tb_rekap) ? $tb_rekap->hari_8_28 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('bulan_1_11') ? 'has-error' : '' }}">
                <label for="bulan_1_11">1 - 11 Bulan</label>
                <input type="number" min="0" id="bulan_1_11" name="bulan_1_11" class="form-control" value="{{ old('bulan_1_11', isset($tb_rekap) ? $tb_rekap->bulan_1_11 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_1_4') ? 'has-error' : '' }}">
                <label for="tahun_1_4">1 - 4 Tahun</label>
                <input type="number" min="0" id="tahun_1_4" name="tahun_1_4" class="form-control" value="{{ old('tahun_1_4', isset($tb_rekap) ? $tb_rekap->tahun_1_4 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_5_9') ? 'has-error' : '' }}">
                <label for="tahun_5_9">5 - 9 Tahun</label>
                <input type="number" min="0" id="tahun_5_9" name="tahun_5_9" class="form-control" value="{{ old('tahun_5_9', isset($tb_rekap) ? $tb_rekap->tahun_5_9 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_10_14') ? 'has-error' : '' }}">
                <label for="tahun_10_14">10 - 14 Tahun</label>
                <input type="number" min="0" id="tahun_10_14" name="tahun_10_14" class="form-control" value="{{ old('tahun_10_14', isset($tb_rekap) ? $tb_rekap->tahun_10_14 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_15_19') ? 'has-error' : '' }}">
                <label for="tahun_15_19">15 - 19 Tahun</label>
                <input type="number" min="0" id="tahun_15_19" name="tahun_15_19" class="form-control" value="{{ old('tahun_15_19', isset($tb_rekap) ? $tb_rekap->tahun_15_19 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_20_44') ? 'has-error' : '' }}">
                <label for="tahun_20_44">20 - 44 Tahun</label>
                <input type="number" min="0" id="tahun_20_44" name="tahun_20_44" class="form-control" value="{{ old('tahun_20_44', isset($tb_rekap) ? $tb_rekap->tahun_20_44 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_45_59') ? 'has-error' : '' }}">
                <label for="tahun_45_59">45 - 59 Tahun</label>
                <input type="number" min="0" id="tahun_45_59" name="tahun_45_59" class="form-control" value="{{ old('tahun_45_59', isset($tb_rekap) ? $tb_rekap->tahun_45_59 : '') }}" step="0.01">
            </div>
            <div class="form-group {{ $errors->has('tahun_60') ? 'has-error' : '' }}">
                <label for="tahun_60">>59 Tahun</label>
                <input type="number" min="0" id="tahun_60" name="tahun_60" class="form-control" value="{{ old('tahun_60', isset($tb_rekap) ? $tb_rekap->tahun_60 : '') }}" step="0.01">
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection