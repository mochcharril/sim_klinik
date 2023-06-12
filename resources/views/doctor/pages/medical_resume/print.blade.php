<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
        body{
            font-family:"sans-serif";
        }
        .date table{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .date table tr{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .date table th{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .ttd table{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .ttd table tr{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .ttd table th{
            border: 1px solid black;
            border-collapse: collapse;
        }
        span{
            font-weight: bold
        }
        li{
            font-weight: normal
        }
        .content{
            margin-left: 5px
        }
    </style>
</head>
<body>
    {{-- kop --}}
    <table style="width: 100%; margin-top:-30px;margin-bottom:-5px;">
        <tr>
             <th>
                <img src="{{public_path('assets/logos/logo_jember.png')}}" style="width: 3.m; height:3.3cm" alt="">
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
             </th>
        </tr>
    </table>
    <hr style="background-color:black; border:none; height:2px;">
    {{-- end kop --}}

    <div style="text-transform: uppercase; border: 2px solid black; border-radius:8px; width:50%; margin-bottom:20px; float:right; clear:both; padding:5px">
        <table>
            <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td>{{$getPatient->name}}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($getPatient->date_of_birth)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td>No RM</td>
                <td>:</td>
                <td>{{$getPatient->code_rm}}</td>
            </tr>
        </table>
    </div>

    {{-- content --}}
    <div style="border: 1px solid black; clear:both; ">
        <div class="title" style="text-transform:uppercase; font-family:sans-serif; text-align:center; height:8px">
            <h3>Resume Medis Pasien</h3>
        </div>

        <div class="date">
            <table class="fixed">
                <tr>
                    <th>
                        Tanggal Masuk : {{$getCheckup->checkup_date}}
                    </th>
                    <th>
                        Tanggal Keluar : {{$getResume->date_out}}
                    </th>
                </tr>
                <tr>
                    <th style="text-align:left">
                        <ol type="a">
                            <li>
                                Alasan MRS
                                <p style="font-size: 10pt;">{{$getResume->reason_mrs}}</p>
                            </li>
                            <li>
                                Kelainan yang ditemukan pada fisik pada pemeriksaan dan lainnya
                                <p style="font-size: 10pt;">{{$getResume->abnormality}}</p>
                            </li>
                        </ol>
                    </th>
                    <th style="text-align:left">
                        <ol type="a">
                            <li>
                                Hasil pemeriksaan penunjang (Lab, Radiodiagnostik, PA, Microbiologi, dll)
                                <p style="font-size: 10pt;">{{$getResume->result}}</p>
                            </li>
                        </ol>
                    </th>
                </tr>
            </table>
        </div>

        <span class="content">Diagnosa awal/kerja : {{$getResume->diagnosa_first}}</span>
        <hr style="background-color:black; border:none; height:1px;">
        <div class="content">
            <div class="diagnosa">
                <span>Diagnosa keluar/akhir : </span>
                <table>
                    <tr>
                        <td>Diagnosa Utama</td>
                        <td>:</td>
                        <td style="padding-left: 20px; padding-right: 20px;">{{$getCheckup->code_diagnosis}} - {{$getCheckup->description_diagnosis}}</td>
                        <td>ICD X : 1</td>
                    </tr>
                    @foreach ($getOtherDiagnosis as $item)
                    <tr>
                        <td>{{$loop->first ? 'Diagnosa Sekunder' : '' }}</td>
                        <td>{{$loop->first ? ':' : '' }}</td>
                        <td style="padding-left: 20px; padding-right: 20px;">{{$item->code_diagnosis}} - {{$item->description_diagnosis}}</td>
                        <td>ICD X : {{$loop->iteration+1}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <hr style="background-color:black; border:none; height:1px;">
        <div class="content">
            <table>
                <tr>
                    <td>Operatif / Non Operatif</td>
                    <td>:</td>
                    <td style="padding-left: 20px; padding-right: 20px;">{{$getResume->operatif}}</td>
                    <td>ICD X CM : 1</td>
                </tr>
                @foreach ($getMeasure as $item)
                <tr>
                    <td>{{$loop->first ? 'Tindakan / Prosedur' : '' }}</td>
                    <td>{{$loop->first ? ':' : '' }}</td>
                    <td style="padding-left: 20px; padding-right: 20px;">{{$item->name}}</td>
                    <td>ICD X CM : {{$loop->iteration+1}}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <hr style="background-color:black; border:none; height:1px;">
        <div class="content">
            <table>
                <tr>
                    <td rowspan="4" style="width: 200px;">Terapi pengobatan selama di rumah sakit</td>
                    <td rowspan="4" style="width: 10px;">:</td>
                </tr>
                <tr>
                    <td>1. Dilit</td>
                    <td style="width: 20px; text-align: center;">:</td>
                    <td>{{$getResume->dilit}}</td>
                </tr>
                <tr>
                    <td>2. Farmakologi</td>
                    <td style="width: 20px; text-align: center;">:</td>
                    <td>{{$getResume->farmakology}}</td>
                </tr>
                <tr>
                    <td>3. Terapi Lain</td>
                    <td style="width: 20px; text-align: center;">:</td>
                    <td>{{$getResume->other_teraphy}}</td>
                </tr>
            </table>
            <table>
                @foreach ($getMedicine as $item)
                <tr>
                    <td>{{$loop->first ? 'Obat yang dibawa pulang' : '' }}</td>
                    <td style="width: 20px; text-align: center;">{{$loop->first ? ':' : '' }}</td>
                    <td style="padding-left: 20px; padding-right: 20px;">{{$item->name}}</td>
                </tr>
                @endforeach
            </table>
        </div>

        <hr style="background-color:black; border:none; height:1px;">
        <div class="content">
            <span>Konsultasi : {{$getResume->consultation}}</span>

            <hr style="background-color:black; border:none; height:1px;">
            <table style="font-weight: bold; font-size: 10pt;">
                <tr>
                    <td>Intruksi/Anjuran(follow up)</td>
                    <td>:</td>
                    <td>Kontrol Tanggal</td>
                    <td>:</td>
                    <td>{{$getResume->date_control}}</td>
                    <td style="text-align: right;">Pukul</td>
                    <td>:</td>
                    <td>{{$getResume->time_control}}</td>
                    <td style="padding-left: 25px;">Tempat</td>
                    <td>:</td>
                    <td>{{$getResume->place_control}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Nama Dokter</td>
                    <td>:</td>
                    <td colspan="6">{{$getResume->doctor_name}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="4">Apabila kondisi mendesak / darurat di bawa ke</td>
                    <td>:</td>
                    <td colspan="2">{{$getResume->hospital_name}}</td>
                </tr>
            </table>
        </div>

        <hr style="background-color:black; border:none; height:1px;">
        <div class="content">
            <table>
                <tr>
                    <td style="font-weight: bold">Kondisi pasien waktu pulang</td>
                    <td style="font-weight: bold">:</td>
                    <td>
                        <input type="checkbox" id="Sembuh" name="Sembuh" {{$getResume->condition == 'Sembuh' ? 'checked' : ''}} value="Sembuh">
                        <label for="Sembuh" style="margin-bottom:-5px">Sembuh</label>
                    </td>
                    <td>
                        <input type="checkbox" id="Pindah RS" name="Pindah RS" {{$getResume->condition == 'Pindah RS' ? 'checked' : ''}} value="Pindah RS">
                        <label for="Pindah RS" style="margin-bottom:-5px">Pindah RS</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="checkbox" id="Pulang Atas Kemauan Sendiri" name="Pulang Atas Kemauan Sendiri" {{$getResume->condition == 'Pulang Atas Kemauan Sendiri' ? 'checked' : ''}} value="Pulang Atas Kemauan Sendiri">
                        <label for="Pulang Atas Kemauan Sendiri" style="margin-bottom:-5px">Pulang Atas Kemauan Sendiri</label>
                    </td>
                    <td>
                        <input type="checkbox" id="Lain-lain" name="Lain-lain" {{$getResume->condition == 'Lain-lain' ? 'checked' : ''}} value="Lain-lain">
                        <label for="Lain-lain" style="margin-bottom:-5px">Lain-lain</label>
                    </td>
                </tr>
            </table>
        </div>
        <hr style="background-color:black; border:none; height:1px;">
        <div class="content">
            <table>
                <tr>
                    <td style="font-weight: bold">Lanjutan Pengobatan</td>
                    <td style="font-weight: bold">:</td>
                    <td>
                        <input type="checkbox" id="Poli" name="Poli" {{$getResume->next_checkup == 'Poli' ? 'checked' : ''}} value="Poli">
                        <label for="Poli" style="margin-bottom:-5px">Poli</label>
                    </td>
                    <td>
                        <input type="checkbox" id="Puskesmas" name="Puskesmas" {{$getResume->next_checkup == 'Puskesmas' ? 'checked' : ''}} value="Puskesmas">
                        <label for="Puskesmas" style="margin-bottom:-5px">Puskesmas</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="checkbox" id="Pindah RS" name="Pindah RS" {{$getResume->next_checkup == 'Pindah RS' ? 'checked' : ''}} value="Pindah RS">
                        <label for="Pindah RS" style="margin-bottom:-5px">Pindah RS</label>
                    </td>
                    <td>
                        <input type="checkbox" id="Lain-lain" name="Lain-lain" {{$getResume->next_checkup == 'Lain-lain' ? 'checked' : ''}} value="Lain-lain">
                        <label for="Lain-lain" style="margin-bottom:-5px">Lain-lain</label>
                    </td>
                </tr>
            </table>
        </div>
        <div class="ttd">
            <table style="width:100% ">
                <tr>
                    <th style="width: 50%">
                        <div class="lembar" style="font-weight:normal">
                            <p style="font-weight:bold;">TTD Pasien/Keluarga</p>
                            <p style="margin-top: 60px; margin-bottom:-20px">({{$getPatient->name}})</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                    <th>
                        <div class="lembar" style="font-weight:normal">
                            <div style="font-weight:bold;margin-top:-10px">
                                <p>Jember, {{ \Carbon\Carbon::parse($getPatient->date_out)->format('d F Y') }}</p>
                                <p style="margin-top:-20px">Dokter Penanggung Jawab Pelayanan</p>
                            </div>
                            <p style="margin-top: 57px;margin-bottom:-20px">({{$getResume->doctor_name}})</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                </tr>
            </table>
        </div>
    </div>
    {{-- end content --}}

</body>
</html>
