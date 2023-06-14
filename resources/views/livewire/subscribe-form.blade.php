<div>
    <div wire:loading  wire:target="save">
        @include('admin/layouts/_loading')
    </div>

    <div class="_input_news">
        @if(session()->has('ssuccess'))
            <div class="alert alert-success">
                <strong>Success: </strong>{{ session()->get('ssuccess') }}
            </div>
        @endif
            <form wire:submit.prevent="save">
                <div class="input-group position-relative">
                    <input type="email" class="_newscontrol @error('email') is-invalid @enderror w-100 py-1 px-3 border-0 position-relative rounded-pill" wire:model="email" placeholder="Enter Email">
                    <button type="submit" class="btn_newsl position-absolute end-0 top-0 rounded-pill py-1 px-3 border-0">Subscribe</button>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        </from>
    </div>
</div>
