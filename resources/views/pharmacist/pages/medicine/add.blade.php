@extends('pharmacist.layouts.app')
@section('content')
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Tambah Data Obat</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/pharmacist/master-data/medicine/store')}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="text-gray-700 ml-1">Kode MD: </label>
                    <input type="text" name="code_md" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_md') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode MD" value="{{$getCodeMD}}" readonly>
                    @error('code_md')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Nama Obat: </label>
                    <input type="text" name="name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Obat" value="{{old('name')}}">
                    @error('name')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Stok Awal Obat: </label>
                    <input type="text" name="stock" class="form-input w-full block rounded mt-1 p-3 border-2 @error('stock') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Stok Awal Obat" value="{{old('stock')}}">
                    @error('stock')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Harga Obat (Contoh: 10000): </label>
                    <input type="text" name="price" class="form-input w-full block rounded mt-1 p-3 border-2 @error('price') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Harga Obat" value="{{old('price')}}">
                    @error('price')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Tanggal Kadaluarsa: </label>
                    <input type="date" name="expired_date" class="form-input w-full block rounded mt-1 p-3 border-2 @error('expired_date') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Kadaluarsa" value="{{old('expired_date')}}">
                    @error('expired_date')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection