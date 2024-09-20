
<?php
session_start();
require_once "./header/frontHeader.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="e-learning, Intellectual Property, IP, Qualcomm, L2Pro, Patents, Standard Essential Patents, Industrial design, Confidential information, Inventions, Moral rights, Works of authorship, Service marks, Logos, Trademarks, Design rights, Commercial secrets, NDAs, Non-Disclosure Agreement, Start-ups">
    <meta name="language" content="en" />
    <title>L2Pro India</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <link href="../assetsnewdesign/css/style.css" rel="stylesheet">
    </head>

    <body>
     

      

        <!-- Navbar Start -->
        <div class="container-fluid navbg">
            <div class="container">
                <nav class="navbar navbar-dark navbar-expand-lg py-0">
                    <a href="index.html" class="navbar-brand">
                        <img src="../assetsnewdesign/images/L2Pro.png" alt="logo">
                    </a>
                    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                        <div class="navbar-nav ms-auto mx-xl-auto p-0">

                            <a href="#home" class="nav-item nav-link ">Home</a>
                            <a href="#about" class="nav-item nav-link">About L2Pro</a>
                            <a href="#partners" class="nav-item nav-link">Partners</a>
                            <a href="#media" class="nav-item nav-link">Media</a>
                         
                            <a href="#mobileapp" class="nav-item nav-link">Mobile App</a>
                             <a href="#new" class="nav-item nav-link">What's New</a>
                              <a href="#contact" class="nav-item nav-link">Contact us</a>
                              <a class=" btn animated fadeInRight Sign-in" href="login.php">Sign In</a>
                              <!-- <a class=" btn animated fadeInRight Sign-in" href="register.php">Create a Free Account</a> -->
                              
                        </div>
                    </div>
                  
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Carousel Start -->
        <div class="container-fluid px-0" id="home">
            <div id="carouselId" class="carousel slide" data-bs-ride="carousel" >
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="../assetsnewdesign/images/carousel-1.jpg" class="img-fluid" alt="First slide">
                        <div class="carousel-caption">
                            <div class="container carousel-content py-5">
                                <h6 class="text-secondary h4 animated fadeInUp">L2Pro</h6>
                                <h1 class="text-white display-1 mb-4 animated fadeInRight">Learn to Protect, Secure, and Maximize Your Innovations</h1>
                                <p class="mb-4 text-white fs-5 animated fadeInDown">Awareness about intellectual property (IP) is crucial for encouraging innovation and entrepreneurship in businesses and start-ups.

The L2Pro IP training e-learning program will introduce you to the various forms of IPRs, including patents, trademarks, and copyrights. At the end of the program, you will have a good understanding of how to use them to help protect and grow your business.

