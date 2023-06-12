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
    $number = 1;
@endphp
@if ($getDetailPayment == null)
<form method="POST" action="{{url('/admin/payment/store',$getDetailCheckup->id)}}">
    @csrf
@endif
    <div>
        <div class="card mb-8">
            <div class="card-header flex flex-row justify-between">
                <h1 class="h6">Tambah Data Pembayaran</h1>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Kode RM: </label>
                        <input type="text" name="code_rm" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rm') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode RM" value="{{$getDetailPatient->code_rm}}" readonly>
                        @error('code_rm')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Nama Pasien: </label>
                        <input type="text" name="patient_name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_name') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Nama Pasien" value="{{$getDetailPatient->name}}" readonly>
                        @error('patient_name')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Jenis Kelamin: </label>
                        <input type="text" name="patient_gender" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_gender') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Jenis Kelamin" value="{{$getDetailPatient->gender}}" readonly>
                        @error('patient_gender')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tempat, Tanggal Lahir: </label>
                        <input type="text" name="patient_birth" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_birth') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tempat, Tanggal Lahir" value="{{$getDetailPatient->place_of_birth}}, {{$getDetailPatient->date_of_birth}} ({{ date_diff(date_create($getDetailPatient->date_of_birth), date_create('now'))->y }} Tahun, {{ date_diff(date_create($getDetailPatient->date_of_birth), date_create('now'))->m }} Bulan)" readonly>
                        @error('patient_birth')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <hr><hr>
                    <div>
                        <label class="text-gray-700 ml-1">Kode Pemeriksaan: </label>
                        <input required type="text" name="code_cu" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_cu') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode Pemeriksaan" value="{{$getDetailCheckup->code_cu}}" readonly>
                        @error('code_cu')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Keluhan: </label>
                        <input required type="text" name="complaint" class="form-input w-full block rounded mt-1 p-3 border-2 @error('complaint') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Keluhan" value="{{$getDetailCheckup->complaint}}" readonly>
                        @error('complaint')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Alergi: </label>
                        <input required type="text" name="allergy" class="form-input w-full block rounded mt-1 p-3 border-2 @error('allergy') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Alergi" value="{{$getDetailCheckup->allergy}}" readonly>
                        @error('allergy')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Kode Diagnosa: </label>
                        <input required type="text" name="code_diagnosis" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_diagnosis') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Diagnosa" value="{{$getDetailCheckup->code_diagnosis}}" readonly>
                        @error('code_diagnosis')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Deskripsi Diagnosa: </label>
                        <input required type="text" name="description_diagnosis" class="form-input w-full block rounded mt-1 p-3 border-2 @error('description_diagnosis') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Diagnosa" value="{{$getDetailCheckup->description_diagnosis}}" readonly>
                        @error('description_diagnosis')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Catatan Lain : </label>
                        <input required type="text" name="other_notes" class="form-input w-full block rounded mt-1 p-3 border-2 @error('other_notes') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Diagnosa" value="{{$getDetailCheckup->other_notes}}" readonly>
                        @error('other_notes')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                @if ($getDetailPayment != null)
                <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Kode Pembayaran: </label>
                        <input required type="text" name="code_py" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_py') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode Resep" value="{{$getDetailPayment->code_py}}" readonly>
                        @error('code_py')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tanggal Pembayaran: </label>
                        <input required type="date" name="date_payment" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_payment') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tanggal Pembayaran" value="{{$getDetailPayment->date_payment}}" readonly>
                        @error('date_payment')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 xl:grid-cols-1 mt-5">
                    <label class="text-gray-700 ml-1">Status Pembayaran : </label>
                    <select name="status_payment" class="form-input mt-1 p-3 border-2 focus:outline-none focus:border-green-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0" disabled>
                        <option value="Belum Dibayar" {{$getDetailPayment->status_payments == 'Belum Dibayar' ? 'selected' : ''}}>Belum Dibayar</option>
                        <option value="Sudah Dibayar" {{$getDetailPayment->status_payments == 'Sudah Dibayar' ? 'selected' : ''}}>Sudah Dibayar</option>
                    </select>
                </div>
                @else
                <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Kode Pembayaran: </label>
                        <input required type="text" name="code_py" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_py') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode Resep" value="{{$generateCodePY}}" readonly>
                        @error('code_py')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tanggal Pembayaran: </label>
                        <input required type="date" name="date_payment" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_payment') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tanggal Pembayaran">
                        @error('date_payment')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                @endif
                <div class="flex">
                    <div class="mt-5">
                        @if ($getDetailPayment != null)
                        <form action="{{url('/admin/payment')}}/{{$getDetailCheckup->id}}/print" method="POST" class="m-auto">
                            @csrf
                            <button type="submit" class="btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Cetak</button>
                        </form>
                        @else
                        <button type="submit" class="btn-shadow bg-green-500 text-white rounded px-10 py-2 mt-2 hover:bg-green-600">Simpan & Bayar</button>
                        @endif
                    </div>
                    @if ($getDetailPayment != null)
                    <div class="mt-5">
                        <form action="{{url('/admin/payment')}}/{{$getDetailCheckup->id}}/print_nota" method="POST" class="m-auto">
                            @csrf
                            <div class="flex">
                                <button type="submit" class="flex-inline ml-2 btn-shadow bg-teal-500 text-white rounded px-10 py-2 mt-2 hover:bg-teal-600">Cetak Nota Resep</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
            <div class="text-bold pb-5">
                <b class="text-bold text-black">RESEP OBAT & TINDAKAN YANG DIBERIKAN</b>
            </div>
            <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">No</th>
                        <th data-priority="2">Nama Jasa (Tindakan / Obat)</th>
                        <th data-priority="3">Harga</th>
                        <th data-priority="4">Jumlah</th>
                        <th data-priority="5">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getDetailMeasure as $itemMeasure)
                    @php
                        $subTotal+=(int)$itemMeasure->price;
                    @endphp
                    <tr>
                        <td class="text-center">{{$number++}}</td>
                        <td class="text-left">{{$itemMeasure->name}}</td>
                        <td class="text-left">@currency($itemMeasure->price)</td>
                        <td class="text-left"><center>1</center></td>
                        <td class="text-left">@currency($itemMeasure->price)</td>
                    </tr>
                    @endforeach
                    @foreach ($getDetailRecipe as $itemRecipe)
                    @php
                        $subTotal+=(int)$itemRecipe->total;
                    @endphp
                    <tr>
                        <td class="text-center">{{$number++}}</td>
                        <td class="text-left">{{$itemRecipe->name}}</td>
                        <td class="text-left">@currency($itemRecipe->price)</td>
                        <td class="text-left"><center>{{$itemRecipe->qty}}</center></td>
                        <td class="text-left">@currency($itemRecipe->total)</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center text-bold" colspan="4"><b>Sub Total</b></td>
                        <td class="text-left text-bold" colspan="1"><b>@currency($subTotal)</b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <input type="hidden" name="total" value="{{$subTotal}}">
@if ($getDetailPayment == null)
</form>
@endif
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
