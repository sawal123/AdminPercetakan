<style>
    .form-control::placeholder {
        color: #424242;
        /* atau warna sesuai kebutuhan */
    }
</style>
<div class="modal d-block fade show" tabindex="-1" role="dialog" x-data="{ show: @entangle('modalBarang') }" x-show="show"
    x-transition:enter="animate__animated animate__fadeInDown" x-transition:leave="animate__animated animate__fadeOutUp"
    style="background-color: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $barangId ? 'Edit Barang' : 'Tambah Barang' }}</h5>

                <button type="button" wire:click="$set('modalBarang', false)" class="btn-close"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent='simpan'>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="mb-3 row align-items-center">
                                <label for="kode" class="col-sm-2 col-form-label text-end">Kode</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="kode" wire:model="kode" type="text"
                                        placeholder="K102">
                                </div>

                                <label for="barang" class="col-sm-2 col-form-label text-end">Nama Barang</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="barang" wire:model="barang" type="text"
                                        placeholder="Nama Barang">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label text-end" for="bahan">Pilih Bahan</label>
                                <div class="col-sm-10">

                                    <select class="form-select" id="bahan" aria-label="Default select example"
                                        wire:model='bahan'>
                                        <option value="" hidden selected>Pilih Bahan</option>
                                        @foreach ($dataBahan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ukuran" class="col-sm-2 col-form-label text-end">Ukuran</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="ukuran" wire:model='ukuran' type="text">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label text-end" for="satuan">Pilih Satuan</label>
                                <div class="col-sm-10">

                                    <select class="form-select" id="bahan" aria-label="Default select example"
                                        wire:model.live='satuan'>
                                        <option value="" hidden selected>Pilih Satuan</option>
                                        @foreach ($dataSatuan as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <div wire:ignore.self>
                                        Satuan dipilih: {{ $satuan }}
                                    </div> --}}
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="stok" class="col-sm-2 col-form-label text-end">Stok</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="stok" wire:model='stok' type="number">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label for="harga" class="col-sm-2 col-form-label text-end">Harga</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="harga" wire:model='harga' type="number">
                                </div>
                                <label for="harga_seller" class="col-sm-2 col-form-label text-end">Harga Seller</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="harga_seller" wire:model='harga_seller' type="number">
                                </div>
                            </div>



                        </div> <!--end col-->
                    </div><!--end row-->

                    <div class="modal-footer">
                        <button type="button" wire:click="$set('modalBarang', false)"
                            class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary">{{ $barangId ? 'Perbarui' : 'Simpan' }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
