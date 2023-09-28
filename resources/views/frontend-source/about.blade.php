@extends('frontend-source.layouts.master')
@section('title') About @stop
@section('keywords') About @stop
@section('description') About @stop
@section('style')
@endsection
@section('content')
<section class="terms">
    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h2 class="mb30">About</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <p>
We (My Medical Mate) will not share your all personal information with anyone else and your data will be safe and secure with us.
The India’s most reliable online medical and digital healthcare service provider application has launched a new digital healthcare campaign that aims to offer high quality of products and better services from the highly experienced, trusted and certified service provider to health diagnostics and devices in its destined signature pleasant style. My Medical Mate. We are one of the largest digital healthcare service provider aggregators in India. We help patients that they easily connect with the concern doctors, medical mate, medicine vendors in local stores and diagnostic centres in order to fulfil their extensive medical needs. We believe in our quality service and better management also believe that everyone will have better access to good health in the future.
Our measure priority on customer satisfaction along with better product and service within the time.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    $(".card.account-type").click(function () {
        $('.check').removeClass('selected');
        $(this).find('.check').addClass('selected');
    });

    $("#confirm_account").click(function () {
        let accountType = $('.selected').attr('data-aut');
        $.ajax({
            type: "Post",
            dataType: "json",
            beforeSend: function () {
                $('#confirm_account').html('Please Wait...');
            },
            url: "{{ url('/confirm-account') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                account_type: accountType
            },
            success: function (result) {
                if (result.response == 'success') {
                    window.location.replace(result.url);
                } else {
                    $('.error-msg').html(result.msg);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {}
        });
    });
</script>
@endpush
