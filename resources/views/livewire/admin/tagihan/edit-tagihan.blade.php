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
                <div class="card-body">
                    <div class="mb-3">
                        @foreach ($pesananItems as $index => $item)
                            <div class="row mb-3">
                                 <input type="hidden" wire:model="pesananItems.{{ $index }}.items_id"
                                        class="form-control" readonly>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Barang</label>
                                    <input type="text" wire:model="pesananItems.{{ $index }}.barang_nama"
                                        class="form-control" readonly>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">Deskripsi</label>
                                    <input type="text" wire:model="pesananItems.{{ $index }}.deskripsi"
                                        class="form-control">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label">Panjang</label>
                                    <input type="number" wire:model.live="pesananItems.{{ $index }}.panjang"
                                        class="form-control" step="any"
                                        {{ $item['satuan'] === 'Meter' ? '' : 'disabled' }}>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label">Lebar</label>
                                    <input type="number" wire:model.live="pesananItems.{{ $index }}.lebar"
                                        class="form-control" step="any"
                                        {{ $item['satuan'] === 'Meter' ? '' : 'disabled' }}>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label">Qty</label>
                                    <input type="number" wire:model.live="pesananItems.{{ $index }}.jumlah"
                                        class="form-control" min="1">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label">Harga</label>
                                    <input type="number" wire:model="pesananItems.{{ $index }}.harga_satuan"
                                        class="form-control" readonly>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Total</label>
                                    <input type="number" wire:model="pesananItems.{{ $index }}.subtotal"
                                        class="form-control" readonly>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label">Aksi</label>
                                    <div class="d-flex gap-1">
                                        <a wire:click.prevent="updatePesananItem({{ $index }})"
                                            class="btn btn-sm btn-primary form-control"><i
                                                class="las la-save text-white font-16"></i></a>
                                        <a wire:click.prevent="confirmDelete({{ $index }})"
                                            class="btn btn-sm btn-danger form-control">
                                            <i class="las la-trash text-white font-16"></i>
                                        </a>

                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if ($modalConfirmDelete)
            <div class="modal d-block fade show" style="background-color: rgba(0,0,0,0.5);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" wire:click="$set('modalConfirmDelete', false)" class="btn-close"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus item ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="$set('modalConfirmDelete', false)"
                                class="btn btn-secondary">
                                Batal
                            </button>
                            <button type="button" wire:click="hapus" class="btn btn-danger">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
