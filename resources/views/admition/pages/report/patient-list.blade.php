@extends('admition.layouts.app')
@section('extraCSS')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

<style>
    .dataTables_wrapper select,
    .dataTables_wrapper .dataTables_filter input {
        color: #4a5568;	
        padding-left: 1rem; 		
        padding-right: 1rem; 		
        padding-top: .5rem; 		
        padding-bottom: .5rem;
        line-height: 1.25;
        border-width: 2px;
        border-radius: .25rem; 		
        border-color: #edf2f7;
        background-color: #edf2f7;
    }

    table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
        background-color: #ebf4ff;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button		{
        font-weight: 700;
        border-radius: .25rem;
        border: 1px solid transparent;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current	{
        color: #fff !important;
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        font-weight: 700;
        border-radius: .25rem;
        background: #4299e1 !important;
        border: 1px solid transparent;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
        color: #fff !important;				/*text-white*/
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 /*shadow*/
        font-weight: 700;
        border-radius: .25rem;
        background: #4299e1 !important;
        border: 1px solid transparent;
    }
    
    table.dataTable.no-footer {
        border-bottom: 1px solid #e2e8f0;
        margin-top: 0.75em;
        margin-bottom: 0.75em;
    }
    
    /*Change colour of responsive icon*/
    table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
        background-color: #4299e1 !important;
    }
</style>
@endsection
@section('content')
<div>
    <div class="mb-8">
        <a href="{{url('/admition/report-patient/print')}}" class="bg-yellow-500 text-white rounded px-4 py-3 mt-2 hover:bg-yellow-600">Cetak PDF (SEMUA)</a>
        <a href="{{url('/admition/report-patient')}}" class="bg-orange-500 text-white rounded px-4 py-3 mt-2 hover:bg-orange-600">Reset Filter</a>
    </div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Filter Berdasarkan</h1>
        </div>
        <div class="card-body">
            <div>
                <label class="text-gray-700 ml-1">Pilih Filter : </label>
                <select onchange="openFilter(this);" class="form-input mt-1 p-3 border-2 focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                    <option value="">Semua</option>
                    <option value="open_as">Daftar Pasien Sebagai</option>
                </select>
            </div>
            <div id="form_as" style="display: none;">
                <form method="POST" action="{{url('/admition/report-patient/as/print')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Daftar Pasien Sebagai: </label>
                        <select name="register_as" id="register_as" class="form-input mt-1 p-3 border-2 @error('register_as') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                            <option value="Umum">Umum</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Keluarga Karyawan">Keluarga Karyawan</option>
                        </select>
                        @error('register_as')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-5 flex gap-2">
                        <button type="button" onclick="getFilterAsPatient()" class="btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Tampilkan</button>
                        <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Cetak PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
        <div class="text-bold pb-5">
            <b class="text-bold text-black">DATA PASIEN</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Kode RM</th>
                    <th data-priority="3">Nama</th>
                    <th data-priority="4">NIK</th>
                    <th data-priority="5">Jenis Kelamin</th>
                    <th data-priority="6">Tempat, Tanggal Lahir</th>
                    <th data-priority="7">Alamat</th>
                    <th data-priority="8">No Telepon</th>
                    <th data-priority="9">Jenis Asuransi</th>
                    <th data-priority="10">No Asuransi</th>
                    <th data-priority="11">Daftar Pasien Sebagai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getPatient as $item)  
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->code_rm}}</td>
                    <td class="text-left">{{$item->name}}</td>
                    <td class="text-left">{{$item->nik}}</td>
                    <td class="text-left">{{$item->gender}}</td>
                    <td class="text-left">{{$item->place_of_birth}}, {{$item->date_of_birth}}</td>
                    <td class="text-left">{{$item->address}}</td>
                    <td class="text-left">{{$item->phone_number}}</td>
                    <td class="text-left">{{$item->insurance_type}}</td>
                    <td class="text-left">{{$item->insurance_number}}</td>
                    <td class="text-left">{{$item->register_as}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extraJS')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#thisTable').DataTable( {
                responsive: true
            } )
            .columns.adjust()
            .responsive.recalc();
        
        var tables = $('#thisTables').DataTable( {
                responsive: true
            } )
            .columns.adjust()
            .responsive.recalc();
    } );
    
    function getFilterAsPatient() {
        $('#thisTable').DataTable().clear().draw();

        $.ajax({
            url: '/getReportPatient/as/'+document.getElementById('register_as').value,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                var tableBody = $('#thisTable tbody');
                tableBody.empty();
                var no = 1;
                $.each(data.getReportPatient, function(index, item){
                    var row = '<tr>' +
                        '<td class="text-center">' + (no++) + '</td>' +
                        '<td class="text-left">' + item.code_rm + '</td>' +
                        '<td class="text-left">' + item.name + '</td>' +
                        '<td class="text-left">' + item.nik + '</td>' +
                        '<td class="text-left">' + item.gender + '</td>' +
                        '<td class="text-left">' + item.place_of_birth + ', ' + item.date_of_birth + '</td>' +
                        '<td class="text-left">' + item.address + '</td>' +
                        '<td class="text-left">' + item.phone_number + '</td>' +
                        '<td class="text-left">' + item.insurance_type + '</td>' +
                        '<td class="text-left">' + item.insurance_number + '</td>' +
                        '<td class="text-left">' + item.register_as + '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });
            }
        });
    }

    function openFilter(that) {
        if (that.value == "open_as"){
            document.getElementById("form_as").style.display = "block";
        }else {
            document.getElementById("form_as").style.display = "none";
        }
    }
</script>
@endsection