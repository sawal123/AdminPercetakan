@php
    $isAdmin = Auth::user()->hasRole('admin');
@endphp

<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="index.html" class="logo">
            <span>
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
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
                            <i class="iconoir-database-check-solid menu-icon"></i>
                            <span>Tagihan</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/pelanggan" wire:navigate>
                            <i class="iconoir-accessibility menu-icon"></i>
                            <span>Pelanggan</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        
                        @if ($isAdmin)
                            <a class="nav-link" href="/dashboard/pegawai" wire:navigate>
                                <i class="iconoir-community menu-icon"></i>
                                <span>Pegawai </span>
                            </a>
                        @else
                            <a href="javascript:void(0);" class="nav-link" onclick="showRestrictedModal()">
                                <i class="iconoir-community menu-icon"></i>
                                <span>Sales </span>
                                <i class="iconoir-lock menu-icon text-end"></i>
                            </a>
                        @endif
                    </li>



                </ul><!--end navbar-nav--->

            </div>
        </div><!--end startbar-collapse-->
    </div><!--end startbar-menu-->
</div><!--end startbar-->

<div class="modal fade" id="restrictedModal" tabindex="-1" aria-labelledby="restrictedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top text-center">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title " id="restrictedModalLabel">Akses Ditolak</h5>
            </div>
            <div class="modal-body">
                Maaf, hanya admin yang dapat mengakses halaman Sales. <br>
                <button type="button" class="btn btn-danger mt-2" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>


<script>
    function showRestrictedModal() {
        let modal = new bootstrap.Modal(document.getElementById('restrictedModal'));
        modal.show();
    }
</script>
