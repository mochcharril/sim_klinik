<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-size: 6px;
        }
        @page{
            size: 8.5cm 5.5cm landscape;
            padding: 2;
            margin: 2;
        }
        .container{
            justify-content: center;
            align-items: center;
        }

    </style>
</head>
<body>
    <div class="container"">
        <table style="width: 100%;">
            <tr>
                <th>
                    <img src="{{public_path('assets/logos/logo_jember.png')}}" style="width: 1.2cm; height:1.2cm;" alt="">
                </th>
                <th>
                    <div style="width:5cm; margin-left:10px">
                        <h3 >PEMERITAH KABUPATEN JEMBER</h3>
                        <h2 style="font-size:8px; align-items:center; margin-bottom:-4px; margin-top:-5px">POLIKLINIK POLITEKNIK NEGERI JEMBER</h2>
                        <p style="font-weight:normal">
                        Jl. Mastrip, Ligkungan Panji, Tegalgede, Kec. Sumbersari, <br>Kabupaten Jember, Jawa Timur 68121
                        </p>
                    </div>
                </th>
                <th>
                    <img src="{{public_path('assets/logos/logo_polije.png')}}" style="width: 1.2cm; height:1.2cm;" alt="">
                </th>
            </tr>
          </table>
    </div>
    <p style="text-align:center;font-size:12px;margin-top:-5px;color: yellow;-webkit-text-stroke: 1px black; font-weight:bold">KARTU KUNJUNGAN / PERIKSA / BEROBAT</p>
    <div style="margin-left: 50px; margin-top:-13px;">
        <p style="font-size:7px">Nama Pasien : {{$getDetailPatient->name}}</p>
        <p style="font-size:7px">No RM : {{$getDetailPatient->code_rm}}</p>
        <p style="font-size:7px">Tanggal Lahir : {{$getDetailPatient->place_of_birth}}, {{$getDetailPatient->date_of_birth}}</p>
        <p style="font-size:7px">Jenis Kelamin : {{$getDetailPatient->gender}}</p>
        <p style="font-size:7px">Alamat : {{$getDetailPatient->address}}</p>
        <p style="font-size:7px">Jenis Asuransi : {{$getDetailPatient->insurance_type}}</p>
        <p style="font-size:7px">Nomer Asuransi : {{$getDetailPatient->insurance_number}}</p>

        <br>
        <span style="color: blue; font-size: 6px; margin-left:2.4cm; font-weight:bold">PERHATIAN : KARTU INI WAJIB DIBAWA BILA BEROBAT</span>
    </div>
</body>
</html>
