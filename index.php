<?php
    include 'db_connect.php';
    // echo "Inside php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleaning company</title>
    <script src="https://kit.fontawesome.com/ed80172cd4.js" crossorigin="anonymous"></script>
</head>
<style>
    .nav{
        display: flex;
        align-items: center;
        gap: 10rem;
        justify-content: space-around;
    }
    .nav ul{
        display: flex;
        gap: 5rem;
    }
    .nav ul li{
        list-style-type: none;
    }
    .nav ul li a{
        text-decoration: none;
        color: black;
    }
    .bgtext{
        margin-left: 50px;
        font-weight: bold;
    }
    .gradient-overlay {
    width: 100%; /* Set the width of the container */
    height: 500px; /* Set the height of the container */
    background-image: 
        linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), /* Dark gradient overlay */
        url(/cleaningagency/images/bg_1.jpg); /* Your background image */
    background-size: cover; /* Ensure the image covers the whole container */
    background-position: center; /* Center the image in the container */
    background-attachment: fixed;
    color: white;
    }
    #bgbutton{
        background-color: #2b98f0;
        border: 1px solid;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
    }
    #aboutusimg{
        width: 250px;
        height: 300px;
    }
    .aboutusdiv{
        display: flex;
        gap: 2rem;
        justify-content: center;
    }
    #viewstaff{
        background-color: #f3e53d;
        border: 1px solid #f3e53d;
        padding: 10px 15px;
        font-weight: bold;
    }
    #viewstaff:hover{
        cursor: pointer;
    }
    .service1{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10rem;
    }
    .service2{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10rem;
    }
    #ourprojectimg{
        width: 350px;
    }
    .ourproject1{
        display: flex;
        justify-content: space-around;
    }
    .ourproject2{
        display: flex;
        justify-content: space-around;
    }
    .contact-container {
    max-width: 600px;
    background: #fff;
    margin: 50px auto;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border-radius: 5px;
    }

        .contact-header h2 {
            color: #333;
        }

        .contact-header p {
            color: #666;
        }

        .contact-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group textarea {
            height: 100px;
        }

        #button {
            display: block;
            width: 25%;
            padding: 10px;
            background-color: #2b98f0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #button:hover {
            background-color: white;
            color: #2b98f0;
            border: 1px solid #2b98f0;
        }
        .newsletter{
            background-color: #2b98f0;
            padding: 20px;
        }
        .newsletter-form input[type="email"] {
        padding: 18px 10px;
        border: none;
        width: 150px;
        border-radius: 5px;
    }

    .newsletter-form button {
        padding: 18px 15px;
        border: none;
        background-color:#ced4da;
        color: black;
        cursor: pointer;
        border-radius: 5px;
    }

    .newsletter-form button:hover {
        background-color: #0056b3;
    }
    .newslettercontent{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5rem;
    }
    /* Footer Styles */
    .footer {
        background-color: #333;
        color: white;
        padding: 20px 0;
    }

    .footer-content {
        display: flex;
        justify-content: space-around;
        padding: 20px;
    }

    .footer-section {
        margin-bottom: 20px;
    }

    .footer-section h3 {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .footer-section p, .footer-section ul {
        list-style-type: none;
        line-height: 1.6;
    }

    .footer-section ul li a {
        color: white;
        text-decoration: none;
    }

    .footer-section ul li a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
        }
    }   
</style>

