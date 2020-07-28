@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Payment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--Name:-->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--Email:-->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--Address -->
                        <div class="form-group row">
                            <label for="e_phone" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address1') is-invalid @enderror" name="address"  required autocomplete="address" placeholder="Address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="e_phone" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"  required autocomplete="city" placeholder="City" autofocus>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="e_phone" class="col-md-4 col-form-label text-md-right">{{ __('Province') }}</label>
                            <div class="col-md-6">
                                <select id="prov" class="form-control @error('prov') is-invalid @enderror" name="prov"  required autocomplete="prov" >
                                    <option value="">Province</optiion>
                                    <option value="AB">Alberta</option>
                                    <option value="BC">British Columbia</option>
                                    <option value="MB">Manitoba</option>
                                    <option value="NB">New Brunswick</option>
                                    <option value="NL">Newfoundland and Labrador</option>
                                    <option value="NS">Nova Scotia</option>
                                    <option value="ON">Ontario</option>
                                    <option value="PE">Prince Edward Island</option>
                                    <option value="QC">Quebec</option>
                                    <option value="SK">Saskatchewan</option>
                                    <option value="NT">Northwest Territories</option>
                                    <option value="NU">Nunavut</option>
                                    <option value="YT">Yukon</option>
                                </select>
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
                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode"  required autocomplete="postcode" placeholder="Postal Code" autofocus>
                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        Subscription
                        <hr>
                        <div class="form-group row">
                            <label for="subscription" class="col-md-4 col-form-label text-md-right">{{ __('Option') }}</label>
                            <div class="col-md-6">
                                <select id="subscription" class="form-control @error('subscription') is-invalid @enderror" name="subscription"  required autocomplete="prov" >
                                    <option value="">Subscription</optiion>
                                    <option value="1">One Year $1050</option>
                                    <option value="2">Two Year $1850</option>
                                </select>
                                @error('subscription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        Card Information
                        <hr>
                        <!--Name ON CARD :-->
                        <div class="form-group row">
                            <label for="noc" class="col-md-4 col-form-label text-md-right">{{ __('Name On Card') }}</label>

                            <div class="col-md-6">
                                <input id="noc" type="text" class="form-control @error('noc') is-invalid @enderror" name="noc"  required>

                                @error('noc')
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
                                    <input type='text' id="datetimepicker" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cc" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="cc" type="cc" class="form-control @error('cc') is-invalid @enderror" name="cc" required>

                                @error('cc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>
                            <div class="col-md-6">
                                <select id="month" name="month" class="form-control @error('month') is-invalid @enderror" required>
                                    <option value=''>--Select Month--</option>
                                    <option selected value='1'>Janaury</option>
                                    <option value='2'>February</option>
                                    <option value='3'>March</option>
                                    <option value='4'>April</option>
                                    <option value='5'>May</option>
                                    <option value='6'>June</option>
                                    <option value='7'>July</option>
                                    <option value='8'>August</option>
                                    <option value='9'>September</option>
                                    <option value='10'>October</option>
                                    <option value='11'>November</option>
                                    <option value='12'>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group offset-md-4 row">
                            <!--label for="exp-year" class="col-md-2 col-form-label text-md-right">{{ __('Exp Year') }}</label-->
                            <div class="col-md-4">
                                <input id="exp-year" type="exp-year" class="form-control @error('exp-year') is-invalid @enderror" name="exp-year" required placeholder="Exp Year">
                                @error('exp-year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--label for="cv" class="col-md-2 col-form-label text-md-right">{{ __('CV Code') }}</label-->
                            <div class="col-md-4">
                                <input id="cv" type="cv" class="form-control @error('cc') is-invalid @enderror" name="cv" required placeholder="CV Code">
                                @error('cv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Make Payment') }}
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
