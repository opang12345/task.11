@extends('adminlte::page')  
@section('tittle', 'Form Mahasantri')
@section('content_header')
     <h1>Form Mahasantri</h1>
@stop
@section('content') {{-- isi konten form Mahasantri --}}

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif
@php 
$rs2= App\Models\Jurusan::all();
$rs3= App\Models\Dosen::all();
@endphp 

<form method="POST" action="{{ route('mahasantri.store') }}">
@csrf
{{-- cross-site request forgery (CSRF) = pencegahan serangan yang dilakukan
oleh pengguna yang tidak terautentifikasi --}}
<div class="form-group">
    <label>Nama</label><input type="text" name="nama" class="form-control"/>
</div>
<div class="form-group">
    <label>Nim</label><input type="text" name="nim" class="form-control"/>
</div>



<div class="form-group">
<label>Jurusan</label>
<select name="jurusan_id" class="form-control">
<option value="">-- Pilih Jurusan --</option>
@foreach($rs2 as $jur)
<option value="{{ $jur->id }}">{{$jur->nama }}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Dosen</label>
<select class="form-control" name="dosen_id">
<option value="">-- Pilih Dosen --</option>
@foreach($rs3 as $dos)
<option value="{{ $dos->id }}">{{ $dos->nama }}</option>
@endforeach
</select>
</div>

<br/>
<a href="{{ route('mahasantri.index') }}" class="btn btn-primary btn-md" role="button" ><i class="fa fa-arrow-left"> Back</i></a>
<button type="submit" class="btn btn-primary"> Simpan</button>
</form>
@stop
@section('css')
     <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
     <script> console.log('Hi!'); </script>
@stop