<div class="modal fade pop-login" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('frontend-source.includes.msg')
                <form method="POST" action="{{ url('login') }}">
                    @csrf
                    <input type="hidden" name="request_from" id="request_from_login" value="@if(isset($assistant->id))medical-mate/{{$assistant->id}}@else./@endif" />
                    <div class="row mb10">
                        <div class="col">
                            <label for="email" class="col-form-label">Email Address:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address*" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="show_password">
                            <label for="password" class="col-form-label">Password:</label>
                            <div style="position: relative">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password*">
                            <div class="input-group-addon">
                                <a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                            </div>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button class="btn btn-primary">Login</button>
                        </div>
                        <div class="col-12 mt20"><p>Don't have an account? <a href="{{ url('/sign-up') }}" class="text-info">Register</a></p></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>