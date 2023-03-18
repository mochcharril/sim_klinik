@extends('admin.layouts.app')
@section('content')
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Perbarui Data Akun Apoteker</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/master-data/pharmacist/update', $getDetailPharmacist->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Nama Apoteker: </label>
                    <input type="text" name="name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Apoteker" value="{{old('name', $getDetailPharmacist->name)}}">
                    @error('name')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Surel Apoteker : </label>
                    <input type="email" name="email" class="form-input w-full block rounded mt-1 p-3 border-2 @error('email') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Surel Apoteker" value="{{old('email', $getDetailPharmacist->email)}}">
                    @error('email')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Diverifikasi Oleh : </label>
                    <input type="text" name="verified" class="form-input w-full block rounded mt-1 p-3 border-2 @error('verified') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Diverifikasi Oleh" value="{{auth()->user()->name}} - {{auth()->user()->email}}" readonly>
                    @error('verified')
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