<div id="sideBar" class="relative shadow-lg flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster" style="background-color: #40513B; color: #edf1d6; z-index: 99 !important;">
    <div class="md:hidden md:flex-none w-56 flex flex-row items-center">
        <img src="{{asset('assets/logos/logo.png')}}" class="h-10 flex-none">
        <strong class="capitalize ml-5 flex-1">SIM-KLINIK Admin</strong>
        <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
            <i class="fad fa-list-ul"></i>
        </button>
    </div>
    <br><br>
    <div class="flex flex-col">
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <p class="uppercase text-xs text-yellow-500 mb-4 tracking-wider font-semibold">Dasbor</p>
        <a href="{{url('dashboard-admin')}}" class="mb-3 @if (Request::segment(1) == 'dashboard-admin') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>
            Dasbor
        </a>

        <p class="uppercase text-xs text-yellow-500 mb-4 mt-4 tracking-wider font-semibold">Master Data</p>
        <a href="{{url('admin/master-data/admin')}}" class="mb-3 @if (Request::segment(3) == 'admin') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Admin
        </a>
        <a href="{{url('admin/master-data/patient')}}" class="mb-3 @if (Request::segment(3) == 'patient') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Pasien
        </a>
        <a href="{{url('admin/master-data/doctor')}}" class="mb-3 @if (Request::segment(3) == 'doctor') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Dokter
        </a>
        <a href="{{url('admin/master-data/nurse')}}" class="mb-3 @if (Request::segment(3) == 'nurse') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Perawat
        </a>
        <a href="{{url('admin/master-data/pharmacist')}}" class="mb-3 @if (Request::segment(3) == 'pharmacist') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Apoteker
        </a>
        <a href="{{url('admin/master-data/admition')}}" class="mb-3 @if (Request::segment(3) == 'admition') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Admisi
        </a>
        <a href="{{url('admin/master-data/clinic')}}" class="mb-3 @if (Request::segment(3) == 'clinic') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Ka Klinik
        </a>
        <hr class="mb-3">
        <a href="{{url('admin/master-data/poly')}}" class="mb-3 @if (Request::segment(3) == 'poly') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Poli Klinik
        </a>
        <a href="{{url('admin/master-data/medicine')}}" class="mb-3 @if (Request::segment(3) == 'medicine') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Obat
        </a>
        <a href="{{url('admin/warehouse/incoming_medicine')}}" class="mb-3 @if (Request::segment(3) == 'incoming_medicine') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Stok Obat
        </a>
        <a href="{{url('admin/master-data/medicine_rule')}}" class="mb-3 @if (Request::segment(3) == 'medicine_rule') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Aturan Pakai
        </a>
        <a href="{{url('admin/master-data/measure')}}" class="mb-3 @if (Request::segment(3) == 'measure') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Tindakan
        </a>

        <p class="uppercase text-xs text-yellow-500 mb-4 mt-4 tracking-wider font-semibold">Pemeriksaan</p>
        <a href="{{url('admin/action/checkup')}}" class="mb-3 @if (Request::segment(3) == 'checkup' || Request::segment(3) == 'checkup-nurse') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Pemeriksaan
        </a>
        <a href="{{url('admin/informed-consent')}}" class="mb-3 @if (Request::segment(2) == 'informed-consent') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Persetujuan Tindakan
        </a>
        <a href="{{url('admin/action/recipe')}}" class="mb-3 @if (Request::segment(3) == 'recipe') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Resep Obat
        </a>
        <a href="{{url('admin/medical-reports')}}" class="mb-3 @if (Request::segment(2) == 'medical-reports') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Riwayat Pemeriksaan
        </a>
        <a href="{{url('admin/medical-resume')}}" class="mb-3 @if (Request::segment(2) == 'medical-resume') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Resume Medis
        </a>
        <a href="{{url('admin/medical')}}" class="mb-3 @if (Request::segment(2) == 'medical') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Rekam Medis
        </a>

        <p class="uppercase text-xs text-yellow-500 mb-4 mt-4 tracking-wider font-semibold">Pembayaran</p>
        <a href="{{url('admin/payment')}}" class="mb-3 @if (Request::segment(2) == 'payment') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Pembayaran
        </a>

        <p class="uppercase text-xs text-yellow-500 mb-4 mt-4 tracking-wider font-semibold">Laporan</p>
        <a href="{{url('admin/report-checkup')}}" class="mb-3 @if (Request::segment(2) == 'report-checkup') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pemeriksaan
        </a>
        <a href="{{url('admin/report-patient')}}" class="mb-3 @if (Request::segment(2) == 'report-patient') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Data Pasien
        </a>
        <a href="{{url('admin/report-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-medicine') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Obat
        </a>
        <a href="{{url('admin/report-incoming-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-incoming-medicine') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Stok Obat
        </a>
        <a href="{{url('admin/report-recipe')}}" class="mb-3 @if (Request::segment(2) == 'report-recipe') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Resep
        </a>
        <a href="{{url('admin/report-payment')}}" class="mb-3 @if (Request::segment(2) == 'report-payment') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pembayaran
        </a>
        <a href="{{url('admin/report-top-sick')}}" class="mb-3 @if (Request::segment(2) == 'report-top-sick') text-yellow-400 @endif capitalize font-medium text-sm hover:text-yellow-400 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan 10 Besar Penyakit
        </a>
    </div>
</div>
