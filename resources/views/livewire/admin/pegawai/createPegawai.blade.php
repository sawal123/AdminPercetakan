<style>
    .form-control::placeholder {
        color: #424242;
        /* atau warna sesuai kebutuhan */
    }
</style>
<div class="modal d-block fade show" tabindex="-1" role="dialog" wire:transition.out.opacity.duration.200ms
    style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $pegawaiId ? 'Edit Pegawai' : 'Tambah Pegawai' }}</h5>
                <button type="button" wire:click="$set('modalPegawai', false)" class="btn-close"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='simpan'>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model='nama' class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">No HP</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model='telepon' class="form-control" placeholder="08xxxx">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">Alamat</label>
                        <div class="col-sm-10">
                            <textarea wire:model="alamat" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" wire:model="birth" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">Gaji</label>
                        <div class="col-sm-10">
                            <input type="number" wire:model="salary" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">Posisi</label>
                        <div class="col-sm-10">
                            <select class="form-select" wire:model="posisi_id">
                                <option value="">-- Pilih Posisi --</option>
                                @foreach ($posisis as $posisi)
                                    <option value="{{ $posisi->id }}">{{ $posisi->nama_posisi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label text-end">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" wire:model='image'>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid mt-2"
                                    style="max-height: 150px;">
                            @elseif ($oldImage)
                                <img src="{{ asset('storage/' . $oldImage) }}" class="img-fluid mt-2"
                                    style="max-height: 150px;">
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" wire:model="is_active"
                                id="flexCheckDefaultdemo">
                            <label class="form-check-label" for="flexCheckDefaultdemo">
                                Active?
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="$set('modalPegawai', false)"
                            class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">{{ $pegawaiId ? 'Perbarui' : 'Simpan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
