<div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
    <div class="flex flex-col">
        <div class="text-right hidden md:block mb-4">
            <button id="sideBarHideBtn">
                <i class="fad fa-times-circle"></i>
            </button>
        </div>
        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider font-semibold">Dasbor</p>
        <a href="{{url('dashboard-doctor')}}" class="mb-3 @if (Request::segment(1) == 'dashboard-doctor') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-chart-pie text-xs mr-2"></i>                
            Dasbor
        </a>

        <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider font-semibold">Menu Dokter</p>
        <a href="{{url('doctor/master-data/medicine_rule')}}" class="mb-3 @if (Request::segment(3) == 'medicine_rule') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Aturan Pakai
        </a>
        <a href="{{url('doctor/master-data/measure')}}" class="mb-3 @if (Request::segment(3) == 'measure') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Data Tindakan
        </a>

        <a href="{{url('doctor/action/checkup')}}" class="mb-3 @if (Request::segment(3) == 'checkup' || Request::segment(3) == 'checkup-nurse') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Pemeriksaan
        </a>
        <a href="{{url('doctor/action/recipe')}}" class="mb-3 @if (Request::segment(3) == 'recipe') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Resep Obat
        </a>

        <a href="{{url('doctor/medical-reports')}}" class="mb-3 @if (Request::segment(2) == 'medical-reports') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Rekam Medis
        </a>
        <a href="{{url('doctor/medical-resume')}}" class="mb-3 @if (Request::segment(2) == 'medical-resume') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            &nbsp;Resume Medis
        </a>

        <a href="{{url('doctor/report-checkup')}}" class="mb-3 @if (Request::segment(2) == 'report-checkup') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Pemeriksaan
        </a>
        <a href="{{url('doctor/report-recipe')}}" class="mb-3 @if (Request::segment(2) == 'report-recipe') text-blue-600 @endif capitalize font-medium text-sm hover:text-blue-600 transition ease-in-out duration-500">
            <i class="fad fa-clipboard text-xs mr-2"></i>
            Laporan Resep
        </a>
    </div>
</div>