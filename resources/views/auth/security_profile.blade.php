@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (Auth::user())
                        <div class="card-header">{{ ucfirst(Auth::user()->type) }} {{ __('Profile') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('profile') }}">
                        @csrf
                        <!--Name:-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ $profile['gender'] }}" required autocomplete="gender">
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="license_type" class="col-md-4 col-form-label text-md-right">{{ __('License Type') }}</label>
                            <div class="col-md-6">
                                <input id="license_type" type="text" class="form-control @error('license_type') is-invalid @enderror" name="license" value="{{ Auth::user()->type }}" required>
                                @error('license_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--License #:-->
                        <div class="form-group row">
                            <label for="license" class="col-md-4 col-form-label text-md-right">{{ __('License #') }}</label>
                            <div class="col-md-6">
                                <input id="license" type="text" class="form-control @error('license') is-invalid @enderror" name="license" value="{{ $profile['license_number'] }}" required>
                                @error('license')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--LICENSE EXPIRY DATE-->
                        <div class="form-group row">
                        <label for="expirydate" class="col-md-4 col-form-label text-md-right">{{ __('Expiry Date') }}</label>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <input type='text' id="expire" class="form-control @error('expire') is-invalid @enderror" value="{{ $profile['license_expire'] }}" name="expire" />
                                    @error('datetimepicker')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <!--JURISDICTION:-->
                        <div class="form-group row">
                            <label for="jurisdiction" class="col-md-4 col-form-label text-md-right">{{ __('Jurisdiction') }}</label>
                            <div class="col-md-6">
                                <input id="jurisdiction" class="form-control @error('prov') is-invalid @enderror" value="{{ $profile['jurisdiction'] }}" name="jurisdiction"  required autocomplete="jurisdiction">

                                @error('jurisdiction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--Email:-->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--Phone #:-->
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $profile['phone'] }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if (Auth::user()->type == 'security')
                        <div class="form-group row">
                            <label for="e_phone" class="col-md-4 col-form-label text-md-right">{{ __('Emergency Phone') }}</label>
                            <div class="col-md-6">
                                <input id="e_phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="e_phone" value="{{ $profile['emergency_phone'] }}"  required autocomplete="e_phone">
                                @error('e_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <!--Address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $address['street'] }}" required autocomplete="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $address['city'] }}" required autocomplete="city">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prov" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>

                            <div class="col-md-6">
                            <input id="prov" type="text" class="form-control @error('prov') is-invalid @enderror" name="prov" value="{{ $address['province'] }}" required autocomplete="city">
                                @error('prov')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postal Code') }}</label>
                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ $address['postal_code'] }}" required autocomplete="postcode">
                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if (Auth::user()->type == 'security')
                        <div class="form-group row">
                        <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('CPR') }}</label>
                            <div class="col-md-2">
                                <input id="cpr" name="cpr" value="@if ($profile['cpr'] == 1) No @else Yes @endif" class="form-control @error('cpr') is-invalid @enderror" required>
                                @error('cpr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--label for="exp-year" class="col-md-2 col-form-label text-md-right">{{ __('Exp Year') }}</label-->
                            <div class="col-md-2">
                                <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" value="{{ $profile['height'] }}" name="height" required >
                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--label for="cv" class="col-md-2 col-form-label text-md-right">{{ __('CV Code') }}</label-->
                            <div class="col-md-2">
                                <input id="weight" type="text" class="form-control @error('cc') is-invalid @enderror" value="{{ $profile['weight'] }}" name="weight" required >
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Eidt') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
