@props(['placeholder'])
<div>
    <div class="mb-3 position-relative" style="max-width: 300px;">
        <input type="text" class="form-control pe-5" placeholder="Cari {{$placeholder}}..."
            wire:model.live.debounce.300ms="search">

        <!-- Loading spinner -->
        <div wire:loading wire:target="search" class="position-absolute top-50 end-0 translate-middle-y me-2">
            <div class="spinner-border spinner-border-sm text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
