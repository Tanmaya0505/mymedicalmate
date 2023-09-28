@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Dashboard Ecommerce')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row">
      <div class="col-xl-12 col-12 dashboard-users">
        <div class="row  ">
          <!-- Statistics Cards Starts -->
          <div class="col-12">
            <div class="row">
              <div class="col-sm-3 col-12 dashboard-users-success">
                <div class="card text-center">
                  <div class="card-content">
                    <div class="card-body py-1">
                      <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                        <i class="fal fa-users-medical font-medium-5"></i>
                      </div>
                      <div class="text-muted line-ellipsis" title="Total Medical Mate">Total Medical Mate</div>
                      <h3 class="mb-0">{{ (new \App\Helpers\CustomerHelper)->noOfAssistant() }}</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-12 dashboard-users-success">
                <div class="card text-center">
                  <div class="card-content">
                    <div class="card-body py-1">
                      <div class="badge-circle badge-circle-lg badge-circle-light-secondary mx-auto mb-50">
                        <i class="fal fa-capsules font-medium-5"></i>
                      </div>
                      <div class="text-muted line-ellipsis" title="Total Vendor">Total Vendor</div>
                      <h3 class="mb-0">{{ (new \App\Helpers\CustomerHelper)->noOfVendor() }}</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-12 dashboard-users-danger">
                <div class="card text-center">
                  <div class="card-content">
                    <div class="card-body py-1">
                      <div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto mb-50">
                        <i class="far fa-user-alt font-medium-5"></i>
                      </div>
                      <div class="text-muted line-ellipsis" title="Total Users">Total Users</div>
                      <h3 class="mb-0">{{ (new \App\Helpers\CustomerHelper)->noOfUser() }}</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 col-12 dashboard-users-warning">
                <div class="card text-center">
                  <div class="card-content">
                    <div class="card-body py-1">
                      <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto mb-50">
                        <i class="fal fa-user-md font-medium-5"></i>
                      </div>
                      <div class="text-muted line-ellipsis" title="Total Doctor">Total Doctor</div>
                      <h3 class="mb-0">{{ (new \App\Helpers\CustomerHelper)->noOfDoctor() }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Revenue Growth Chart Starts -->
        </div>
      </div>
    </div>
<!--    <div class="row">
       Marketing Campaigns Starts 
      <div class="col-xl-12 col-12 dashboard-marketing-campaign">
        <div class="card marketing-campaigns">
          <div class="card-header d-flex justify-content-between align-items-center pb-1">
            <h4 class="card-title">Marketing campaigns</h4>
            <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
          </div>
          <div class="card-content">
            <div class="card-body pb-0">
              <div class="row">
                <div class="col-md-9 col-12">
                  <div class="d-inline-block">
                     chart-1   
                    <div class="d-flex market-statistics-1">
                       chart-statistics-1 
                      <div id="donut-success-chart"></div>
                       data 
                      <div class="statistics-data my-auto">
                        <div class="statistics">
                          <span class="font-medium-2 mr-50 text-bold-600">25,756</span><span
                            class="text-success">(+16.2%)</span>
                        </div>
                        <div class="statistics-date">
                          <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                          <small class="text-muted">May 12, 2019</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-inline-block">
                     chart-2 
                    <div class="d-flex mb-75 market-statistics-2">
                       chart statistics-2 
                      <div id="donut-danger-chart"></div>
                       data-2 
                      <div class="statistics-data my-auto">
                        <div class="statistics">
                          <span class="font-medium-2 mr-50 text-bold-600">5,352</span><span
                            class="text-danger">(-4.9%)</span>
                        </div>
                        <div class="statistics-date">
                          <i class="bx bx-radio-circle font-small-1 text-success mr-25"></i>
                          <small class="text-muted">Jul 26, 2019</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-12 text-md-right">
                  <button class="btn btn-sm btn-primary glow mt-md-2 mb-1">View Report</button>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
             table start 
            <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
              <thead>
                <tr>
                  <th>Campaign</th>
                  <th>Growth</th>
                  <th>Charges</th>
                  <th>Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="{{asset('images/icon/fs.png')}}" alt="card" height="24"
                      width="24">Fastrack Watches
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>30%</span>
                  </td>
                  <td class="py-1">$5,536</td>
                  <td class="text-success py-1">Active</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span
                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="{{asset('images/icon/puma.png')}}" alt="card" height="24"
                      width="24">Puma Shoes
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>15.5%</span>
                  </td>
                  <td class="py-1">$1,569</td>
                  <td class="text-success py-1">Active</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span
                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="{{asset('images/icon/nike.png')}}" alt="card" height="24"
                      width="24">Nike Air Jordan
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>70.30%</span>
                  </td>
                  <td class="py-1">$23,859</td>
                  <td class="text-danger py-1">Closed</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span
                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="{{asset('images/icon/one-plus.png')}}" alt="card"
                      height="24" width="24">Oneplus 7 pro
                  </td>
                  <td class="py-1">
                    <i class="bx bx-trending-up text-success align-middle mr-50"></i><span>10.4%</span>
                  </td>
                  <td class="py-1">$9,523</td>
                  <td class="text-success py-1">Active</td>
                  <td class="text-center py-1">
                    <div class="dropdown">
                      <span
                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="py-1 line-ellipsis">
                    <img class="rounded-circle mr-1" src="{{asset('images/icon/google.png')}}" alt="card"
                      height="24" width="24">Google Pixel 4 xl
                  </td>
                  <td class="py-1"><i class="bx bx-trending-down text-danger align-middle mr-50"></i><span>-62.38%</span>
                  </td>
                  <td class="py-1">12,897</td>
                  <td class="text-danger py-1">Closed</td>
                  <td class="text-center py-1">
                    <div class="dropup">
                      <span
                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                      </span>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                        <a class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
             table ends 
          </div>
        </div>
      </div>
    </div>-->
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection

