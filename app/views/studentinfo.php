<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Profile</title>

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

            background:
                radial-gradient(
                    circle at top right,
                    rgba(34, 197, 94, 0.15),
                    transparent 30%
                ),
                radial-gradient(
                    circle at bottom left,
                    rgba(16, 185, 129, 0.10),
                    transparent 30%
                ),
                var(--background);

            color: var(--text);

            min-height: 100vh;
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

            background: rgba(255, 255, 255, 0.92);

            backdrop-filter: blur(15px);

            border-bottom: 1px solid var(--border);

            box-shadow:
                0 4px 20px rgba(5, 46, 22, 0.06);

            position: relative;

            z-index: 10;
        }


        .logo {

            display: flex;

            align-items: center;

            gap: 11px;

            color: var(--dark);

            font-size: 20px;

            font-weight: bold;

            text-decoration: none;
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

            color: white;

            border-radius: 12px;

            font-size: 21px;

            box-shadow:
                0 6px 15px rgba(22, 163, 74, 0.25);
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

            text-decoration: none;

            color: #475569;

            padding: 10px 16px;

            border-radius: 9px;

            font-size: 14px;

            font-weight: 600;

            transition: all 0.25s ease;
        }


        .nav-links a:hover {

            background: var(--green-soft);

            color: var(--green-dark);

            transform: translateY(-2px);
        }


        .nav-links .active {

            background: var(--green);

            color: white;

            box-shadow:
                0 5px 15px rgba(22, 163, 74, 0.20);
        }


        .nav-links .active:hover {

            background: var(--green-dark);

            color: white;
        }


        /* =========================
           MAIN CONTAINER
        ========================= */

        .container {

            width: 100%;

            max-width: 950px;

            margin: 55px auto;

            padding: 0 25px;
        }


        /* =========================
           PROFILE CARD
        ========================= */

        .profile-card {

            background: white;

            border-radius: 24px;

            padding: 45px;

            border: 1px solid var(--border);

            box-shadow:
                0 20px 50px rgba(5, 46, 22, 0.09);

            position: relative;

            overflow: hidden;
        }


        /* Green top line */

        .profile-card::before {

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


        /* =========================
           PROFILE HEADER
        ========================= */

        .profile-header {

            text-align: center;

            margin-bottom: 35px;
        }


        .profile-icon {

            width: 100px;
            height: 100px;

            margin: 0 auto 18px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #dcfce7,
                    #bbf7d0
                );

            border: 6px solid white;

            box-shadow:
                0 8px 25px rgba(22, 163, 74, 0.18);

            font-size: 45px;

            animation: float 4s ease-in-out infinite;
        }


        @keyframes float {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }


        .profile-header h1 {

            color: var(--dark);

            font-size: 30px;

            margin-bottom: 8px;
        }


        .profile-header p {

            color: var(--muted);

            font-size: 14px;

            margin-bottom: 15px;
        }


        /* Status badge */

        .status {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 7px 14px;

            border-radius: 50px;

            background: var(--green-soft);

            color: var(--green-dark);

            font-size: 12px;

            font-weight: bold;
        }


        .status-dot {

            width: 8px;
            height: 8px;

            background: var(--green);

            border-radius: 50%;

            animation: pulse 2s infinite;
        }


        @keyframes pulse {

            0%, 100% {
                opacity: 1;
            }

            50% {
                opacity: .4;
            }
        }


        /* =========================
           INFORMATION TITLE
        ========================= */

        .information-title {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 18px;

            color: var(--dark);

            font-size: 18px;
        }


        .information-title-icon {

            width: 35px;
            height: 35px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: var(--green-soft);

            border-radius: 9px;

            font-size: 17px;
        }


        /* =========================
           INFORMATION GRID
        ========================= */

        .info-list {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 15px;
        }


        .info-row {

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-radius: 13px;

            padding: 18px;

            transition: all .25s ease;
        }


        .info-row:hover {

            background: var(--green-soft);

            border-color: #86efac;

            transform: translateY(-3px);

            box-shadow:
                0 8px 20px rgba(22, 163, 74, .08);
        }


        .info-label {

            display: block;

            color: #94a3b8;

            font-size: 11px;

            font-weight: bold;

            text-transform: uppercase;

            letter-spacing: .7px;

            margin-bottom: 7px;
        }


        .info-value {

            display: block;

            color: var(--dark);

            font-size: 15px;

            font-weight: 600;

            word-break: break-word;
        }


        /* =========================
           ACTIONS
        ========================= */

        .actions {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-top: 30px;

            padding-top: 25px;

            border-top: 1px solid var(--border);
        }


        .back-button {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            background: var(--green);

            color: white;

            text-decoration: none;

            padding: 12px 20px;

            border-radius: 10px;

            font-size: 14px;

            font-weight: bold;

            transition: all .25s ease;

            box-shadow:
                0 6px 15px rgba(22, 163, 74, .20);
        }


        .back-button:hover {

            background: var(--green-dark);

            transform: translateY(-3px);

            box-shadow:
                0 10px 20px rgba(22, 163, 74, .25);
        }


        .secure-text {

            color: #64748b;

            font-size: 12px;

            display: flex;

            align-items: center;

            gap: 5px;
        }


        /* =========================
           FOOTER
        ========================= */

        footer {

            margin-top: 50px;

            background: var(--dark);

            color: white;

            padding: 28px;

            text-align: center;
        }


        footer p {

            color: #a7f3d0;

            font-size: 13px;

            margin-bottom: 6px;
        }


        footer small {

            color: #64748b;

            font-size: 11px;
        }


        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 700px) {

            .navbar {

                padding: 0 20px;
            }


            .logo {

                font-size: 17px;
            }


            .nav-links a {

                padding: 9px 10px;

                font-size: 12px;
            }


            .container {

                margin-top: 30px;

                padding: 0 15px;
            }


            .profile-card {

                padding: 30px 20px;

                border-radius: 18px;
            }


            .profile-header h1 {

                font-size: 25px;
            }


            .info-list {

                grid-template-columns: 1fr;
            }


            .actions {

                flex-direction: column;

                align-items: stretch;

                gap: 15px;
            }


            .back-button {

                justify-content: center;
            }


            .secure-text {

                justify-content: center;
            }
        }


        @media (max-width: 450px) {

            .nav-links a:first-child {

                display: none;
            }

            .logo-icon {

                width: 37px;
                height: 37px;
            }
        }

    </style>
