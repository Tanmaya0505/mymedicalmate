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
                <h4 class="mb-4">Referal History</h4>
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
                                                    <th>Amount</th>
                                                    <th>Register Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @forelse($customer->firstchilds as $user)
                              
                                @if($user->customer->firstchilds)
                                   
                                   
                                      @forelse($user->customer->firstchilds as $child)

                                      <tr>
                                                    <td>{{$child->customer->full_name}}</td>
                                                    <td>{{@$value->amount}}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($child->created_at)->format('d-m-Y h:i:s') }}
                                                        
                                                    </td>
                                                    
                                                    
                                                </tr>
                                        
                                      @empty
                                      @endforelse
                                   
                                @endif
                              
                            @empty
                            @endforelse
                                                
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


@endsection
@push('script')
<script>
    var prefix = "@php echo $account_prefix @endphp";

    function addCoinTransfer(){
        $('#staticBackdrop').modal('show');
    }
</script>

@endpush