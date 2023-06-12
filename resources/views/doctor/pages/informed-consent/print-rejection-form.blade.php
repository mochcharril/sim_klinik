<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
        .isi-tabel table{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .isi-tabel table tr{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .isi-tabel table td{
            border: 1px solid black;
            border-collapse: collapse;
            height: 70px;
            padding: 8px
        }
        .isi-tabel table th{
            border: 1px solid black;
            border-collapse: collapse;
            font-weight: normal;
            text-align: left;
            padding: 5px
        }
    </style>
</head>
<body>
    {{-- kop --}}
    <table style="width: 100%; margin-top:-30px;margin-bottom:-5px;">
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

    <div style="text-transform: uppercase;width:50%; margin-bottom:20px; float:right; clear:both; padding:10px">
        <table>
            <tr>
                <td>No.RM</td>
                <td>:</td>
                <td>{{$getPatient->code_rm}}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{$getPatient->name}}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{$getPatient->gender}}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td>{{$getPatient->date_of_birth}}</td>
            </tr>
            <tr>
                <td>Poli</td>
                <td>:</td>
                <td>{{$getPoly->name}}</td>
            </tr>
        </table>
    </div>

    <div class="content" style="clear:both">
        <div class="title" style="text-align: center;">
            <h4 style="font-weight:normal">Formulir Penolakan Tindakan Kedokteran</h4>
            <h4 style="font-weight:normal">Pemberi Informasi</h4>
        </div>

        <div class="isi-tabel">
            <table style="width:100%;text-align:left;">
                <tr>
                    <th colspan="2">
                        Dokter Pelaksana
                    </th>
                    <th colspan="2">
                        {{$getUser->name}}
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        Pemberi Informasi
                    </th>
                    <th colspan="2">
                        {{$getUser->name}}
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        Penerima Informasi
                    </th>
                    <th colspan="2">
                        {{$getPatient->name}}
                    </th>
                </tr>
                <tr>
                    <th style="width: 10%" style="font-weight:bold;text-align:center">
                       No
                    </th>
                    <th style="font-weight:bold;text-align:center">
                        Jenis Informasi
                    </th>
                    <th style="font-weight:bold;text-align:center">
                        Isi Informasi
                    </th>
                    <th style="font-weight:bold;text-align:center">
                        Tanda
                    </th>
                </tr>
                <tr>
                    <td style="width: 10%">
                       1
                    </td>
                    <td>
                        Diagnosis
                    </td>
                    <td>
                        {{-- Asam Lambung --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                       2
                    </td>
                    <td>
                        Tindakan Kedokteran
                    </td>
                    <td>
                        {{-- Suntik --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                       3
                    </td>
                    <td>
                        Tujuan
                    </td>
                    <td>
                        {{-- Biar Sembuh --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                       4
                    </td>
                    <td>
                        Alternatif
                    </td>
                    <td>
                        {{-- rawat jalan --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                       5
                    </td>
                    <td>
                        Risiko
                    </td>
                    <td>
                        {{-- efek samping yang berbahaya --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                       6
                    </td>
                    <td>
                        Prognosis
                    </td>
                    <td>
                        {{-- Lorem ipsum dolor sit amet. --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                       7
                    </td>
                    <td>
                        Perkiraan Pembiayaan
                    </td>
                    <td>
                        {{-- 10 juta --}}
                    </td>
                    <td>
                        {{-- Tanda --}}
                    </td>
                </tr>



            </table>
        </div>

        <div class="pernyataan" style="page-break-before:always">
            <h4 style="text-align: center">Penolakan Tindakan Kedokteran</h4>
            <div class="biodata">
                <p>Yang bertanda tangan di bawah ini :</p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>................................................</td>
                    </tr>
                    <tr>
                        <td>Umur / Kelamin</td>
                        <td></td>
                        <td>...................... / .......................</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>................................................</td>
                    </tr>
                </table>
            </div>
            <div class="hubungan">
                <p>Dengan ini menyatakan penolakan untuk dilakukan tindakan terhadap diri saya/istri/suami/anak/ayah/ibu dengan</p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$getPatient->name}}</td>
                    </tr>
                    <tr>
                        <td>Umur / Kelamin</td>
                        <td>:</td>
                        <td>{{ date_diff(date_create($getPatient->date_of_birth), date_create('now'))->y }} Tahun / {{$getPatient->gender}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$getPatient->address}}</td>
                    </tr>
                </table>
                <p>Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti di atas kepada saya, termasuk risiko dan komplikasi yang mungkin timbul.</p>
                <p>Demikian pernyataan persetujuan ini saya buat dengan penuh kesadaran dan tanpa paksaan.</p>
            </div>
        </div>

        <div class="ttd">
            <table style="width:100% ">
                <tr>
                    <th style="">
                        <div class="lembar" style="font-weight:normal">
                            <p style="font-weight:bold;">Saksi</p>
                            <p style="margin-top: 60px; margin-bottom:-10px">(.....................)</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                    <th style="">
                        <div class="lembar" style="font-weight:normal;margin-left:70px">
                            <p style="font-weight:bold;">Dokter</p>
                            <p style="margin-top: 60px; margin-bottom:-10px">{{$getUser->name}}</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                    <th>
                        <div class="lembar" style="font-weight:normal">
                            <div style="font-weight:bold;margin-top:-10px">
                                <p>Jember, {{ \Carbon\Carbon::parse($getCheckup->checkup_date)->format('d F Y') }}</p>
                                <p style="margin-top:-20px">Yang membuat pernyataan</p>
                            </div>
                            <p style="margin-top: 57px;margin-bottom:-10px">{{$getPatient->name}}</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
