@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Post') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('create_post') }}">
                        @csrf
                        <!--Address location-->
                        Location
                        <hr>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address1') is-invalid @enderror" name="address" value="{{ old('name') }}" required autocomplete="address" >
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
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">
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
                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode"  value="{{ old('postcode') }}" required autocomplete="postcode" >
                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        Post Details
                        <hr>
                        <!--div class="form-group row">
                        <label for="nog" class="col-md-4 col-form-label text-md-right">{{ __('Number of Guards') }}</label>
                            <div class="col-md-6">
                                <input id="nog" type="text" class="form-control @error('nog') is-invalid @enderror" name="nog" value="{{ old('nog') }}" required autocomplete="nog">
                                @error('nog')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div-->

                        <!--Start DATE AND TIME-->
                        <div class="form-group row">
                        <label for="datetime" class="col-md-4 col-form-label text-md-right">{{ __('Start Date and Time') }}</label>
                            <div class='col-md-6'>
                                    <input type='text' id="datetimepicker"  name="datetimepicker" value="{{ old('datetimepicker') }}" class="form-control @error('datetimepicker') is-invalid @enderror" />
                                    @error('datetimepicker')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--End DATE AND TIME-->
                        <div class="form-group row">
                        <label for="datetime" class="col-md-4 col-form-label text-md-right">{{ __('End Date and Time') }}</label>
                            <div class='col-md-6'>
                                    <input type='text' id="datetimepicker1" name="datetimepicker1" value="{{ old('datetimepicker1') }}" class="form-control @error('datetimepicker1') is-invalid @enderror" />
                                    @error('datetimepicker1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rate" class="col-md-4 col-form-label text-md-right">{{ __('Rate/Hr') }}</label>
                            <div class="col-md-6">
                                <input id="rate" type="rate" value="{{ old('rate') }}" class="form-control @error('rate') is-invalid @enderror" name="rate" required>

                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="textarea" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" name="description" required>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--NUMBER OF GUARDS-->
                        <div class="form-group row">
                        <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Number of Guards') }}</label>
                            <!--label for="exp-year" class="col-md-2 col-form-label text-md-right">{{ __('Exp Year') }}</label-->
                            <div class="col-md-3">
                                <input id="femaleGuards" type="text" class="form-control @error('femaleGuards') is-invalid @enderror" name="femaleGuards" value="{{ old('femaleGuards') }}" required placeholder="Number of Female Guards">
                                @error('femaleGuards')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--label for="cv" class="col-md-2 col-form-label text-md-right">{{ __('CV Code') }}</label-->
                            <div class="col-md-3">
                                <input id="maleGuards" type="text" class="form-control @error('maleGuards') is-invalid @enderror" name="maleGuards" value="{{ old('maleGuards') }}" required placeholder="Number of Male Guards">
                                @error('maleGuards')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Guard Details') }}</label>
                            <!--label for="exp-year" class="col-md-2 col-form-label text-md-right">{{ __('Exp Year') }}</label-->
                            <div class="col-md-2">
                                <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" required placeholder="Min Height cm">
                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--label for="cv" class="col-md-2 col-form-label text-md-right">{{ __('CV Code') }}</label-->
                            <div class="col-md-2">
                                <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required placeholder="Min Weight lbs">
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="rating" type="text" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating') }}" name="rating" required placeholder="Min Rating 1-5">
                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Post') }}
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