Let’s get you started on your learning journey.</p>
                                <a href="" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Read More</button></a>
                                <a href="" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Contact Us</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../assetsnewdesign/images/carousel-2.jpg" class="img-fluid" alt="Second slide">
                        <div class="carousel-caption">
                            <div class="container carousel-content">
                                <h6 class="text-secondary h4 animated fadeInUp">L2Pro</h6>
                                <h1 class="text-white display-1 mb-4 animated fadeInLeft">Quality Digital Services You Really Need!</h1>
                                <p class="mb-4 text-white fs-5 animated fadeInDown">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Pellentesque aliquam dolor eget urna ultricies tincidunt.</p>
                                <a href="" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Read More</button></a>
                                <a href="" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInRight">Contact Us</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Fact Start -->
        <div class="container-fluid bg-secondary py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">99</h1>
                            <h5 class="text-white mt-1">Success in getting happy customer</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">25</h1>
                            <h5 class="text-white mt-1">Thousands of successful business</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".5s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">120</h1>
                            <h5 class="text-white mt-1">Total clients who love HighTech</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                        <div class="d-flex counter">
                            <h1 class="me-3 text-primary counter-value">5</h1>
                            <h5 class="text-white mt-1">Stars reviews given by satisfied clients</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact End -->


        <!-- About Start -->
        <div class="container-fluid py-5 my-5" >
            <div class="container pt-5">
                <div class="row g-5">
                    <div class="col-lg-6 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                        <!-- <div class="h-100 position-relative">
                            <img src="images/about-1.jpg" class="img-fluid w-75 rounded" alt="" style="margin-bottom: 25%;">
                            <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                                <img src="images/about-2.jpg" class="img-fluid w-100 rounded" alt="">
                            </div>
                        </div> -->

                        <video style="width:100%;max-width: 600px;" autoplay="" muted="" controls="controls">
                    <source src="../assetsnewdesign/images/introduction.m4v" type="video/mp4">
                    <source src="../assetsnewdesign/images/introduction.m4v" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                        <h1 class="text-primary">L2Pro Highlights</h1>
                       
                        <p class="mb-4">L2Pro will increase awareness and aid in a better understanding of the IP domain. You will learn how to</p>
                      
                      <ul class="list-unstyled list-view">
                    <li><i class="bi bi-check"></i> Protect innovations with patents,</li>
                    <li><i class="bi bi-check"></i> Use copyrights to protect software,</li>
                    <li><i class="bi bi-check"></i> Develop trademarks,</li>
                    <li><i class="bi bi-check"></i> Integrate IP considerations into company business models</li>
                    <li><i class="bi bi-check"></i> Obtain value from research and development (R&amp;D) efforts.</li>
                    <li><i class="bi bi-check"></i> Enable innovators to access tools to help bring innovations quickly to market.</li>
                </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Services Start -->
        <div class="container-fluid services py-5 mb-5" id="about">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 800px;">
                    <h1 class="text-primary">L2Pro E-Learning IP Training platform</h1>
                    <p class="mb-4">The L2Pro course has 11 modules, which are distributed into three levels: basic, intermediate, and advanced. Each module explains the concept using text, quizzes and short videos. Every lesson also provides links to additional resources on the subject.</p>
                </div>
                <div class="row g-5 services-inner">
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-code fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">Basic Level</h4>
                                  <ul class="list-unstyled list-view text-start">
                    <li>
                        <i class="bi bi-check"></i> IP Fundamentals: General Introduction, Patents
                    </li>
                    <li>
                      <i class="bi bi-check"></i>  IP Fundamentals: Trademarks &amp; Geographical Indications
                    </li>
                    <li>
                     <i class="bi bi-check"></i>  IP Fundamentals: Copyrights &amp; Neighbouring Rights, Industrial Designs Protection
                    </li>
                    <li>
                     <i class="bi bi-check"></i>   IP Fundamentals: Unfair Competition, Trade Secrets, Plant Variety Protection
                    </li>
                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-file-code fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">Intermediate Level</h4>
                                   <ul class="list-unstyled list-view text-start">
                    <li>
                        <i class="bi bi-check"></i>
                        Securing your IP: Filing and acquisition of IP.
                    </li>
                    <li> <i class="bi bi-check"></i>
                        Market Assessment: IP Searches and FTO
                    </li>
                    <li> <i class="bi bi-check"></i>
                        IP Commercialization: Assignment and Licensing Arrangements
                    </li>
                    <li> <i class="bi bi-check"></i>
                        Managing IP Portfolios: Territorial Considerations and Relevance of Restrictive Covenants
                    </li>
                </ul>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                        <div class="services-item bg-light">
                            <div class="p-4 text-center services-content">
                                <div class="services-content-icon">
                                    <i class="fa fa-external-link-alt fa-7x mb-4 text-primary"></i>
                                    <h4 class="mb-3">Advance Level</h4>
                                   <ul class="list-unstyled list-view text-start">
                    <li>
                        <i class="bi bi-check"></i> Access to Funding and Venture Capital and IP
                    </li>
                    <li>
                        <i class="bi bi-check"></i> Introduction to Standards and Standard Setting Organizations (SSOs)
                    </li>
                    <li>
                       <i class="bi bi-check"></i>  Dealing with Disputes: Infringement, Validity and Defenses, arbitration
                    </li>
                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Services End -->


        <!-- Project Start -->
        <div class="container-fluid project py-5 mb-5" >
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 800px;">
                    <h1 class="text-primary">L2Pro Certification</h1>
                  <p class="mb-4">At the end of every level, there is an assessment based on a case study along with questions to test your learning. Successful learners are provided e-certificates jointly awarded by CIPAM, NLUD, and Qualcomm.</p> 
                </div>
                <div class="row ">
                    <div class="col-md-8 mx-auto wow fadeIn" data-wow-delay=".3s">
                        <div class="project-item">
                            <div class="project-img">
                                <img src="../assetsnewdesign/images/certificate.jpg" class="img-fluid w-100 rounded" alt="">
                                <div class="project-content">
                                    <a href="#" class="text-center">
                                        <h4 class="text-secondary">L2Pro Certification</h4>
                                        <p class="m-0 text-white">Congrats!!</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Project End -->


     

       

        <!-- Testimonial Start -->
        <div class="container-fluid testimonial py-5 mb-5" id="partners">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 800px;">
                    <h1 class="text-primary">Partners</h1>
                   
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay=".5s">
                    <div class="testimonial-item border p-4">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <img src="../assetsnewdesign/images/logo1.png" alt="">
                            </div>
                            <div class="ms-4">
                                <h4 class="text-secondary">DPIIT</h4>
                                
                            </div>
                        </div>
                        <div class="border-top mt-4 pt-3">
                            <p class="mb-0">The role of the Department for Promotion of Industry and Internal Trade (DPIIT) is to promote/accelerate the industrial Development of the Country by facilitating investment in new and upcoming technology, foreign direct investment and supporting the balanced development of industries</p>
                        </div>
                    </div>
                    <div class="testimonial-item border p-4">
                        <div class=" d-flex align-items-center">
                            <div class="">
                                <img src="../assetsnewdesign/images/cpam.png" alt="">
                            </div>
                            <div class="ms-4">
                                <h4 class="text-secondary">CIPAM</h4>
                               
                            </div>
                        </div>
                        <div class="border-top mt-4 pt-3">
                            <p class="mb-0">CIPAM is a professional body under the aegis of Department for Promotion of industry and Internal Trade(DPIIT) which ensures focused action on issues related to Intellectual Property Rights (IPR). CIPAM assists in simplifying and streamlining of IP processes, apart from undertaking steps for furthering IPR awareness, commercialization and enforcement.</p>
                        </div>
                    </div>
                    <div class="testimonial-item border p-4">
                        <div class=" d-flex align-items-center">
                            <div class="">
                                <img src="../assetsnewdesign/images/ciipc.png" alt="">
                            </div>
                            <div class="ms-4">
                                <h4 class="text-secondary">CIIPC</h4>
                                
                            </div>
                        </div>
                        <div class="border-top mt-4 pt-3">
                            <p class="mb-0">The Centre for Innovation, Intellectual Property and Competition (CIIPC) has been established at the National Law University Delhi with the aim of supporting academic and policy oriented dialogues in the areas of innovation, IP and competition</p>
                        </div>
                    </div>
                    <div class="testimonial-item border p-4">
                        <div class=" d-flex align-items-center">
                            <div class="">
                                <img src="../assetsnewdesign/images/NLU-logo.png" alt="">
                            </div>
                            <div class="ms-4">
                                <h4 class="text-secondary">NLUD</h4>
                                
                            </div>
                        </div>
                        <div class="border-top mt-4 pt-3">
                            <p class="mb-0">National Law University, Delhi (NLUD) is a premier law school committed to training future generations of lawyers. National Law University, Delhi endeavoures to provide clinical and interdisciplinary legal education having interface with finance, technology, business and provide necessary skills to students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial End -->

 <!-- Media Start -->
        <div class="container-fluid project py-5 mb-5" id="media">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 800px;">
                    <h1 class="text-primary">L2Pro Webinars</h1>
                  
                </div>
                <div class="row ">
                    <div class="col-md-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="project-item">
                            <div class="project-img">
                             <a href="https://www.youtube.com/channel/UCKqBBz0GyhpsSZHrU3Tfd0Q" target="_blank"><p style="height:170px;background-color:#3252CD;display:flex;justify-content:center;align-items:center;flex-direction: row;margin:0;font-size:24px;color:#fff;"><i class="bi bi-youtube" aria-hidden="true" style="margin-right: 10px;"></i>
                    PREVIOUS WEBINAR</p></a>
                                
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="project-item">
                            <div class="project-img">
                               <video style="display:flex;justify-content: center;align-items:center;width:100%;    max-height: 250px;" muted controls="controls">
                    <source src="../assetsnewdesign/images/L2Pro webinar.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                                
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="project-item">
                            <div class="project-img">
                             <video style="display:flex;justify-content: center;align-items:center;width:100%;    max-height: 250px;" muted controls="controls">
                    <source src="../assetsnewdesign/images/L2Pro webinar.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- Media End -->


