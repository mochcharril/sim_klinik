@extends('admin.layouts.app')
@section('extraCSS')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
@endsection
@section('content')
<form method="POST" action="{{url('/admin/action/recipe/store',$getDetailCheckup->id)}}">
    @csrf
    <div>
        <div class="card mb-8">
            <div class="card-header flex flex-row justify-between">
                <h1 class="h6">Tambah Data Resep Obat</h1>
            </div>
            <div class="card-body">
                <div class="grid mt-5 grid-cols-2 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Kode RM: </label>
                        <input type="text" name="code_rm" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rm') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode RM" value="{{$getDetailPatient->code_rm}}" readonly>
                        @error('code_rm')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Nama Pasien: </label>
                        <input type="text" name="patient_name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_name') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Nama Pasien" value="{{$getDetailPatient->name}}" readonly>
                        @error('patient_name')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Jenis Kelamin: </label>
                        <input type="text" name="patient_gender" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_gender') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Jenis Kelamin" value="{{$getDetailPatient->gender}}" readonly>
                        @error('patient_gender')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tempat, Tanggal Lahir: </label>
                        <input type="text" name="patient_birth" class="form-input w-full block rounded mt-1 p-3 border-2 @error('patient_birth') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tempat, Tanggal Lahir" value="{{$getDetailPatient->place_of_birth}}, {{$getDetailPatient->date_of_birth}} ({{ date_diff(date_create($getDetailPatient->date_of_birth), date_create('now'))->y }} Tahun, {{ date_diff(date_create($getDetailPatient->date_of_birth), date_create('now'))->m }} Bulan)" readonly>
                        @error('patient_birth')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <hr><hr>
                    <div>
                        <label class="text-gray-700 ml-1">Kode Pemeriksaan: </label>
                        <input required type="text" name="code_cu" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_cu') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode Pemeriksaan" value="{{$getDetailCheckup->code_cu}}" readonly>
                        @error('code_cu')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Keluhan: </label>
                        <input required type="text" name="complaint" class="form-input w-full block rounded mt-1 p-3 border-2 @error('complaint') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Keluhan" value="{{$getDetailCheckup->complaint}}" readonly>
                        @error('complaint')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Alergi: </label>
                        <input required type="text" name="allergy" class="form-input w-full block rounded mt-1 p-3 border-2 @error('allergy') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Alergi" value="{{$getDetailCheckup->allergy}}" readonly>
                        @error('allergy')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Diagnosa: </label>
                        <input required type="text" name="diagnosis" class="form-input w-full block rounded mt-1 p-3 border-2 @error('diagnosis') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Diagnosa" value="{{$getDetailCheckup->code_diagnosis}} || {{$getDetailCheckup->description_diagnosis}}" readonly>
                        @error('diagnosis')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <hr><hr>
                    <div>
                        <label class="text-gray-700 ml-1">Kode Resep: </label>
                        <input required type="text" name="code_rp" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rp') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode Resep" value="{{$generateCodeRP}}" readonly>
                        @error('code_rp')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-700 ml-1">Tanggal Pemberian Resep: </label>
                        <input required type="date" name="date_recipe" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_recipe') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Tanggal Pemberian Resep">
                        @error('date_recipe')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
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
                    <input id="stock-1" type="hidden" name="stock[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Sisa">
                    @error('stock[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Stok Sisa: </label>
                    <input id="stocks-1" type="text" name="stocks[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stocks[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Sisa" readonly>
                    @error('stocks[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Stok Keluar: </label>
                    <input id="stock_out-1" type="text" name="stock_out[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock_out[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Keluar">
                    @error('stock_out[]')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Aturan Pakai: </label>
                    <select placeholder="Pilih Aturan Pakai..." name="medication_rules[]" class="form-input mt-1 p-3 border-2 @error('medication_rules[]') border-red-500 @enderror focus:outline-none focus:border-green-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                        <option value="">Pilih Aturan Pakai</option>
                        @foreach ($getMedicineRule as $itemMedicineRule)
                            <option value="{{$itemMedicineRule->name}}">{{$itemMedicineRule->name}}</option>
                        @endforeach
                    </select>
                    @error('medication_rules[]')
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
                console.log(res)
                document.getElementById("price-"+number).value = res.price;
                document.getElementById("stock-"+number).value = res.stock;
                document.getElementById("stocks-"+number).value = res.stock;
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
        divtest.innerHTML = '<div class="card mb-8"><div class="card-body"><div class="mt-3"><label class="text-gray-700 ml-1">Pilih Obat :</label><select onchange="openMedicine(this,'+room+')" id="medicine" placeholder="Pilih Obat..." name="medicine[]" class="form-input mt-1 p-3 border-2 @error('medicine[]') border-red-500 @enderror focus:outline-none focus:border-green-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0"><option value="">Pilih Obat</option>@foreach ($getMedicine as $itemMedicine)<option value="{{$itemMedicine->id}}">{{$itemMedicine->name}}</option>@endforeach</select>@error('medicine[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Harga:</label><input id="price-'+room+'" type="text" name="price[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('price[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Harga"> @error('price[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><input id="stock-'+room+'" type="hidden" name="stock[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Sisa"> @error('stock[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Stok Sisa:</label><input id="stocks-'+room+'" type="text" name="stocks[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stocks[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Sisa" readonly> @error('stocks[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Stok Keluar:</label><input id="stock_out-'+room+'" type="text" name="stock_out[]" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock_out[]') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Stok Keluar"> @error('stock_out[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-3"><label class="text-gray-700 ml-1">Aturan Pakai:</label><select placeholder="Pilih Aturan Pakai..." name="medication_rules[]" class="form-input mt-1 p-3 border-2 @error('medication_rules[]') border-red-500 @enderror focus:outline-none focus:border-green-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0"><option value="">Pilih Aturan Pakai</option>@foreach ($getMedicineRule as $itemMedicineRule)<option value="{{$itemMedicineRule->name}}">{{$itemMedicineRule->name}}</option>@endforeach</select>@error('medication_rules[]')<span class="pl-1 text-xs text-red-600 text-bold">{{$message}}</span>@enderror</div><div class="mt-5 flex flex-row-reverse"><button type="button" class="btn-shadow bg-red-500 text-white rounded px-10 py-2 mt-2 hover:bg-red-600" onclick="remove_panel_fields('+room+')">Hapus</button></div></div></div>';
        
        objTo.appendChild(divtest)
        
        selectOption();
    }
    function remove_panel_fields(rid) {
	   $('.removeclass'+rid).remove();
   }
</script>
@endsection