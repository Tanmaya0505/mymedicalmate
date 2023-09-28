@extends('frontend-source.layouts.master')
@section('title') Login @stop
@section('keywords') Login @stop
@section('description') Login @stop
@section('style')
@endsection
@section('content')
<section class="user-type">
    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h2 class="mb30">Select Your Account Type</h2>
                </div>
            </div>
            <div class="row">
                @foreach($types as $key=>$type)
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <div class="card account-type">
                        <div class="card-header">
                            <span class="check @if($key == 0)selected @endif" data-aut="{{ $type->id }}">
                                <i class="fas fa-check"></i>
                            </span>
                            <h4>{!! $type->account_icon !!} {{ $type->account_name }}</h4>
                        </div>
                        <div class="card-body">
                            {!! $type->account_description !!}
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-12 col-md-12 pl-2">
                    <div class="tacbox">
                    <label class="checkbox-inline" for="terms">
                        <input type="checkbox" id="terms"> I agree to these <a target="_blank" href="{{ url('/terms') }}">Terms and Conditions</a>. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula egestas enim,
                    </label>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 pl-2">
                    <div class="error-msg"></div>
                    <div class="text-center">
                        <button class="btn btn-primary" id="confirm_account" disabled="">Proceed Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
$("#terms").change(function() {
    if(this.checked) {
        $('#confirm_account').prop('disabled', false);
    } else {
        $('#confirm_account').prop('disabled', true);
    }
});

$(".card.account-type").click(function() {
    $('.check').removeClass('selected');
    $(this).find('.check').addClass('selected');
});

$("#confirm_account").click(function() {
    let accountType = $('.selected').attr('data-aut');
    $.ajax({
        type: "Post",
        dataType: "json",
        beforeSend: function() {
            $('#confirm_account').html('Please Wait...');
        },
        url: "{{ url('/confirm-account') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            account_type: accountType
        },
        success: function(result) {
            if (result.response == 'success') {
                window.location.replace(result.url);
            } else {
                $('.error-msg').html(result.msg);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {}
    });
});
</script>
@endpush
