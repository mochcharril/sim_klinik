<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <table style="width: 100%; margin-top:-30px;margin-bottom:-5px">
        <tr>
            <th>
                <img src="{{public_path('assets/logos/logo_jember.png')}}" style="width: 3cm; height:3.3cm" alt="">
            </th>
            <th>
                <div style="font-weight:normal">
                     <center><p>
                        <br  style="text-transform:uppercase;letter-spacing: 1px; font-size: 1.2rem;">KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN
                        <br> <b style="text-transform:uppercase;letter-spacing: 1px; font-size: 1.2rem;">POLITEKNIK NEGERI JEMBER</b>
                        <br> <b style="text-transform:uppercase;letter-spacing: 1px; font-size: 1.2rem;"> UNIT POLIKLINIK </b>

                    <br> Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121 
                    </p></center>
                    <br><br>
                </div>
            </th>
            <th>
                <img src="{{public_path('assets/logos/logo_polije.png')}}" style="width: 3cm; height:3cm;" alt="">
            </th>
        </tr>
    </table>
    <hr style="background-color:black; border:none; height:2px;">
    <div>
        <center>
            <h2>Data Rekam Medis Pasien</h2>
        </center>
    </div>
    <div>
        <table border="1" style="width: 100%;">
            <tr>
                <td colspan="2"><center><h3>Data Pasien</h3></center></td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Kode RM</b></td>
                <td style="width: 70%;">{{$getDetailPatient->code_rm}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Nama</b></td>
                <td style="width: 70%;">{{$getDetailPatient->name}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>NIK</b></td>
                <td style="width: 70%;">{{$getDetailPatient->nik}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Jenis Kelamin</b></td>
                <td style="width: 70%;">{{$getDetailPatient->gender}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Tempat, Tanggal Lahir</b></td>
                <td style="width: 70%;">{{$getDetailPatient->place_of_birth}}, {{$getDetailPatient->date_of_birth}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Alamat</b></td>
                <td style="width: 70%;">{{$getDetailPatient->address}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Nomor Telepon</b></td>
                <td style="width: 70%;">{{$getDetailPatient->phone_number}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Jenis Asuransi</b></td>
                <td style="width: 70%;">{{$getDetailPatient->insurance_type}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Nomor Asuransi</b></td>
                <td style="width: 70%;">{{$getDetailPatient->insurance_number}}</td>
            </tr>
        </table>
    </div>
    @foreach ($getCheckup as $itemCheckup)
    <p style="page-break-after: always;">&nbsp;</p>
    <br>
    @php
        $subTotal = 0;
    @endphp
    <div>
        <table border="1" style="width: 100%;">
            <tr>
                <td colspan="2"><center><h3>Pemeriksaan - {{$itemCheckup->code_cu}}</h3></center></td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Kode Pemeriksaan</b></td>
                <td style="width: 70%;">{{$itemCheckup->code_cu}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Tanggal Pemeriksaan</b></td>
                <td style="width: 70%;">{{$itemCheckup->checkup_date}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Pemeriksa</b></td>
                <td style="width: 70%;">{{$itemCheckup->doctor_nurse_name}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Keluhan</b></td>
                <td style="width: 70%;">{{$itemCheckup->complaint}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Tinggi Badan</b></td>
                <td style="width: 70%;">{{$itemCheckup->height}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Berat Badan</b></td>
                <td style="width: 70%;">{{$itemCheckup->weight}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Tekanan Darah</b></td>
                <td style="width: 70%;">{{$itemCheckup->blood_preasure}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Alergi</b></td>
                <td style="width: 70%;">{{$itemCheckup->allergy}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Kode Diagnosa</b></td>
                <td style="width: 70%;">{{$itemCheckup->code_diagnosis}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Kode Diagnosa</b></td>
                <td style="width: 70%;">{{$itemCheckup->description_diagnosis}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Tindakan</b></td>
                <td style="width: 70%;">@foreach($getMeasure as $itemDetail)@if($itemCheckup->id == $itemDetail->checkup_id){{$itemDetail->name}},@endif @endforeach</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Poli</b></td>
                <td style="width: 70%;">{{$itemCheckup->poly_name}}</td>
            </tr>
            <tr>
                <td colspan="2"><center><h4>Detail Resep Obat</h4></center></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table border="0,1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Resep</th>
                                <th>Tanggal Resep</th>
                                <th>Dokter</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                                <th>Aturan Pemakaian</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getDetailRecipe as $item)
                            @if ($itemCheckup->id == $item->checkup_id)
                            @php
                                $subTotal+=(int)$item->total;
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->code_rp}}</td>
                                <td>{{$item->date_recipe}}</td>
                                <td>{{$item->doctor_name}}</td>
                                <td>{{$item->medicine_name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->medication_rules}}</td>
                                <td>@currency($item->total)</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6"><center><b>Sub Total</b></center></td>
                                <td colspan="2"><center><b>@currency($subTotal)</b></center></td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    @endforeach
</body>
</html>
