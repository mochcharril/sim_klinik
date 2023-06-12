@extends('admin.layouts.app')
@section('content')
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Perbarui Data Poli Klinik</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admin/master-data/poly/update',$getDetailPoly->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div>
                    <label class="text-gray-700 ml-1">Kode RM: </label>
                    <input type="text" name="code_pl" class="form-input w-full block rounded mt-1 p-3 border-2 @error('code_pl') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Kode RM" value="{{$getDetailPoly->code_pl}}" readonly>
                    @error('code_pl')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-gray-700 ml-1">Nama Poli: </label>
                    <input type="text" name="name" class="form-input w-full block rounded mt-1 p-3 border-2 @error('name') border-red-500 @enderror focus:outline-none focus:border-green-500" placeholder="Nama Poli" value="{{old('name', $getDetailPoly->name)}}">
                    @error('name')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn-shadow bg-green-500 text-white rounded px-10 py-2 mt-2 hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection