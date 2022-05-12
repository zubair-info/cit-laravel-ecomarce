@extends('fontend.master')

@section('content')
    <div class="breadcrumb_section">
        <div class="container">
            <ul class="breadcrumb_nav ul_li">
                <li><a href="{{ route('homepage') }}">Home</a></li>
                <li>My Account</li>
            </ul>
        </div>
    </div>

    <!-- account_section - start-->
    <section class="account_section section_space">
        <div class="container">

            <div class="row">

                <div class="col-lg-3 account_menu">

                    <div class="nav account_menu_list flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link text-start active w-100" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">Account Dashboard </button>
                        <button class="nav-link text-start w-100" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                            aria-selected="false">Acount</button>
                        <button class="nav-link text-start w-100" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile_picture" type="button" role="tab"
                            aria-controls="v-pills-profile_picture" aria-selected="false">Picture Change</button>
                        <button class="nav-link text-start w-100" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile_password" type="button" role="tab"
                            aria-controls="v-pills-profile_password" aria-selected="false">Password Change</button>
                        <button class="nav-link text-start w-100" id="v-pills-messages-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                            aria-selected="false">My Orders</button>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content bg-light p-3" id="v-pills-tabContent">
                        <div class="tab-pane fade show active text-center" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">

                            <h5 class="text-center"> <span class="text-danger">Hi..!</span> <strong
                                    class="text-warning">{{ Auth::guard('customerlogin')->user()->name }}</strong>
                                Welcome
                                to Account</h5>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <h5 class="text-center pb-3">Account Details</h5>
                            <form class="row g-3 p-2" action="{{ url('/customer/acount/update') }}" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputnamel4" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="inputnamel4"
                                        value="{{ Auth::guard('customerlogin')->user()->name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="inputEmail4"
                                        value="{{ Auth::guard('customerlogin')->user()->email }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="number" class="form-label">Phone</label>
                                    <input type="text" name="number"
                                        value="{{ Auth::guard('customerlogin')->user()->number }}" class="form-control"
                                        id="number">
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address"
                                        value="{{ Auth::guard('customerlogin')->user()->address }}" class="form-control"
                                        id="address">
                                </div>

                                {{-- <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="inputPassword4">
                                </div> --}}
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary active">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile_picture" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <h5 class="text-center pb-3">Profile picture change</h5>
                            <form action="{{ url('/profile/photo/update') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="custom-file mb-4">
                                    <input type="file" name="profile_photo" class="custom-file-input">

                                    @error('profile_photo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>


                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile_password" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <h5 class="text-center pb-3">Password change</h5>
                            <form action="{{ url('/customer/password/update') }} " method="post">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="old_password" class="form-label">Old Password</label>

                                    <input type="password" name="old_password" id="old_password" class="form-control">
                                    @if (session('wrong_pass'))
                                        <strong class="text-danger mt-2"> {{ session('wrong_pass') }} </strong>
                                    @endif

                                    @if (session('same_pass'))
                                        <strong class="text-danger mt-2"> {{ session('same_pass') }} </strong>
                                    @endif
                                    @error('old_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror



                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">New Password</label>

                                    <input type="password" id="password" name="password" class="form-control">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>

                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>


                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <h5 class="text-center pb-3">Your Orders</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>SL</th>
                                    <th>Order No</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Delivery Charge</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>#120</td>
                                    <td>52500</td>
                                    <td>200</td>
                                    <td>100</td>
                                    <td>52400</td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Download Invoice</a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('footer_script')
    {{-- all insert code --}}
    @if (session('success_msg'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success_msg') }}'
            })
        </script>
    @endif

    {{-- all update code --}}

    @if (session('update'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('update') }}'
            })
        </script>
    @endif
@endsection
