<div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
    <div class="flex flex-col">
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider font-semibold">Dasbor</p>
        <a href="{{url('dashboard-admin')}}" class="mb-3 @if (Request::segment(1) == 'dashboard-admin') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>                
            Dasbor
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider font-semibold">Master Data</p>
        <a href="{{url('admin/master-data/patient')}}" class="mb-3 @if (Request::segment(3) == 'patient') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Pasien
        </a>
        <a href="{{url('admin/master-data/doctor')}}" class="mb-3 @if (Request::segment(3) == 'doctor') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Dokter
        </a>
        <a href="{{url('admin/master-data/nurse')}}" class="mb-3 @if (Request::segment(3) == 'nurse') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Perawat
        </a>
        <a href="{{url('admin/master-data/pharmacist')}}" class="mb-3 @if (Request::segment(3) == 'pharmacist') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Apoteker
        </a>
        <a href="{{url('admin/master-data/admition')}}" class="mb-3 @if (Request::segment(3) == 'admition') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Admisi
        </a>
        <a href="{{url('admin/master-data/clinic')}}" class="mb-3 @if (Request::segment(3) == 'clinic') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Ka Klinik
        </a>
        <hr class="mb-3">
        <a href="{{url('admin/master-data/poly')}}" class="mb-3 @if (Request::segment(3) == 'poly') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Poli Klinik
        </a>
        <a href="{{url('admin/master-data/medicine')}}" class="mb-3 @if (Request::segment(3) == 'medicine') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Obat
        </a>
        <a href="{{url('admin/warehouse/incoming_medicine')}}" class="mb-3 @if (Request::segment(3) == 'incoming_medicine') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Obat Masuk
        </a>
        <a href="{{url('admin/master-data/medicine_rule')}}" class="mb-3 @if (Request::segment(3) == 'medicine_rule') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Aturan Pakai
        </a>
        <a href="{{url('admin/master-data/measure')}}" class="mb-3 @if (Request::segment(3) == 'measure') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Tindakan
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider font-semibold">Pemeriksaan</p>
        <a href="{{url('admin/action/checkup')}}" class="mb-3 @if (Request::segment(3) == 'checkup' || Request::segment(3) == 'checkup-nurse') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Pemeriksaan
        </a>
        <a href="{{url('admin/action/recipe')}}" class="mb-3 @if (Request::segment(3) == 'recipe') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Resep Obat
        </a>
        <a href="{{url('admin/medical-reports')}}" class="mb-3 @if (Request::segment(2) == 'medical-reports') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Rekam Medis
        </a>
        <a href="{{url('admin/medical-resume')}}" class="mb-3 @if (Request::segment(2) == 'medical-resume') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Resume Medis
        </a>
        
        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider font-semibold">Pembayaran</p>
        <a href="{{url('admin/payment')}}" class="mb-3 @if (Request::segment(2) == 'payment') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Pembayaran
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider font-semibold">Laporan</p>
        <a href="{{url('admin/report-checkup')}}" class="mb-3 @if (Request::segment(2) == 'report-checkup') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pemeriksaan
        </a>
        <a href="{{url('admin/report-patient')}}" class="mb-3 @if (Request::segment(2) == 'report-patient') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Data Pasien
        </a>
        <a href="{{url('admin/report-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-medicine') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Obat
        </a>
        <a href="{{url('admin/report-incoming-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-incoming-medicine') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Obat Masuk
        </a>
        <a href="{{url('admin/report-recipe')}}" class="mb-3 @if (Request::segment(2) == 'report-recipe') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Resep
        </a>
        <a href="{{url('admin/report-payment')}}" class="mb-3 @if (Request::segment(2) == 'report-payment') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pembayaran
        </a>
        <a href="{{url('admin/report-top-sick')}}" class="mb-3 @if (Request::segment(2) == 'report-top-sick') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan 10 Penyakit Teratas
        </a>
    </div>
</div>