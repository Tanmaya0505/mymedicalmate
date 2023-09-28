@extends('frontend-source.customer-dashboard.layouts.master')
@section('title') Prescription @stop
@section('keywords') Prescription @stop
@section('description') Prescription @stop
@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Available Coupon</h4>
                <div class="appointment-tab ">
                    <div class="tab-content">
                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $key=>$value)
                                                
                                                <tr>
                                                    <td>{{$value->coupon_name}}</td>
                                                    <td>{{$value->coupon_type}}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($value->start_date)->format('d-m-Y h:i:s') }}
                                                        
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($value->end_date)->format('d-m-Y h:i:s') }}
                                                        
                                                    </td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>		
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Cancel modal popup-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="staticBackdropLabel"><i class="nc-icon nc-notes"></i> Coin Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="doctor-widget"></div>
                <form novalidate id="coin-transfer-form" method="post" action="{{url('/user/convert-coin-transfer')}}">
                    @csrf
                    <div class="form-group">
                        <ul class="list-group">
                            
                            <li class="list-group-item d-flex justify-content-between align-items-center ">
                                <p><span class="alert alert-warning"><span>10 coins = Rs.1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                               </span></p>
                                <p>Total Available Coin ({{$user->total_coin}})</p>
                                
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Coin Transfer:</label>
                        <select  class="form-control" name="coin_transfer"  required="">
                            <option value="50">Rs.5 = 50 Coins</option>
                            <option value="100">Rs.10 = 100 Coins</option>
                            <option value="150">Rs.15 = 150 Coins</option>
                            <option value="200">Rs.20 = 200 Coins</option>
                            <option value="250">Rs.25 = 250 Coins</option>
                            <option value="300">Rs.30 = 300 Coins</option>
                            <option value="350">Rs.35 = 350 Coins</option>
                            <option value="400">Rs.40 = 400 Coins</option>
                            <option value="450">Rs.45 = 450 Coins</option>
                            <option value="500">Rs.50 = 500 Coins</option>
                        </select>
                        <div class="invalid-feedback">Please write the reasons</div>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-confirm" class="btn btn-primary btn-sm btn-fill">Convert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Cancel modal popup-->
@endsection
@push('script')
<script>
    var prefix = "@php echo $account_prefix @endphp";

    function addCoinTransfer(){
        $('#staticBackdrop').modal('show');
    }
</script>

@endpush