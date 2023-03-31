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