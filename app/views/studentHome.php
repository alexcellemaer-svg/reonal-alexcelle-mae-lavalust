<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Home Page</title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        :root {

            --green: #16a34a;
            --green-dark: #15803d;
            --green-light: #22c55e;

            --green-soft: #dcfce7;

            --dark: #052e16;
            --text: #1e293b;
            --muted: #64748b;

            --white: #ffffff;

            --background: #f0fdf4;

            --border: #d1fae5;
        }


        body {

            font-family: Arial, Helvetica, sans-serif;

            color: var(--text);

            min-height: 100vh;

            background:

                radial-gradient(
                    circle at top right,
                    rgba(34,197,94,.15),
                    transparent 30%
                ),

                radial-gradient(
                    circle at bottom left,
                    rgba(16,185,129,.10),
                    transparent 30%
                ),

                var(--background);

            overflow-x: hidden;
        }


        /* =========================
           DECORATIVE BACKGROUND
        ========================= */

        .circle {

            position: fixed;

            border-radius: 50%;

            pointer-events: none;

            z-index: 0;

            filter: blur(2px);
        }


        .circle-1 {

            width: 330px;
            height: 330px;

            top: -130px;
            right: -80px;

            background:
                rgba(34,197,94,.10);

            animation:
                floating 6s ease-in-out infinite;
        }


        .circle-2 {

            width: 250px;
            height: 250px;

            bottom: 40px;
            left: -100px;

            background:
                rgba(16,185,129,.10);

            animation:
                floating 7s ease-in-out infinite reverse;
        }


        @keyframes floating {

            0%,100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(20px);
            }
        }


        /* =========================
           NAVIGATION
        ========================= */

        .navbar {

            height: 70px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 7%;

            background:
                rgba(255,255,255,.92);

            backdrop-filter:
                blur(15px);

            border-bottom:
                1px solid var(--border);

            box-shadow:
                0 4px 20px
                rgba(5,46,22,.06);

            position: relative;

            z-index: 10;
        }


        .logo {

            display: flex;

            align-items: center;

            gap: 11px;

            color: var(--dark);

            text-decoration: none;

            font-size: 20px;

            font-weight: bold;
        }


        .logo-icon {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:

                linear-gradient(
                    135deg,
                    var(--green),
                    var(--green-dark)
                );

            border-radius: 12px;

            color: white;

            font-size: 21px;

            box-shadow:
                0 6px 15px
                rgba(22,163,74,.25);
        }


        .logo span {
            color: var(--green);
        }


        .nav-links {

            display: flex;

            align-items: center;

            gap: 8px;

            list-style: none;
        }


        .nav-links a {

            color: #475569;

            text-decoration: none;

            padding: 10px 16px;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 600;

            transition:
                all .25s ease;
        }


        .nav-links a:hover {

            background:
                var(--green-soft);

            color:
                var(--green-dark);

            transform:
                translateY(-2px);
        }


        .nav-links a.active {

            background:
                var(--green);

            color:
                white;

            box-shadow:
                0 5px 15px
                rgba(22,163,74,.20);
        }


        .nav-links a.active:hover {

            background:
                var(--green-dark);

            color: white;
        }


        /* =========================
           MAIN
        ========================= */

        .container {

            max-width: 1100px;

            margin: auto;

            padding:
                65px 25px 80px;

            position: relative;

            z-index: 1;
        }


        /* =========================
           WELCOME SECTION
        ========================= */

        .welcome-section {

            display: grid;

            grid-template-columns:
                1.2fr .8fr;

            gap: 35px;

            align-items: stretch;
        }


        .welcome-card {

            background:
                white;

            border:
                1px solid var(--border);

            border-radius:
                24px;

            padding:
                45px;

            box-shadow:
                0 20px 50px
                rgba(5,46,22,.08);

            position: relative;

            overflow: hidden;
        }


        .welcome-card::before {

            content: "";

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 7px;

            background:

                linear-gradient(
                    90deg,
                    var(--green-dark),
                    var(--green-light)
                );
        }


        .badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            background:
                var(--green-soft);

            color:
                var(--green-dark);

            border:
                1px solid #bbf7d0;

            padding:
                8px 14px;

            border-radius:
                50px;

            font-size:
                12px;

            font-weight:
                bold;

            margin-bottom:
                20px;
        }


        .badge-dot {

            width: 8px;
            height: 8px;

            border-radius: 50%;

            background:
                var(--green);

            animation:
                pulse 2s infinite;
        }


        @keyframes pulse {

            0%,100% {
                opacity: 1;
            }

            50% {
                opacity: .4;
            }
        }


        .welcome-card h1 {

            font-size:
                clamp(35px,5vw,55px);

            line-height:
                1.1;

            letter-spacing:
                -2px;

            color:
                var(--dark);

            margin-bottom:
                18px;
        }


        .welcome-card h1 span {

            color:
                var(--green);
        }


        .welcome-card p {

            color:
                var(--muted);

            line-height:
                1.8;

            font-size:
                16px;

            max-width:
                600px;

            margin-bottom:
                28px;
        }


        /* =========================
           PROFILE PREVIEW
        ========================= */

        .profile-preview {

            background:
                linear-gradient(
                    145deg,
                    var(--dark),
                    #064e3b
                );

            border-radius:
                24px;

            padding:
                35px;

            color:
                white;

            position:
                relative;

            overflow:
                hidden;

            box-shadow:
                0 20px 45px
                rgba(5,46,22,.18);
        }


        .profile-preview::after {

            content:
                "";

            position:
                absolute;

            width:
                200px;
            height:
                200px;

            border-radius:
                50%;

            background:
                rgba(34,197,94,.15);

            right:
                -80px;

            top:
                -70px;
        }


        .profile-preview-header {

            position:
                relative;

            z-index:
                1;

            display:
                flex;

            align-items:
                center;

            gap:
                15px;

            margin-bottom:
                25px;
        }


        .avatar {

            width:
                65px;

            height:
                65px;

            border-radius:
                50%;

            background:
                var(--green-soft);

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            font-size:
                30px;
        }


        .profile-preview h2 {

            font-size:
                19px;

            margin-bottom:
                5px;
        }


        .profile-preview small {

            color:
                #a7f3d0;
        }


        .profile-details {

            position:
                relative;

            z-index:
                1;

            display:
                grid;

            grid-template-columns:
                1fr 1fr;

            gap:
                10px;
        }


        .detail {

            background:
                rgba(255,255,255,.08);

            border:
                1px solid
                rgba(255,255,255,.08);

            padding:
                13px;

            border-radius:
                10px;
        }


        .detail small {

            display:
                block;

            color:
                #94a3b8;

            font-size:
                9px;

            text-transform:
                uppercase;

            margin-bottom:
                5px;
        }


        .detail strong {

            font-size:
                12px;

            color:
                white;
        }


        /* =========================
           BUTTONS
        ========================= */

        .buttons {

            display:
                flex;

            gap:
                12px;

            flex-wrap:
                wrap;
        }


        .btn {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                8px;

            padding:
                13px 20px;

            border-radius:
                10px;

            text-decoration:
                none;

            font-size:
                14px;

            font-weight:
                bold;

            transition:
                all .25s ease;
        }


        .btn-green {

            background:
                var(--green);

            color:
                white;

            box-shadow:
                0 7px 18px
                rgba(22,163,74,.22);
        }


        .btn-green:hover {

            background:
                var(--green-dark);

            transform:
                translateY(-3px);
        }


        .btn-white {

            background:
                white;

            color:
                var(--green-dark);

            border:
                1px solid var(--border);
        }


        .btn-white:hover {

            background:
                var(--green-soft);

            transform:
                translateY(-3px);
        }


        /* =========================
           QUICK ACCESS
        ========================= */

        .quick-section {

            margin-top:
                35px;
        }


        .section-heading {

            margin-bottom:
                20px;
        }


        .section-heading h2 {

            color:
                var(--dark);

            font-size:
                25px;

            margin-bottom:
                6px;
        }


        .section-heading p {

            color:
                var(--muted);

            font-size:
                14px;
        }


        .cards {

            display:
                grid;

            grid-template-columns:
                repeat(3,1fr);

            gap:
                18px;
        }


        .quick-card {

            background:
                white;

            border:
                1px solid var(--border);

            border-radius:
                18px;

            padding:
                25px;

            text-decoration:
                none;

            color:
                inherit;

            transition:
                all .25s ease;

            position:
                relative;

            overflow:
                hidden;
        }


        .quick-card:hover {

            transform:
                translateY(-6px);

            border-color:
                #86efac;

            box-shadow:
                0 15px 35px
                rgba(22,163,74,.10);
        }


        .quick-icon {

            width:
                50px;

            height:
                50px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                var(--green-soft);

            border-radius:
                12px;

            font-size:
                24px;

            margin-bottom:
                15px;
        }


        .quick-card h3 {

            color:
                var(--dark);

            font-size:
                16px;

            margin-bottom:
                7px;
        }


        .quick-card p {

            color:
                var(--muted);

            font-size:
                13px;

            line-height:
                1.6;
        }


        .arrow {

            position:
                absolute;

            right:
                20px;

            top:
                22px;

            color:
                var(--green);

            font-size:
                20px;
        }


        /* =========================
           FOOTER
        ========================= */

        footer {

            background:
                var(--dark);

            color:
                white;

            text-align:
                center;

            padding:
                30px;

            position:
                relative;

            z-index:
                1;
        }


        footer p {

            color:
                #a7f3d0;

            font-size:
                13px;

            margin-bottom:
                6px;
        }


        footer small {

            color:
                #64748b;

            font-size:
                11px;
        }


        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 800px) {

            .navbar {
                padding: 0 20px;
            }


            .welcome-section {

                grid-template-columns:
                    1fr;
            }


            .cards {

                grid-template-columns:
                    1fr;
            }


            .welcome-card {

                padding:
                    35px 25px;
            }
        }


        @media (max-width: 500px) {

            .logo {

                font-size:
                    17px;
            }


            .nav-links a {

                padding:
                    9px 10px;

                font-size:
                    12px;
            }


            .nav-links a:first-child {

                display:
                    none;
            }


            .container {

                padding:
                    40px 15px;
            }


            .welcome-card h1 {

                font-size:
                    36px;
            }


            .profile-details {

                grid-template-columns:
                    1fr;
            }


            .buttons {

                flex-direction:
                    column;
            }


            .btn {

                justify-content:
                    center;
            }
        }

    </style>

