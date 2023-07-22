@extends('frontend.layouts.master')
@section('title','Customer Profile')
@section('css')
<link rel="stylesheet" href="{{asset('assets/front/css/inner_product.css')}}" media="all">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
<section class="_inner_page_banner" {{--style="background-image: url()"--}}>
  <div class="container">
      <div class="_in_title_text">
          <h1>{{ auth('customer')->user()->first_name }} {{ auth('customer')->user()->last_name }}</h1>
      </div>
  </div>
</section>
<section class="_sub_nav">
  <div class="container">
      <div class="_nav_product_view">
          <nav>
              <ul>
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li><a href="#">Profile</a></li>
              </ul>
          </nav>
      </div>
  </div>
</section>

<!--    Our Product -->
<section class="_store_by_team">
  <div class="container-fluid">
      <div class="row justify-content-center">
          <div class="col-md-3 col-lg-3">
                @include('frontend.customer.menu')
          </div>

          <div class="col-md-8 col-lg-8 profile">
						{!! Form::model($user, ['route'=>['customer.profile.update',$user->id],'method'=>'POST','enctype'=>'multipart/form-data','class'=>'form-horizontal']) !!}
						<h2 class="text-center">Update Your Profile</h2>
						@include('admin.layouts._message')
            <div class="row my-3">
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('first_name', 'First name',['class'=>'form-label']) !!}
                        {!! Form::text('first_name',null,['class'=>'form-control','required'=>'','placeholder'=>'First name']) !!}
                	</div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('last_name', 'Last name',['class'=>'form-label']) !!}
                        {!! Form::text('last_name',null,['class'=>'form-control','required'=>'','placeholder'=>'Last name']) !!}
                	</div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('email', 'Email',['class'=>'form-label']) !!}
                        {!! Form::email('email',null,['class'=>'form-control','required'=>'','placeholder'=>'Email']) !!}
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('date_of_birth', 'Date of birth',['class'=>'form-label']) !!}
                        {!! Form::date('date_of_birth',null,['class'=>'form-control','required'=>'']) !!}
                    </div>
                </div>

                 <div class="col-6">
                    <p class="ofb">Gender</p>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('gender', 'Male', null,['class'=>'form-check-input', 'id'=>'male']) !!}
                        {!! Form::label('male', 'Male',['class'=>'form-check-label']) !!}
                    </div>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('gender', 'Female', null,['class'=>'form-check-input', 'id'=>'female']) !!}
                        {!! Form::label('female', 'Female',['class'=>'form-check-label']) !!}
                    </div>
                </div>
                <div class="row address-info">
                <p class="ofb">Shipping Address</p>
                {{-- @dump($user->address) --}}
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('address1', 'House &amp; Road',['class'=>'form-label']) !!}
                        {!! Form::text('address1',null,['class'=>'form-control','required'=>'','placeholder'=>'House &amp; Road']) !!}
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('phone', 'Phone',['class'=>'form-label']) !!}
                        {!! Form::text('phone',null,['class'=>'form-control','required'=>'','placeholder'=>'Phone']) !!}
                	</div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('city', 'City',['class'=>'form-label']) !!}
                        {!! Form::text('city',null,['class'=>'form-control','required'=>'','placeholder'=>'City']) !!}
                	</div>
                </div>
                {{-- <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('country', 'State',['class'=>'form-label']) !!}
                        {!! Form::select('country',$countries,null,['class'=>'form-control select2','required'=>'','id'=>'country','placeholder'=>'Country','data-url'=>route('stateApi')]) !!}
                	</div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        {!! Form::label('state', 'State',['class'=>'form-label']) !!}
                        {!! Form::select('state',$states,null,['class'=>'form-control select2','required'=>'','id'=>'state','placeholder'=>'State']) !!}
                	</div>
                </div> --}}
                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::label('postcode', 'Zip',['class'=>'form-label']) !!}
                        {!! Form::text('postcode',null,['class'=>'form-control','required'=>'','placeholder'=>'Zip']) !!}
                	</div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" required type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            <p class="Privacytxt">By clicking Create account, I agree that I have read and accepted the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
                        </label>
                    </div>
                </div> --}}
                <div class="col-12 mt-3">
                    <div class="form-group">
                        {{ Form::submit('Update Profile', ['class'=>'btn btn-success btnCreate']) }}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
      </div>
  </div>
</section>
<!--    Our Product -->
@endsection

@section('js')
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function () {
            'use strict'
            $(document).ready(function() {
                $('.select2').select2();
                $('.select2-multi').select2();         //{ width: '300px' }
            });


        });

        $(document).ready(function(){
            $('.profile').on('click', '.btn-add-more-field', function() {
                var $clone = $( ".siblings" ).first().clone();
                $clone.find('input').val('');
                $clone.removeClass("disabled");
                $clone.insertBefore( ".address-info" );
            });

            $( ".profile" ).on("click", ".btn-remove-field", function(){
                $(this).closest('.siblings').remove();
            });
        });

        $('body').on('load | change', '#country', function() {
            $.get($(this).data('url'), {
                    option: $(this).val()
                },
                function(data) {
                    var subcat = $('#state');
                    subcat.empty();
                    subcat.append("<option value=''>Select State</option>")
                    $.each(data, function(index, element) {
                        subcat.append("<option value='"+ element.name +"'>" + element.name + "</option>");
                    });
                });
        });
    </script>
@endsection
