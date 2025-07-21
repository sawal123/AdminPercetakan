<div class="modal d-block fade show" tabindex="-1" role="dialog" wire:transition.out.opacity.duration.200ms
    style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Bahan</h5>
                <button type="button" wire:click="$set('openModal', false)" class="btn-close"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent='{{ $isEdit ? 'update' : 'simpan' }}'>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-2 col-form-label text-end">Nama
                                    Bahan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" wire:model='nama' id="example-text-input">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-text-input"
                                    class="col-sm-2 col-form-label text-end">Deskripsi</label>
                                <div class="col-sm-10">
                                    <div class="form-floating">
                                        <textarea class="form-control" wire:model='deskripsi' id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Deskripsi</label>
                                    </div>
                                </div>
                            </div>
                        </div> <!--end col-->
                    </div><!--end row-->
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('openModal', false)"
                        class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
