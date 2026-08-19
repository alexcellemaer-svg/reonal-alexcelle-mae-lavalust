<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Portal</title>

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
            --dark-2: #064e3b;
            --text: #17251b;
            --muted: #64748b;
            --white: #ffffff;
            --bg: #f0fdf4;
            --border: #d1fae5;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* =========================
           BACKGROUND DECORATIONS
        ========================= */

        .circle {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            filter: blur(2px);
        }

        .circle-1 {
            width: 350px;
            height: 350px;
            background: rgba(34, 197, 94, 0.12);
            top: -120px;
            right: -80px;
            animation: float 6s ease-in-out infinite;
        }

        .circle-2 {
            width: 250px;
            height: 250px;
            background: rgba(16, 185, 129, 0.10);
            bottom: 80px;
            left: -100px;
            animation: float 7s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(25px);
            }
        }

        /* =========================
           NAVIGATION
        ========================= */

        nav {
            position: relative;
            z-index: 10;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 18px 7%;

            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);

            border-bottom: 1px solid var(--border);

            box-shadow: 0 4px 20px rgba(5, 46, 22, 0.06);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;

            text-decoration: none;
            color: var(--dark);

            font-size: 20px;
            font-weight: bold;
        }

        .logo-icon {
            width: 42px;
            height: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                var(--green),
                var(--green-dark)
            );

            border-radius: 12px;

            color: white;
            font-size: 21px;

            box-shadow:
                0 6px 15px rgba(22, 163, 74, 0.25);
        }

        .logo-text span {
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

            font-size: 14px;
            font-weight: 600;

            padding: 10px 16px;

            border-radius: 9px;

            transition: all 0.25s ease;
        }

        .nav-links a:hover {
            color: var(--green-dark);
            background: var(--green-soft);
        }

        .nav-links .profile-btn {
            color: white;
            background: var(--green);
            box-shadow: 0 5px 15px rgba(22, 163, 74, 0.2);
        }

        .nav-links .profile-btn:hover {
            color: white;
            background: var(--green-dark);
            transform: translateY(-2px);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            position: relative;
            z-index: 1;

            max-width: 1100px;
            margin: auto;

            padding: 85px 30px 70px;

            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            align-items: center;
            gap: 60px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            background: var(--green-soft);
            color: var(--green-dark);

            border: 1px solid #bbf7d0;

            padding: 8px 14px;

            border-radius: 50px;

            font-size: 12px;
            font-weight: bold;

            margin-bottom: 20px;
        }

        .badge-dot {
            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: var(--green);

            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .5;
                transform: scale(1.4);
            }
        }

        .hero h1 {
            font-size: clamp(42px, 6vw, 70px);

            line-height: 1.05;

            letter-spacing: -3px;

            color: var(--dark);

            margin-bottom: 22px;
        }

        .hero h1 span {
            color: var(--green);
        }

        .hero-description {
            max-width: 580px;

            font-size: 17px;
            line-height: 1.8;

            color: var(--muted);

            margin-bottom: 30px;
        }

        /* =========================
           BUTTONS
        ========================= */

        .buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            text-decoration: none;

            padding: 13px 21px;

            border-radius: 10px;

            font-weight: bold;
            font-size: 14px;

            transition: all .25s ease;
        }

        .btn-green {
            background: var(--green);
            color: white;

            box-shadow:
                0 8px 20px rgba(22, 163, 74, .25);
        }

        .btn-green:hover {
            background: var(--green-dark);
            transform: translateY(-3px);
            box-shadow:
                0 12px 25px rgba(22, 163, 74, .3);
        }

        .btn-white {
            background: white;
            color: var(--green-dark);

            border: 1px solid var(--border);
        }

        .btn-white:hover {
            background: var(--green-soft);
            transform: translateY(-3px);
        }

        /* =========================
           STUDENT CARD
        ========================= */

        .student-card {
            position: relative;

            background: white;

            border-radius: 24px;

            padding: 35px;

            border: 1px solid var(--border);

            box-shadow:
                0 20px 50px rgba(5, 46, 22, 0.10);

            overflow: hidden;

            animation: cardFloat 5s ease-in-out infinite;
        }

        @keyframes cardFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .student-card::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;
            right: 0;

            height: 7px;

            background: linear-gradient(
                90deg,
                var(--green-dark),
                var(--green-light)
            );
        }

        .student-avatar {
            width: 85px;
            height: 85px;

            margin: 10px auto 18px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--green-soft);

            font-size: 40px;

            border: 5px solid white;

            box-shadow:
                0 5px 20px rgba(22, 163, 74, .15);
        }

        .student-card h2 {
            text-align: center;

            color: var(--dark);

            font-size: 22px;

            margin-bottom: 6px;
        }

        .student-card .course {
            text-align: center;

            color: var(--green);

            font-size: 13px;

            font-weight: bold;

            margin-bottom: 25px;
        }

        .mini-info {
            display: grid;
            grid-template-columns: 1fr 1fr;

            gap: 10px;
        }

        .mini-box {
            background: #f8fafc;

            border: 1px solid #e2e8f0;

            padding: 13px;

            border-radius: 10px;
        }

        .mini-box small {
            display: block;

            color: #94a3b8;

            font-size: 10px;

            margin-bottom: 4px;

            text-transform: uppercase;
        }

        .mini-box strong {
            font-size: 13px;

            color: var(--dark);
        }

        /* =========================
           QUICK ACCESS
        ========================= */

        .section {
            position: relative;
            z-index: 1;

            max-width: 1100px;

            margin: auto;

            padding: 30px 30px 80px;
        }

        .section-title {
            text-align: center;

            font-size: 30px;

            color: var(--dark);

            margin-bottom: 10px;
        }

        .section-subtitle {
            text-align: center;

            color: var(--muted);

            margin-bottom: 35px;
        }

        .cards {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .quick-card {
            background: white;

            padding: 28px;

            border-radius: 18px;

            border: 1px solid var(--border);

            box-shadow:
                0 8px 25px rgba(5, 46, 22, .06);

            text-decoration: none;

            color: inherit;

            transition: all .25s ease;

            position: relative;

            overflow: hidden;
        }

        .quick-card:hover {
            transform: translateY(-7px);

            border-color: #86efac;

            box-shadow:
                0 15px 35px rgba(22, 163, 74, .12);
        }

        .quick-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--green-soft);

            border-radius: 13px;

            font-size: 25px;

            margin-bottom: 18px;
        }

        .quick-card h3 {
            color: var(--dark);

            margin-bottom: 8px;

            font-size: 17px;
        }

        .quick-card p {
            color: var(--muted);

            font-size: 13px;

            line-height: 1.6;
        }

        .arrow {
            position: absolute;

            right: 22px;
            top: 25px;

            color: var(--green);

            font-size: 20px;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            position: relative;
            z-index: 1;

            background: var(--dark);

            color: white;

            padding: 30px 7%;

            text-align: center;
        }

        footer p {
            color: #a7f3d0;

            font-size: 13px;

            margin-bottom: 7px;
        }

        footer small {
            color: #64748b;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            nav {
                padding: 15px 20px;
            }

            .hero {
                grid-template-columns: 1fr;

                padding-top: 55px;

                text-align: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .buttons {
                justify-content: center;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                letter-spacing: -2px;
            }
        }

        @media (max-width: 500px) {

            .nav-links a {
                padding: 8px;
                font-size: 12px;
            }

            .nav-links a:first-child {
                display: none;
            }

            .hero {
                padding-left: 20px;
                padding-right: 20px;
            }

            .student-card {
                padding: 25px;
            }

            .mini-info {
                grid-template-columns: 1fr;
            }

            .section {
                padding-left: 20px;
                padding-right: 20px;
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

<nav>

    <a href="/student" class="logo">

        <div class="logo-icon">
            🎓
        </div>

        <div class="logo-text">
            Student<span>Portal</span>
        </div>

    </a>


    <ul class="nav-links">

        <li>
            <a href="/student">
                🏠 Home
            </a>
        </li>

        <li>
            <a href="/student/profile" class="profile-btn">
                👤 My Profile
            </a>
        </li>

    </ul>

</nav>


<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div>

        <div class="badge">
            <span class="badge-dot"></span>
            Student Portal
        </div>


        <h1>
            Welcome to your
            <span>Student</span>
            Portal
        </h1>


        <p class="hero-description">
            Manage your student information and access your profile
            through a simple, secure, and friendly student portal.
        </p>


        <div class="buttons">

            <a href="/student/profile" class="btn btn-green">
                👤 View My Profile
            </a>

            <a href="#quick-access" class="btn btn-white">
                Explore Portal ↓
            </a>

        </div>

    </div>


    <!-- Student Preview Card -->

    <div class="student-card">

        <div class="student-avatar">
            👨‍🎓
        </div>

        <h2>Student Profile</h2>

        <p class="course">
            BS Information Technology
        </p>


        <div class="mini-info">

            <div class="mini-box">
                <small>Student ID</small>
                <strong>MCC2024-00179</strong>
            </div>

            <div class="mini-box">
                <small>Year</small>
                <strong>3rd Year</strong>
            </div>

            <div class="mini-box">
                <small>Section</small>
                <strong>3-F4</strong>
            </div>

            <div class="mini-box">
                <small>Status</small>
                <strong style="color:#16a34a;">
                    ● Active
                </strong>
            </div>

        </div>

    </div>

</section>


<!-- =========================
     QUICK ACCESS
========================= -->

<section class="section" id="quick-access">

    <h2 class="section-title">
        Quick Access
    </h2>

    <p class="section-subtitle">
        Everything you need is just one click away.
    </p>


    <div class="cards">


        <!-- Home -->

        <a href="/student" class="quick-card">

            <div class="quick-icon">
                🏠
            </div>

            <span class="arrow">→</span>

            <h3>
                Student Home
            </h3>

            <p>
                Return to your student portal homepage
                and explore the available options.
            </p>

        </a>


        <!-- Profile -->

        <a href="/student/profile" class="quick-card">

            <div class="quick-icon">
                👤
            </div>

            <span class="arrow">→</span>

            <h3>
                Student Profile
            </h3>

            <p>
                View your student ID, name, course,
                year level, section, and email.
            </p>

        </a>


        <!-- Security -->

        <a href="/student/profile" class="quick-card">

            <div class="quick-icon">
                🛡️
            </div>

            <span class="arrow">→</span>

            <h3>
                Protected Profile
            </h3>

            <p>
                Your profile is protected by
                StudentMiddleware before access is granted.
            </p>

        </a>


    </div>

</section>


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
