<div id="sideBar" class="relative shadow-lg flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster" style="background-color: #40513b; color: #edf1d6;  z-index: 99 !important;">
    <div class="md:hidden md:flex-none w-56 flex flex-row items-center">
        <img src="{{asset('assets/logos/logo.png')}}" class="h-10 flex-none">
        <strong class="capitalize ml-5 flex-1">SIM-KLINIK Apoteker</strong>
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
        <p class="uppercase text-xs text-yellow-300 mb-4 tracking-wider font-semibold">Dasbor</p>
        <a href="{{url('dashboard-pharmacist')}}" class="mb-3 @if (Request::segment(1) == 'dashboard-pharmacist') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>
            Dasbor
        </a>

        <p class="uppercase text-xs text-yellow-300 mb-4 mt-4 tracking-wider font-semibold">Apoteker</p>
        <a href="{{url('pharmacist/master-data/medicine')}}" class="mb-3 @if (Request::segment(3) == 'medicine') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Obat
        </a>
        <a href="{{url('pharmacist/master-data/medicine_rule')}}" class="mb-3 @if (Request::segment(3) == 'medicine_rule') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Aturan Pakai
        </a>
        <a href="{{url('pharmacist/warehouse/incoming_medicine')}}" class="mb-3 @if (Request::segment(3) == 'incoming_medicine') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Stok Obat
        </a>
        <a href="{{url('pharmacist/payment')}}" class="mb-3 @if (Request::segment(2) == 'payment') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Pembayaran
        </a>
        <a href="{{url('pharmacist/report-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-medicine') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Laporan Obat
        </a>
        <a href="{{url('pharmacist/report-incoming-medicine')}}" class="mb-3 @if (Request::segment(2) == 'report-incoming-medicine') text-yellow-600 @endif capitalize font-medium text-sm hover:text-yellow-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Laporan Stok Obat
        </a>
    </div>
</div>
