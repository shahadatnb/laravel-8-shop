@extends('admin.layouts.layout')
@section('title',"Dashboard")
@section('css')
{{--     <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">--}}
@endsection
@section('content')

<div class="row d-flex justify-content-center">
  @if(Auth::user()->hasAnyRole(['staff','admin']))
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
        <h3>{{ $dashboard['total-products'] }}</h3>

          <p>Total Products</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{route('product.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $dashboard['total-orders'] }}</h3>

          <p>Total Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{route('order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    @endif
  </div>
@if(Auth::user()->hasAnyRole(['staff','admin']))
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Order last 12 month</h3>
{{--                    <a href="javascript:void(0);">View Report</a>--}}
                </div>
            </div>
            <div class="card-body">
                {{--
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">$18,230.00</span>
                        <span>Sales Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                          <i class="fas fa-arrow-up"></i> 33.1%
                        </span>
                        <span class="text-muted">Since last Year</span>
                    </p>
                </div>
                <!-- /.d-flex -->
                --}}
                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
              <span class="mr-2">
                <i class="fas fa-square text-primary"></i> This month
              </span>
{{--                <span>--}}
{{--                <i class="fas fa-square text-gray"></i> Last year--}}
{{--              </span>--}}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Order last month</h3>
                {{-- <a href="javascript:void(0);">View Report</a> --}}
              </div>
            </div>
            <div class="card-body">
                {{--}}
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">820</span>
                  <span>Visitors Over Time</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <i class="fas fa-arrow-up"></i> 12.5%
                  </span>
                  <span class="text-muted">Since last week</span>
                </p>
              </div>
              <!-- /.d-flex -->
              --}}
              <div class="position-relative mb-4">
                <canvas id="visitors-chart" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> This month
                </span>

                {{-- <span>
                  <i class="fas fa-square text-gray"></i> Last Week
                </span> --}}
              </div>
            </div>
          </div>
          <!-- /.card -->
        {{--
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Products Sold last month</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Sales</th>
                        <th>More</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)                            
                        <tr>
                            <td>
                                {{-- <img src="dist/img/default-150x150.png" alt="" class="img-circle img-size-32 mr-2"> 
                                Some Product
                            </td>
                            <td>$13 USD</td>
                            <td>
                                <small class="text-success mr-1">
                                    <i class="fas fa-arrow-up"></i>
                                    12%
                                </small>
                                12,000 Sold
                            </td>
                            <td>
                                <a href="#" class="text-muted">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
        --}}
    </div>
</div>
@endif

@endsection
@section('js')
    <script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"> </script>
    <script>
      
    </script>
@endsection

