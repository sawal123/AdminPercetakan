<div>
     @if (session()->has('message'))
        @script
            <script>
                $wire.on('showToast', () => {
                    toastr.success('{{ session('message') }}', 'Success', {
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
                <div class="card-header d-flex justify-content-between">
                    <button type="button" wire:click='modalB' class="btn btn-primary">Tambah Barang</button>
                    @if ($modalBarang)
                        @include('livewire.admin.barang.create')
                    @endif
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Barang</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">

                    {{-- Search --}}
                    <div class="mb-3" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Cari kode atau nama barang..."
                            wire:model.live.debounce.300ms="search">
                    </div>


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
                                @forelse ($dataBarang as $index => $barang)
                                    <tr>
                                        <td>{{ $dataBarang->firstItem() + $index }}</td>
                                        <td>{{ $barang->kode }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>{{ $barang->bahan->nama ?? '-' }}</td>
                                        <td>{{ $barang->ukuran }}</td>
                                        <td>{{ $barang->satuan }}</td>
                                        <td>{{ $barang->stok }}</td>
                                        <td>Rp {{ number_format($barang->harga_seller) }}</td>
                                        <td>Rp {{ number_format($barang->harga) }}</td>
                                        <td class="text-end space-x-2">
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="bukaModal({{ $barang->id }})"><i
                                                    class="las la-pen text-dark font-16"></i></button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="konfirmasiHapus({{ $barang->id }})"><i
                                                    class="las la-trash-alt text-dark font-16"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Data tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $dataBarang->links() }}
                    </div>

                </div>
            </div>
        </div>


        @if ($modalConfirmDelete)
            <div class="modal d-block fade show" x-data="{ show: @entangle('modalConfirmDelete') }" x-show="show"
                x-transition:enter="animate__animated animate__fadeInDown"
                x-transition:leave="animate__animated animate__fadeOutUp" style="background-color: rgba(0,0,0,0.5);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" wire:click="$set('modalConfirmDelete', false)" class="btn-close"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus barang ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="$set('modalConfirmDelete', false)"
                                class="btn btn-secondary">Batal</button>
                            <button type="button" wire:click="hapus" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </div><!--end row-->
    <livewire:admin.bahan />
</div>
