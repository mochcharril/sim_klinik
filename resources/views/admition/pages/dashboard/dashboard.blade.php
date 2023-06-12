@extends('admition.layouts.app')
@section('content')
<div>
    <div class="grid grid-cols-4 gap-6 xl:grid-cols-1">
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-red-700 fad fa-sitemap"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countDoctor}} Dokter</h1>
                        <p>Total Data Akun Dokter</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-yellow-600 fad fa-clipboard"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countNurse}} Perawat</h1>
                        <p>Total Data Akun Perawat</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-green-700 fad fa-newspaper"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countParmachist}} Apoteker</h1>
                        <p>Total Data Akun Apoteker</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-pink-700 fad fa-calendar"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countAdmition}} Admisi</h1>
                        <p>Total Data Akun Admisi</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
    </div>
    <div class="grid mt-6 grid-cols-3 gap-6 xl:grid-cols-1">
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-green-700 fad fa-share-alt"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countClinic}} Ka Klinik</h1>
                        <p>Total Data Akun Ka Klinik</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-tags"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countAdmin}} Admin</h1>
                        <p>Total Data Akun Admin</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-lime-700 fad fa-users"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countPatient}} Pasien</h1>
                        <p>Total Data Pasien Terdaftar</p>
                    </div>            
                </div>
            </div>
            <div class="footer {{-- @if ($getCountFeedbackUnread != 0) bg-green-500 @else bg-white @endif --}} p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
    </div>
    <div class="grid mt-6 grid-cols-1 gap-6 xl:grid-cols-1">
        <div class="report-card">
            <div class="card {{$countRetention > 0 ? 'bg-orange-200' : 'bg-white'}}">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-lime-700 fad fa-users"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countRetention}} Retensi</h1>
                        <p>Total Data Pasien Yang Dapat Diretensi</p>
                    </div>
                </div>
            </div>
            <div class="footer {{$countRetention > 0 ? 'bg-orange-300' : 'bg-white'}} p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
    </div>
    <div class="grid mt-6 grid-cols-1 gap-6 xl:grid-cols-1">
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="overflow-hidden rounded-lg">
                        <div class="py-3 px-5">
                            Grafik Pendafar Pasien Setiap Bulan
                        </div>
                        <canvas class="p-10" id="chartLine"></canvas>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
    </div>
</div>
@endsection
@section('extraJS')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const data = {
      labels: labels,
      datasets: [
        {
          label: "Data Pasien",
          backgroundColor: "hsl(89, 43%, 51%)",
          borderColor: "hsl(89, 43%, 51%)",
          data: [{{$getJanuary}}, {{$getFebruary}}, {{$getMarch}}, {{$getApril}}, {{$getMay}}, {{$getJune}}, {{$getJuly}}, {{$getAugust}}, {{$getSeptember}}, {{$getOctober}}, {{$getNovember}}, {{$getDecember}}],
        },
      ],
    };
  
    const configLineChart = {
      type: "line",
      data,
      options: {},
    };
  
    var chartLine = new Chart(
      document.getElementById("chartLine"),
      configLineChart
    );
  </script>
@endsection