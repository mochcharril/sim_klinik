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
    <form action="{{url('/doctor/medical-resume/'.$getCheckup->id.'/detail/send')}}" method="POST">
        @csrf
        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Data Pribadi Pasien</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-3 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Nama Pasien: </label>
                            <input type="text" name="patient_name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Pasien" value="{{$getPatient->name}}" readonly>
                            @error('patient_name')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Tanggal Lahir Pasien: </label>
                            <input type="text" name="date_of_birth_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_of_birth_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Lahir Pasien" value="{{$getPatient->date_of_birth}}" readonly>
                            @error('date_of_birth_patient')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Kode RM: </label>
                            <input type="text" name="code_rm_patient" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rm_patient') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode RM" value="{{$getPatient->code_rm}}" readonly>
                            @error('code_rm_patient')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Resume Medis Pasien</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-2 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Tanggal Masuk: </label>
                            <input type="date" name="date_income" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_income') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Masuk" value="{{$getCheckup->checkup_date}}" readonly>
                            @error('date_income')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Tanggal Keluar: </label>
                            <input type="date" name="date_out" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_out') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Lahir Pasien" value="{{old('date_out')}}">
                            @error('date_out')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-5 xl:grid-cols-1 mt-3">
                        <div>
                            <label class="text-gray-700 ml-1">Alasan Masuk MRS: </label>
                            <input type="text" name="reason_mrs" class="form-input w-full block rounded mt-1 p-3 border-2 @error('reason_mrs') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Alasan Masuk MRS" value="{{old('reason_mrs')}}">
                            @error('reason_mrs')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Kelainan dan Lainnya: </label>
                            <input type="text" name="abnormality" class="form-input w-full block rounded mt-1 p-3 border-2 @error('abnormality') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kelainan dan Lainnya" value="{{old('abnormality')}}">
                            @error('abnormality')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Hasil Pemeriksaan (Lab, dll): </label>
                            <input type="text" name="result" class="form-input w-full block rounded mt-1 p-3 border-2 @error('result') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Hasil Pemeriksaan (Lab, dll)" value="{{old('result')}}">
                            @error('result')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Diagnosa</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Diagnosa Awal: </label>
                            <input type="text" name="diagnosa_first" class="form-input w-full block rounded mt-1 p-3 border-2 @error('diagnosa_first') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Diagnosa Awal" value="{{old('diagnosa_first')}}">
                            @error('diagnosa_first')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-1 mt-3">
                        <div>
                            <label class="text-gray-700 ml-1">Diagnosa Utama: </label>
                            <table class="table-auto mt-1" style="width:100%; padding-top: 1em; border-collapse: collapse; padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #999;" data-priority="1">No</th>
                                        <th style="border: 1px solid #999;" data-priority="2">Kode Diagnosa</th>
                                        <th style="border: 1px solid #999;" data-priority="3">Deskripsi Diagnosa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">1.</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$getCheckup->code_diagnosis}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$getCheckup->description_diagnosis}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Diagnosa Sekunder: </label>
                            <table class="table-auto mt-1" style="width:100%; padding-top: 1em; border-collapse: collapse; padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #999;" data-priority="1">No</th>
                                        <th style="border: 1px solid #999;" data-priority="2">Kode Diagnosa</th>
                                        <th style="border: 1px solid #999;" data-priority="3">Deskripsi Diagnosa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getOtherDiagnosis as $item)
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">{{$loop->iteration}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$item->code_diagnosis}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$item->description_diagnosis}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">1.</td>
                                        <td style="border: 1px solid #999;" class="text-center">-</td>
                                        <td style="border: 1px solid #999;" class="text-center">-</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Prosedur</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Tindakan / Prosedur: </label>
                            <table class="table-auto mt-1" style="width:100%; padding-top: 1em; border-collapse: collapse; padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #999;" data-priority="1">No</th>
                                        <th style="border: 1px solid #999;" data-priority="2">Nama Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getMeasure as $item)
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">{{$loop->iteration}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$item->name}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">1.</td>
                                        <td style="border: 1px solid #999;" class="text-center">-</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Operatif / Non Operatif: </label>
                            <input type="text" name="operatif" class="form-input w-full block rounded mt-1 p-3 border-2 @error('operatif') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Operatif / Non Operatif" value="{{old('operatif')}}">
                            @error('operatif')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Pengobatan</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-3 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Terapi Pengobatan RS (Dilit): </label>
                            <input type="text" name="dilit" class="form-input w-full block rounded mt-1 p-3 border-2 @error('dilit') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Terapi Pengobatan RS (Dilit)" value="{{old('dilit')}}">
                            @error('dilit')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Terapi Pengobatan RS (Farmakologi): </label>
                            <input type="text" name="farmakology" class="form-input w-full block rounded mt-1 p-3 border-2 @error('farmakology') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Terapi Pengobatan RS (Farmakologi)" value="{{old('farmakology')}}">
                            @error('farmakology')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Terapi Pengobatan RS (Lainnya): </label>
                            <input type="text" name="other_teraphy" class="form-input w-full block rounded mt-1 p-3 border-2 @error('other_teraphy') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Terapi Pengobatan RS (Lainnya)" value="{{old('other_teraphy')}}">
                            @error('other_teraphy')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-1 mt-3">
                        <div>
                            <label class="text-gray-700 ml-1">Obat yang Dibawa Pulang: </label>
                            <table class="table-auto mt-1" style="width:100%; padding-top: 1em; border-collapse: collapse; padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #999;" data-priority="1">No</th>
                                        <th style="border: 1px solid #999;" data-priority="2">Nama Obat</th>
                                        <th style="border: 1px solid #999;" data-priority="3">Jumlah</th>
                                        <th style="border: 1px solid #999;" data-priority="4">Aturan Pakai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getMedicine as $item)
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">{{$loop->iteration}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$item->name}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$item->qty}}</td>
                                        <td style="border: 1px solid #999;" class="text-center">{{$item->medication_rules}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td style="border: 1px solid #999;" class="text-center">1.</td>
                                        <td style="border: 1px solid #999;" class="text-center">-</td>
                                        <td style="border: 1px solid #999;" class="text-center">-</td>
                                        <td style="border: 1px solid #999;" class="text-center">-</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Konsultasi</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Konsultasi: </label>
                            <input type="text" name="consultation" class="form-input w-full block rounded mt-1 p-3 border-2 @error('consultation') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Konsultasi" value="{{old('consultation')}}">
                            @error('consultation')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="card mb-8">
                <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Instruksi / Anjuran</h1>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-3 gap-5 xl:grid-cols-1">
                        <div>
                            <label class="text-gray-700 ml-1">Kontrol Tanggal: </label>
                            <input type="date" name="date_control" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_control') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kontrol Tanggal" value="{{old('date_control')}}">
                            @error('date_control')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Tempat: </label>
                            <input type="text" name="place_control" class="form-input w-full block rounded mt-1 p-3 border-2 @error('place_control') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tempat" value="{{old('place_control')}}">
                            @error('place_control')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Jam / Pukul: </label>
                            <input type="text" name="time_control" class="form-input w-full block rounded mt-1 p-3 border-2 @error('time_control') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Jam / Pukul" value="{{old('time_control')}}">
                            @error('time_control')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5 xl:grid-cols-1 mt-3">
                        <div>
                            <label class="text-gray-700 ml-1">Nama Dokter: </label>
                            <input type="text" name="doctor_name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('doctor_name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Dokter" value="{{old('doctor_name', auth()->user()->name)}}">
                            @error('doctor_name')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Kondisi Mendesak Dibawa: </label>
                            <input type="text" name="hospital_name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('hospital_name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kondisi Mendesak Dibawa" value="{{old('hospital_name')}}">
                            @error('hospital_name')
                            <span class="pl-1 text-xs text-red-600 text-bold">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Kondisi Pasien Ketika Pulang : </label>
                            <select name="condition" class="form-input mt-1 p-3 border-2 focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                                <option value="Sembuh">Sembuh</option>
                                <option value="Pindah RS">Pindah RS</option>
                                <option value="Pulang Atas Kemauan Sendiri">Pulang Atas Kemauan Sendiri</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-gray-700 ml-1">Lanjutan Pengobatan : </label>
                            <select name="next_checkup" class="form-input mt-1 p-3 border-2 focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                                <option value="Poli">Poli</option>
                                <option value="Puskesmas">Puskesmas</option>
                                <option value="Pindah RS">Pindah RS</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="m-5">
                <button type="submit" class="btn-shadow m-auto bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('extraJS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var table = $('#thisTable').DataTable( {
                responsive: true
            } )
            .columns.adjust()
            .responsive.recalc();
    });
</script>
@endsection
