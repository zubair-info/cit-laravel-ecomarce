@extends('fontend.master')
@section('content')
    <div class="container">
        <div class="row m-5">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Order Confirm Message
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('order_success'))
                            <div class="alert alert-success">
                                {{ session('order_success') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
