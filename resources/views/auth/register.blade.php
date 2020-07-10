@include('layouts.header')
@include('layouts.nav')




        <div class="sufee-login d-flex align-content-center flex-wrap ">
            <div class="container">
                <div class="login-content">
                  
                    <div class="login-form">
                        <div><h4 class="text-warning">Add New Admin</h4></div>

                                <img class="align-content" src="{{url('public/assets/images/logo/logo2.jpg')}}" alt="">

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('Name') is-invalid @enderror" name="Name" value="{{ old('Name') }}"  required autocomplete="Name" autofocus>
                                    
                                        @error('Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>E-Mail Address</label>
                                        <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                                    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>password</label>
                                        <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                
                                    </div>

                                <button type="submit" class="btn btn-warning btn-flat m-b-30 m-t-30">Register</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')