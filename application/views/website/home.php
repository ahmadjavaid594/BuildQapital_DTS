<style>
    /* General Styling */
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
        justify-content: center;
        color: white;
        text-align: center;
        padding: 20px;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .hero h3 {
        font-size: 1.5rem;
        margin-top: 30px;
        margin-bottom: 40px;
    }

    .btn-lg {
        padding: 10px 20px;
        font-size: 1rem;
    }

    .toggle-icons {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 20px;
        flex-wrap: wrap;
    }

    .toggle-icons i {
        font-size: 30px;
        cursor: pointer;
        color: #007bff;
        transition: color 0.3s, transform 0.3s;
    }

    .toggle-icons i:hover {
        color: #0056b3;
        transform: scale(1.1);
    }

    .content-section {
        display: none;
        text-align: center;
        background-color: rgb(233, 240, 239);
        padding: 20px;
        border-radius: 5px;
        margin: 10px;
    }

    .content-section.active {
        display: block;
    }

    .marquee-container {
        height: 400px;
        overflow: hidden;
        position: relative;
        padding: 10px;
        border: 2px solid #ccc;
    }

    .marquee-content {
        position: absolute;
        width: 100%;
        animation: marquee 14s linear infinite;
    }

    @keyframes marquee {
        from {
            transform: translateY(0%);
        }
        to {
            transform: translateY(-50%);
        }
    }

    .marquee-container:hover .marquee-content {
        animation-play-state: paused;
    }

    .about-section {
        padding: 30px 20px;
        text-align: center;
    }

    .about-section h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .about-section p {
        font-size: 1rem;
        line-height: 1.8;
        text-align: justify;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero h1 {
            font-size: 2.5rem;
        }

        .hero h3 {
            font-size: 1.2rem;
        }

        .btn-lg {
            font-size: 0.9rem;
        }

        .toggle-icons {
            gap: 20px;
        }

        .toggle-icons i {
            font-size: 25px;
        }

        .marquee-container {
            height: 300px;
        }

        .about-section h1 {
            font-size: 2rem;
        }

        .about-section p {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .hero {
            flex-direction: column;
            padding: 10px;
        }

        .hero h1 {
            font-size: 2rem;
        }

        .hero h3 {
            font-size: 1rem;
        }

        .btn-lg {
            font-size: 0.8rem;
        }

        .toggle-icons {
            flex-direction: column;
            gap: 15px;
        }

        .toggle-icons i {
            font-size: 20px;
        }

        .marquee-container {
            height: 250px;
        }

        .about-section h1 {
            font-size: 1.8rem;
        }

        .about-section p {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .hero h1 {
            font-size: 1.8rem;
        }

        .hero h3 {
            font-size: 0.9rem;
        }

        .btn-lg {
            font-size: 0.7rem;
            padding: 8px 15px;
        }

        .toggle-icons {
            gap: 10px;
        }

        .toggle-icons i {
            font-size: 18px;
        }

        .marquee-container {
            height: 200px;
        }

        .about-section h1 {
            font-size: 1.5rem;
        }

        .about-section p {
            font-size: 0.7rem;
        }
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
   <div class="toggle-icons bg-light">
    
        <i id="new-project-icon" class="fa fa-plus-circle card" title="New Projects">New Projects    </i>
        <i id="ongoing-project-icon" class="fa fa-spinner card" title="Ongoing Projects">  Ongoing Projects</i>
        <br>
    </div>

    <!-- Content Sections -->
    <div class="row">
    <div id="new-projects" class="content-section">
        <h2>New Projects</h2>
        <p>Board of Intermediate and Secondary Education Abbotabad</p>
    </div>

    <div id="ongoing-projects" class="content-section">
    <h2>Ongoing Projects</h2>
    <p>Board of Intermediate and Secondary Education Dera Ismail Khan</p>
    </div>
    </div>
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
       <div>
           <h3 style="margin-top:30px;margin-bottom:20px;color:Red;">New Job Openings - <a href="/jobs">APPLY NOW!</a></h3>
           <p>Current Job Openings, Please review complete job advertisement:</p>
           <ul>
               <li>Computer Operator BPS-16</li>
               <li>Stenographer BPS-14</li>
               <li>Junior Clerk BPS-11</li>
               <li>Driver BPS-6</li>
               <li>Cook BPS-6</li>
               <li>Watchman BPS-3</li>
               <li>Naib Qasid BPS-3</li>
           </ul>
           <br>
           <span style="color:red;">Last Date to apply January 17, 2025</span>
       </div>
       <div>
       <h3 style="margin-top:30px;margin-bottom:20px;color:Red;">Job Applications Closed.</h3>
                   <p>Thank you for your interest! <br>The application deadline for below positions has passed, and we are no longer accepting submissions.<br>
We appreciate the effort of all applicants and encourage you to stay connected for future openings. If you have any questions or need assistance regarding these closed positions, please feel free to <a href="/contact">contact us</a>.<br>
                   <ul>
                       <li>Computer Operator BPS-16</li>
                       <li>Web Master BPS-16</li>
                       <li>Assistant Accounts Officer BPS-16</li>
                       <li>Junior Clerk BPS-11</li>
                   </ul>
                   <br>

<span style="color:red;"></span></p>
       </div>
   </div>
</div>

              
           </div>
       </div>
   </section>

   <script>
        document.addEventListener('DOMContentLoaded', function () {
            const newProjectIcon = document.getElementById('new-project-icon');
            const ongoingProjectIcon = document.getElementById('ongoing-project-icon');
            const newProjectsDiv = document.getElementById('new-projects');
            const ongoingProjectsDiv = document.getElementById('ongoing-projects');

            // Show "New Projects" and hide others when clicking the new project icon
            newProjectIcon.addEventListener('click', function () {
                newProjectsDiv.classList.add('active');
                ongoingProjectsDiv.classList.remove('active');
            });

            // Show "Ongoing Projects" and hide others when clicking the ongoing project icon
            ongoingProjectIcon.addEventListener('click', function () {
                ongoingProjectsDiv.classList.add('active');
                newProjectsDiv.classList.remove('active');
            });
        });
    </script>




 
</body>

</html>