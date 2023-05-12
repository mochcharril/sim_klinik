<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table style="width: 100%; margin-top:-30px;margin-bottom:-5px">
        <tr>
            <th>
                <img src="{{public_path('assets/logos/logo_jember.png')}}" style="width: 3.4cm; height:3.7cm" alt="">
            </th>
            <th>
                <div style="font-weight:normal">
                    <center><p>
                        <h1 style="margin-top:-3px;margin-bottom:-2px;">UPT SIM-KLINIK</h1>
                        <b style="text-transform:uppercase;letter-spacing: 2px;">Politeknik Negeri Jember</b>
                        <br>
                        Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
                    </p></center>
                    <br><br>
                </div>
            </th>
            <th>
                <img src="{{public_path('assets/logos/logo_polije.png')}}" style="width: 3.8cm; height:3.8cm;" alt="">
            </th>
        </tr>
    </table>
    <hr style="background-color:black; border:none; height:2px;">
    <div>
        <center>
            <h2>Laporan Data Pemeriksaan</h2>
        </center>
        <p>
            Tanggal : <b>{{$start_date}}</b> sampai <b>{{$end_date}}</b>
            <br>
            Total Pemeriksaan : <b>{{$countData}} Pemeriksaan</b>
        </p>
    </div>
    <div>
        <table border="1" style="width: 100%;">
            <thead>
                <tr>
                    <th style="padding: 2px;">No</th>
                    <th style="padding: 2px;">Tanggal Pemeriksaan</th>
                    <th style="padding: 2px;">Kode RM</th>
                    <th style="padding: 2px;">Kode Pemeriksaan</th>
                    <th style="padding: 2px;">Nama Pasien</th>
                    <th style="padding: 2px;">Keluhan</th>
                    <th style="padding: 2px;">Kode Diagnosa</th>
                    <th style="padding: 2px;">Deskripsi Diagnosa</th>
                    <th style="padding: 2px;">Tindakan</th>
                    <th style="padding: 2px;">Catatan Lain</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getCheckup as $item)
                <tr>
                    <td style="padding: 2px;">{{$loop->iteration}}</td>
                    <td style="padding: 2px;">{{$item->checkup_date}}</td>
                    <td style="padding: 2px;">{{$item->code_rm}}</td>
                    <td style="padding: 2px;">{{$item->code_cu}}</td>
                    <td style="padding: 2px;">{{$item->patient_name}}</td>
                    <td style="padding: 2px;">{{$item->complaint}}</td>
                    <td style="padding: 2px;">{{$item->code_diagnosis}}</td>
                    <td style="padding: 2px;">{{$item->description_diagnosis}}</td>
                    <td style="padding: 2px;">
                        @foreach ($getMeasureDetail as $itemDetail)
                            @if ($item->id == $itemDetail->checkup_id)
                            {{$itemDetail->name}},
                            @endif
                        @endforeach
                    </td>
                    <td style="padding: 2px;">{{$item->other_notes}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
</body>
</html>
