@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Dashboard</h1>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Last Login Time</h4>
                            <p class="card-text">{{ $lastLoginTime }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Total Messages Sent</h4>
                            <p class="card-text">{{ $totalMessagesSent }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-secondary">Last 5 Messages</h2>
            <ul class="list-group">
                @foreach ($lastFiveMessages as $message)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $message->message }}</span>
                        <span class="badge badge-primary badge-pill">{{ $message->created_at->format('d M Y, h:i A') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
