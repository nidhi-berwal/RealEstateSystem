<?php include('header.php');
 include('db_connect.php');
 ?>


<!-- Embedded CSS for styling and typing effect -->
<style>
    /* Background and main container */
    body {
        background: url('p1.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }

    .main-content {
        background: rgba(255, 255, 255, 0.9);
        background-image: url('p2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        margin-top: 20px;
    }

    /* Navbar customization */
    .navbar {
        background-color: rgba(0, 0, 0, 0.7);
    }
    .navbar-brand, .navbar-nav .nav-link {
        color: #fff !important;
    }

    /* Search form styling */
    .search-form .form-control {
        width: 300px;
    }
    /* Hover and transition effect on cards */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for transform and shadow */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Initial subtle shadow */
}

/* On hover: scale the card and add a stronger shadow */
.card:hover {
    transform: scale(1.05); /* Slightly increase size on hover */
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2); /* Larger shadow on hover */
}

/* Styling for Card Images */
.card-img-top {
    width: 100%; /* Full width of the card */
    height: 200px; /* Fixed height for the images */
    object-fit: cover; /* Ensures the image covers the area without distortion */
}

/* For smoother shadow transition */
.card-body {
    transition: box-shadow 0.3s ease;
}


    /* Property cards */
    .property-card .card {
        transition: transform 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .property-card .card:hover {
        transform: scale(1.05);
    }

    /* Typing effect */
    .typing-text {
        display: inline;
        border-right: 2px solid #333;
        white-space: nowrap;
        overflow: hidden;
    }

    /* Center the text */
    .header-text {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Adjust spacing for sub-text */
    .sub-text {
        margin-top: 10px;
    }

    /* Card Section Styling */
    .card-section {
        margin-top: 50px;
    }
    .card-img-top {
    width: 100%; /* Make the image fill the width of the card */
    height: 500px; /* You can adjust the height as needed */
    object-fit: cover; /* Ensures the image covers the entire area without distortion */
}
</style>

<div class="container main-content py-5">
    <div class="header-text">
        <h1 class="text-center typing-text" id="main-heading"></h1>
        <p class="text-center typing-text sub-text" id="sub-heading"></p>
    </div>

    <!-- Property Search Form -->
    <form action="search.php" method="get" class="search-form form-inline justify-content-center my-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search by location or price" required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Bootstrap Cards for Landlords, Developers, and Service Providers -->
<div class="container card-section">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row justify-content-center">
        <!-- Landlords Card -->
        <div class="col-md-4 my-3">
            <div class="card">
                <img src="c2.jpg" class="card-img-top" alt="Landlords">
                <div class="card-body">
                    <h5 class="card-title">For Landlords</h5>
                    <p class="card-text">List your property and find reliable tenants easily.</p>
                    <a href="https://www.ire.ms/for-landlords" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Developers Card -->
        <div class="col-md-4 my-3">
            <div class="card">
                <img src="c4.jpg" class="card-img-top" alt="Developers">
                <div class="card-body">
                    <h5 class="card-title">For Developers</h5>
                    <p class="card-text">Showcase your latest developments and projects.</p>
                    <a href="https://www.ire.ms/for-developers" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>

        <!-- Service Providers Card -->
        <div class="col-md-4 my-3">
            <div class="card">
                <img src="c3.jpg" class="card-img-top" alt="Service Providers">
                <div class="card-body">
                    <h5 class="card-title">For Service Providers</h5>
                    <p class="card-text">Offer services such as cleaning, repairs, and more.</p>
                    <a href="https://www.ire.ms/for-serviceproviders" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const mainText = "Welcome to the Real Estate Management System";
    const subText = "Browse and manage properties easily.";
    const typingSpeed = 50;
    const delayBetweenTexts = 2000;

    function typeText(elementId, text, callback) {
        let i = 0;
        document.getElementById(elementId).innerHTML = "";
        function type() {
            if (i < text.length) {
                document.getElementById(elementId).innerHTML += text.charAt(i);
                i++;
                setTimeout(type, typingSpeed);
            } else if (callback) {
                setTimeout(callback, delayBetweenTexts);
            }
        }
        type();
    }

    function startTypingEffect() {
        typeText("main-heading", mainText, () => {
            typeText("sub-heading", subText, () => {
                setTimeout(() => {
                    document.getElementById("main-heading").innerHTML = "";
                    document.getElementById("sub-heading").innerHTML = "";
                    startTypingEffect();  // Restart the typing effect
                }, delayBetweenTexts);
            });
        });
    }

    startTypingEffect();  // Initiate the typing effect
</script>
