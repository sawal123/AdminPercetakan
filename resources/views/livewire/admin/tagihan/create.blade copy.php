<div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <form wire:submit.prevent="store">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                    <select wire:model.live="pelanggan_id" class="form-control" required>
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach ($pelanggan as $costumer)
                                            <option value="{{ $costumer->id }}">{{ $costumer->nama }} -
                                                {{ $costumer->seller ? 'Seller' : 'Non-seller' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- {{$seller}} --}}
                                </div>

                                <div class="col-md-4">
                                    <label for="invoice" class="form-label">Invoice</label>
                                    <input wire:model="invoice" class="form-control" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" wire:model="tanggal" class="form-control" required>
                                </div>
                            </div>
                            <hr>

                            <div class="mb-3">
                                <label for="items" class="form-label">Items</label>
                                @foreach ($this->items as $index => $item)
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <select wire:model.live="items.{{ $index }}.nama_barang"
                                                class="form-control" required>
                                                <option value="">Jenis Barang</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" wire:model="items.{{ $index }}.deskripsi"
                                                class="form-control" placeholder="sticker outdoor - 2x3">
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" wire:model="items.{{ $index }}.panjang"
                                                class="form-control" placeholder="Panjang" min="0"
                                                step="any">
                                        </div>

                                        <div class="col-md-1">
                                            <input type="number" wire:model="items.{{ $index }}.lebar"
                                                class="form-control" placeholder="Lebar" min="0" step="any">
                                        </div>

                                        <div class="col-md-1">
                                            <input type="number" wire:model="items.{{ $index }}.jumlah"
                                                class="form-control" placeholder="Jumlah" min="1">
                                        </div>

                                        <div class="col-md-2">
                                            <input type="number" wire:model="items.{{ $index }}.harga_satuan"
                                                class="form-control" placeholder="Harga Satuan" readonly>
                                        </div>

                                        <div class="col-md-1">
                                            <input type="number" wire:model="items.{{ $index }}.subtotal"
                                                class="form-control" placeholder="Total" readonly>
                                        </div>

                                        <div class="col-md-1">
                                            <button type="button" wire:click="removeItem({{ $index }})"
                                                class="btn btn-danger"><i
                                                    class="las la-trash-alt text-dark font-16"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @if (count($this->items) < $this->maxItems)
                                <button type="button" wire:click="addItem" class="btn btn-primary mb-3">Tambah
                                    Item</button>
                            @endif

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Simpan Tagihan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        {{-- <form wire:submit.prevent="store"> --}}
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                    <select  wire:model='pelanggan_id' class="form-control" required>
                                        <option  hidden>Pilih Pelanggan</option>
                                        @foreach ($pelanggan as $costumer)
                                            <option value="{{ $costumer->id }}">{{ $costumer->nama }} -
                                                {{ $costumer->seller ? 'Seller' : 'Non-seller' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- {{$pel}} --}}
                                </div>

                                <div class="col-md-4">
                                    <label for="invoice" class="form-label">Invoice</label>
                                    <input wire:model="invoice" class="form-control" required readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" wire:model="tanggal" class="form-control" required>
                                </div>
                            </div>
                            <hr>

                            <div class="mb-3">
                                <label for="items" class="form-label">Items</label>

                                <div class="row mb-3">
                                    <div class="col-md-2 mb-2">
                                        <select wire:model.live="nama_barang" class="form-control" required>
                                            <option value="">Jenis Barang</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <input type="text" wire:model='deskripsi' class="form-control"
                                            placeholder="sticker outdoor - 2x3">
                                            {{$tes}}
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <input type="number" wire:model="panjang" class="form-control"
                                            placeholder="Panjang" min="0" step="any">
                                    </div>

                                    <div class="col-md-1 mb-2">
                                        <input type="number" wire:model="lebar" class="form-control"
                                            placeholder="Lebar" min="0" step="any">
                                    </div>

                                    <div class="col-md-1 mb-2">
                                        <input type="number" wire:model="jumlah" class="form-control"
                                            placeholder="Jumlah" min="1">
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <input type="number" wire:model="harga_satuan" class="form-control"
                                            placeholder="Harga Satuan" readonly>
                                    </div>

                                    <div class="col-md-1 mb-2">
                                        <input type="number" wire:model="subtotal" class="form-control"
                                            placeholder="Total" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Simpan Tagihan</button>
                            </div>
                            <hr>
                        {{-- </form> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
