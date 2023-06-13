<section class="_why-us text-center">
    @php $why_us_center = CustomHelper::posts(['post_type'=>'why-us','cat'=>['center'],'single'=>true,'orderBy'=>'id']) @endphp
    @if($why_us_center)
    <div class="container-fluid px-sm-5">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="sectionTitle"><span>{{ $why_us_center->title }}</span></h4>
                <h3 class="pt-5">{!! $why_us_center->body !!}</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-4 col-lg-4">
                @php $why_us = CustomHelper::posts(['post_type'=>'why-us','cat'=>['left'],'take'=>3,'orderBy'=>'sort']) @endphp
                @if($why_us)
                @foreach($why_us as $key=>$item)
                <div class="_text_title">
                    <div class="title_left_image">
                        <h3>{{ $item->title }}</h3>
                        <figure>
                            <!-- <img src="{{asset('storage/'.$item->image)}}" alt=""> -->
                            <img src="assets\front\img\FACILITIES.png" class="img-fluid" alt="Company Logo">
                        </figure>
                    </div>
                    <div class="_club_text">
                        {!! $item->body !!}
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="col-md-4 col-lg-4">
                <figure>
                    <!-- <img class="img-fluid" src="{{asset('storage/'.$why_us_center->image)}}" alt=""> -->
                    <img src="assets\front\img\Why-Us.jpg" class="img-fluid" alt="Company Logo">
                </figure>
            </div>

            <div class="col-md-4 col-lg-4">
                @php $why_us = CustomHelper::posts(['post_type'=>'why-us','cat'=>['right'],'take'=>3,'orderBy'=>'sort']) @endphp
                @if($why_us)
                @foreach($why_us as $key=>$item)
                <div class="_text_title">
                    <div class="title_left_image">
                        <h3>{{ $item->title }}</h3>
                        <figure>
                            <!-- <img src="{{asset('storage/'.$item->image)}}" alt=""> -->
                            <img src="assets\front\img\LESSONS-FOR-ALL-AGES.png" class="img-fluid" alt="Company Logo">
                        </figure>
                    </div>
                    <div class="_club_text">
                        {!! $item->body !!}
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @endif
</section>