</head>


<body>


<!-- =========================
     NAVIGATION
========================= -->

<nav class="navbar">

    <a href="/student" class="logo">

        <div class="logo-icon">
            🎓
        </div>

        Student<span>Portal</span>

    </a>


    <ul class="nav-links">

        <li>
            <a href="/student">
                🏠 Home
            </a>
        </li>

        <li>
            <a href="/student/profile" class="active">
                👤 Profile
            </a>
        </li>

    </ul>

</nav>



<!-- =========================
     MAIN CONTENT
========================= -->

<main class="container">


    <div class="profile-card">


        <!-- PROFILE HEADER -->

        <div class="profile-header">

            <div class="profile-icon">
                👨‍🎓
            </div>


            <h1>
                <?= $name ?>
            </h1>


            <p>
                Student Profile
            </p>


            <div class="status">

                <span class="status-dot"></span>

                Active Student

            </div>

        </div>



        <!-- INFORMATION -->

        <div class="information-title">

            <div class="information-title-icon">
                📋
            </div>

            Student Information

        </div>



        <div class="info-list">


            <!-- Student ID -->

            <div class="info-row">

                <span class="info-label">
                    Student ID
                </span>

                <span class="info-value">
                    <?= $student_id ?>
                </span>

            </div>



            <!-- Name -->

            <div class="info-row">

                <span class="info-label">
                    Full Name
                </span>

                <span class="info-value">
                    <?= $name ?>
                </span>

            </div>



            <!-- Course -->

            <div class="info-row">

                <span class="info-label">
                    Course
                </span>

                <span class="info-value">
                    <?= $course ?>
                </span>

            </div>



            <!-- Year -->

            <div class="info-row">

                <span class="info-label">
                    Year Level
                </span>

                <span class="info-value">
                    <?= $year ?>
                </span>

            </div>



            <!-- Section -->

            <div class="info-row">

                <span class="info-label">
                    Section
                </span>

                <span class="info-value">
                    <?= $section ?>
                </span>

            </div>



            <!-- Email -->

            <div class="info-row">

                <span class="info-label">
                    Email Address
                </span>

                <span class="info-value">
                    <?= $email ?>
                </span>

            </div>


        </div>



        <!-- ACTIONS -->

        <div class="actions">

            <a href="/student" class="back-button">

                ← Back to Home

            </a>


            <div class="secure-text">

                🛡️ Protected by StudentMiddleware

            </div>

        </div>


    </div>

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
