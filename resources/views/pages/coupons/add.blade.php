@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Coupon Listing')
{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection
{{-- page styles --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
<link href="{{asset('dist/css/select2.css')}}" rel="stylesheet" />
<style>
.btn i {
    top:0px;
}
.x {
    /*position: absolute;*/
    background: red;
    color: white;
    top: -10px;
    right: -10px;
}
</style>
@endsection
@section('content')
<!-- account setting page start -->
<section id="page-account-settings">
    <div class="row">
        <div class="col-12">
            <div class="row">
            <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- right content section -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                         aria-labelledby="account-pill-general" aria-expanded="true">
                                        
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <a class="btn btn-primary pull-right" href="{{url('/cms-admin/coupon-list')}}">Back</a>
                                            
                                        </div>
                                        <div class="table-responsive">
                                            <form novalidate id="add_doctor" method="post" action="{{url('/cms-admin/coupon-list/store')}}" enctype="multipart/form-data">
                                                
                                            @csrf 
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>coupon Title</label>
                                                            <input type="text" required name="title" class="form-control @error('title') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>coupon Name</label>
                                                            <input type="text" pattern="[A-Za-z0-9]+" onkeydown="if(['Space'].includes(arguments[0].code)){return false;}"  required name="name" class="form-control @error('name') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>coupon Discount type</label>
                                                            <fieldset class="">
                                                                <select class="form-control" id="coupon_discount_type" name="coupon_discount_type">
                                                                <option value="FIXED">FIXED</option>
                                                                <option value="PERCENTAGE">PERCENTAGE</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Coupon amount</label>
                                                            <input type="number" required name="coupon_value" class="form-control @error('coupon_value') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Purchasing amount</label>
                                                            <input type="number"  required name="purchasing_value" class="form-control @error('purchasing_value') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <form action=" {{url('/cms-admin/coupon-list/couponcodegen')}}" id="generateCouponCodeForm">
                                                    
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <label>Generate Coupon Code</label>
                                                                <input type="text" id="coupon-code"  pattern="[A-Za-z0-9]+" onkeydown="if(['Space'].includes(arguments[0].code)){return false;}" required name="coupon_name"  class="form-control @error('purchasing_value') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-primary" id="btnSubmit">Generate Coupon</button>
                                                    </form>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Start Date</label>
                                                            <input type="date" required name="start_date" class="form-control @error('start_date') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>End Date</label>
                                                            <input type="date" required name="end_date" class="form-control @error('end_date') is-invalid @enderror" data-validation-required-message="This type field is required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Coupon user Type</label>
                                                            <select  name="coupon_type" id="coupon_type" class="form-control @error('coupon_type') is-invalid @enderror" required data-validation-required-message="This type field is required">
                                                               <option value="">-selected-</option>
                                                                <option value="PRIVATE">PRIVATE</option>
                                                                <option value="PUBLIC">PUBLIC</option>
                                                                <option value="USER_CATEGORY">USER CATEGORY</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 private">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Users</label>
                                                            <select  name="user_id[]" style="width: 1206px;" multiple class="form-control @error('user_id') is-invalid @enderror"  >
                                                                @forelse($users as $user)
                                                                <option value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
                                                                @empty
                                                                @endforelse

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 Usercategory">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>USER-CATEGORY type</label>
                                                            <fieldset class="">
                                                                <select class="form-control" style="width: 1206px;" id="user_category_type" name="user_category_type">
                                                                <option value="1">User</option>
                                                                <option value="2">Medicalmate</option>
                                                                <option value="4">Vender</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Create</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account setting page ends -->
@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('vendors/js/ui/blockUI.min.js')}}"></script>
@endsection
@section('page-scripts')
<script src="{{asset('js/scripts/pages/page-account-settings.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
<script src="{{asset('custom/account-settings.js')}}"></script>
<script src="{{asset('dist/js/select2.js')}}"></script>

<script type="text/javascript">
    //$('.private').hide();
    $('.private').hide();
        $('.usercategory').hide();
    $('#coupon_type').on('change',function(){
        if($(this).val()=='PUBLIC'){
            $('.private').hide();
            $('.Usercategory').hide();
        }else if($(this).val()=='USER_CATEGORY') {
            $('.Usercategory').show();
            $('.private').hide();
        }else if($(this).val()=='PRIVATE'){
            $('.private').show();
            $('.Usercategory').hide();
        }
    })
    // $('#coupon_type').on('change',function(){
    //     if($(this).val()=='PUBLIC'){
    //         $('.private').hide();
    //     }else{
    //         $('.private').show();
    //     }
    // })
    $(function () {
      $('select').each(function () {
        $(this).select2({
          //theme: 'bootstrap4',
          //width: 'style',
          placeholder: $(this).attr('placeholder'),
          allowClear: Boolean($(this).data('allow-clear')),
        });
      });
    });
    
    
        $("#btnSubmit").on("click", function() {
            var $this 		    = $(this); //submit button selector using ID
            var $caption        = $this.html();// We store the html content of the submit button
            var form 			= "#generateCouponCodeForm"; //defined the #generateCouponCodeForm ID
            var formData        = $(form).serializeArray(); //serialize the form into array
            var route 			= $(form).attr('action'); //get the route using attribute action
            // Ajax config
           // alert(1111);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                type: "POST", //we are using POST method to submit the data to the server side
                url: "{{url('/cms-admin/coupon-list/couponcodegen')}}", // get the route value
                data: formData, // our serialized array data for server side
               // dataType: 'json',
                beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
                    $this.attr('disabled', true).html("Processing...");
                },
                success: function (response) {//once the request successfully process to the server side it will return result here
                // Insert response generated coupon code
                console.log(response);
                //alert(response);
                //$(form).find("[id='coupon-code']").val(response);
                $('#coupon-code').val(response);
                //$('#coupon-code').html(response);
                //document.getElementById('coupon-code').innerHTML = response['data'];
                },
                complete: function() {
                    $this.attr('disabled', false).html($caption);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    // You can put something here if there is an error from submitted request
                }
            });
        });
    
</script>
@endsection
