<div>
    <div wire:loading  wire:target="sendMail">
        @include('admin/layouts/_loading')
    </div>

    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle">Create <span>Account</span></h4>
                <h3 class="pt-5">Some representative placeholder content for the first slide content for the. Some representative placeholder content for the first slide content for the.</h3>
            </div>
        </div>
    </div>

  
    <div class="container">
        <form wire:submit.prevent="sendMail">
        @if(session()->has('success'))
            <div class="alert alert-success">
                <strong>Success: </strong>{{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('warning'))
            <div class="alert alert-warning">
                <strong>Warning: </strong>{{ session()->get('warning') }}
            </div>
        @endif
        <div class="row justify-content-center _bottom_space">
            <div class="col-md-5 col-lg-5">
                <div class="form-group">
                    <input type="text" class="form-control @error('clubName') is-invalid @enderror" wire:model="clubName" id="clubName"  aria-describedby="Name" placeholder="Club Name">
                    @error('clubName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" id="email" aria-describedby="Email" placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" id="phone" aria-describedby="Phone" placeholder="Phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" wire:model="subject" id="subject" aria-describedby="Subject" placeholder="Subject">
                    @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


            </div>


            <div class="col-md-5 col-lg-5">
                <div class="form-group">

                    <input type="text" class="form-control @error('contactPerson') is-invalid @enderror" wire:model="contactPerson" id="contactPerson" aria-describedby="contactPerson" placeholder="Contact Person">
                    @error('contactPerson')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <textarea class="form-control @error('message') is-invalid @enderror" wire:model="message" id="message" rows="3" placeholder="Message"></textarea>
                    @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>
        </div>

        <div class="row justify-content-center _bottom_space">
            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                <div class="_input_capcha flex @error('message') is-invalid @enderror">
                    <div class="">
                        <input type="text" readonly class="form-va" value="{{$c1st}}">
                    </div>
                    <div class="">
                        <input type="text" readonly class="form-op" value="+">
                    </div>
                    <div class="">
                        <input type="text" readonly class="form-va" value="{{ $c2nd }}">
                    </div>
                    <div class="">
                        <input type="text" readonly class="form-op" value="=">
                    </div>
                    <div class="">
                        <input type="text" class="form-re" wire:model="captcha">
                    </div>
                </div>
                @error('captcha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-xs-6 col-sm-6 col-md-5 col-lg-5">
                <div class="_sendbtn">
                    <button type="submit" class="btn btn-primary btn_sub">Send <img src="{{asset('/assets/front')}}/img/Submit.png"></button>
                </div>
            </div>
        </div>

        </form>

    </div>
</div>
