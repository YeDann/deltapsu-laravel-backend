@extends('layouts.admin')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Partner</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="{{route('partner.index')}}" >Partner</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content mb-5">
    <div class="block block-rounded block-bordered">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Partner</h3>
        </div>
        <div class="block-content mb-5">
            <form id="submitformbkuser" method="POST" action="{{ route('partner.store') }}">
                @csrf
                <!-- Basic Elements -->


                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}*</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required >

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}*</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required >

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}*</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}" required >

                                @if ($errors->has('position'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="companyName" class="col-md-4 col-form-label text-md-right">{{ __('Company Name (Distributor)') }}*</label>

                            <div class="col-md-6">
                                <input id="companyName" type="text" class="form-control{{ $errors->has('companyName') ? ' is-invalid' : '' }}" name="companyName" value="{{ old('companyName') }}" required >

                                @if ($errors->has('companyName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('companyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}*</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required >

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fax" class="col-md-4 col-form-label text-md-right">{{ __('Fax') }}*</label>

                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control{{ $errors->has('fax') ? ' is-invalid' : '' }}" name="fax" value="{{ old('fax') }}" required >

                                @if ($errors->has('fax'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }} *</label>
                            <div class="col-md-6">
                             <select class="form-control" name="country">
                                 @foreach ($countries as $item)
                                 <option value="{{$item->name}}">{{$item->name}}</option>
                                 @endforeach
                             </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }} *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                             <label class=" col-md-4 col-form-label"></label>
                           <div class="col-md-6">
                        <small class="form-text text-muted mt-2 ">
                                *The password must be:
                                <ul class="mb-0">
                                    <li>At least one uppercase letter</li>
                                    <li>At least one lowercase letter</li>
                                    <li>At least two digits (numbers)</li>
                                    <li>At least one special character</li>
                                    <li>Minimum 8 characters</li>
                                </ul>
                            </small>
                           </div>
                          </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">

                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} *</label>

                            <div class="col-md-6">
                                <input  id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <strong style="color:green;" id="passwordmatch"></strong>
                                <strong style="color:red;" id="passwordmatcherror"></strong>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="d-block col-md-4 col-form-label text-md-right">Role *</label>
                            <div class="col-md-6">
                            <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-1" name="role" value="1"  required >
                                    <label class="custom-control-label" for="status-1">Distributor</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline custom-control-primary">
                                    <input type="radio" class="custom-control-input" id="status-2" name="role" value="2" required >
                                    <label class="custom-control-label" for="status-2">FES</label>
                                </div>

                            </div>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button onclick="validateInput();" type="button" class="btn btn-primary">
                                       Save
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function validateInput() {
    var pass = $('#password').val();
    var confipass = $('#password-confirm').val();

    // Reset messages
    $('#passwordmatch').text('');
    $('#passwordmatcherror').text('');

    if (pass !== '' && confipass !== '') {

        // Check password match
        if (pass !== confipass) {
            $('#passwordmatcherror').text('Passwords do not match!');
            $('#password-confirm').val('');
            return;
        }

        // Validation checks
        var hasUppercase = /[A-Z]/.test(pass);
        var hasLowercase = /[a-z]/.test(pass);
        var hasTwoDigits = (pass.match(/\d/g) || []).length >= 2;
        var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(pass);
        var isLongEnough = pass.length >= 8;

        // Display specific validation messages
        if (!isLongEnough) {
            $('#passwordmatcherror').text('Password must be at least 8 characters long!');
            return;
        }
        if (!hasUppercase) {
            $('#passwordmatcherror').text('Password must contain at least one uppercase letter!');
            return;
        }
        if (!hasLowercase) {
            $('#passwordmatcherror').text('Password must contain at least one lowercase letter!');
            return;
        }
        if (!hasTwoDigits) {
            $('#passwordmatcherror').text('Password must contain at least two numbers!');
            return;
        }
        if (!hasSpecialChar) {
            $('#passwordmatcherror').text('Password must contain at least one special character!');
            return;
        }

        // All checks passed
        $('#passwordmatch').text('Password is valid and matched!');
        document.getElementById("submitformbkuser").submit();

    } else {
        // No password entered (no change)
        document.getElementById("submitformbkuser").submit();
    }
}
</script>
@endsection
