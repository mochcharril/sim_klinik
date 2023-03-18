@extends('admin.layouts.app')
@section('content')
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Tambah Data Pasien</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/master-data/patient/store')}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="text-gray-700 ml-1">Kode RM: </label>
                    <input type="text" name="code_rm" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_rm') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Kode RM" value="{{$getCodeRM}}" readonly>
                    @error('code_rm')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Nama Pasien: </label>
                    <input type="text" name="name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('name') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Pasien" value="{{old('name')}}">
                    @error('name')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">NIK Pasien : </label>
                    <input type="text" name="nik" class="form-input w-full block rounded mt-1 p-3 border-2 @error('nik') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="NIK Pasien" value="{{old('nik')}}">
                    @error('nik')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Jenis Kelamin : </label>
                    <select name="gender" class="form-input mt-1 p-3 border-2 @error('tag') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    @error('gender')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Tempat Lahir : </label>
                    <input type="text" name="place_of_birth" class="form-input w-full block rounded mt-1 p-3 border-2 @error('place_of_birth') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tempat Lahir" value="{{old('place_of_birth')}}">
                    @error('place_of_birth')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Tanggal Lahir : </label>
                    <input type="date" name="date_of_birth" class="form-input w-full block rounded mt-1 p-3 border-2 @error('date_of_birth') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Tanggal Lahir" value="{{old('date_of_birth')}}">
                    @error('date_of_birth')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Alamat : </label>
                    <input type="text" name="address" class="form-input w-full block rounded mt-1 p-3 border-2 @error('address') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Alamat" value="{{old('address')}}">
                    @error('address')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Nomor Telepon : </label>
                    <input type="text" name="phone_number" class="form-input w-full block rounded mt-1 p-3 border-2 @error('phone_number') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nomor Telepon" value="{{old('phone_number')}}">
                    @error('phone_number')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Jenis Asuransi : </label>
                    <input type="text" name="insurance_type" class="form-input w-full block rounded mt-1 p-3 border-2 @error('insurance_type') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Jenis Asuransi" value="{{old('insurance_type')}}">
                    @error('insurance_type')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Nomor Asuransi : </label>
                    <input type="text" name="insurance_number" class="form-input w-full block rounded mt-1 p-3 border-2 @error('insurance_number') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nomor Asuransi" value="{{old('insurance_number')}}">
                    @error('insurance_number')
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