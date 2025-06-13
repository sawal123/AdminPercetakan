<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="index.html" class="logo">
            <span>
                <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{asset('assets/images/logo-light.png')}}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label mt-2">
                        <span>Navigation</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard" wire:navigate>
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/barang" wire:navigate>
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Daftar Barang</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/tagihan" wire:navigate>
                            <i class="iconoir-invoice-alt menu-icon"></i>
                            <span>Tagihan</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/pelanggan" wire:navigate>
                            <i class="iconoir-accessibility menu-icon"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li><!--end nav-item-->

                    
                </ul><!--end navbar-nav--->
                <div class="update-msg text-center">
                    <div
                        class="d-flex justify-content-center align-items-center thumb-lg update-icon-box  rounded-circle mx-auto">
                        <img src="assets/images/extra/party.gif" alt="" class="d-inline-block me-1"
                            height="30">
                    </div>
                    <h5 class="mt-3">Mannat Themes</h5>
                    <p class="mb-3 text-muted">Mifty is a high quality web applications.</p>
                    <a href="javascript: void(0);" class="btn bg-black text-white shadow-sm rounded-pill">Upgrade your
                        plan</a>
                </div>
            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->
