<?php
ob_start();
include "headerbefore.php";
?>
<style>
    .all{
        background-image: url('assets/images/slider/4.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<div class="all">
    <section class="container-fluid d-flex align-items-center justify-content-center" style="height: 500px ; background:rgba(5,5,5,0.15)" >
        <div class="" >
            <div class="row">
                <div class="col-lg-7 col-md-5 " >
                    <div class="overview-content text-center">
                        <br>
                        <br>
                        <div class="form-group">
                            <h6 class="text-light display-4">Want to Sell Your Items on Carty.com?</h6>
                        </div>
                        <div class="form-group">
                            <h2 class="text-light font-weight-light">Start selling where millions of customers are shopping every day.</h2>
                        </div>
                        <div class="form-group">
                            <h5 class="text-light font-weight-light">You’re just a few steps away from becoming a seller on Carty.com</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7 d-flex align-items-center offset-1" >
                    <div class="overview-content">
                        <div class="login-form">
                            <div class="form-group text-center">
                                <h4 class="login-title">Sign in to your account</h4>
                            </div>
                            
                            <div class="row text-center">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <a href="http://localhost:803/laravel/carty/carty" class="btn btn-warning form-control">Seller Login</a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h6>OR</h6>
                                </div>
                                <div class="col-12 mb--20">
                                    <div class="form-group">
                                        <a href="signup_supplier.php" class="btn btn-dark form-control">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include "footer.php";
?>