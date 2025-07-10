@props(['title' => 'Default Title', 'back' => ''])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    @livewireStyles
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <style>
        /* Default untuk light mode */
        [data-bs-theme="light"] .form-control::placeholder,
        [data-bs-theme="light"] .form-select::placeholder {
            color: #212529;
            /* warna gelap agar placeholder terlihat di light mode */
            opacity: 0.5;
        }

        /* Untuk dark mode */
        [data-bs-theme="dark"] .form-control::placeholder,
        [data-bs-theme="dark"] .form-select::placeholder {
            color: #adb5bd;
            /* abu terang agar terlihat di dark mode */
            opacity: 0.5;
        }

        .form-control {
            color: inherit;
            opacity: 1;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Top Bar Start -->
        @include('admin.layouts.topbar')
        <!-- Top Bar End -->
        <!-- leftbar-tab-menu -->
        @include('admin.layouts.tabmenu')
        <div class="startbar-overlay d-print-none"></div>
        <!-- end leftbar-tab-menu-->
        <!-- Page Content -->
        <main>
            <div class="page-wrapper">
                <!-- Page Content-->
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 no-print">
                                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                                    @if ($back)
                                        <a href="{{ $back }}" class="btn btn-primary" wire:navigate><i
                                                class="las la-arrow-left"></i> Kembali</a>
                                    @endif
                                    <h4 class="page-title">{{ $title }}</h4>
                                </div><!--end page-title-box-->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                    {{ $slot }}
                    <footer class="footer text-center text-sm-start d-print-none">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-0 rounded-bottom-0">
                                        <div class="card-body">
                                            <p class="text-muted mb-0">
                                                ©
                                                Mifty
                                                <span class="text-muted d-none d-sm-inline-block float-end">
                                                    Design with
                                                    <i class="iconoir-heart-solid text-danger align-middle"></i>
                                                    by Mannatthemes</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!--end footer-->
                </div>
                <!-- end page content -->
            </div>
        </main>
    </div>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="{{ asset('assets/js/pages/index.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>


    <script>
        try {
            const currentTheme = localStorage.getItem("theme");
            if (currentTheme) {
                document.documentElement.setAttribute("data-bs-theme", currentTheme);
            }
            var themeColorToggle = document.getElementById("light-dark-mode");
            if (themeColorToggle) {
                themeColorToggle.addEventListener("click", function() {
                    let current = document.documentElement.getAttribute("data-bs-theme");
                    let newTheme = current === "light" ? "dark" : "light";
                    document.documentElement.setAttribute("data-bs-theme", newTheme);
                    localStorage.setItem("theme", newTheme);
                });
            }
        } catch (e) {
            console.error("Theme toggle error:", e);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
    function waitForImagesToLoad(container, callback) {
        const images = container.querySelectorAll("img");
        let loadedCount = 0;

        if (images.length === 0) {
            callback(); // tidak ada gambar, langsung callback
            return;
        }

        images.forEach(img => {
            if (img.complete && img.naturalHeight !== 0) {
                loadedCount++;
                if (loadedCount === images.length) callback();
            } else {
                img.onload = img.onerror = () => {
                    loadedCount++;
                    if (loadedCount === images.length) callback();
                };
            }
        });
    }

    document.getElementById("download-png").addEventListener("click", function () {
        const invoiceElement = document.getElementById("invoice-area");

        // Tambahkan kelas khusus jika ingin ubah tampilan download
        invoiceElement.classList.add("download-mode");

        // Tunggu semua gambar selesai load + tambahkan delay
        waitForImagesToLoad(invoiceElement, () => {
            setTimeout(() => {
                html2canvas(invoiceElement, {
                    scale: 2,
                    useCORS: true,
                    scrollY: -window.scrollY,
                }).then(function (canvas) {
                    const link = document.createElement("a");
                    link.download = "tagihan-{{ now()->format('YmdHis') }}.png";
                    link.href = canvas.toDataURL("image/png");
                    link.click();

                    invoiceElement.classList.remove("download-mode");
                });
            }, 500); // delay opsional 500ms
        });
    });
</script>




</body>


</html>
