<div>
    @if (session()->has('message'))
        @script
            <script>
                $wire.on('showToast', () => {
                    toastr.success('{{ session('message') }}', 'Warning', {
                        positionClass: 'toast-top-right',
                        closeButton: true,
                        progressBar: true,
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        positionClass: "toast-top-right",
                    })
                })
            </script>
        @endscript
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent='simpan'>
                        <div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                    <select wire:model.live='pelanggan_id' class="form-control" required
                                        {{ $tagihan_id ? 'disabled' : '' }}>
                                        <option hidden>Pilih Pelanggan</option>
                                        @foreach ($pelanggan as $costumer)
                                            <option value="{{ $costumer->id }}">{{ $costumer->nama }} -
                                                {{ $costumer->seller ? 'Seller' : 'Non-seller' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="invoice" class="form-label">Invoice</label>
                                    <input wire:model="invoice" class="form-control" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" wire:model="tanggal" class="form-control" required
                                        {{ $tagihan_id ? 'disabled' : '' }}>
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <div class="row mb-3">
                                    <div class="col-md-2 mb-2">
                                        <label for="barang" class="form-label">Barang</label>
                                        <select wire:model.live="nama_barang" class="form-control" required
                                            {{ $disabled }}>
                                            <option hidden>Jenis Barang</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="text" wire:model='deskripsi' class="form-control"
                                            placeholder="sticker outdoor - 2x3">

                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label for="panjang" class="form-label">Panjang</label>
                                        <input type="number" wire:model.live="panjang" class="form-control"
                                            placeholder="Panjang" min="0" step="any" {{ $inputDisabled }}>
                                    </div>

                                    <div class="col-md-1 mb-2">
                                        <label for="lebar" class="form-label">Lebar</label>
                                        <input type="number" wire:model.live="lebar" class="form-control"
                                            placeholder="Lebar" min="0" step="any" {{ $inputDisabled }}>
                                    </div>

                                    <div class="col-md-1 mb-2">
                                        <label for="jumlah" class="form-label">Qty</label>
                                        <input type="number" wire:model.live="jumlah" class="form-control"
                                            placeholder="Jumlah" min="1">
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" wire:model="harga_satuan" class="form-control"
                                            placeholder="Harga Satuan" readonly>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <label for="total" class="form-label">Total</label>
                                        <input type="number" wire:model="subtotal" class="form-control"
                                            placeholder="Total" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Simpan Tagihan</button>
                            </div>
                            <hr>
                            {{-- </form> --}}
                        </div>
                    </form>
                </div>



            </div>
            {{-- @if ($savedItems->count()) --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body bg-light rounded-top">
                            <div class="row">
                                <div class="col-4 align-self-center">
                                    <img src="https://media.istockphoto.com/id/1432952577/id/vektor/desain-logo-perusahaan-percetakan-dengan-warna-cyan-magenta-kuning-dan-hitam.jpg?s=612x612&w=0&k=20&c=OPutJqOKVHyEjl_AY_mQUBGhI-oB5UnKUkim1vX9cRE="
                                        alt="logo-small" class="logo-sm me-1" height="70">
                                </div><!--end col-->
                                <div class="col-8 text-end align-self-center">
                                    <h5 class="mb-1 fw-semibold text-black"><span class="text-muted">Jl. Menteng No.
                                            22
                                            Kota Medan</h5>
                                    <p class="mb-1 fw-semibold text-black"><span class="text-muted">Telp :
                                            0822487584758
                                    </p>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div class="row row-cols-3 d-flex justify-content-md-between">
                                <div class="col-md-3 d-print-flex align-self-center">
                                    <div class="">
                                        <span class="badge rounded text-dark bg-light">Invoice to</span>
                                        <h5 class="my-1 fw-semibold fs-18">
                                            {{ $dataPelanggan->nama ?? '[No_Name]' }}
                                        </h5>
                                        <p class="text-muted ">{{ $dataPelanggan->telepon ?? '-' }}</p>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-3 d-print-flex align-self-center">
                                    <div class="">
                                        <address class="fs-13">
                                            <strong class="fs-14">
                                                Invoice:</span>
                                                {{ $invoice }} <br>
                                                Date:</span> {{ $tanggal }}<br>
                                                Sales : {{ $dataPelanggan->sales->nama ?? '' }}
                                            </strong>
                                        </address>
                                    </div>
                                </div><!--end col-->

                            </div><!--end row-->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive project-invoice">
                                        <table class="table table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <th>Qty</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Jumlah</th>
                                                </tr><!--end tr-->
                                            </thead>
                                            <tbody>

                                                @php $total = 0; @endphp
                                                @foreach ($savedItems as $item)
                                                    <tr>
                                                        <td>
                                                            <h5 class="mt-0 mb-1 fs-14">{{ $item->deskripsi }}
                                                            </h5>
                                                        </td>
                                                        <td>{{ $item->jumlah }}</td>
                                                        <td>{{ $item->harga_satuan }}</td>
                                                        <td>{{ $item->subtotal }}</td>
                                                    </tr><!--end tr-->
                                                    @php $total += $item->subtotal; @endphp
                                                @endforeach
                                                <tr class="">
                                                    <th colspan="1" class="border-0"></th>
                                                    <td colspan="2" class="border-0 fs-14"><b>Total</b>
                                                    </td>
                                                    <td class="border-0 fs-14"><b>Rp
                                                            {{ number_format($total, 0, ',', '.') }}</b></td>
                                                </tr><!--end tr-->
                                            </tbody>
                                        </table><!--end table-->
                                    </div> <!--end /div-->
                                </div> <!--end col-->
                            </div><!--end row-->

                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="mt-4">Note :</h5>
                                    <ul class="ps-3">
                                        <li><small class="fs-12">Barang yang sudah diterima baik dan cukup</small>
                                        </li>
                                        <li><small class="fs-12">Note dianggap lunas apabila giro yang diterima
                                                telah
                                                dicairkan</small></li>
                                        <li><small class="fs-12">uang panjar tidak dapat dikembalikan dengan
                                                alasan
                                                apapun</small></li>
                                        <li><strong class="fs-20">Rek 1090-3445-45453-4545 - BRI <br>
                                                A.N Sawalinto</strong></li>

                                    </ul>
                                </div> <!--end col-->
                                <div class="col-lg-3 align-self-center">
                                    <div class="float-none float-md-end" style="width: 30%;">
                                        <small>Hormat Kami</small>
                                        {{-- <img src="assets/images/extra/signature.png" alt="" class="mt-2 mb-1"
                                            height="24"> --}}
                                        <p class="border-top mt-5">Signature</p>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3 align-self-center">
                                    <div class="float-none float-md-end" style="width: 30%;">
                                        <small>Diterima Oleh</small>

                                        <p class="border-top mt-5">Signature</p>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                            <hr>
                            <div class="row d-flex justify-content-center">

                                <div class="col-lg-12 col-xl-4">
                                    <div class="float-end d-print-none mt-2 mt-md-0">
                                        <a href="javascript:window.print()" class="btn btn-info">Print</a>
                                        <a href="#" class="btn btn-primary">Submit</a>
                                        <a href="#" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            {{-- @endif --}}
        </div>
    </div>
</div>
