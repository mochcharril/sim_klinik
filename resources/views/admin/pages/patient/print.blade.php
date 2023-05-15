<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <style type="text/css">
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
        body{
            font-family:sans-serif;
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
        <hr style="background-color:black; border:none; height:1px;">

    </div>
    <p style="text-align:center;font-size:10px;margin-top:5px;color: blue;-webkit-text-stroke: 1px black; font-weight:bold">KARTU KUNJUNGAN / PERIKSA / BEROBAT</p>
    <div style="margin-left: 20px; margin-top:-13px;">
        <p style="font-size:7px;">Nama Pasien&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  {{$getDetailPatient->name}}</p>
        <p style="font-size:7px">No RM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$getDetailPatient->code_rm}}</p>
        <p style="font-size:7px">Tanggal Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$getDetailPatient->place_of_birth}}, {{$getDetailPatient->date_of_birth}}</p>
        <p style="font-size:7px">Jenis Kelamin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$getDetailPatient->gender}}</p>
        <p style="font-size:7px">Alamat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$getDetailPatient->address}}</p>
        <p style="font-size:7px">Jenis Asuransi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$getDetailPatient->insurance_type}}</p>
        <p style="font-size:7px">Nomer Asuransi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$getDetailPatient->insurance_number}}</p>

        <br>
        <p style="color: red; font-size: 6px; float:right;margin-top:-7px;margin-right:5px; font-weight:bold">PERHATIAN : KARTU INI WAJIB DIBAWA BILA BEROBAT</p>
    </div>
</body>
</html>
