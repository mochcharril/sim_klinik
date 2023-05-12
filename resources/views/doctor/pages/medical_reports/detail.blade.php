@extends('doctor.layouts.app')
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
            <h1 class="h6">Detail Rekam Medis (Pasien)</h1>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
                <div>
                    <label class="text-gray-700 ml-1">Kode RM: </label>
                    <input type="text" name="code_rm_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rm_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode RM" value="{{$getPatient->code_rm}}" readonly>
                    @error('code_rm_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Nama Pasien: </label>
                    <input type="text" name="name_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('name_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Pasien" value="{{$getPatient->name}}" readonly>
                    @error('name_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">NIK Pasien: </label>
                    <input type="text" name="nik_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('nik_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="NIK Pasien" value="{{$getPatient->nik}}" readonly>
                    @error('nik_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Jenis Kelamin Pasien: </label>
                    <input type="text" name="gender_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('gender_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Jenis Kelamin Pasien" value="{{$getPatient->gender}}" readonly>
                    @error('gender_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Tempat, Tanggal lahir Pasien: </label>
                    <input type="text" name="date_place_of_birth_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_place_of_birth_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tempat, Tanggal lahir Pasien" value="{{$getPatient->place_of_birth}}, {{$getPatient->date_of_birth}}" readonly>
                    @error('date_place_of_birth_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Alamat Pasien: </label>
                    <input type="text" name="address_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('address_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Alamat Pasien" value="{{$getPatient->address}}" readonly>
                    @error('address_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Nomor Telepon Pasien: </label>
                    <input type="text" name="phone_number_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('phone_number_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nomor Telepon Pasien" value="{{$getPatient->phone_number}}" readonly>
                    @error('phone_number_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Asuransi Pasien: </label>
                    <input type="text" name="insurance_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('insurance_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Asuransi Pasien" value="{{$getPatient->insurance_type}} ({{$getPatient->insurance_number}})" readonly>
                    @error('insurance_patient')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($getCheckup as $itemCheckup)
@php
    $subTotal = 0;
@endphp
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Detail Rekam Medis (Pemeriksaan - {{$itemCheckup->code_cu}})</h1>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
                <div>
                    <label class="text-gray-700 ml-1">Kode Pemeriksaan: </label>
                    <input type="text" name="code_cu_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_cu_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode Pemeriksaan" value="{{$itemCheckup->code_cu}}" readonly>
                    @error('code_cu_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Tanggal Pemeriksaan : </label>
                    <input type="text" name="checkup_date_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('checkup_date_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Pemeriksaan " value="{{$itemCheckup->checkup_date}}" readonly>
                    @error('checkup_date_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Pemeriksa : </label>
                    <input type="text" name="doctor_nurse_name_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('doctor_nurse_name_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Pemeriksa " value="{{$itemCheckup->doctor_nurse_name}}" readonly>
                    @error('doctor_nurse_name_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Keluhan : </label>
                    <input type="text" name="complaint_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('complaint_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Keluhan " value="{{$itemCheckup->complaint}}" readonly>
                    @error('complaint_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Tinggi Badan : </label>
                    <input type="text" name="height_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('height_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tinggi Badan " value="{{$itemCheckup->height}}" readonly>
                    @error('height_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Berat Badan : </label>
                    <input type="text" name="weight_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('weight_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Berat Badan " value="{{$itemCheckup->weight}}" readonly>
                    @error('weight_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Tekanan Darah : </label>
                    <input type="text" name="blood_preasure_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('blood_preasure_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tekanan Darah " value="{{$itemCheckup->blood_preasure}}" readonly>
                    @error('blood_preasure_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Alergi : </label>
                    <input type="text" name="allergy_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('allergy_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Alergi " value="{{$itemCheckup->allergy}}" readonly>
                    @error('allergy_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Kode Diagnosa : </label>
                    <input type="text" name="description_diagnosis" class="form-input w-full block rounded mt-1 p-3 border-2 @error('description_diagnosis') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Diagnosa " value="{{$itemCheckup->description_diagnosis}}" readonly>
                    @error('description_diagnosis')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Kode Diagnosa : </label>
                    <input type="text" name="code_diagnosis" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_diagnosis') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Diagnosa " value="{{$itemCheckup->code_diagnosis}}" readonly>
                    @error('code_diagnosis')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Tindakan : </label>
                    <input type="text" name="measures_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('measures_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tindakan " value="@foreach($getMeasure as $itemDetail)@if($itemCheckup->id == $itemDetail->checkup_id){{$itemDetail->name}},@endif @endforeach" readonly>
                    @error('measures_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-700 ml-1">Poli : </label>
                    <input type="text" name="poly_name_checkup" class="form-input w-full block rounded mt-1 p-3 border-2 @error('poly_name_checkup') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Poli " value="{{$itemCheckup->poly_name}}" readonly>
                    @error('poly_name_checkup')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 mt-5 gap-5 xl:grid-cols-1">
                <div>
                    <label class="text-gray-700 ml-1">Catatan Lain : </label>
                    <input type="text" name="other_notes" class="form-input w-full block rounded mt-1 p-3 border-2 @error('other_notes') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Catatan" value="{{$itemCheckup->other_notes}}" readonly>
                    @error('other_notes')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 mt-5 gap-5 xl:grid-cols-1">
                <h1 class="h6">Detail Resep Obat</h1>
                <div>
                    <table id="thisTable-{{$loop->iteration}}" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
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
                            @if ($itemCheckup->id == $item->checkup_id)
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
                            @endif
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
        </div>
    </div>
</div>
@endforeach
@endsection
@section('extraJS')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        let x = 1000;
        for (i=1; i<=x; i++){
            var table = $('#thisTable-'+i).DataTable( {
                    responsive: true
                } )
                .columns.adjust()
                .responsive.recalc();
            }
        }
    );
</script>
@endsection
