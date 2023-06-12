@extends('admition.layouts.app')
@section('content')
<div>
    <div class="card mb-8">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Tambah Data Pasien</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{url('/admition/master-data/patient/store')}}" enctype="multipart/form-data">
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
                    <label class="text-gray-700 ml-1">Daftar Sebagai : </label>
                    <select onchange="openStatus(this);" name="register_as" class="form-input mt-1 p-3 border-2 @error('tag') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                        <option value="as_umum">Umum</option>
                        <option value="as_mhs">Mahasiswa</option>
                        <option value="as_kry">Karyawan</option>
                        <option value="as_klg">Keluarga Karyawan</option>
                    </select>
                    @error('register_as')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div id="form_open_mhs" style="display: none;">
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">NIM Mahasiswa : </label>
                        <input type="text" name="nim_nip" class="form-input w-full block rounded mt-1 p-3 border-2 @error('nim_nip') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="NIM Mahasiswa" value="{{old('nim_nip')}}">
                        @error('nim_nip')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div id="form_open_kry" style="display: none;">
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">NIP Karyawan : </label>
                        <input type="text" name="nim_nip_karyawan" class="form-input w-full block rounded mt-1 p-3 border-2 @error('nim_nip_karyawan') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="NIP Karyawan" value="{{old('nim_nip_karyawan')}}">
                        @error('nim_nip_karyawan')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div id="form_open_klg" style="display: none;">
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Nama Karyawan : </label>
                        <input type="text" name="family_from" class="form-input w-full block rounded mt-1 p-3 border-2 @error('family_from') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nama Karyawan" value="{{old('family_from')}}">
                        @error('family_from')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">NIP Karyawan : </label>
                        <input type="text" name="nim_nip_keluarga" class="form-input w-full block rounded mt-1 p-3 border-2 @error('nim_nip_keluarga') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="NIP Karyawan" value="{{old('nim_nip_keluarga')}}">
                        @error('nim_nip_keluarga')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Hubungan Keluarga : </label>
                        <select name="family_as" class="form-input mt-1 p-3 border-2 @error('tag') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                            <option value="Suami">Suami</option>
                            <option value="Istri">Istri</option>
                            <option value="Kakek">Kakek</option>
                            <option value="Nenek">Nenek</option>
                            <option value="Anak">Anak</option>
                            <option value="Saudara">Saudara</option>
                        </select>
                        @error('family_as')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
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
                    <label class="text-gray-700 ml-1">Pilih Asuransi : </label>
                    <select onchange="openInsurance(this);" name="insurance" class="form-input mt-1 p-3 border-2 @error('tag') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                        <option value="umum">Tidak Ada Asuransi (Umum)</option>
                        <option value="open_bpjs">BPJS</option>
                        <option value="open_other">Lainnya</option>
                    </select>
                    @error('insurance')
                    <span class="pl-1 text-xs text-red-600 text-bold">
                        {{$message}}
                    </span>
                    @enderror
                </div>
                <div id="form_open" style="display:none;">
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Jenis Asuransi : </label>
                        <input type="text" id="insurance_type" name="insurance_type" class="form-input w-full block rounded mt-1 p-3 border-2 @error('insurance_type') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Jenis Asuransi" value="{{old('insurance_type')}}">
                        @error('insurance_type')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="text-gray-700 ml-1">Nomor Asuransi : </label>
                        <input type="text" id="insurance_number" name="insurance_number" class="form-input w-full block rounded mt-1 p-3 border-2 @error('insurance_number') border-red-500 @enderror focus:outline-none focus:border-blue-500" placeholder="Nomor Asuransi" value="{{old('insurance_number')}}">
                        @error('insurance_number')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="grid mt-5 grid-cols-1 gap-5 xl:grid-cols-1">
                    <div>
                        <label class="text-gray-700 ml-1">Pilih Poli : </label>
                        <select id="poly" placeholder="Pilih Poli..." name="poly" class="form-input mt-1 p-2 border-2 @error('poly') border-red-500 @enderror focus:outline-none focus:border-blue-500 form-select appearance-none block w-full px-3 py-2.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0">
                            @foreach ($getPoly as $itemPoly)
                                <option value="{{$itemPoly->id}}">{{$itemPoly->name}}</option>
                            @endforeach
                        </select>
                        @error('poly')
                        <span class="pl-1 text-xs text-red-600 text-bold">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn-shadow bg-blue-500 text-white rounded px-10 py-2 mt-2 hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extraJS')
    <script>
        function openInsurance(that) {
            if (that.value == "open_bpjs") {
                document.getElementById("form_open").style.display = "block";
                document.getElementById("insurance_type").value = "BPJS";
                document.getElementById("insurance_type").readOnly = true;
                document.getElementById("insurance_type").required = true;
                document.getElementById("insurance_number").required = true;
            } else if (that.value == "open_other"){
                document.getElementById("form_open").style.display = "block";
                document.getElementById("insurance_type").value = "";
                document.getElementById("insurance_type").readOnly = false;
                document.getElementById("insurance_type").required = true;
                document.getElementById("insurance_number").required = true;
            } else {
                document.getElementById("form_open").style.display = "none";
                document.getElementById("insurance_type").required = false;
                document.getElementById("insurance_number").required = false;
            }
        }

        function openStatus(that){
            if (that.value == "as_mhs") {
                document.getElementById("form_open_mhs").style.display = "block";
                document.getElementById("form_open_kry").style.display = "none";
                document.getElementById("form_open_klg").style.display = "none";
            } else if (that.value == "as_kry") {
                document.getElementById("form_open_kry").style.display = "block";
                document.getElementById("form_open_mhs").style.display = "none";
                document.getElementById("form_open_klg").style.display = "none";
            } else if (that.value == "as_klg") {
                document.getElementById("form_open_klg").style.display = "block";
                document.getElementById("form_open_kry").style.display = "none";
                document.getElementById("form_open_mhs").style.display = "none";
            } else {
                document.getElementById("form_open_klg").style.display = "none";
                document.getElementById("form_open_kry").style.display = "none";
                document.getElementById("form_open_mhs").style.display = "none";
            }
        }
    </script>
@endsection