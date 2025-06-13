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
                    <button type="button" wire:click='modal' class="btn btn-primary">Tambah Bahan</button>
                    @if ($openModal)
                        @include('livewire.admin.barang.createBahan')
                    @endif
                    <div class="row align-items-center">
                        <div class="col">Bahan</h4>
                        </div><!--end col-->
                    </div> <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td class="text-end">
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="edit({{ $item->id }})"><i
                                                    class="las la-pen text-dark font-16"></i></button>
                                            <button class="btn btn-sm btn-danger"
                                                wire:click="confirmDelete({{ $item->id }})"><i
                                                    class="las la-trash-alt text-dark font-16"></i></button>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table><!--end /table-->
                    </div><!--end /tableresponsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!--end col-->
        @if ($confirmingDelete)
            <div class="modal d-block fade show" style="background-color: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-dialog-top">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" wire:click="$set('confirmingDelete', false)"
                                class="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary"
                                wire:click="$set('confirmingDelete', false)">Batal</button>
                            <button class="btn btn-danger" wire:click="delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div><!--end row-->
</div>
