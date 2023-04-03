@extends('pharmacist.layouts.app')
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
@section('content')
@php
    $subTotal = 0;
@endphp
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Detail Data Obat Masuk</h1>
        </div>
        <div class="card-body">
            <div>
                <label class="text-gray-700 ml-1">Kode Transaksi Obat Masuk: </label>
                <input id="code_im" type="text" name="code_im" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_im') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode Transaksi Obat Masuk" value="{{$getIncomingMedicine->code_im}}" readonly>
                @error('code_im')
                <span class="pl-1 text-xs text-red-600 text-bold">
                    {{$message}}
                </span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-gray-700 ml-1">Tanggal Obat Masuk: </label>
                <input id="date_income_medicine" type="date" name="date_income_medicine" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_income_medicine') border-red-500 @enderror focus:outline-none focus:border-blue-500" value="{{$getIncomingMedicine->date_income_medicine}}" readonly>
                @error('date_income_medicine')
                <span class="pl-1 text-xs text-red-600 text-bold">
                    {{$message}}
                </span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-gray-700 ml-1">Transaksi Dilakukan Oleh: </label>
                <input id="transaction_by" type="text" name="transaction_by" class="form-input w-full block rounded mt-1 p-3 border-2 @error('transaction_by') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Transaksi Dilakukan Oleh" value="{{$getIncomingMedicine->name}}" readonly>
                @error('transaction_by')
                <span class="pl-1 text-xs text-red-600 text-bold">
                    {{$message}}
                </span>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-gray-700 ml-1">Total Transaksi: </label>
                <input id="transaction_total" type="text" name="transaction_total" class="form-input w-full block rounded mt-1 p-3 border-2 @error('transaction_total') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Transaksi Dilakukan Oleh" value="@currency($getIncomingMedicine->total)" readonly>
                @error('transaction_total')
                <span class="pl-1 text-xs text-red-600 text-bold">
                    {{$message}}
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>
<div>
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
        <div class="text-bold pb-5">
            <b class="text-bold text-black">DATA DETAIL OBAT MASUK ({{$getIncomingMedicine->code_im}})</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Kode Obat</th>
                    <th data-priority="3">Nama Obat</th>
                    <th data-priority="4">Stok Masuk</th>
                    <th data-priority="5">Stok Terbaru</th>
                    <th data-priority="6">Harga</th>
                    <th data-priority="7">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getIncomingMedicineDetail as $item)
                @php
                    $subTotal+=(int)$item->total;
                @endphp  
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->code_md}}</td>
                    <td class="text-left">{{$item->name}}</td>
                    <td class="text-left">{{$item->stock_in}}</td>
                    <td class="text-left">{{$item->stock}}</td>
                    <td class="text-left">@currency($item->price)</td>
                    <td class="text-left">@currency($item->total)</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center text-bold" colspan="6"><b>Sub Total</b></td>
                    <td class="text-center text-bold" colspan="1"><b>@currency($subTotal)</b></td>
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