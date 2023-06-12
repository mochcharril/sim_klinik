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
            font-size: 10pt;
        }
        @page{
            size: 21cm 29cm;
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

    <div class="content">
        <h3 style="text-decoration: underline;text-align:center">SURAT PERSETUJUAN TINDAKAN MEDIS</h3>

        <div class="biodata">
            <p>Saya, yang bertanda tangan di bawah ini :</p>
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
                <tr>
                    <td>Bukti diri / KTP</td>
                    <td>:</td>
                    <td>{{$getPatient->nik}}</td>
                </tr>
            </table>
        </div>

        <div class="persetujuan">
            <p>Menyatakan dengan sesungguhnya memberikan <b>PERSETUJUAN</b> untuk dilakukan tindakan medis berupa 
                <i style="text-decoration: underline">
                    @foreach ($getMeasureDetail as $item)
                        {{$item->name}} {{!$loop->last ? ',' : ''}}
                    @endforeach
                </i> terhadap diri saya sendiri, yang tujuan, sifat dan perlunya tindakan medis tersebut di atas, serta resiko yang dapat ditimbulkannya telah cukup dijelaskan oleh Dokter / Petugas Poliklinik dan telah saya mengerti sepenuhnya.</p>

            <p>Demikian pernyataan ini saya buat dengan penuh kesadaran dan tanpa ada paksaan.</p>
        </div>

        <div class="ttd">
            <table style="width:100% ">
                <tr>
                    <th style="width: 50%">
                        <div class="lembar" style="font-weight:normal">
                            <p style="font-weight:bold;">TTD Pasien/Keluarga</p>
                            <p style="margin-top: 60px; margin-bottom:-10px">{{$getPatient->name}}</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                    <th>
                        <div class="lembar" style="font-weight:normal">
                            <div style="font-weight:bold;margin-top:-10px">
                                <p>Jember, {{ \Carbon\Carbon::parse($getCheckup->checkup_date)->format('d F Y') }}</p>
                                <p style="margin-top:-10px">Dokter Penanggung Jawab Pelayanan</p>
                            </div>
                            <p style="margin-top: 57px;margin-bottom:-10px">{{$getUser->name}}</p>
                            <p>Nama Terang</p>
                        </div>
                    </th>
                </tr>
            </table>
        </div>

        <div class="note" style="font-style:italic; font-weight:bold">
            <p>** Isi Dengan tindakan medis yang akan dilakukan</p>
            <p style="margin-top: -15px">* Coret yang tidak perlu</p>
        </div>
    </div>

</body>
</html>
