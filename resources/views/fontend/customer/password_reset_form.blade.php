@extends('fontend.master')
@section('content')
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="index.html">Home</a></li>
                <li>Password Reset</li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row m-5">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="card-title text-white">Password Reset Form</div>
                    </div>
                    <form action="{{ route('password.reset.update') }}" method="POST">
                        @csrf
                        @if (session('reset_success'))
                            <div class="alert alert-success">{{ session('reset_success') }}</div>
                        @endif
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">New Password</label>
                                <input type="text" class="form-control" name="password">
                                <input type="hidden" class="form-control" name="reset_token" value="{{ $token }}">
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
