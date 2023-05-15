@extends('admin.layouts.app')
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
@php
    $subTotal = 0;
@endphp
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Detail Data Resep Obat</h1>
        </div>
        <div class="card-body">
            <div class="grid mt-5 grid-cols-2 gap-5 xl:grid-cols-1">
                <div>
                    <label class="text-gray-700 ml-1">Kode RM: </label>
                    <input type="text" name="code_rm" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rm') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode RM" value="{{$getDetailPatient->code_rm}}" readonly>
                    @error('code_rm')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Nama Pasien: </label>
                    <input type="text" name="patient_name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Pasien" value="{{$getDetailPatient->name}}" readonly>
                    @error('patient_name')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Jenis Kelamin: </label>
                    <input type="text" name="patient_gender" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_gender') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Jenis Kelamin" value="{{$getDetailPatient->gender}}" readonly>
                    @error('patient_gender')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Tempat, Tanggal Lahir: </label>
                    <input type="text" name="patient_birth" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_birth') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tempat, Tanggal Lahir" value="{{$getDetailPatient->place_of_birth}}, {{$getDetailPatient->date_of_birth}} ({{ date_diff(date_create($getDetailPatient->date_of_birth), date_create('now'))->y }} Tahun, {{ date_diff(date_create($getDetailPatient->date_of_birth), date_create('now'))->m }} Bulan)" readonly>
                    @error('patient_birth')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <hr><hr>
                <div>
                    <label class="text-gray-700 ml-1">Kode Pemeriksaan: </label>
                    <input required type="text" name="code_cu" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_cu') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode Pemeriksaan" value="{{$getDetailCheckup->code_cu}}" readonly>
                    @error('code_cu')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Keluhan: </label>
                    <input required type="text" name="complaint" class="form-input w-full block rounded mt-1 p-3 border-2 @error('complaint') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Keluhan" value="{{$getDetailCheckup->complaint}}" readonly>
                    @error('complaint')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Alergi: </label>
                    <input required type="text" name="allergy" class="form-input w-full block rounded mt-1 p-3 border-2 @error('allergy') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Alergi" value="{{$getDetailCheckup->allergy}}" readonly>
                    @error('allergy')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Diagnosa: </label>
                    <input required type="text" name="diagnosis" class="form-input w-full block rounded mt-1 p-3 border-2 @error('diagnosis') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Diagnosa" value="{{$getDetailCheckup->code_diagnosis}} || {{$getDetailCheckup->description_diagnosis}}" readonly>
                    @error('diagnosis')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="grid grid-cols-1 mt-5 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Catatan Lain : </label>
                        <input type="text" name="other_notes" class="form-input w-full block rounded mt-1 p-3 border-2 @error('other_notes') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Catatan" value="{{$getDetailCheckup->other_notes}}" readonly>
                        @error('other_notes')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
        <div class="text-bold pb-5">
            <b class="text-bold text-black">RESEP OBAT YANG DIBERIKAN</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Kode Resep</th>
                    <th data-priority="3">Tanggal Resep</th>
                    <th data-priority="4">Dokter</th>
                    <th data-priority="5">Nama Obat</th>
                    <th data-priority="6">Jumlah Obat</th>
                    <th data-priority="7">Aturan Pemakaian</th>
                    <th data-priority="8">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getDetailRecipe as $item)
                @php
                    $subTotal+=(int)$item->total;
                @endphp
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->code_rp}}</td>
                    <td class="text-left">{{$item->date_recipe}}</td>
                    <td class="text-left">{{$item->doctor_name}}</td>
                    <td class="text-left">{{$item->medicine_name}}</td>
                    <td class="text-left">{{$item->qty}}</td>
                    <td class="text-left">{{$item->medication_rules}}</td>
                    <td class="text-left">@currency($item->total)</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center text-bold" colspan="7"><b>Sub Total</b></td>
                    <td class="text-left text-bold" colspan="1"><b>@currency($subTotal)</b></td>
                </tr>
            </tfoot>
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
    } );
</script>
@endsection
