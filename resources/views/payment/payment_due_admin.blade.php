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

                    <h2 class="mb30">Payment</h2>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <p>

                        <a class="btn btn-primary" href="{{url('/afterpaymentdueadmin')}}">Make Payment</a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>




@endsection