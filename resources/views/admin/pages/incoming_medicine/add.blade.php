@extends('admin.layouts.app')
@section('extraCSS')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
@endsection
@section('content')
<form method="POST" action="{{url('/admin/warehouse/incoming_medicine/store')}}" enctype="multipart/form-data">
@csrf
    <div>
        <div class="card mb-8">
            <div class="card-header flex flex-row justify-between">
                <h1 class="h6">Tambah Data Obat Masuk</h1>
            </div>
            <div class="card-body">
                <div>
                    <label class="text-gray-700 ml-1">Kode Transaksi Obat Masuk: </label>
                    <input id="code_im" type="text" name="code_im" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_im') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode Transaksi Obat Masuk" value="{{$getCodeIM}}" >
                    @error('code_im')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Tanggal Obat Masuk: </label>
                    <input id="date_income_medicine" type="date" name="date_income_medicine" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_income_medicine') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Nama Obat" value="{{old('date_income_medicine')}}">
                    @error('date_income_medicine')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-5 flex justify-between">
                    <button type="button" class="btn-shadow bg-green-500 text-white rounded px-10 py-2 mt-2 hover:bg-green-600" onclick="panel_fields()">Tambah</button>
                    <button type="submit" class="btn-shadow bg-cyan-500 text-white rounded px-10 py-2 mt-2 hover:bg-cyan-600">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div id="panel_fields"></div>
    <div>
        <div class="card mb-8">
            <div class="card-body">
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Pilih Obat : </label>
                    <select onchange="openMedicine(this, 1);" id="medicine" placeholder="Pilih Obat..." name="medicine[]" class="form-input mt-1 p-3 border-2 @error('medicine[]') border-red-500 @enderror focus:outline-none focus:border-green-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                        <option value="">Pilih Obat</option>
                        @foreach ($getMedicine as $itemMedicine)
                            <option value="{{$itemMedicine->id}}">{{$itemMedicine->name}}</option>
                        @endforeach
                    </select>
                    @error('medicine[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Harga: </label>
                    <input id="price-1" type="text" name="price[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('price[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Harga">
                    @error('price[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Stok Sisa: </label>
                    <input id="stock-1" type="text" name="stock[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Sisa">
                    @error('stock[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Stok Masuk: </label>
                    <input id="stock_in-1" type="text" name="stock_in[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock_in[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Masuk">
                    @error('stock_in[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Tanggal Kadaluarsa Baru: </label>
                    <input id="expired_date-1" type="date" name="expired_date[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('expired_date[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tanggal Kadaluarsa Baru">
                    @error('expired_date[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('extraJS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
    function selectOption(){
        $('select').selectize({
            sortField: 'text'
        });
    }
    $(document).ready(function () {
        selectOption();
    });
    function openMedicine(that, number) {
        console.log(that);
        $.ajax({
            url: '/getMedicine/'+that.value,
            type: 'GET',
            dataType: 'JSON',
            success: function(res){
                // console.log(res)
            document.getElementById("price-"+number).value = res.price;
            document.getElementById("stock-"+number).value = res.stock;
            }
        })
    }
</script>
<script>
    var room = 1;
    function panel_fields(){
        room++;
        var objTo = document.getElementById('panel_fields');
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+room);
        var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="card mb-8"><div class="card-body"><div class="mt-3"><label class="text-gray-700 ml-1">Pilih Obat :</label><select onchange="openMedicine(this, '+room+')" id="medicine" placeholder="Pilih Obat..." name="medicine[]" class="form-input mt-1 p-3 border-2 @error('medicine[]') border-red-500 @enderror focus:outline-none focus:border-green-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0"><option value="">Pilih Obat</option>@foreach ($getMedicine as $itemMedicine)<option value="{{$itemMedicine->id}}">{{$itemMedicine->name}}</option>@endforeach</select>@error('medicine[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Harga:</label><input id="price-'+room+'" type="text" name="price[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('price[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Harga"> @error('price[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Stok Sisa:</label><input id="stock-'+room+'" type="text" name="stock[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Sisa"> @error('stock[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Stok Masuk:</label><input id="stock_in-'+room+'" type="text" name="stock_in[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock_in[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Masuk"> @error('stock_in[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Tanggal Kadaluarsa Baru:</label><input id="expired_date-'+room+'" type="date" name="expired_date[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('expired_date[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tanggal Kadaluarsa Baru"> @error('expired_date[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-5 flex flex-row-reverse"><button type="button" class="btn-shadow bg-red-500 text-white rounded px-10 py-2 mt-2 hover:bg-red-600" onclick="remove_panel_fields('+room+')">Hapus</button></div></div></div>';
        
        objTo.appendChild(divtest)
        
        selectOption();
    }
    function remove_panel_fields(rid) {
	   $('.removeclass'+rid).remove();
   }
</script>
@endsection