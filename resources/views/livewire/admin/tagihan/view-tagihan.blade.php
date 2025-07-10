<div>
    <style>
        @media print {
            @page {
                /* size: A4; */
                margin: 1cm;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                background: white !important;
                color: black !important;
            }

            * {
                background: white !important;
                color: black !important;
                box-shadow: none !important;
                text-shadow: none !important;
            }

            .card,
            .card-body,
            .table,
            .table-bordered,
            .table-light,
            .bg-light {
                background-color: white !important;
                color: black !important;
            }

            img {
                filter: grayscale(100%);
            }

            .td-total {
                border: none !important;
            }

            .badge,
            .text-muted,
            .text-dark,
            .fw-semibold {
                color: black !important;
            }

            .fix-border {
                background-color: white !important;
                color: black !important;
            }

            /* .table th, */
            .table .fix-border {
                border-color: #000 !important;
                border: 1px solid #000 !important;
                background-color: #fff !important;
                border-radius: 0 !important;
            }



            .no-print {
                display: none !important;
            }

            #invoice-area {
                background-color: white;
                border: 1px solid #ccc;
                font-family: Arial, sans-serif;
                page-break-inside: avoid;
            }

            table,
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
                download-mode
            }

            .signature-block {
                width: 100% !important;
            }

        }

        .download-mode,
        .download-mode * {
            background: white !important;
            color: black !important;
            box-shadow: none !important;
            text-shadow: none !important;
            border-color: black !important;
            filter: none !important;
        }

        .download-mode img {
            filter: grayscale(100%) !important;
        }

        .download-mode table {
            border-collapse: collapse !important;
            border-radius: 0 !important;
        }

        .download-mode .td-total {
            border: none !important;
        }

        .download-mode td,
        .download-mode th {
            border: 1px solid #000 !important;
            background-color: #fff !important;
            border-radius: 0 !important;
        }
    </style>

    <div class="card " id="invoice-area">
        <div class="card-body bg-light rounded-top">
            <div class="row ">
                <div class="col-8 align-self-center d-flex gap-4">
                    <img src="https://media.istockphoto.com/id/1432952577/id/vektor/desain-logo-perusahaan-percetakan-dengan-warna-cyan-magenta-kuning-dan-hitam.jpg?s=612x612&w=0&k=20&c=OPutJqOKVHyEjl_AY_mQUBGhI-oB5UnKUkim1vX9cRE="
                        alt="logo-small" class="logo-sm me-1" height="70">
                    <div class=" text-start ">
                        <h4 class="mb-1 fw-semibold text-black"><span class="text-muted">Amanah Printing</h4>
                        <h5 class="mb-1 fw-semibold text-black"><span class="text-muted">Jl. Menteng No. 22
                                Kota Medan</h5>
                        <p class="mb-1 fw-semibold text-black"><span class="text-muted">Telp : 0822487584758
                        </p>
                    </div><!--end col-->
                </div><!--end col-->

                <div class="col-4 align-self-center">
                    <h1 class="text-center fw-bold" style="font-style: italic">FAKTUR PENJUALAN</h1>
                </div>

            </div><!--end row-->
        </div><!--end card-body-->
        <div class="card-body">
            <div class="row row-cols-3 d-flex justify-content-md-between">
                <div class="col-md-3 d-print-flex align-self-center">
                    <div class="">
                        <address class="fs-13">
                            <strong class="fs-14">
                                Invoice:</span>
                                {{ $invoice }} <br>

                            </strong>
                            <span>Date:</span> {{ $tanggal }}<br>
                            Sales : {{ $dataPelanggan->sales->nama ?? '' }}</span>
                        </address>
                    </div>
                </div><!--end col-->
                <div class="col-md-3 d-print-flex align-self-center">
                    <div class="">
                        <span class="badge rounded text-dark bg-light">Kepada Yth</span>
                        <h5 class="my-1 fw-semibold fs-18">{{ $dataPelanggan->nama ?? '[No_Name]' }}
                        </h5>
                        <p class="text-muted ">Telp: {{ $dataPelanggan->telepon ?? '-' }}</p>
                    </div>
                </div><!--end col-->
                
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive project-invoice">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fix-border">Keterangan</th>
                                    <th class="fix-border text-center">Qty</th>
                                    <th class="fix-border">Harga Satuan</th>
                                    <th class="fix-border">Jumlah</th>
                                </tr><!--end tr-->
                            </thead>
                            <tbody>

                                @php $total = 0; @endphp
                                @foreach ($savedItems as $item)
                                    <tr>
                                        <td class="fix-border ">
                                            <h5 class="mt-0 mb-1 fs-14">{{ $item->deskripsi }}
                                            </h5>
                                        </td>
                                        <td class="fix-border text-center">{{ $item->jumlah }}</td>
                                        <td class="fix-border text-end">
                                            {{ number_format($item->harga_satuan, 0, ',', '.') }} </td>
                                        <td class="fix-border text-end">
                                            {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr><!--end tr-->
                                    @php $total += $item->subtotal; @endphp
                                @endforeach
                                <tr>
                                    {{-- <td colspan="4" style="height: 30px;"></td> --}}
                                </tr>

                                <!-- RINGKASAN TOTAL -->
                                <tr class="tr-total" style="border-bottom: none">
                                    <td class="td-total" colspan="2" rowspan="4" style="border: none"></td>
                                    <td class="td-total text-end" style="border: none"><strong>Total</strong></td>
                                    <td class="td-total text-end" style="border: none">
                                        {{ number_format($total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table><!--end table-->
                    </div> <!--end /div-->
                </div> <!--end col-->

                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="">Note :</h5>
                        <ul class="ps-3">
                            <li><small class="fs-12">Barang yang sudah diterima baik dan cukup</small>
                            </li>
                            <li><small class="fs-12">Note dianggap lunas apabila giro yang diterima telah
                                    dicairkan</small></li>
                            <li><small class="fs-12">uang panjar tidak dapat dikembalikan dengan alasan
                                    apapun</small></li>
                            <li><strong class="fs-12">Rek 1090-3445-45453-4545 - BRI <br>
                                    A.N Sawalinto</strong></li>
                        </ul>
                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-start mt-2 gap-5">
                            <div class="">
                                <div class="float-none float-md-end signature-block">
                                    <small>Hormat Kami</small>
                                    {{-- <img src="assets/images/extra/signature.png" alt="" class="mt-2 mb-1"
                                            height="24"> --}}
                                    <p class="border-top mt-5">Signature</p>
                                </div>
                            </div>
                            <div class="">
                                <div class="float-none float-md-end signature-block">
                                    <small>Diterima Oleh</small>
                                    <p class="border-top mt-5">Signature</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--end row-->
            </div><!--end row-->
        </div>
    </div>
    <div class="row d-flex justify-content-end mb-3 no-print">
        <div class="col-lg-12 col-xl-4">
            <div class="float-end d-print-none mt-2 mt-md-0">
                <a href="javascript:window.print()" class="btn btn-info ">Print</a>
                <a href="javascript:void(0)" class="btn btn-primary" id="download-png">Download PNG</a>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</div>
