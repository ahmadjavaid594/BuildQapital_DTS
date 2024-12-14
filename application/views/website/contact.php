
    <style>
       
        .service-card {
            transition: transform 0.3s;
            padding: auto;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .service-icon {
            font-size: 40px;
            color: #007bff;
        }
        .hero {
            background: url('uploads/app_image/dts4.jpg') no-repeat center center/cover;
            height: 40vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }
        .display_image{
            width: 100%;
            border-radius: 20px;
            padding: auto;
            margin: 20px;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .service-icon {
            font-size: 50px;
            color: #007bff;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>


    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Contact Us</h1>
            <h3>We would love to hear from you!</br>Please reach out with any questions or feedback.</h3>
           
        </div>
    </header>

    <section id="services" class="py-5 bg-light">
    <div class="container" style="padding-top:30px; padding-bottom:50px;">
        <div class="text-center mb-5">
            <h1>Our Location</h1>
           
        </div>
        
        <div class="row" style="padding-top:30px; padding-bottom:50px;">
            <!-- Service Card 1 -->
            <div class="col-md-6 mb-6">
                <img class="display_image" src ="uploads/app_image/map.png"></img>
            </div>

            <!-- Service Card 2 -->
            <div class="col-md-6 mb-6">
                <div class="card service-card p-3 text-left h-100" style="padding-left:10px;">
                    
                    <h2 style="padding-top:50px;">Professional Testing </h2>
                    <p class="card-text">DTS is a leading autonomous body providing national companies with comprehensive testing services to ensure they hire the right candidates for their organizations.</p>
                    <h3>Address</h2>
                    <p class="card-text">Al Sahib Arcade Rawalpindi</p>
                    <h3>Timings</h3>
                    <p class="card-text">Mon-Fri: 9am-5pm</p>
                  
                    <h3>Contact</h3>
                    <p class="card-text">Landline: 051-6149457<br> Mobile: 03 33 34 34 187</p>
                    


                </div>
            </div>

        </div>
    </div>
</section>

  
</body>

