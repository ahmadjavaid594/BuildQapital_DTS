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
            background: url('uploads/app_image/dts1.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }
        .display_image{
            width: 80%;
            border-radius: 20px;
            padding: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .hero h1 {
            font-size: 5rem;
            margin-bottom: 20px;
        }

        .service-icon {
            font-size: 50px;
            color: #007bff;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 90px 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Empowering National Companies</br>with Comprehensive Testing Services</h1>
            <h3 style="margin-top:30px;margin-bottom: 40px;">Partnering with DTS to streamline your candidate screening process and find the perfect match.</h3>
            <a href="/jobs" class="btn btn-primary btn-lg">VIEW NEW JOB OPENINGS</a>
        </div>
    </header>

    <!-- Services Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container" style="padding-top:30px;padding-bottom:50px;">
            <h1>About Us</h1>
            <div class="row">
                <div class="col-md-6 card service-card">
                   
                    <h3 style="margin-top:30px; margin-bottom:20px;">Connecting Companies with Top Candidates</h3>
                    <p>In educational institutions, our goal is to provide standardization and transparency in the selection criteria, eliminating the discriminations caused by the quota system, and offering opportunities for talented individuals to be selected in both public and private sector universities under the Higher Education Commission.<br><br>

For other sectors, DTS leads in contributing improved assessment strategies, capacity building, training, and research and development in human resource development (HRD) for both public and private sector organizations. Our tests, based on integrated sets of questionnaires and inventories for personality, aptitude, and ability testing, are designed using state-of-the-art theory and practice. They provide reliable services for personality analysis and self-awareness, vocational counseling and career choice, personnel assessment and selection, and overall human resources management.</p>
                </div>
                <div class="marquee-container">
    <div class="marquee-content">
        <h3 style="margin-top:30px;margin-bottom:20px;color:Red;">New Job Openings - <a href="/jobs">APPLY NOW!</a></h3>
        <p>Current Job Openings, Please review complete job advertisement, <br>
        <ul>
            <li>Computer Operator BPS-16</li>
            <li>Web Master BPS-16</li>
            <li>Assistant Accounts Officer BPS-16</li>
            <li>Junior Clerk BPS-11</li>
        </ul>
        <br>
        <span style="color:red;">Last Date to apply December 15, 2024</span></p>
    
       
    </div>
</div>

<style>
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    /* Optional for background */
    border: 2px solid #ccc; /* Optional for styling */
    position: relative;
}

.marquee-content {
    display: inline-block;
    padding-left: 100%; /* Start off-screen */
    animation: marquee 5s linear infinite; /* Adjust duration as needed */
    white-space: nowrap;
}

@keyframes marquee {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}

/* Pause the animation on hover */
.marquee-container:hover .marquee-content {
    animation-play-state: paused;
}
</style>

               
            </div>
        </div>
    </section>
    
    <!-- Footer -->


  
</body>

</html>