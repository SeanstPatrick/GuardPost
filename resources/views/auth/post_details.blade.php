@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><h2>Post Details</h2></div>
                <div class="card-body">
                    <div class="container">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                            <h4 class="list-group-item-heading">Posted By</h4>
                            <p class="list-group-item-heading">{{ $post->company }}</p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Status</h4>
                            <p class="list-group-item-text">{{ ucfirst($post['status']) }}</p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Post Date</h4>
                            <p class="list-group-item-text">{{  date("d-M-Y h:i:s a", strtotime($post->start_date_time)) }}</p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Location</h4>
                            <p class="list-group-item-text">{{ $post->street.' '.$post->city.' '. $post->prov.' '. $post->postcode }}</p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Shift Details</h4>
                            <p class="list-group-item-text">
                            {{ $post->description }}
                            </p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Rate</h4>
                            <p class="list-group-item-text">${{ $post->rate }} Per Hour</p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Number of Guards Requested</h4>
                            <p class="list-group-item-text">{{ $post->female_guards }} Female(s)</p>
                            <br>
                            <p class="list-group-item-text">{{ $post->male_guards }} Male(s)</p>
                            </a>
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Available Positions</h4>
                            @if ($post['status']!='filled')
                                <p class="list-group-item-text">{{ $post->female_guards - $booked[0]->females}} Female(s)</p>
                                <br>
                                <p class="list-group-item-text">{{ $post->male_guards - $booked[1]->males}} Male(s)</p>
                                </a>
                            @else
                                <p class="list-group-item-text">All Positions {{  ucfirst($post['status']) }}</p>
                            @endif
                            <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading">Guard Preference</h4>
                            <p class="list-group-item-text">Rating: {{ $post->security_rating }} and higher <b>|</b> Minimum Height: {{ $post->height }}cm <b>|</b> Minimum Weight: {{ $post->weight }}lbs</p>
                            </a>
                            <input type="hidden" name="post_id" id="post_id" value="{{ str_replace('/post-details/', '', Request::getRequestUri()) }}">
                            <!--REQUEST LIST START-->
                            @if (Auth::user()->type == 'company' && count($requestList) > 0)
                            <hr>
                            <h3>Request List</h3>
                            <div class="panel-group" id="accordion">
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($requestList as $request)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $i }}">
                                                {{ $request->name }}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $i }}" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Rating</th>
                                                        <th>Jurisdition</th>
                                                        <th>License Number</th>
                                                        <th>Gender</th>
                                                        <th>CPR</th>
                                                        <th>Height</th>
                                                    </tr>
                                                    </thead>
                                                    <tr class="active">
                                                        <td>{{ $request->rating }}</td>
                                                        <td>{{ $request->jurisdiction }}</td>
                                                        <td>{{ $request->license_number }}</td>
                                                        <td>{{ $request->gender }}</td>
                                                        <td>{{ $request->cpr }}</td>
                                                        <td>{{ $request->height }}</td>
                                                    </tr>
                                                </table>
                                                @if ($request->status == 2)
                                                   <button type="button" class="btn btn-success approve" user_id="{{ $request->user_id }}">
                                                        {{ __('Approve') }}
                                                    </button>
                                                    <button type="button" class="btn btn-danger decline" user_id="{{ $request->user_id }}">
                                                        {{ __('Decline') }}
                                                    </button>
                                                @elseif ($request->status == 4)
                                                    <button type="button" class="btn btn-success booked">
                                                        {{ __('Booked') }}
                                                    </button>
                                                @elseif ($request->status == 5)
                                                    <button type="button" class="btn btn-success booked">
                                                        {{ __('Filled') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-success" user_id="{{ $request->user_id }}">
                                                        {{ __('Pending Security Confirmation') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <!--REQUEST LIST END-->
                        <div class="form-group row mb-0" style="margin-top:5px;">
                            <div class="col-md-6 container">
                                @if (Auth::user()->type == 'company')
                                    @if ($post['status'] != 'filled')
                                       <button type="button" class="btn btn-success upgrade">
                                            {{ __('Upgrade') }}
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            {{ __('Cancel') }}
                                        </button>
                                    @endif
                                @else
                                    @foreach ($requestList as $list)
                                        @if ($list->security_id == Auth::user()->id)
                                            @php
                                                $user_postStatus = $list->status;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($user_postStatus ?? '')
                                            @if($user_postStatus == 3 )
                                                <button type="button" class="btn btn-primary confirm" user_id="{{ Auth::user()->id}}">
                                                    {{ __('Confirm Booking') }}
                                                </button>
                                            @elseif ($user_postStatus ==  4 || $user_postStatus ==  5)
                                                <button type="button" class="btn btn-primary">
                                                    {{ __('Booked') }}
                                                </button>
                                            @elseif ($user_postStatus ==  2)
                                                <button type="button" class="btn btn-primary requested">
                                                    {{ __('Requested') }}
                                                </button>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-primary pick_shift">
                                                {{ __('Pick Up Shift') }}
                                            </button>
                                    @endif

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
