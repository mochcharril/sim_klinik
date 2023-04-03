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
            <h2>Laporan Data Obat Masuk</h2>
        </center>
    </div>
    <div>
        <table border="1" style="width: 100%;">
            <thead>
                <tr>
                    <th style="padding: 2px;">No</th>
                    <th style="padding: 2px;">Kode IM</th>
                    <th style="padding: 2px;">Apoteker</th>
                    <th style="padding: 2px;">Tanggal Obat Masuk</th>
                    <th style="padding: 2px;">Nama Obat</th>
                    <th style="padding: 2px;">Stok Masuk</th>
                    <th style="padding: 2px;">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getMedicineIncoming as $item)  
                <tr>
                    <td style="padding: 2px;"><center>{{$loop->iteration}}</center></td>
                    <td style="padding: 2px;">{{$item->code_im}}</td>
                    <td style="padding: 2px;">{{$item->pharmacist}}</td>
                    <td style="padding: 2px;">{{$item->date_income_medicine}}</td>
                    <td style="padding: 2px;">{{$item->name}}</td>
                    <td style="padding: 2px;">{{$item->stock_in}}</td>
                    <td style="padding: 2px;">@currency($item->total)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
</body>
</html>