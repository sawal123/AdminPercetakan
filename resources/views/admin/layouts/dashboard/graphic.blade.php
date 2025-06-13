 <!--end row-->
 <div class="row justify-content-center">
     <div class="col-md-6 col-lg-8">
         <div class="card">
             <div class="card-header">
                 <div class="row align-items-center">
                     <div class="col">
                         <h4 class="card-title">Monthly Avg. Income</h4>
                     </div><!--end col-->
                     <div class="col-auto">
                         <div class="dropdown">
                             <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                 aria-haspopup="true" aria-expanded="false">
                                 <i class="icofont-calendar fs-5 me-1"></i> This Month<i
                                     class="las la-angle-down ms-1"></i>
                             </a>
                             <div class="dropdown-menu dropdown-menu-end">
                                 <a class="dropdown-item" href="#">Today</a>
                                 <a class="dropdown-item" href="#">Last Week</a>
                                 <a class="dropdown-item" href="#">Last Month</a>
                                 <a class="dropdown-item" href="#">This Year</a>
                             </div>
                         </div>
                     </div><!--end col-->
                 </div> <!--end row-->
             </div><!--end card-header-->
             <div class="card-body pt-0">
                 <div id="monthly_income" class="apex-charts"></div>
             </div>
             <!--end card-body-->
         </div>
         <!--end card-->
     </div>
     <!--end col-->
     <div class="col-md-6 col-lg-4">
         <div class="card">
             <div class="card-header">
                 <div class="row align-items-center">
                     <div class="col">
                         <h4 class="card-title">Customers</h4>
                     </div><!--end col-->
                     <div class="col-auto">
                         <div class="img-group d-flex">
                             <a class="user-avatar position-relative d-inline-block" href="#">
                                 <img src="assets/images/users/avatar-1.jpg" alt="avatar"
                                     class="thumb-md shadow-sm rounded-circle">
                             </a>
                             <a class="user-avatar position-relative d-inline-block ms-n2" href="#">
                                 <img src="assets/images/users/avatar-2.jpg" alt="avatar"
                                     class="thumb-md shadow-sm rounded-circle">
                             </a>
                             <a class="user-avatar position-relative d-inline-block ms-n2" href="#">
                                 <img src="assets/images/users/avatar-4.jpg" alt="avatar"
                                     class="thumb-md shadow-sm rounded-circle">
                             </a>
                             <a class="user-avatar position-relative d-inline-block ms-n2" href="#">
                                 <img src="assets/images/users/avatar-3.jpg" alt="avatar"
                                     class="thumb-md shadow-sm rounded-circle">
                             </a>
                             <a href="" class="user-avatar position-relative d-inline-block ms-1">
                                 <span
                                     class="thumb-md shadow-sm justify-content-center d-flex align-items-center bg-info-subtle rounded-circle fw-semibold fs-6">+6</span>
                             </a>
                         </div>
                     </div><!--end col-->
                 </div> <!--end row-->
             </div>
             <div class="card-body pt-0">
                 <div id="customers" class="apex-charts"></div>
                 <div class="bg-light py-3 px-2 mb-0 mt-3 text-center rounded">
                     <h6 class="mb-0"><i class="icofont-calendar fs-5 me-1"></i> 01 January 2024 to 31 December 2024
                     </h6>
                 </div>
             </div><!--end card-body-->
         </div><!--end card-->
     </div> <!--end col-->
 </div>
 <!--end row-->