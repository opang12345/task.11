@extends('adminlte::page')  
@section('tittle', 'Detail Mahasantri')
@section('content_header')
     <h1>Detail Mahasantri</h1>
@stop
@section('content') {{-- isi konten Detail Mahasantri --}}


@php 
$rs2= App\Models\Jurusan::all();
$rs3= App\Models\Dosen::all();
@endphp 

@foreach($ar_mahasantri AS $mah)
<form>
@csrf
{{-- cross-site request forgery (CSRF) = pencegahan serangan yang dilakukan
oleh pengguna yang tidak terautentifikasi --}}
<div class="form-group">
    <label>Nama</label><input type="text" placeholder="{{ $mah->nama}}" class="form-control" disabled/>
</div>
<div class="form-group">
    <label>Nim</label><input type="text" placeholder="{{ $mah->nim }}" class="form-control" disabled/>
</div>



<div class="form-group">
<label>Jurusan</label>
<select name="jurusan_id" class="form-control" disabled>
<option value="">-- Pilih Jurusan --</option>
@foreach($rs2 as $jur)
@php
$sel2 = ($jur->id == $mah->jurusan_id) ? 'selected' : '';
@endphp
<option value="{{ $jur->id }}"  {{ $sel2 }}>{{ $jur->nama }}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Dosen</label>
<select class="form-control" name="dosen_id" disabled>
<option value="">-- Pilih Dosen --</option>
@foreach($rs3 as $dos)
@php
$sel3 = ($dos->id == $mah->dosen_id) ? 'selected' : '';
@endphp
<option value="{{ $dos->id }}"  {{ $sel3 }}>{{ $dos->nama }}</option>
@endforeach
</select>
</div>

<br/>
<a href="{{ route('mahasantri.index') }}" class="btn btn-primary btn-md" role="button" ><i class="fa fa-arrow-left"> Back</i></a>
</form>
@endforeach
@stop
@section('css')
     <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
     <script> console.log('Hi!'); </script>
@stop