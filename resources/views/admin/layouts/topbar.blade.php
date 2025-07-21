 <div class="topbar d-print-none">
     <div class="container-fluid">
         <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
             <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                 <li>
                     <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                         <i class="iconoir-menu"></i>
                     </button>
                 </li>
                 <li class="mx-2 welcome-text">
                     <h5 class="mb-0 fw-semibold text-truncate">Good Morning, {{ Auth::user()->name }}</h5>
                     @if (Auth::user()->hasRole('admin'))
                         (Admin)
                     @elseif (Auth::user()->hasRole('kasir'))
                         (Kasir)
                     @endif

                 </li>
             </ul>
             <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                 <li class="topbar-item">
                     <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                         <i class="iconoir-half-moon dark-mode-icon d-none"></i>
                         <i class="iconoir-sun-light light-mode-icon"></i>
                     </a>
                 </li>
                 <li class="dropdown topbar-item " >
                     <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                         role="button" aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                         <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                             class="thumb-md rounded-circle">
                     </a>
                     <div class="dropdown-menu dropdown-menu-end py-0" wire:ignore.self>
                         <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                             <div class="flex-shrink-0">
                                 <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt=""
                                     class="thumb-md rounded-circle">
                             </div>
                             <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                 <h6 class="my-0 fw-medium text-dark fs-13">{{ Auth::user()->name }}</h6>
                                 <small class="text-muted mb-0">
                                     @if (Auth::user()->hasRole('admin'))
                                         (Admin)
                                     @elseif (Auth::user()->hasRole('kasir'))
                                         (Kasir)
                                     @endif
                                 </small>
                             </div><!--end media-body-->
                         </div>
                         <div class="dropdown-divider mt-0"></div>
                         <small class="text-muted px-2 pb-1 d-block">Account</small>
                         <a class="dropdown-item" href="pages-profile.html"><i
                                 class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
                         <a class="dropdown-item text-danger" href="/dashboard/logout"><i
                                 class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                     </div>
                 </li>
             </ul><!--end topbar-nav-->
         </nav>
         <!-- end navbar-->
     </div>
 </div>

