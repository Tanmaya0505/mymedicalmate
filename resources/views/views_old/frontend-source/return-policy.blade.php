@extends('frontend-source.layouts.master')
@section('title') Return Policy @stop
@section('keywords') Return Policy @stop
@section('description') Return Policy @stop
@section('style')
@endsection
@section('content')
<section class="terms">
    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h2 class="mb30">Return Policy</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <p>Return Policy</p>
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
