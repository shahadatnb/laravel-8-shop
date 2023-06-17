<div
    x-data="{ isUploading: false, progress: 0 }"
    x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
>

    <div wire:loading wire:target="save">
        @include('admin/layouts/_loading')
    </div>

    <div class="card card-outline">
        <div class="card-body">
            <div class="row">
                @foreach ($product->allphotos as $item)
                <div class="col-4 col-lg-3">
                    <i class="fas fa-photo-video image-thumb" wire:click="makeThumb({{$item->id}})"></i>
                    <i class="fas fa-times-circle imaage-remove" wire:click="phoroRemove({{$item->id}})"></i>                    
                    <img class="img-thumbnail {{$thumbnail==1? 'select-thum':''}}" src="{{ asset('storage/' . $item->path) }}" alt="">
                </div>
                @endforeach
            </div>
            <div class="row">
                @if ($photos)
                    <div class="col-12"><p>Photo Preview</p></div>
                    @foreach($photos as $photo)
                    <div class="col-4 col-lg-3" wire:key="{{$loop->index}}">
                        <i class="fas fa-times-circle imaage-remove"
                            wire:click="tempPhotoRemove({{$loop->index}})"></i>
                        <div class="flex justify-center">
                            <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail">
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>

            <div class="form-group">
                <input x-ref="fileInput" type="file" multiple wire:model="photos" accept="image/*" class="hidden" />
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>
                @error('photos.*') <span class="error invalid-feedback d-block">{{ $message }}</span> @enderror
                <button type="button"  wire:click="save()" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
      {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
      </button> --}}
      <!-- Modal wire:ignore.self  -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="save">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        {{-- <label for="_media" class="form-label">Media</label>
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                        <input wire:model="photo" id="_media" name="photo" type="file" accept="image/*" > --}}
                        {{-- multiple --}}
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button"  wire:click="save()" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

@section('js2')
    <script>
        //$('input[type="file"]').imageuploadify();
        //$('.imageupload').imageuploadify();
    </script>
@endsection
