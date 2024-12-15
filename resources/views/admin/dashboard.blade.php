@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('body-class', 'admin-dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Admin Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="feather-users display-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-white">Total Users</h5>
                                        <p class="card-text display-4">{{ $totalUsers }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="feather-slack display-3"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title text-white">Total Flowers</h5>
                                        <p class="card-text display-4">{{ $totalProducts }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Recent Activity</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Activity</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentActivities as $activity)
                                            <tr>
                                                <td>{{ $activity->description }}</td>
                                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-body .card {
        margin-bottom: 20px;
    }
</style>
@endpush