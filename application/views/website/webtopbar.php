<header class="header">
    <style>
        /* General Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #38ACEC; /* Dark background for header */
            padding: 10px 20px;
            position: relative; /* Positioning for z-index to work */
            z-index: 10; /* Ensures header is on top */
        }

        .logo-env {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }

        .header-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .header-menu li {
            margin: 0 10px;
        }

        .header-menu li a {
            color: white !important;
            font-size: 16px;
            padding: 10px 15px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .header-menu li a.active {
            background-color: #007bff; /* Active link background */
            color: #ffffff !important; /* Active link text color */
            border-radius: 5px;
        }

        .header-menu li a:hover {
            color: #ddd;
        }

        .toggle-sidebar-left {
            display: none; /* Hidden by default */
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                flex-wrap: wrap; /* Allows wrapping of header elements */
            }

            .header-menu {
                flex-direction: column; /* Stack menu items vertically */
                display: none; /* Hidden by default */
                background-color: #38ACEC; /* Match header background */
                width: 100%; /* Full width for mobile */
                padding: 10px 0;
                position: absolute; /* Ensures it doesn't push other elements */
                top: 100%; /* Positions the menu just below the header */
                left: 0;
                z-index: 20; /* Ensures it appears above everything else */
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for better visibility */
            }

            .header-menu.show {
                display: flex; /* Show menu when toggled */
            }

            .toggle-sidebar-left {
                display: block; /* Show menu toggle for small screens */
            }
        }
    </style>

    <!-- Logo -->
    <div class="logo-env">
        <a href="<?php echo base_url('home'); ?>" class="logo">
            <img src="<?php echo base_url('uploads/app_image/logo-small.png'); ?>" alt="Logo">
        </a>

        <!-- Hamburger Menu Icon -->
        <div class="toggle-sidebar-left" id="menu-toggle">
            <i class="fa fa-bars" aria-label="Toggle menu"></i>
        </div>
    </div>

    <!-- Menu -->
	<div class="header-left">
    <ul class="header-menu" id="header-menu">
        <li>
            <a href="<?php echo base_url('home'); ?>" 
               class="<?php echo (current_url() == base_url('home')) ? 'active' : ''; ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo base_url('services'); ?>" 
               class="<?php echo (current_url() == base_url('services')) ? 'active' : ''; ?>">Services</a>
        </li>
        <li>
            <a href="<?php echo base_url('about'); ?>" 
               class="<?php echo (current_url() == base_url('about')) ? 'active' : ''; ?>">About</a>
        </li>
        <li>
            <a href="<?php echo base_url('contact'); ?>" 
               class="<?php echo (current_url() == base_url('contact')) ? 'active' : ''; ?>">Contact Us</a>
        </li>
        <li>
            <a href="<?php echo base_url('jobs'); ?>" 
               class="<?php echo (current_url() == base_url('jobs')) ? 'active' : ''; ?>">Jobs</a>
        </li>
        <li>
            <a href="<?php echo base_url('resultsList'); ?>" 
               class="<?php echo (current_url() == base_url('resultsList')) ? 'active' : ''; ?>">Results</a>
        </li>
        <li>
            <a href="<?php echo base_url('login'); ?>" 
               class="<?php echo (current_url() == base_url('login')) ? 'active' : ''; ?>">Login</a>
        </li>
        <li>
            <a href="<?php echo base_url('register'); ?>" 
               class="<?php echo (current_url() == base_url('register')) ? 'active' : ''; ?>">Register</a>
        </li>
    </ul>
</div>

</header>

<script>
    // JavaScript to toggle the menu
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menu-toggle'); // Hamburger icon
        const headerMenu = document.getElementById('header-menu'); // Menu UL element

        // Add click event listener to toggle visibility
        menuToggle.addEventListener('click', function () {
            headerMenu.classList.toggle('show'); // Toggle the "show" class
        });
    });
</script>
