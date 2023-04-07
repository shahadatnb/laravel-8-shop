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
        $(function () {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode      = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            var salesChart  = new Chart($salesChart, {
                type   : 'bar',
                data   : {
                    labels  : [@foreach($orders as $order) '{{$order['months']}}', @endforeach],//['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                    datasets: [
                        {
                            backgroundColor: '#007bff',
                            borderColor    : '#007bff',
                            data           : [@foreach($orders as $order) '{{$order['sums']}}', @endforeach]
                        }/*,
                        {
                            backgroundColor: '#ced4da',
                            borderColor    : '#ced4da',
                            data           : [700, 1700, 2700, 2000, 1800, 1500, 2000]
                        }*/
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips           : {
                        mode     : mode,
                        intersect: intersect
                    },
                    hover              : {
                        mode     : mode,
                        intersect: intersect
                    },
                    legend             : {
                        display: false
                    },
                    scales             : {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display      : true,
                                lineWidth    : '4px',
                                color        : 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks    : $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function (value, index, values) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return '$' + value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display  : true,
                            gridLines: {
                                display: false
                            },
                            ticks    : ticksStyle
                        }]
                    }
                }
            });
        


  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : [@foreach($orders_last_month as $order) '{{$order['days']}}', @endforeach],//['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type                : 'line',
        data                : [@foreach($orders_last_month as $order) '{{$order['sums']}}', @endforeach],
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },/*
        {
          type                : 'line',
          data                : [60, 80, 70, 67, 80, 77, 100],
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }*/
        ]
        
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  });

});

    </script>
@endsection

