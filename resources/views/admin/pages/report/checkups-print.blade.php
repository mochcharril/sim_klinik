<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <center><p>
            <h1>UPT SIM-KLINIK</h1>
            <b>Politeknik Negeri Jember</b>
            <br>
            Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
        </p></center>
        <br><br>
    </div>
    <hr>
    <div>
        <center>
            <h2>Laporan Data Pemeriksaan</h2>
        </center>
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
                    <th style="padding: 2px;">Diagnosa</th>
                    <th style="padding: 2px;">Tindakan</th>
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
                    <td style="padding: 2px;">{{$item->diagnosis}}</td>
                    <td style="padding: 2px;">
                        @foreach ($getMeasureDetail as $itemDetail)
                            @if ($item->id == $itemDetail->checkup_id)
                            {{$itemDetail->name}},
                            @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
</body>
</html>