</head>


<body>


<!-- Decorative Background -->

<div class="circle circle-1"></div>
<div class="circle circle-2"></div>



<!-- =========================
     NAVIGATION
========================= -->

<nav class="navbar">


    <a href="<?= site_url('student'); ?>"
       class="logo">

        <div class="logo-icon">
            🎓
        </div>

        Student<span>Portal</span>

    </a>



    <ul class="nav-links">

        <li>

            <a href="<?= site_url('student'); ?>"
               class="active">

                🏠 Home

            </a>

        </li>


        <li>

            <a href="<?= site_url('student/profile'); ?>">

                👤 Student Profile

            </a>

        </li>

    </ul>


</nav>



<!-- =========================
     MAIN CONTENT
========================= -->

<main class="container">


    <!-- WELCOME AREA -->

    <section class="welcome-section">


        <!-- Welcome Card -->

        <div class="welcome-card">


            <div class="badge">

                <span class="badge-dot"></span>

                Student Portal

            </div>


            <h1>

                Welcome to your

                <span>
                    Student Portal
                </span>

            </h1>


            <p>

                Welcome! Your student portal gives you
                quick and easy access to your student
                information. Explore your profile using
                the navigation above.

            </p>


            <div class="buttons">


                <a href="<?= site_url('student/profile'); ?>"
                   class="btn btn-green">

                    👤 View My Profile

                </a>


                <a href="#quick-access"
                   class="btn btn-white">

                    Explore Portal ↓

                </a>


            </div>


        </div>



        <!-- Profile Preview -->

        <div class="profile-preview">


            <div class="profile-preview-header">


                <div class="avatar">

                    👨‍🎓

                </div>


                <div>

                    <h2>
                        Student Account
                    </h2>

                    <small>
                        ● Active Student
                    </small>

                </div>


            </div>



            <div class="profile-details">


                <div class="detail">

                    <small>
                        Student ID
                    </small>

                    <strong>
                        MCC2024-00179
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        Year Level
                    </small>

                    <strong>
                        3rd Year
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        Course
                    </small>

                    <strong>
                        BS Information Technology
                    </strong>

                </div>


                <div class="detail">

                    <small>
                        Section
                    </small>

                    <strong>
                        3-F4
                    </strong>

                </div>


            </div>


        </div>


    </section>



    <!-- =========================
         QUICK ACCESS
    ========================= -->

    <section class="quick-section"
             id="quick-access">


        <div class="section-heading">

            <h2>
                Quick Access
            </h2>

            <p>
                Access your student portal features.
            </p>

        </div>



        <div class="cards">


            <!-- Profile -->

            <a href="<?= site_url('student/profile'); ?>"
               class="quick-card">


                <div class="quick-icon">
                    👤
                </div>


                <span class="arrow">
                    →
                </span>


                <h3>
                    Student Profile
                </h3>


                <p>

                    View your personal information,
                    course, year level, section,
                    and email address.

                </p>


            </a>



            <!-- Student Information -->

            <a href="<?= site_url('student/profile'); ?>"
               class="quick-card">


                <div class="quick-icon">
                    📋
                </div>


                <span class="arrow">
                    →
                </span>


                <h3>
                    Student Information
                </h3>


                <p>

                    Check your registered student
                    information in one convenient
                    profile page.

                </p>


            </a>



            <!-- Security -->

            <a href="<?= site_url('student/profile'); ?>"
               class="quick-card">


                <div class="quick-icon">
                    🛡️
                </div>


                <span class="arrow">
                    →
                </span>


                <h3>
                    Protected Profile
                </h3>


                <p>

                    Your profile page is protected
                    by StudentMiddleware before
                    access is granted.

                </p>


            </a>


        </div>


    </section>


</main>



<!-- =========================
     FOOTER
========================= -->

<footer>

    <p>
        🎓 Student Portal
    </p>

    <small>
        Powered by LavaLust • Student Management System
    </small>

</footer>


</body>

</html>