<div class="container-fluid bg-secondary py-5" id="mobileapp">
            <div class="container">
                <div class="row">
              <h1 class="text-white animated fadeInRight text-center">Mobile App</h1>    
             <p class="mb-4 text-white fs-5 animated fadeInDown text-center">Now You Can Enjoy Our Services On Latest Android And IOS Devices</p> 
                 
             <div class="row mobileApp" style="display: flex;flex-direction: row;align-items: center;">
                <div class="col-6 col-sm-6 col-md-6 mobile-align-center" style="display: flex;justify-content: space-evenly;align-items: flex-end;height: 200px;flex-direction: column;">
                    <img src="../assetsnewdesign/images/availableOnAndriod.png" style="width:190px; cursor:pointer;" class="animated fadeInLight ">
                    <img src="../assetsnewdesign/images/availableOnIOS.png" style="width:190px;cursor:pointer;" class="animated fadeInLight">
                </div>
                <div class="col-6 col-sm-6 col-md-6 mobile-align-center" style="display: flex;justify-content: flex-start;align-items: center;">
                    <img src="../assetsnewdesign/images/phone_img.png" class="img-fluid animated fadeInRight ">
                </div>
            </div>
                </div>
            </div>
        </div>




        <!-- Contact Start -->
        <div class="container-fluid py-5 mb-5" id="contact">
            <div class="container">
                <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                    <h5 class="text-primary">Get In Touch</h5>
                    <h1 class="mb-3">Contact for any query</h1>
                    <!-- <p class="mb-2">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p> -->
                </div>
                <div class="contact-detail position-relative p-5">
                    <div class="row g-5 mb-5 justify-content-center">
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Address</h4>
                                    <a href="https://goo.gl/maps/Zd4BCynmTb98ivUJ6" target="_blank" class="h5">23 rank Str, NY</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fa fa-phone text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Call Us</h4>
                                    <a class="h5" href="tel:+0123456789" target="_blank">+012 3456 7890</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                            <div class="d-flex bg-light p-3 rounded">
                                <div class="flex-shrink-0 btn-square bg-secondary rounded-circle" style="width: 64px; height: 64px;">
                                    <i class="fa fa-envelope text-white"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="text-primary">Email Us</h4>
                                    <a class="h5" href="mailto:info@example.com" target="_blank">info@example.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                            <div class="p-5 h-100 rounded contact-map">
                                <!-- <iframe class="rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3025.4710403339755!2d-73.82241512404069!3d40.685622471397615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c26749046ee14f%3A0xea672968476d962c!2s123rd%20St%2C%20Queens%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1686493221834!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                                <iframe class="rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.13537021868!2d77.31959397416692!3d28.595715485754063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce4fa61b81603%3A0x4eec85f89eb7e309!2sLIQVID%20eLearning%20Services%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1726556413842!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                         <?php if (isset($_POST['contact_name']) && $_POST['contact_name'] != "" && isset($_POST['contact_email']) && $_POST['contact_email'] != "" && isset($_POST['contact_subject']) && $_POST['contact_subject'] != "") {
                    print_r("<script>alert('hello');</script>");
                    $contact_name = $_POST['contact_name'];
                    $contact_email = $_POST['contact_email'];
                    $contact_subject1 = $_POST['contact_subject'];
                    $contact_message = $_POST['contact_msg'];
                    //echo "<pre>";print_r($_POST);exit;
                    try {
                        require_once('contact_us_mailer.php');
                        $contact_name = '';
                        $contact_email = '';
                        $contact_subject1 = '';
                        $contact_message = '';
                    } //catch exception
                    catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        exit;
                    }
                }
                //vinayak soni added else here
                else {

                    $contact_name = '';
                    $contact_email = '';
                    $contact_subject1 = '';
                    $contact_message =  '';
                }
                $contact_msg = '';
                $contact_err = '';
                $contact_succ = '';
                //echo "<pre>";print_r($_SESSION);exit;
                if (isset($_SESSION['contact_error']) && $_SESSION['contact_error'] != '') {
                    if ($_SESSION['contact_error'] == '1') {
                        $contact_msg = '<label class="required showErr error login_msg_err" id="login_msg_err" >Invalid email address or problem in server</label>';
                    }
                    if ($_SESSION['contact_error'] == '2') {
                        $contact_msg = '<label class="required showErr error login_msg_err" id="login_msg_err" >Invalid user</label>';
                    }
                }
                if (isset($_SESSION['contact_success']) && $_SESSION['contact_success'] != '') {
                    if ($_SESSION['contact_success'] == '1') {
                        $contact_msg = 'Your query has been sent to successfully.';
                    }
                }
                if (isset($_SESSION['contact_success']) && $_SESSION['contact_success'] != "") {

                    $contact_succ = $_SESSION['contact_success'];
                    unset($_SESSION['contact_success']);
                }
                if (isset($_SESSION['contact_error']) && $_SESSION['contact_error'] != "") {
                    $contact_err = $_SESSION['contact_error'];
                    unset($_SESSION['contact_error']);
                }
                ?>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <form type="hidden" action="" method="get"></form>
                        <form action="new_contactus_mailer.php" action="post" data-validate="parsley" enctype="multipart/form-data" autocomplete="off" id="contact" method="post">
                            <div class="p-5 rounded contact-form">
                                <div class="mb-4">
                                    <input type="text" class="form-control border-0 py-3" name='contact_name' id="contact_name" type="text" placeholder="Your Name*" data-required="true" value="<?php echo $contact_name; ?>" maxlength="50" autocomplete="first-name" data-regexp="^[a-zA-Z ]+$" data-regexp-message="Name should contain characters only." tabindex="1">
                                </div>
                                <div class="mb-4">
                                    <input type="email" class="form-control border-0 py-3" name='contact_email' id="contact_email" placeholder="Your Email*" data-required="true" data-type="email" value="<?php echo $contact_email; ?>" maxlength="50" autocomplete="new-email" type="email" tabindex="2">
                                </div>
                                <div class="mb-4">
                                    <input type="text" class="form-control border-0 py-3" name="contact_subject" id="contact_subject" placeholder="Organization Name" type="text" data-required="true" maxlength="100" value="<?php echo $contact_subject1; ?>" autocomplete="new-subject" tabindex="3">
                                </div>
                                <div class="mb-4">
                                    <textarea class="w-100 form-control border-0 py-3" rows="6" cols="10" rows="4" placeholder="Message*" name="contact_msg" id="contact_msg" maxlength="1000" data-required="true" tabindex="4" autocomplete="off" style="height:80px; resize: none;" class="parsley"><?php echo $contact_message; ?></textarea>
                                </div>
                                <div class="form-group col-12 text-left">
                                        <label class="required" id="contactError" style="display:block;">
                                            <?php
                                            if ($contact_err == '1' || $contact_err == '2') {
                                                echo '<span class="err" style="color:red;background-color:#fff;display:block;width:100%;">' . $contact_msg  . '</span>';
                                            }
                                            if ($contact_succ == '1') {
                                                echo '<span class="text-success" style="color:green;background-color:#fff;display:block;width:100%;   padding-left: 15px;">' . $contact_msg  . '</span>';
                                            }
                                            ?>    
                                        </label>
                                   
                                </div>
                                <div class="text-start">
                                    <button class="btn bg-primary text-white py-3 px-5" type="submit">Send Message</button>
                                </div>
                            </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- Contact End -->


        <!-- Footer Start -->
         <div class="container-fluid footer bg-dark wow fadeIn" data-wow-delay=".3s">
            <div class="container pt-5 pb-4">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <a href="index.html">
                            <h1 class="text-white fw-bold d-block"><a href="index.html" class="navbar-brand">
                        <img src="../assetsnewdesign/images/L2Pro.png" alt="logo">
                    </a> </h1>
                        </a>
                        <p class="mt-4 text-light">Awareness about intellectual property (IP) is crucial for encouraging innovation and entrepreneurship in businesses and start-ups.</p>
                        <div class="d-flex hightech-link">
                            <a href="" class="btn-light nav-fill btn btn-square rounded-circle me-2"><i class="fab fa-facebook-f text-primary"></i></a>
                            <a href="" class="btn-light nav-fill btn btn-square rounded-circle me-2"><i class="fab fa-twitter text-primary"></i></a>
                            <a href="" class="btn-light nav-fill btn btn-square rounded-circle me-2"><i class="fab fa-instagram text-primary"></i></a>
                            <a href="" class="btn-light nav-fill btn btn-square rounded-circle me-0"><i class="fab fa-linkedin-in text-primary"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#" class="h3 text-secondary">Short Link</a>


                        <div class="mt-4 d-flex flex-column short-link">
                            <a href="#about" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>About L2Pro</a>
                            <a href="#partners" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Partners</a>
                            <a href="#media" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Our Media</a>
                            <a href="#mobileapp" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Our Mobile App</a>
                            <a href="#new" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>What's New</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#" class="h3 text-secondary">Help Link</a>
                        <div class="mt-4 d-flex flex-column help-link">
                           
                            <a href="privacy_policy.php" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Privacy Policy</a>
                            <a href="tnc.php" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Terms of Conditions</a>
                            
                            <a href="#contact" class="mb-2 text-white"><i class="fas fa-angle-right text-secondary me-2"></i>Contact</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="#" class="h3 text-secondary">Contact Us</a>
                        <div class="text-white mt-4 d-flex flex-column contact-link">
                            <a href="#" class="pb-3 text-light border-bottom border-primary"><i class="fas fa-map-marker-alt text-secondary me-2"></i> 123 Street, New York, USA</a>
                            <a href="#" class="py-3 text-light border-bottom border-primary"><i class="fas fa-phone-alt text-secondary me-2"></i> +123 456 7890</a>
                            <a href="#" class="py-3 text-light border-bottom border-primary"><i class="fas fa-envelope text-secondary me-2"></i> info@l2pro.com</a>
                        </div>
                    </div>
                </div>
                <hr class="text-light mt-5 mb-4">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <span class="text-light"><a href="#" class="text-secondary"> All right reserved,   Copyright© Powered by LIQVID.</span>
                    </div>
                  
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i class="fa fa-arrow-up text-white"></i></a>

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../assetsnewdesign/js/wow.min.js"></script>
        <script src="../assetsnewdesign/js/easing.min.js"></script>
        <script src="../assetsnewdesign/js/waypoints.min.js"></script>
        <script src="../assetsnewdesign/js/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="../assetsnewdesign/js/main.js"></script>
    </body>

</html>