<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        *{
            font-size: 2pt;
        }
        @page{
            size: 10cm 5cm landscape;
            /* padding: 0;
            margin: 0; */
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        td{
            padding: 1px;
            padding-left: 2px;
        }
    </style>
</head>
<body>
    <div>
        <center><p>
            <h1 style="font-size: 4pt;">UPT SIM-KLINIK</h1>
            <b>Politeknik Negeri Jember</b>
            <br>
            Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
        </p></center>
        <br><br>
    </div>
    <div>
        <table border="0.2">
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
        <br>
        <span style="color: red; font-size: 2pt;">*Simpan dan bawalah selalu kartu ini jika anda berobat.</span>
    </div>
</body>
</html>