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
            <h2>Laporan Data Obat</h2>
        </center>
    </div>
    <div>
        <table border="1" style="width: 100%;">
            <thead>
                <tr>
                    <th style="padding: 2px;">No</th>
                    <th style="padding: 2px;">Kode MD</th>
                    <th style="padding: 2px;">Nama Obat</th>
                    <th style="padding: 2px;">Harga</th>
                    <th style="padding: 2px;">Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getMedicine as $item)
                <tr>
                    <td style="padding: 2px;"><center>{{$loop->iteration}}</center></td>
                    <td style="padding: 2px;">{{$item->code_md}}</td>
                    <td style="padding: 2px;">{{$item->name}}</td>
                    <td style="padding: 2px;">@currency($item->price)</td>
                    <td style="padding: 2px;">{{$item->stock}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
</body>
</html>
