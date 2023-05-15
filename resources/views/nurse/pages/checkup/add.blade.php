@extends('nurse.layouts.app')
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
    <form method="POST" action="{{url('/nurse/action/checkup/store',$getDetailPatient->id)}}">
        @csrf
        <div class="card mb-8">
            <div class="card-header flex flex-row justify-between">
                <h1 class="h6">Tambah Data Pemeriksaan</h1>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
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
                    <div>
                        <label class="text-gray-700 ml-1">Alamat: </label>
                        <input type="text" name="patient_address" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_address') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Alamat" value="{{$getDetailPatient->address}}" readonly>
                        @error('patient_address')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">No Telepon: </label>
                        <input type="text" name="patient_phone_number" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_phone_number') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="No Telepon" value="{{$getDetailPatient->phone_number}}" readonly>
                        @error('patient_phone_number')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tipe Asuransi: </label>
                        <input type="text" name="patient_insurance_type" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_insurance_type') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tipe Asuransi" value="{{$getDetailPatient->insurance_type == '-' ? 'Tidak Ada Asuransi (Umum)' : $getDetailPatient->insurance_type}}" readonly>
                        @error('patient_insurance_type')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">No Asuransi: </label>
                        <input type="text" name="patient_insurance_number" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_insurance_number') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="No Asuransi" value="{{$getDetailPatient->insurance_number}}" readonly>
                        @error('patient_insurance_number')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="grid mt-5 grid-cols-1 gap-5 xl:grid-cols-1">
                    <hr>
                    <div>
                        <label class="text-gray-700 ml-1">Code Pemeriksaan: </label>
                        <input required type="text" name="code_cu" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_cu') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Code Pemeriksaan" value="{{$generateCodeCU}}" readonly>
                        @error('code_cu')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <hr>
                </div>
                <div class="grid mt-5 grid-cols-2 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Tanggal Pemeriksaan: </label>
                        <input required type="date" name="checkup_date" class="form-input w-full block rounded mt-1 p-3 border-2 @error('checkup_date') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Pemeriksaan" value="{{old('checkup_date')}}">
                        @error('checkup_date')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tinggi Badan: </label>
                        <input required type="text" name="height" class="form-input w-full block rounded mt-1 p-3 border-2 @error('height') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tinggi Badan" value="{{old('height')}}">
                        @error('height')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Berat Badan: </label>
                        <input required type="text" name="weight" class="form-input w-full block rounded mt-1 p-3 border-2 @error('weight') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Berat Badan" value="{{old('weight')}}">
                        @error('weight')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tekanan Darah: </label>
                        <input required type="text" name="blood_preasure" class="form-input w-full block rounded mt-1 p-3 border-2 @error('blood_preasure') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tekanan Darah" value="{{old('blood_preasure')}}">
                        @error('blood_preasure')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Suhu: </label>
                        <input required type="text" name="temperature" class="form-input w-full block rounded mt-1 p-3 border-2 @error('temperature') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Suhu" value="{{old('temperature')}}">
                        @error('temperature')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Keluhan: </label>
                        <input required type="text" name="complaint" class="form-input w-full block rounded mt-1 p-3 border-2 @error('complaint') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Keluhan" value="{{old('complaint')}}">
                        @error('complaint')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="grid mt-5 grid-cols-1 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Pilih Poli : </label>
                        <select id="poly" placeholder="Pilih Poli..." name="poly" class="form-input mt-1 p-2 border-2 @error('poly') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-2.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                            <option value="">Pilih Poli</option>
                            @foreach ($getPoly as $itemPoly)
                                <option value="{{$itemPoly->id}}">{{$itemPoly->name}}</option>
                            @endforeach
                        </select>
                        @error('poly')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div>
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white bg-opacity-90">
        <div class="text-bold pb-5">
            <b class="text-bold text-black">HISTORI DATA PEMERIKSAAN</b>
        </div>
        <table id="thisTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">No</th>
                    <th data-priority="2">Tanggal Pemeriksaan</th>
                    <th data-priority="3">Kode Pemeriksaan</th>
                    <th data-priority="4">Kode Diagnosa</th>
                    <th data-priority="5">Deskripsi Diagnosa</th>
                    <th data-priority="6">Keluhan</th>
                    <th data-priority="7">Tindakan</th>
                    <th data-priority="8">Poli</th>
                    <th data-priority="9">Catatan Lain</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getCheckupHistory as $item)  
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-left">{{$item->checkup_date}}</td>
                    <td class="text-left">{{$item->code_cu}}</td>
                    <td class="text-left">{{$item->code_diagnosis}}</td>
                    <td class="text-left">{{$item->description_diagnosis}}</td>
                    <td class="text-left">{{$item->complaint}}</td>
                    <td class="text-left">
                        @foreach ($getMeasureDetail as $itemDetail)
                        @if ($item->id == $itemDetail->checkup_id)
                        {{$itemDetail->name}},
                        @endif
                        @endforeach
                    </td>
                    <td class="text-left">{{$item->poly_name}}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    function selectOption(){
        $('select').selectize({
            sortField: 'text'
        });
    }
    $(document).ready(function () {
        selectOption();
    });
</script>
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