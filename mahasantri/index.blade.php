@extends('adminlte::page')
@section('tittle', 'Data Mahasantri')
@section('content_header')
<h1><i class="fa fa-user"> Data Mahasantri</i></h1>
@stop

@section('content') {{-- isi konten data Mahasantri --}}
@if(session('success'))
<div class="alert alert-info">
    {{ session('success') }}
</div>
@endif


@php
$ar_judul = ['No','Nama','Nim','Jurusan','Matakuliah', 'Dosen Pengajar','Action'];
$no = 1;
@endphp
<a href="{{ route('mahasantri.create') }}" class="btn btn-primary btn-md" role="button"><i class="fa fa-plus"> Tambah Mahasantri</i></a>
<br/><br/>
<table class="table table-striped">
    <thead>
        <tr>
        @foreach($ar_judul as $jdl)
            <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
<tbody>
    @foreach($ar_mahasantri as $mah)
    <tr>
        <td>{{ $no++ }}</td>    
        <td>{{ $mah->nama }}</td>    
        <td>{{ $mah->nim }}</td>
        <td>{{ $mah->jur }}</td> 
        <td>{{ $mah->mt }}</td>     
        <td>{{ $mah->dos }}</td>   
         
        <td>
            <form action="{{ route('mahasantri.destroy',$mah->id) }}" method="POST">
                @csrf
                @method('delete')
                <a class="btn btn-info"
                href="{{ route('mahasantri.show',$mah->id) }}"><i class="fa fa-eye"></i> Detail</a>
                <a  class="btn btn-success" 
                href="{{ route('mahasantri.edit',$mah->id) }}"><i class="fa fa-edit"></i> Edit</a>
               <button class="btn btn-danger" onclick="return confirm('Anda Yakin Data Dihapus')"><i class="fa fa-trash"></i> Hapus</button>

            </form>
        </td>
        
       
    </tr>
    @endforeach
</tbody>
</table>
@stop
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script> console.log('Hi!'); </script>
@stop