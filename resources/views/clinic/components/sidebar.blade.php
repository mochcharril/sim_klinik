<div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
    <div class="flex flex-col">
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider font-semibold">Dasbor</p>
        <a href="{{url('dashboard-clinic')}}" class="mb-3 @if (Request::segment(1) == 'dashboard-clinic') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>
            Dasbor
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider font-semibold">Menu Ka Klinik</p>
        <a href="{{url('clinic/report-checkup')}}" class="mb-3 @if (Request::segment(2) == 'report-checkup') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pemeriksaan
        </a>
        <a href="{{url('clinic/report-patient')}}" class="mb-3 @if (Request::segment(2) == 'report-patient') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Data Pasien
        </a>
        <a href="{{url('clinic/report-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-medicine') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Obat
        </a>
        <a href="{{url('clinic/report-incoming-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-incoming-medicine') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Stok Obat
        </a>
        <a href="{{url('clinic/report-recipe')}}" class="mb-3 @if (Request::segment(2) == 'report-recipe') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Resep
        </a>
        <a href="{{url('clinic/report-payment')}}" class="mb-3 @if (Request::segment(2) == 'report-payment') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pembayaran
        </a>
        <a href="{{url('clinic/report-top-sick')}}" class="mb-3 @if (Request::segment(2) == 'report-top-sick') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan 10 Besar Penyakit
        </a>
    </div>
</div>
