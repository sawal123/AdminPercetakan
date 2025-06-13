<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <button type="button" wire:click='modalB' class="btn btn-primary">Buat Tagihan</button>
                    {{-- @if ($modalBarang)
                        @include('livewire.admin.barang.create')
                    @endif --}}
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Tagihan</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Barang</th>
                                    <th>Bahan</th>
                                    <th>Ukuran</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Harga Seller</th>
                                    <th>Harga Jual</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