<body>
    <div class="nav">
        <div class="header">
            <h2 style="font-weight: bold; font-family:Verdana, Geneva, Tahoma, sans-serif;">CLEANING COMPANY</h2>
        </div>
        <div class="nav-menu">
            <ul>
                <li><a href="#teamandstaff">About</a></li>
                <li><a href="#servicesoffered">Services</a></li>
                <li><a href="#contactss">Contact</a></li>
                <li><a href="/cleaningagency/login.php">Login/Signup</a></li>
            </ul> 
        </div> 
    </div> 

    <div class="gradient-overlay">
        <br><br><br><br><br><br><br>
        <div class="bgtext">
        <h3>Leave the hourse cleaning chores to us</h3>
        <h1 style="font-size: 35px;">Let us do the dirty work, so you <br> don't have to.</h1> <br>
        <button id="bgbutton"><a href="/cleaningagency/signup.php" style="text-decoration: none; color: white;">Get started</a></button>
        </div>
    </div> <br><br><br><br><br>

    <div class="about-section">
        <h1 style="text-align: center;" id="teamandstaff">About Us</h1>
        <div class="aboutusdiv">

            <div> 
                <p style="color: #2b98f0; font-weight: bold; "><a href="" style="text-decoration: none;color: #2b98f0;" >Team & staff</a></p>
                <h1>Meet our team</h1>
                <p>Our mission is to exceed your expectations <br> with our reliability, quality, and flexibility. <br>We pride ourselves on our customer-focused <br> approach, and we strive to build lasting <br> relationships with our clients.</p>
                <button id="viewstaff">View All Staff</button>
            </div>

            <div><img src="/cleaningagency/images/staff-1.jpg" alt="" id="aboutusimg"></div><br>
            <div><img src="/cleaningagency/images/staff-2.jpg" alt="" id="aboutusimg"></div>
            <div><img src="/cleaningagency/images/staff-3.jpg" alt="" id="aboutusimg"></div>

        </div>
    </div> <br><br><br>

    <div class="services-section">
       <div class="services">
        <h1 style="text-align: center;" id="servicesoffered">Services Offered</h1> <br><br>
            <div class="service1">
                <div class="one">
                    <span style="font-size: 50px;"><i class="fa-solid fa-broom"></i></span> 
                    <h1>Sanitation</h1>
                    <p>Even the all-powerful Pointing <br> has no control about the blind <br> texts it is an almost unorthographic. <br><br> <span style="font-weight: bold; font-size: larger;color: #2b98f0;">Price : $50</span></p>
                </div>
                <div class="two">
                    <span style="font-size: 50px;"><i class="fa-solid fa-soap"></i></span>
                    <h1>Carpet cleaning</h1>
                    <p>Even the all-powerful Pointing <br>has no control about the blind<br> texts it is an almost unorthographic. <br><br> <span style="font-weight: bold; font-size: larger;color: #2b98f0;">Price : $50</span></p>
                </div>
                <div class="three">
                    <span style="font-size: 50px;"><i class="fa-solid fa-lines-leaning"></i></span> 
                    <h1>Window cleaning</h1>
                    <p> Even the all-powerful Pointing <br>has no control about the blind<br> texts it is an almost unorthographic. <br><br> <span style="font-weight: bold; font-size: larger;color: #2b98f0;">Price : $50</span></p>
                </div>
            </div> <br><br>
            
            <div class="service2">
                <div><span style="font-size: 50px;"><i class="fa-solid fa-broom"></i></span>
                    <h1>Deep cleaning</h1>
                    <p>Even the all-powerful Pointing<br> has no control about the blind<br> texts it is an almost unorthographic. <br><br> <span style="font-weight: bold; font-size: larger;color: #2b98f0;">Price : $100</span></p>
                </div>
                <div><span style="font-size: 50px;"><i class="fa-solid fa-soap"></i></span>
                    <h1>General cleaning</h1>
                    <p> Even the all-powerful Pointing<br> has no control about the blind<br> texts it is an almost unorthographic. <br><br> <span style="font-weight: bold; font-size: larger;color: #2b98f0;">Price : $100</span></p>
                </div>
                <div><span style="font-size: 50px;"><i class="fa-solid fa-lines-leaning"></i></span>
                    <h1>Sanitization </h1>
                    <p>Even the all-powerful Pointing<br> has no control about the blind <br>texts it is an almost unorthographic. <br><br> <span style="font-weight: bold; font-size: larger;color: #2b98f0;">Price : $100</span></p>
                </div>
            </div> <br><br>
            <button style="background-color: #2b98f0; border: 1px solid #2b98f0; padding: 10px 10px; margin-left: 30rem;"><a href="/cleaningagency/service_request.php" style="text-decoration: none; color: white; font-weight: bold;">Book a service now!</a></button>
        </div>
    </div> <br><br><br>

    <div class="ourproject">
        <p style="color: #2b98f0; text-align: center; font-weight: bold;" id="projectss">Our projects</p>
        <h1 style="text-align: center;">we have done many latest cleaning projects</h1>
        <div class="ourproject1">
            <div><img src="/cleaningagency/images/work-1.jpg" alt="" id="ourprojectimg"></div>
            <div><img src="/cleaningagency/images/work-2.jpg" alt="" id="ourprojectimg"></div>
            <div><img src="/cleaningagency/images/work-3.jpg" alt="" id="ourprojectimg"></div>
        </div> <br><br><br>
        <div class="ourproject2">
            <div><img src="/cleaningagency/images/work-4.jpg" alt="" id="ourprojectimg"></div>
            <div><img src="/cleaningagency/images/work-5.jpg" alt="" id="ourprojectimg"></div>
            <div><img src="/cleaningagency/images/work-7.jpg" alt="" id="ourprojectimg"></div>
        </div>
    </div> <br><br><br>

  <div class="contactus">
    <div class="contact-container">
        <div>
            <div class="contact-header">
                <h2 id="contactss">Contact Us</h2>
                <p>Your message was sent, thank you!</p>
            </div>
            <form class="contact-form">
                <div class="form-group">
                    <label for="fullname">FULL NAME</label>
                    <input type="text" id="fullname" name="fullname" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="email">EMAIL ADDRESS</label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="subject">SUBJECT</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="message">MESSAGE</label>
                    <textarea id="message" name="message" placeholder="Message"></textarea>
                </div>
                <button id="button" type="submit">SEND MESSAGE</button>
            </form>
        </div>
    </div>

    <div class="newsletter">
        <div class="newslettercontent">
            <h2 style="color: white;">Subscribe to our Newsletter</h2>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
  </div>

  <footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>Cleaning Company</h3>
            <p>A small river named Duden flows by their place  and supplies it with <br> the necessary regelialia.  It is a paradisematic country, in which roasted <br> parts of sentences fly into your mouth.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#teamandstaff">About</a></li>
                <li><a href="#servicesoffered">Services</a></li>
                <li><a href="#projectss">Works</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#contactss">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Have a Questions?</h3>
            <p>203 Fake St. Mountain View, San Francisco, California, USA</p>
            <p>+2 392 3929 210</p>
            <p>info@yourdomain.com</p>
        </div>
    </div>
</footer>
</body>
</html>