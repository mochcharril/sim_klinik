@extends('admin.layouts.app')
@section('content')
<div>
    <div class="grid grid-cols-4 gap-6 xl:grid-cols-1">
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-users"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countPatient}} Pasien</h1>
                        <p>Total Data Pasien Terdaftar</p>
                    </div>            
                </div>
            </div>
            <div class="footer {{-- @if ($getCountFeedbackUnread != 0) bg-teal-500 @else bg-white @endif --}} p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
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
                        <div class="h6 text-red-700 fad fa-podcast"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">{{$countPayment}} Pembayaran</h1>
                        <p>Total Transaksi Pembayaran</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>

        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-indigo-700 fad fa-clipboard"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">0 Laporan Pemeriksaan</h1>
                        <p>Total Data Laporan Pemeriksaan</p>
                    </div>            
                </div>
            </div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-red-700 fad fa-clipboard"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">0 Laporan Pasien</h1>
                        <p>Total Data Laporan Pasien</p>
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
                        <h1 class="h5">0 Laporan Obat Masuk</h1>
                        <p>Total Data Laporan Obat Masuk</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-green-700 fad fa-clipboard"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">0 Laporan Resep</h1>
                        <p>Total Data Laporan Resep</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-pink-700 fad fa-clipboard"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">0 Laporan Obat</h1>
                        <p>Total Data Laporan Obat</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
        <div class="report-card">
            <div class="card">
                <div class="card-body flex flex-col">
                    <div class="flex flex-row justify-between items-center">
                        <div class="h6 text-green-700 fad fa-clipboard"></div>
                    </div>
                    <div class="mt-8">
                        <h1 class="h5">0 Laporan Pembayaran</h1>
                        <p>Total Data Laporan Pembayaran</p>
                    </div>
                </div>
            </div>
            <div class="footer bg-white p-1 mx-4 border border-t-0 rounded rounded-t-none"></div>
        </div>
    </div>
</div>
@endsection