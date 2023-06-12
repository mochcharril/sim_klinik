@extends('doctor.layouts.app')
@section('extraCSS')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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
        <a href="{{url('/doctor/report-checkup/print')}}" class="bg-yellow-500 text-white rounded px-4 py-3 mt-2 hover:bg-yellow-600">Cetak PDF (SEMUA)</a>
        <a href="{{url('/doctor/report-checkup')}}" class="bg-orange-500 text-white rounded px-4 py-3 mt-2 hover:bg-orange-600">Reset Filter</a>
    </div>

    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Filter Berdasarkan</h1>
        </div>
        <div class="card-body">
            <div>
                <label class="text-gray-700 ml-1">Pilih Filter : </label>
                <select onchange="openFilter(this);" class="form-input mt-1 p-3 border-2 focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                    <option value="">Pilih Filter</option>
                    <option value="open_date">Per Tanggal</option>
                    <option value="open_code">Kode RM</option>
                    <option value="open_as">Daftar Pasien Sebagai</option>
                </select>
            </div>
            <div id="form_date" style="display: none;">
                <form method="POST" action="{{url('/doctor/report-checkup/date/print')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Tanggal Awal: </label>
                        <input type="date" id="date_start" name="date_start" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_start') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Awal" required>
                        @error('date_start')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Tanggal Akhir: </label>
                        <input type="date" id="date_end" name="date_end" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_end') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Akhir" required>
                        @error('date_end')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-5 flex gap-2">
                        <button type="button" onclick="getFilterDatePatient()" class="btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Tampilkan</button>
                        <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Cetak PDF</button>
                    </div>
                </form>
            </div>
            <div id="form_code" style="display: none;">
                <form method="POST" action="{{url('/doctor/report-checkup/code/print')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Pilih Pasien: </label>
                        <select name="patient" id="patient" placholder="Pilih Pasien..." class="form-input mt-1 p-3 border-2 @error('patient') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                            <option value="">Pilih Pasien</option>
                            @foreach ($getPatient as $itemPatient)
                                <option value="{{$itemPatient->id}}">{{$itemPatient->code_rm}} || {{$itemPatient->name}}</option>
                            @endforeach
                        </select>
                        @error('patient')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-5 flex gap-2">
                        <button type="button" onclick="getFilterCodePatient()" class="btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Tampilkan</button>
                        <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Cetak PDF</button>
                    </div>
                </form>
            </div>
            <div id="form_as" style="display: none;">
                <form method="POST" action="{{url('/doctor/report-checkup/as/print')}}" enctype="multipart/form-data">
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
            <b class="text-bold text-black">DATA PEMERIKSAAN</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Tanggal Pemeriksaan</th>
                    <th data-priority="3">Kode RM</th>
                    <th data-priority="4">Kode Pemeriksaan</th>
                    <th data-priority="5">Nama Pasien</th>
                    <th data-priority="6">Keluhan</th>
                    <th data-priority="7">Kode Diagnosa</th>
                    <th data-priority="8">Deskripsi Diagnosa</th>
                    <th data-priority="9">Tindakan</th>
                    <th data-priority="10">Catatan Lain</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getCheckup as $item)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->checkup_date}}</td>
                    <td class="text-left">{{$item->code_rm}}</td>
                    <td class="text-left">{{$item->code_cu}}</td>
                    <td class="text-left">{{$item->patient_name}}</td>
                    <td class="text-left">{{$item->complaint}}</td>
                    <td class="text-left">{{$item->code_diagnosis}}</td>
                    <td class="text-left">{{$item->description_diagnosis}}</td>
                    <td class="text-left">
                        @php $first = true; @endphp
                        @foreach ($getMeasureDetail as $itemDetail)
                            @if ($item->id == $itemDetail->checkup_id)
                                @if (!$first)
                                    ,
                                @else
                                    @php $first = false; @endphp
                                @endif
                                {{$itemDetail->name}}
                            @endif
                        @endforeach
                    </td>
                    <td class="text-left">{{$item->other_notes}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('extraJS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    function selectOption(){
        $('#patient').selectize({
            sortField: 'text'
        });
    }

    $(document).ready(function() {
        selectOption();
        var table = $('#thisTable').DataTable( {
                responsive: true
            } )
            .columns.adjust()
            .responsive.recalc();
    });

    function getMeasure(thisID){
        $.ajax({
            url: '/getMeasureDetail',
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                $.each(data, function(index, item){
                    if (thisID == item.checkup_id) {
                        console.log(item.name);
                        return '<span>' + item.name + '</span>';
                    }
                });
            }
        });
    }

    function getFilterCodePatient() {
        $('#thisTable').DataTable().clear().draw();

        $.ajax({
            url: '/getReportCheckup/'+document.getElementById('patient').value,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                var tableBody = $('#thisTable tbody');
                tableBody.empty();
                $.each(data.getReportPatient, function(index, item){
                    var measure = [];
                    $.each(data.getMeasureDetail, function(indexMeasure, itemMeasure){
                        if (item.id == itemMeasure.checkup_id) {
                            measure.push(itemMeasure.name)
                        }
                    });
                    var row = '<tr>' +
                        '<td class="text-center">' + item.id + '</td>' +
                        '<td class="text-left">' + item.checkup_date + '</td>' +
                        '<td class="text-left">' + item.code_rm + '</td>' +
                        '<td class="text-left">' + item.code_cu + '</td>' +
                        '<td class="text-left">' + item.patient_name + '</td>' +
                        '<td class="text-left">' + item.complaint + '</td>' +
                        '<td class="text-left">' + item.code_diagnosis + '</td>' +
                        '<td class="text-left">' + item.description_diagnosis + '</td>' +
                        '<td class="text-left">' + measure + '</td>' +
                        '<td class="text-left">' + item.other_notes + '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });
            }
        });
    }

    function getFilterDatePatient() {
        $('#thisTable').DataTable().clear().draw();

        $.ajax({
            url: '/getReportCheckupDate/'+document.getElementById('date_start').value+'/'+document.getElementById('date_end').value,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                var tableBody = $('#thisTable tbody');
                tableBody.empty();
                $.each(data.getReportPatient, function(index, item){
                    var measure = [];
                    $.each(data.getMeasureDetail, function(indexMeasure, itemMeasure){
                        if (item.id == itemMeasure.checkup_id) {
                            measure.push(itemMeasure.name)
                        }
                    });
                    var row = '<tr>' +
                        '<td class="text-center">' + item.id + '</td>' +
                        '<td class="text-left">' + item.checkup_date + '</td>' +
                        '<td class="text-left">' + item.code_rm + '</td>' +
                        '<td class="text-left">' + item.code_cu + '</td>' +
                        '<td class="text-left">' + item.patient_name + '</td>' +
                        '<td class="text-left">' + item.complaint + '</td>' +
                        '<td class="text-left">' + item.code_diagnosis + '</td>' +
                        '<td class="text-left">' + item.description_diagnosis + '</td>' +
                        '<td class="text-left">' + measure + '</td>' +
                        '<td class="text-left">' + item.other_notes + '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });
            }
        });
    }

    function getFilterAsPatient() {
        $('#thisTable').DataTable().clear().draw();

        $.ajax({
            url: '/getReportCheckup/as/'+document.getElementById('register_as').value,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                var tableBody = $('#thisTable tbody');
                tableBody.empty();
                $.each(data.getReportPatient, function(index, item){
                    var measure = [];
                    $.each(data.getMeasureDetail, function(indexMeasure, itemMeasure){
                        if (item.id == itemMeasure.checkup_id) {
                            measure.push(itemMeasure.name)
                        }
                    });
                    var row = '<tr>' +
                        '<td class="text-center">' + item.id + '</td>' +
                        '<td class="text-left">' + item.checkup_date + '</td>' +
                        '<td class="text-left">' + item.code_rm + '</td>' +
                        '<td class="text-left">' + item.code_cu + '</td>' +
                        '<td class="text-left">' + item.patient_name + '</td>' +
                        '<td class="text-left">' + item.complaint + '</td>' +
                        '<td class="text-left">' + item.code_diagnosis + '</td>' +
                        '<td class="text-left">' + item.description_diagnosis + '</td>' +
                        '<td class="text-left">' + measure + '</td>' +
                        '<td class="text-left">' + item.other_notes + '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });
            }
        });
    }

    function openFilter(that) {
        if (that.value == "open_date") {
            document.getElementById("form_date").style.display = "block";
            document.getElementById("form_code").style.display = "none";
            document.getElementById("form_as").style.display = "none";
        } else if (that.value == "open_code"){
            document.getElementById("form_code").style.display = "block";
            document.getElementById("form_date").style.display = "none";
            document.getElementById("form_as").style.display = "none";
        } else if (that.value == "open_as"){
            document.getElementById("form_as").style.display = "block";
            document.getElementById("form_code").style.display = "none";
            document.getElementById("form_date").style.display = "none";
        }else {
            document.getElementById("form_date").style.display = "none";
            document.getElementById("form_code").style.display = "none";
            document.getElementById("form_as").style.display = "none";
        }
    }
</script>
@endsection
