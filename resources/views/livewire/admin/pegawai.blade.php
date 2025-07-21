<div>
    <x-toast />

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <button type="button" wire:click='openModal' class="btn btn-primary">Tambah Pegawai</button>
                    @if ($modalPegawai)
                        @include('livewire.admin.pegawai.createPegawai')
                    @endif
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Pegawai</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <x-search placeholder="pegawai" />

                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Posisi</th>
                                    <th>Is_Active</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pegawai as $index=>$item)
                                    <tr wire:key='pegawai-{{$item->id}}'>
                                        <td>{{ ($pegawai->currentPage() - 1) * $pegawai->perPage() + $index + 1 }}
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ $item->posisi->nama_posisi }}</td>

                                        <td><span
                                                class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }} ">{{ $item->is_active ? 'Active' : 'Non Active' }}</span>
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
                        <div class="mt-4">
                            {{ $pegawai->links('pagination::bootstrap-5', data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($modalConfirmDelete)
        <div class="modal d-block fade show" wire:transition.out.opacity.duration.200ms
            style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" wire:click="$set('modalConfirmDelete', false)" class="btn-close"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus pegawai ini?</p>
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

