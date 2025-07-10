<style>
    .form-control::placeholder {
        color: #424242;
        /* atau warna sesuai kebutuhan */
    }
</style>
<div class="modal d-block fade show" tabindex="-1" role="dialog" x-data="{ show: @entangle('modalPelanggan') }" x-show="show"
    x-transition:enter="animate__animated animate__fadeInDown" x-transition:leave="animate__animated animate__fadeOutUp"
    style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $pelangganId ? 'Edit Barang' : 'Tambah Barang' }}</h5>
                <button type="button" wire:click="$set('modalPelanggan', false)" class="btn-close"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='simpan'>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label text-end">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="nama" wire:model='nama' type="text">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telepon" class="col-sm-2 col-form-label text-end">No Hp</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="telepon" wire:model='telepon' type="number"
                                placeholder="08225656xxxx" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="telepon" class="col-sm-2 col-form-label text-end">Alamat</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="telepon" wire:model='alamat' type="text"
                                placeholder="Jl. Medan" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="sales" class="col-sm-2 col-form-label text-end">Sales</label>
                        <div class="col-sm-10">
                            <select wire:model.live='sales_id' class="form-control" id="sales" required>
                                <option hidden>Pilih Sales</option>
                                @foreach ($sales as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" value=""
                                id="flexCheckDefaultdemo" wire:model='seller'>
                            <label class="form-check-label" for="flexCheckDefaultdemo">
                                Seller?
                            </label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="$set('modalPelanggan', false)"
                            class="btn btn-secondary">Batal</button>
                        <button type="submit"
                            class="btn btn-primary">{{ $pelangganId ? 'Perbarui' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
