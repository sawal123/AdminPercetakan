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
                    <button type="button" wire:click='openModal' class="btn btn-primary">Tambah Pelanggan</button>
                    @if ($modalPelanggan)
                        @include('livewire.admin.pelanggan.modalCreate')
                    @endif
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Pelanggan</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Seller</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pelanggan as $index=>$item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td><span
                                                class="badge {{ $item->seller ? 'bg-success' : 'bg-danger' }} ">{{ $item->seller ? 'Seller' : 'Non Seller' }}</span>
                                        </td>
                                        <td class="text-end space-x-2"><button class="btn btn-sm btn-primary"
                                                wire:click="openModal({{ $item->id }})"><i
                                                    class="las la-pen text-dark font-16"></i></button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="konfirmasiHapus({{ $item->id }})"><i
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
                        <p>Apakah Anda yakin ingin menghapus pelanggan ini?</p>
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

</div>
