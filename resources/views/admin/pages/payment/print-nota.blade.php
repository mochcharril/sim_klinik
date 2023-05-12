<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    @php
        $subTotal = 0;
        $number = 1;
    @endphp
    <table style="width: 100%; margin-top:-50px;margin-bottom:-28px">
        <tr>
            <th>
                <img src="{{public_path('assets/logos/logo_jember.png')}}" style="width: 2.7cm; height:2.9cm" alt="">
            </th>
            <th>
                <div style="font-weight:normal">
                    <center><p>
                        <h1 style="margin-top:-3px;margin-bottom:-3px;font-weight:normal">UPT SIM-KLINIK</h1>
                        <b style="text-transform:uppercase;letter-spacing: 2px;">Politeknik Negeri Jember</b>
                        <br>
                        Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
                    </p></center>
                    <br><br>
                </div>
            </th>
            <th>
                <img src="{{public_path('assets/logos/logo_polije.png')}}" style="width: 2.9cm; height:3.1cm;" alt="">
            </th>
        </tr>
    </table>
    <hr style="background-color:black; border:none; height:2px;">
    <div>
        <center>
            <h2>Data Pembayaran Pemeriksaan Pasien</h2>
        </center>
    </div>
    <div>
    </div>
    <br>
    <div>
        <table border="1" style="width: 100%">
            <tr>
                <td colspan="2"><center><h3>Data Pembayaran</h3></center></td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Kode Pembayaran</b></td>
                <td style="width: 70%;">{{$getDetailPayment->code_py}}</td>
            </tr>
            <tr>
                <td style="width: 30%;"><b>Tanggal Pembayaran</b></td>
                <td style="width: 70%;">{{$getDetailPayment->date_payment}}</td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table border="1" style="width: 100%;">
            <tr>
                <td colspan="5"><center><h3>Resep Obat dan Tindakan Yang Diberikan</h3></center></td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama Jasa (Tindakan / Obat)</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
            @foreach ($getDetailMeasure as $itemMeasure)
            @php
                $subTotal+=(int)$itemMeasure->price;
            @endphp
            <tr>
                <td><center>{{$number++}}</center></td>
                <td>{{$itemMeasure->name}}</td>
                <td>@currency($itemMeasure->price)</td>
                <td><center>1</center></td>
                <td>@currency($itemMeasure->price)</td>
            </tr>
            @endforeach
            @foreach ($getDetailRecipe as $itemRecipe)
            @php
                $subTotal+=(int)$itemRecipe->total;
            @endphp
            <tr>
                <td><center>{{$number++}}</center></td>
                <td>{{$itemRecipe->name}}</td>
                <td>@currency($itemRecipe->price)</td>
                <td><center>{{$itemRecipe->qty}}</center></td>
                <td>@currency($itemRecipe->total)</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"><b><center>Sub Total</center></b></td>
                <td colspan="1"><b>@currency($subTotal)</b></td>
            </tr>
        </table>
    </div>
</body>
</html>
