@extends('frontend-source.customer-dashboard.layouts.master')

@section('title') Bookings @stop

@section('keywords') Bookings @stop

@section('description') Bookings @stop

@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('frontend-source/myaccount/assets/css/custom.css')}}">

@endsection

@section('content')

<div class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <h4 class="mb-4">BOOKING SUCCESS MESSAGE</h4>

                

                <div class="card">

                    <div class="card-body booking-details-body">

                        <div class="row">

                            

                            <div class="col-xl-12">

                                <div class="white-bx">

                                    <!-- About Details -->
                                    <form class="otp-validation" action="{{url('assistant/add-review')}}" method="post" novalidate id="complete-book-review">
                                        @csrf
                                    <input type="hidden" name="booking_id"   value="{{$booking->booking_id}}"  />
                                    <input type="hidden" name="submit_star_pb_review" id="submit_star_pb_review"  value="0"  />
                                    <input type="hidden" name="submit_star_pc_review" id="submit_star_pc_review"  value="0"  />
                                    <input type="hidden" name="submit_star_pp_review" id="submit_star_pp_review"  value="0"  />
                                    <input type="hidden" name="submit_star_review" id="submit_star_review"  value="0"  />
                                    <h1 class="text-center">Thank You!</h1>

                                    <div class="widget about-widget">

                                        <h5 class="doc-name">We wish you all the best on your effort, hard work and integrity</h5>

                                        <h4 class="text-center mt-2 mb-4">
                                            <i class="fas fa-star star-light submit_star1 mr-1" id="submit_star_1" data-rating="1"></i>
                                            <i class="fas fa-star star-light submit_star1 mr-1" id="submit_star_2" data-rating="2"></i>
                                            <i class="fas fa-star star-light submit_star1 mr-1" id="submit_star_3" data-rating="3"></i>
                                            <i class="fas fa-star star-light submit_star1 mr-1" id="submit_star_4" data-rating="4"></i>
                                            <i class="fas fa-star star-light submit_star1 mr-1" id="submit_star_5" data-rating="5"></i>
                                        </h4>

                                    </div>
                                    
                                    <h4>How was the overall experience with this patient</h4>

                                    <div class="widget about-widget">

                                        
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Patient Behaviour 
                                            <span class=""><h4 class="text-center mt-2 mb-4">
                                            <i class="fas fa-star star-light submit_star submit_star_pb mr-1" id="submit_star_pb_1" data-rating="1"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pb mr-1" id="submit_star_pb_2" data-rating="2"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pb mr-1" id="submit_star_pb_3" data-rating="3"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pb mr-1" id="submit_star_pb_4" data-rating="4"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pb mr-1" id="submit_star_pb_5" data-rating="5"></i>
                                        </h4></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Patient Co-operation
                                            <span class=""><h4 class="text-center mt-2 mb-4">
                                            <i class="fas fa-star star-light submit_star submit_star_pc mr-1" id="submit_star_pc_1" data-rating="1"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pc mr-1" id="submit_star_pc_2" data-rating="2"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pc mr-1" id="submit_star_pc_3" data-rating="3"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pc mr-1" id="submit_star_pc_4" data-rating="4"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pc mr-1" id="submit_star_pc_5" data-rating="5"></i>
                                        </h4></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                            Patient Punctuality
                                            <span class=""><h4 class="text-center mt-2 mb-4">
                                            <i class="fas fa-star star-light submit_star submit_star_pp mr-1" id="submit_star_pp_1" data-rating="1"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pp mr-1" id="submit_star_pp_2" data-rating="2"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pp mr-1" id="submit_star_pp_3" data-rating="3"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pp mr-1" id="submit_star_pp_4" data-rating="4"></i>
                                            <i class="fas fa-star star-light submit_star submit_star_pp mr-1" id="submit_star_pp_5" data-rating="5"></i>
                                        </h4></span>
                                            </li>
                                            
                                        </ul>
                                        <center><button  data-id="{{ $booking->booking_id }}"  class="btn bg-primary btn-fill text-center">Submit Now</button></center>
                                    </div>
                                    
                                    
                                    </form>
                                </div>

                            </div>

                            <div class="clearfix"></div>

                        </div>

                        

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!--Comment modal popup-->



<!--End Comment modal popup-->



@endsection

@push('script')

<script>

    var prefix = "@php echo $account_prefix @endphp";
    var rating_data = 0;

    

    $(document).on('mouseenter', '.submit_star', function(){
        var id = '';
        if($(this).hasClass('submit_star_pb')){
            id='submit_star_pb_';
        }
        if($(this).hasClass('submit_star_pc')){
            id='submit_star_pc_';
        }
        if($(this).hasClass('submit_star_pp')){
            id='submit_star_pp_';
        }
        var rating = $(this).data('rating');
        $('#'+id+'review').val(rating);
        reset_background(id);

        for(var count = 1; count <= rating; count++)
        {

            $('#'+id+count).addClass('text-warning');

        }
        average_review();
    });

    function reset_background(id)
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#'+id+count).addClass('star-light');

            $('#'+id+count).removeClass('text-warning');

        }
    }

    function average_review()
    {
        var pb = parseInt($('#submit_star_pb_review').val());
        var pc = parseInt($('#submit_star_pc_review').val());
        var pp = parseInt($('#submit_star_pp_review').val());

        $('.submit_star1').removeClass('text-warning');

        $('#submit_star_'+count).addClass('star-light');

        $('#submit_star_'+count).removeClass('text-warning');


        var avg_rat = Math.ceil(((pb+pc+pp)/3));
        console.log(pb+pc+pp);
        $('#submit_star_'+'review').val(avg_rat);
        for(var count = 1; count <= avg_rat; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){
        var id = '';
        if($(this).hasClass('submit_star_pb')){
            id='submit_star_pb_';
        }
        if($(this).hasClass('submit_star_pc')){
            id='submit_star_pc_';
        }
        if($(this).hasClass('submit_star_pp')){
            id='submit_star_pp_';
        }
        reset_background(id);

        for(var count = 1; count <= rating_data; count++)
        {

            $('#'+id+count).removeClass('star-light');

            $('#'+id+count).addClass('text-warning');
        }
        average_review();

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        var user_name = $('#user_name').val();

        var user_review = $('#user_review').val();

        if(user_name == '' || user_review == '')
        {
            alert("Please Fill Both Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });
</script>

<script src="{{asset('frontend-source/myaccount/assets/js/assistant-validate.js')}}"></script>

@endpush