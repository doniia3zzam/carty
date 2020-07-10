<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
    } ?>

        <!-- Begin Uren's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>About US</h2>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Uren's Breadcrumb Area End Here -->
        <!-- Begin Uren's About Us Area -->
        <div class="about-us-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-5">
                        <div class="overview-img text-center img-hover_effect">
                            <a href="#">
                                <img class="img-full" src="assets/images/about-us/1.jpg" alt="Uren's About Us Image">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7 d-flex align-items-center">
                        <div class="overview-content">
                            <h2>Welcome To <span>Uren's</span> Store!</h2>
                            <p class="short_desc">it is an e-commerce auto parts retailer. With over 10 million orders shipped,
                            we’ve helped millions of customers to fix their car without breaking the bank.
                            Our vast catalog provides a one-stop-shop for quality, discount auto parts and car accessories across a large selection of vehicle makes,
                            including many types of cars. All of our parts are sourced by industry veterans with
                            a high standard for quality control as well as a combined 100+ years of experience in automotive mechanics.</p>
                            <p>
                            <b>SIMPLE SHOPPING EXPERIENCE</b> <br>

                            our online catalog carries over a million parts for vehicles ranging from 1980 to the present, ensuring you’ll find the right part,
                            at the right time, and at an unbeatable price, guaranteed. Adding in a secure and easy checkout. we provides a quick and
                            stress-free shopping journey.</p>

                            <p>
                           <b> CUSTOMER SERVICE</b> <br>
                            If you have any questions,  please reachout to our customer service team toll free at 1 (866) 529-0412, live chat, or email.
                            Our hours of operation are 9am to 11pm Monday – Sunday.
                            Happy driving from all of us at Uren's.com! Contact Us.</p>

                            <div class="uren-about-us_btn-area">
                                <a class="about-us_btn" href="allproducts.php">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's About Us Area End Here -->

        <!-- Begin Uren's Project Countdown Area -->
        <div class="project-count-area" style="padding-bottom:85px;" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-count text-center">
                            <div class="count-icon">
                                <span class="ion-ios-briefcase-outline"></span>
                            </div>
                            <div class="count-title">
                                <h2 class="count">2169</h2>
                                <span>Project Done</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-count text-center">
                            <div class="count-icon">
                                <span class="ion-ios-wineglass-outline"></span>
                            </div>
                            <div class="count-title">
                                <h2 class="count">869</h2>
                                <span>Awards Winned</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-count text-center">
                            <div class="count-icon">
                                <span class="ion-ios-lightbulb-outline"></span>
                            </div>
                            <div class="count-title">
                                <h2 class="count">689</h2>
                                <span>Hours Worked</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-count text-center">
                            <div class="count-icon">
                                <span class="ion-happy-outline"></span>
                            </div>
                            <div class="count-title">
                                <h2 class="count">2169</h2>
                                <span>Happy Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's Project Countdown Area End Here -->

        <?php include "footer.php"; ?>
