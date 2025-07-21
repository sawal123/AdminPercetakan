<div>
    <x-toast  />
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <a href="/dashboard/tagihan/create" class="btn btn-primary" wire:navigate>Buat Tagihan</a>
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Tagihan</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <x-search placeholder="Tagihan" />
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tagihan as $index => $t)
                                    <tr>
                                        <td>{{ $tagihan->firstItem() + $index }}</td>
                                        <td>{{ $t->invoice }}</td>
                                        <td>{{ $t->pelanggan->nama ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</td>
                                        <td>{{ $t->pesananItems->sum('jumlah') ?? 0 }}</td>
                                        <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $t->status == 0 ? 'text-bg-danger' : 'text-bg-success' }}">
                                                {{ $t->status == 0 ? 'Belum Lunas' : 'Lunas' }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            @if ($t->status == 0)
                                                <a wire:click='lunas({{ $t->id }})'
                                                    class="btn btn-sm btn-warning"><i
                                                        class="las la-check text-white font-16"></i></a>
                                            @else
                                                <a wire:click='lunas({{ $t->id }})'
                                                    class="btn btn-sm btn-light border"><i
                                                        class="las la-redo-alt text-dark font-16"></i></a>
                                            @endif
                                            <a href="/dashboard/tagihan/view/{{ $t->invoice }}" wire:navigate
                                                class="btn btn-sm btn-success"><i
                                                    class="las la-eye text-white font-16"></i></a>


                                            @if ($t->status == 0)
                                                <a href="/dashboard/tagihan/edit/{{ $t->invoice }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="las la-pencil-alt text-white font-16"></i></a>
                                                <a wire:click="confirmDelete({{ $t->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="las la-trash-alt text-white font-16"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data tidak ditemukan.</td>
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
        <div class="modal d-block fade show" wire:transition.out.opacity.duration.200ms style="background-color: rgba(0,0,0,0.5);">
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
                        <button type="button" wire:click="$set('modalConfirmDelete', false)" class="btn btn-secondary">
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
