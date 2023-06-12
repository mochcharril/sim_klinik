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
        <a href="{{url('/doctor/report-recipe/print')}}" class="bg-yellow-500 text-white rounded px-4 py-3 mt-2 hover:bg-yellow-600">Cetak PDF (SEMUA)</a>
        <a href="{{url('/doctor/report-recipe')}}" class="bg-orange-500 text-white rounded px-4 py-3 mt-2 hover:bg-orange-600">Reset Filter</a>
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
                    <option value="open_code">Kode Resep</option>
                </select>
            </div>
            <div id="form_date" style="display: none;">
                <form method="POST" action="{{url('/doctor/report-recipe/date/print')}}" enctype="multipart/form-data">
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
                        <button type="button" onclick="getFilterDateRecipe()" class="btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Tampilkan</button>
                        <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Cetak PDF</button>
                    </div>
                </form>
            </div>
            <div id="form_code" style="display: none;">
                <form method="POST" action="{{url('/doctor/report-recipe/code/print')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Pilih Resep: </label>
                        <select name="recipe" id="recipe" placholder="Pilih Resep..." class="form-input mt-1 p-3 border-2 @error('recipe') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                            <option value="">Pilih Resep</option>
                            @foreach ($getFilterRecipe as $itemRecipe)
                                <option value="{{$itemRecipe->id}}">{{$itemRecipe->code_rp}}</option>
                            @endforeach
                        </select>
                        @error('recipe')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-5 flex gap-2">
                        <button type="button" onclick="getFilterCodeRecipe()" class="btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Tampilkan</button>
                        <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Cetak PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
        <div class="text-bold pb-5">
            <b class="text-bold text-black">DATA RESEP OBAT</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Tanggal Pemberian Resep</th>
                    <th data-priority="3">Kode Resep</th>
                    <th data-priority="4">Kode Pemeriksaan</th>
                    <th data-priority="5">Nama Pasien</th>
                    <th data-priority="6">Nama Dokter</th>
                    <th data-priority="7">Nama Obat</th>
                    <th data-priority="8">Aturan Pakai</th>
                    <th data-priority="9">Jumlah</th>
                    <th data-priority="10">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getRecipe as $item)  
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->date_recipe}}</td>
                    <td class="text-left">{{$item->code_rp}}</td>
                    <td class="text-left">{{$item->code_cu}}</td>
                    <td class="text-left">{{$item->patient_name}}</td>
                    <td class="text-left">{{$item->doctor}}</td>
                    <td class="text-left">{{$item->medicine}}</td>
                    <td class="text-left">{{$item->medication_rules}}</td>
                    <td class="text-left">{{$item->qty}}</td>
                    <td class="text-left">@currency($item->total)</td>
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
        $('#recipe').selectize({
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

    function getFilterCodeRecipe() {
        $('#thisTable').DataTable().clear().draw();
        
        $.ajax({
            url: '/getReportRecipe/'+document.getElementById('recipe').value,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                var tableBody = $('#thisTable tbody');
                var number = 1;
                tableBody.empty();
                $.each(data.getRecipe, function(index, item){
                    var row = '<tr>' +
                        '<td class="text-center">' + (number++) + '</td>' +
                        '<td class="text-left">' + item.date_recipe + '</td>' +
                        '<td class="text-left">' + item.code_rp + '</td>' +
                        '<td class="text-left">' + item.code_cu + '</td>' +
                        '<td class="text-left">' + item.patient_name + '</td>' +
                        '<td class="text-left">' + item.doctor + '</td>' +
                        '<td class="text-left">' + item.medicine + '</td>' +
                        '<td class="text-left">' + item.medication_rules + '</td>' +
                        '<td class="text-left">' + item.qty + '</td>' +
                        '<td class="text-left">' + item.total + '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });
            }
        });
    }

    function getFilterDateRecipe() {
        $('#thisTable').DataTable().clear().draw();
        
        $.ajax({
            url: '/getReportRecipeDate/'+document.getElementById('date_start').value+'/'+document.getElementById('date_end').value,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                var tableBody = $('#thisTable tbody');
                var number = 1;
                tableBody.empty();
                $.each(data.getRecipe, function(index, item){
                    var row = '<tr>' +
                        '<td class="text-center">' + (number++) + '</td>' +
                        '<td class="text-left">' + item.date_recipe + '</td>' +
                        '<td class="text-left">' + item.code_rp + '</td>' +
                        '<td class="text-left">' + item.code_cu + '</td>' +
                        '<td class="text-left">' + item.patient_name + '</td>' +
                        '<td class="text-left">' + item.doctor + '</td>' +
                        '<td class="text-left">' + item.medicine + '</td>' +
                        '<td class="text-left">' + item.medication_rules + '</td>' +
                        '<td class="text-left">' + item.qty + '</td>' +
                        '<td class="text-left">' + item.total + '</td>' +
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
        } else if (that.value == "open_code"){
            document.getElementById("form_code").style.display = "block";
            document.getElementById("form_date").style.display = "none";
        } else {
            document.getElementById("form_date").style.display = "none";
            document.getElementById("form_code").style.display = "none";
        }
    }
</script>
@endsection