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
<div>
    <a href="{{url('/admin/master-data/pharmacist/add')}}" class="text-white rounded px-4 py-3 mt-2" style="background-color: #609966;">Tambah Data</a>
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
        <div class="text-bold pb-5">
            <b class="text-bold text-black">DATA APOTEKER</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Nama</th>
                    <th data-priority="3">Surel</th>
                    <th data-priority="4">Surel Verifikasi</th>
                    <th data-priority="5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getPharmacist as $item)  
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->name}}</td>
                    <td class="text-left">{{$item->email}}</td>
                    <td class="text-left">{{$item->email_verified_at}}</td>
                    <td class="text-left t-mx-3 flex">
                        <form action="{{url('/admin/master-data/pharmacist')}}/{{$item->id}}/edit" method="POST" class="m-auto">
                            @csrf
                            <button class="bg-green-500 w-6 p-5 text-sm font-bold tracking-wider text-white rounded-full hover:bg-green-600 inline-flex items-center justify-center">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </form>
                        <span class="m-auto">|</span>
                        <form action="{{url('/admin/master-data/pharmacist')}}/{{$item->id}}/drop" method="POST" class="m-auto">
                            @method('delete')
                            @csrf
                            <button class="bg-red-500 w-6 p-5 text-sm font-bold tracking-wider text-white rounded-full hover:bg-red-600 inline-flex items-center justify-center"  onclick="return confirm('Hapus Data ?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
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
    } );
</script>
@endsection