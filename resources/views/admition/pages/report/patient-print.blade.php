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
            <h2>Data Laporan Data Pasien</h2>
        </center>
    </div>
    <div>
        <table border="1" style="width: 100%;">
            <thead>
                <tr>
                    <th style="padding: 2px;">No</th>
                    <th style="padding: 2px;">Kode RM</th>
                    <th style="padding: 2px;">Nama</th>
                    <th style="padding: 2px;">NIK</th>
                    <th style="padding: 2px;">Jenis Kelamin</th>
                    <th style="padding: 2px;">Tempat, Tanggal Lahir</th>
                    <th style="padding: 2px;">Alamat</th>
                    <th style="padding: 2px;">No Telepon</th>
                    <th style="padding: 2px;">Jenis Asuransi</th>
                    <th style="padding: 2px;"">No Asuransi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getPatient as $item)  
                <tr>
                    <td style="padding: 2px;"><center>{{$loop->iteration}}</center></td>
                    <td style="padding: 2px;">{{$item->code_rm}}</td>
                    <td style="padding: 2px;">{{$item->name}}</td>
                    <td style="padding: 2px;">{{$item->nik}}</td>
                    <td style="padding: 2px;">{{$item->gender}}</td>
                    <td style="padding: 2px;">{{$item->place_of_birth}}, {{$item->date_of_birth}}</td>
                    <td style="padding: 2px;">{{$item->address}}</td>
                    <td style="padding: 2px;">{{$item->phone_number}}</td>
                    <td style="padding: 2px;">{{$item->insurance_type}}</td>
                    <td style="padding: 2px;">{{$item->insurance_number}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
</body>
</html>