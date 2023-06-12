<div id="sideBar" class="relative shadow-lg flex flex-col flex-wrap bg-white border-r border-yellow-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster" style="background-color: #40513B; color: #edf1d6; z-index: 99 !important;">
    <div class="md:hidden md:flex-none w-56 flex flex-row items-center">
        <img src="{{asset('assets/logos/logo.png')}}" class="h-10 flex-none">
        <strong class="capitalize ml-5 flex-1">SIM-KLINIK Perawat</strong>
        <button id="sliderBtn" class="flex-none text-right text-yellow-900 hidden md:block">
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
        <a href="{{url('dashboard-nurse')}}" class="mb-3 @if (Request::segment(1) == 'dashboard-nurse') text-yellow-200 @endif capitalize font-medium text-sm hover:text-yellow-200 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>
            Dasbor
        </a>

        <p class="uppercase text-xs text-yellow-300 mb-4 mt-4 tracking-wider font-semibold">Perawat</p>
        <a href="{{url('nurse/action/checkup')}}" class="mb-3 @if (Request::segment(3) == 'checkup') text-yellow-200 @endif capitalize font-medium text-sm hover:text-yellow-200 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Pemeriksaan
        </a>
        <a href="{{url('nurse/report-checkup')}}" class="mb-3 @if (Request::segment(2) == 'report-checkup') text-yellow-200 @endif capitalize font-medium text-sm hover:text-yellow-200 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Laporan Pemeriksaan
        </a>
    </div>
</div>
