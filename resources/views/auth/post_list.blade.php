@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post List</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                        <th>Posted Id</th>
                            <th>Start Time</th>
                            <th>Rate/Hr</th>
                            <th>Site Location</th>
                            <th>Posted By</th>
                            <th>Status</th>
                            <th>Post Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($posts as $post)
                            @php
                                $class = ($i % 2 === 1) ? 'active' : 'success';
                                $i++;
                            @endphp
                            <tr class="{{ $class }}">
                            <td>{{ $post->id }}</td>
                                <td>{{  date("d-M-Y h:i:s a", strtotime($post->start_date_time)) }}</td>
                                <td>${{ $post->rate }}</td>
                                <td>{{ $post->street.' '.$post->city.' '. $post->prov.' '. $post->postcode }}</td>
                                <td>{{ $post->company }}</td>
                                <td>{{ ucfirst($post->status) }}</td>
                                <td><a href="post-details/{{ $post->id }}">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
