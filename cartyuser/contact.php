<?php
ob_start();
session_start();
require_once "src/PHPMailer.php";
require_once "src/Exception.php";
require_once "src/SMTP.php";
require_once "vendor/autoload.php";
if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
    } ?>

<div class="contact-main-page">
            <div class="container-fluid">
                
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content">
                            <h3 class="contact-page-title">Contact Us</h3>
                            <p class="contact-page-message">There’s no shortage of remarkable ideas, what’s missing is the one who will execute them.</p>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-fax"></i> Address</h4>
                                <p>123 Main Street, Anytown, CA 12345 – USA</p>
                            </div>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-phone"></i> Phone</h4>
                                <p>Mobile: (+2011) 4489 5434</p>
                            </div>
                            <div class="single-contact-block last-child">
                                <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                <p>carspares54@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content">
                            <h3 class="contact-page-title" id="msg">Tell Us Your Message</h3>
                            <?php 
                            // echo("hello");
                            if(isset($_POST['contact'])){

                                $mailTo="doniaalaa56@gmail.com";
                                $message = ``;
                                unset($_POST['contact']);

                                foreach ($_POST as $key => $value) {
                                $message .= "<b>".$key. "</b> : " .$value."<br>";
                                // echo($key);echo($value);
                                }
                                // print_r($message);
                               

                                $mail = new  PHPMailer\PHPMailer\PHPMailer();
                                $mail->IsSMTP();
                                $mail->SMTPAuth = true;
                                $mail->SMTPSecure = 'ssl';
                                $mail->Host = "smtp.gmail.com";
                                $mail->Port = 465; // or 587
                                $mail->IsHTML(true);
                        
                                $mail->Username = "yourmobileapp2017@gmail.com";
                                $mail->Password = "ABC@123456bb";
                        
                                $mail->setFrom('yourmobileapp2017@gmail.com', 'Contact Us Message');
                                $mail->addAddress($mailTo, "");
                            

                                $mail->Subject = 'Contact Us Message';
                                $mail->Body = $message;
                                
                                if(!$mail->send()) {
                                    echo "<br><b>Opps! For some technical reasons we couldn't able to sent you an email. We will shortly get back to you with download details.";	
                                    echo "Mailer Error: " . $mail->ErrorInfo .'</b><br>';
                                } else {  
                                    $msg = "<h4 class='alert alert-success text-center'>Message has been sent , We will contact with you within 24 Hours </h4>";
                                }
                            }
                            ?>
                            <div class="contact-form">
                                <form  method="post" action="#msg">
                                <p class="form-messege" ><?php if(isset($msg)) {echo($msg);} ?></p>
                                    <div class="form-group">
                                        <label>Your Name <span class="required">*</span></label>
                                        <input type="text" name="name" id="con_name" required value ="<?php if(isset($_POST['name'])){echo($_POST['name']);} else{echo("");}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email <span class="required">*</span></label>
                                        <input type="email" name="email" id="con_email" required value ="<?php if(isset($_POST['email'])){echo($_POST['email']);} else{echo("");}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" id="con_subject" value ="<?php if(isset($_POST['subject'])){echo($_POST['subject']);} else{echo("");}?>">
                                    </div>
                                    <div class="form-group form-group-2">
                                        <label>Your Message<span class="required">*</span></label>
                                        <textarea name="message" id="con_message" required><?php if(isset($_POST['message'])){echo($_POST['message']);} else{echo("");}?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="submit" class="uren-contact-form_btn"  name="contact" style="cursor:pointer">
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->
        <div id="google-map"></div>
        
           

<!-- Begin Uren's Google Map Area -->
<script src="https://maps.google.com/maps/api/js?sensor=false&amp;libraries=geometry&amp;v=3.22&amp;key=AIzaSyChs2QWiAhnzz0a4OEhzqCXwx_qA9ST_lE"></script>

<script>
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 15,
            scrollwheel: false,
            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(30.132499, 31.318411), // New York
            // How you would like to style the map.
            // This is where you would paste any style found on
            styles: [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#e9e9e9"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#dedede"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                            "saturation": 36
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{
                            "color": "#f2f2f2"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                }
            ]
        };
        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('google-map');
        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);
        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(30.132499, 31.318440),
            map: map,
            title: 'Limupa',
            animation: google.maps.Animation.BOUNCE
        });
    }
</script>
<!-- Uren's Google Map Area End Here -->
<?php include "footer.php"; ?>
