@extends('layouts.dashboard')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>
        </ol>
    </div>
    <div class="row">

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <div class="cart-tittle">
                        Coupon List
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">

                            <tr>
                                <th>SL</th>
                                <th>name</th>
                                <th>Discount(%)</th>
                                <th>Type</th>
                                <th>Validity</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->discount }}</td>
                                    <td>{{ $coupon->type }}</td>
                                    <td>{{ Carbon\Carbon::parse($coupon->validity)->format('D, d F Y') }}</td>
                                    <td>
                                        @php

                                            $carbon = Carbon\Carbon::now()->format('Y-m-d');
                                        @endphp
                                        @if ($coupon->validity >= $carbon)
                                            <span class="badge light badge-success">Valid</span>
                                        @else
                                            <span class="badge light badge-danger">Invalid</span>
                                        @endif

                                    </td>


                                    <td>
                                        <button name="{{ route('coupon.delete', $coupon->id) }}" type="button"
                                            class="delete_btn btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></button>


                                    </td>


                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold text-black">Add Sub Category </h4>
                    {{-- <h3 class="float-end">Count: <span></span></h3> --}}
                </div>
                <div class="card-body">
                    <form action="{{ url('/coupon/insert') }} " method="post">
                        @csrf
                        <div class="form-group mb-4">

                            <div class="form-group mb-4">
                                <label for="" class="form-label">Coupon Name</label>

                                <input type="text" name="coupon_name" class="form-control">

                                @error('coupon_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group mb-4">
                                <label for="" class="form-label">Coupon Discount(%)</label>

                                <input type="text" name="discount" class="form-control">

                                @error('discount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group mb-4">
                                <label for="" class="form-label">Coupon Type</label>
                                <select name="type" id="" class="form-control">
                                    <option value="">---Select Type---</option>

                                    <option value="percentage">Percentage</option>
                                    <option value="amount">Amount</option>

                                </select>

                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="form-label">Coupon Validity</label>

                                <input type="date" name="validity" class="form-control">

                                @error('validity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>

                        <button class="btn btn-primary btn-xs" type="submit">Add Coupon</button>


                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
