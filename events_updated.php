<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap');

    body {
        overflow-x: hidden;
    }

    /*This is banner section*/

    .new_event {
        background: url('assets/images/background111.jpeg') no-repeat center center;
        background-size: cover;
        text-align: center;
        padding: 30px;
        color: white;
        margin: auto;
        transition: background-image 1s ease-in-out;
    }

    .new_event img {
        width: 270px;
        display: block;
        margin: 0 auto 30px;

    }

    .new_event h3 {
        color: white;
        margin-bottom: 30px;
        line-height: 0.8;
        font-size: 66px;
        font-weight: 700;
        font-family: 'Dosis', sans-serif;
    }

    .new_event p {
        font-size: 20px;
        margin: 5px 0;
        color: white;
    }

    .new_event .btn-register {
        display: inline-block;
        padding: 12px 30px;
        font-size: 18px;
        background-color: #e68900;
        color: white;
        border-radius: 30px;
        text-decoration: none;
        transition: 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-top: 20px;
    }

    .new_event .btn-register:hover {
        background-color: rgb(56, 116, 255);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 500px) {

        .new_event {
            background: url('assets/images/test3.copy.jpeg') no-repeat center center;
            background-size: cover;
            text-align: center;
            padding: 20px;
            color: white;
            margin: auto;
        }

        .new_event img {
            width: 100px;
            display: block;
            margin: 0 auto 20px;
        }

        .new_event h3 {
            color: white;
            margin-bottom: 10px;
            line-height: 1.1;
            font-size: 25px;
            font-weight: 700;
            font-family: 'Dosis', sans-serif;
        }

        .new_event p {
            font-size: 13px;
            margin: 5px 0;
            color: white;
        }

        .new_event .btn-register {
            display: inline-block;
            padding: 5px 13px;
            font-size: 9px;
            background-color: #e68900;
            color: white;
            border-radius: 15px;
            text-decoration: none;
            transition: 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
        }

        .new_event .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            background-color: rgb(56, 116, 255);
        }

    }

    /*  This is Countdown Timer Section */

    .countdown {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 5px;
        padding: 20px;
        flex-wrap: wrap;
    }

    .time-box {
        position: relative;
        width: 180px;
        height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #333;
    }

    .progress-ring {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }

    .time-box span {
        position: relative;
        z-index: 10;
        font-family: Open Sans, sans-serif;
        color: #57647c;
        margin-bottom: 14px;
        font-weight: 800;
        font-size: 25px;
    }

    .time-box p {
        position: relative;
        z-index: 10;
        font-family: Open Sans, sans-serif;
        color: #57647c;
        margin-bottom: 15px;
        line-height: 1.8;
        font-size: 15px;
        font-weight: 600;
    }

    .progress-ring .bg-circle {
        fill: rgb(255, 248, 248);
        stroke-width: 7;
    }

    .progress-ring .fg-circle.days {
        stroke: rgb(247, 77, 21);
    }

    /* Red-Orange */
    .progress-ring .fg-circle.hours {
        stroke: rgb(14, 172, 43);
    }

    /* Green */
    .progress-ring .fg-circle.minutes {
        stroke: #337BFF;
    }

    /* Blue */
    .progress-ring .fg-circle.seconds {
        stroke: rgb(250, 130, 10);
    }

    /* Orange */
    .progress-ring .fg-circle {
        fill: none;
        stroke-width: 7;
        stroke-linecap: round;
        transition: stroke-dasharray 0.5s linear;
    }

    @media (max-width: 500px) {

        .countdown {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 5px;
            padding: 5px;
            flex-wrap: wrap;
        }

        .time-box {
            position: relative;
            width: 70px;
            height: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            color: black;
        }

        .progress-ring {
            width: 100%;
            height: 100%;
        }

        .time-box span {
            font-size: 10px;
            margin-bottom: 0px;
        }

        .time-box p {
            font-size: 8px;
            margin-bottom: 0px;
        }


    }

    /*This is counter increase section*/

    .counter-wrapper {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-column-gap: 1.5rem;
        padding: 75px;
        position: relative;
        color: white;
        font-family: Dosis, sans-serif;
    }

    .counter-wrapper::before {
        position: absolute;
        content: '';
        content: 0;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, #61967d, #4a4493);
        border-radius: 20px;
        z-index: 1;
    }

    .counterr {
        text-align: center;
        z-index: 2;
        position: relative;
    }

    .counterr::before {
        position: absolute;
        content: '';
        bottom: -2rem;
        left: 50%;
        width: 20%;
        height: .2rem;
        transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        -o-transform: translateX(-50%);
    }

    .counterr p {
        font-size: 20px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }

    .counterr img {
        max-width: 20%;
        height: auto;
        margin-bottom: 10px;
    }

    .small-number {
        font-size: 40px;
        font-weight: 700;
    }

    @media (max-width: 768px) {

        .counter-wrapper {
            grid-template-columns: repeat(2, 1fr);
            grid-row-gap: 8rem;
        }
    }

    @media (max-width: 550px) {

        .counter-wrapper {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-column-gap: 1rem;
            padding: 25px;
            position: relative;
            color: white;
            font-family: Dosis, sans-serif;
        }

        .small-number {
            font-size: 18px;
            /* Adjust this value as needed */
            font-weight: 700;
        }

        .counterr p {
            font-size: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .counterr img {
            max-width: 25%;
            height: auto;

        }



    }



    .text-center h3 {
        color: #333;
        font-family: Dosis, sans-serif;

    }

    #about {
        background: url('assets/images/event_about_bg_copy.jpeg') no-repeat center center/cover;
        padding: 20px 0;
        text-align: center;
        color: #fff;
        /* Adjust text color for better contrast */
    }

    .ai-about-content h3 {
        font-size: 40px;
        font-weight: 700;
        color: white;
        font-family: Dosis, sans-serif;
        margin-bottom: 15px;
    }

    .ai-about-content p {
        font-family: Open Sans, sans-serif;
        font-size: 16px;
        color: rgb(209, 213, 219);
        margin-bottom: 15px;
        line-height: 1.8;
        margin: 20px;
    }

    .about-list li i {
        color: #28a745;
        margin-right: 10px;
    }

    .about-list {
        display: inline-block;
        /* Makes the list width fit its content */
        text-align: left;
        /* Ensures text is aligned properly */
        padding: 0;
        max-width: 100%;
        /* Prevents overflow on smaller screens */
    }

    .about-list li {
        display: flex;
        align-items: center;
        font-size: 14px;
        font-family: Open Sans, sans-serif;
        color: rgb(234, 234, 234);
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1;

        padding: 15px;
        /*border: 0.5px solid white;*/
        width: auto;
        /* Ensures the list items take only required space */
        min-width: 280px;
        /* Adjusted for better mobile fit */
        border-radius: 50px;
    }

    /* Responsive Styles for Mobile */
    @media (max-width: 768px) {


        #about {
            background: url('assets/images/event_about_bg_copy.jpeg') no-repeat center center/cover;
            padding: 10px 0;
            text-align: center;
            color: #fff;
            /* Adjust text color for better contrast */
        }

        .about-list {
            display: block;
            /* Ensures proper alignment on smaller screens */
            text-align: left;
            /* Ensures text is aligned properly */
            padding: 0;
            max-width: 110%;
            /* Prevents overflow on smaller screens */

        }

        .about-list li {
            min-width: unset;
            /* Allows flexibility on smaller screens */
            width: 100%;
            /* Takes most of the screen width while keeping it small */
            margin: 0;
            /* Centers the list items */
            font-size: 11px;
            line-height: 0.3;
            margin-bottom: 0;
            padding: 10px;
        }

        .ai-about-content p {
            font-family: Open Sans, sans-serif;
            font-size: 11px;
            color: rgb(209, 213, 219);
            margin-bottom: 10px;
            line-height: 1.6;
            margin: 10px;
        }

        .ai-about-content h3 {
            font-size: 30px;
            font-weight: 700;
            color: white;
            font-family: Dosis, sans-serif;
            margin-bottom: 10px;
        }

    }

    /* This is the theme section */

    .ai-services-area {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f7fbff;
    }

    .section-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .single-services-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .single-services-card:hover {
        transform: translateY(-5px);
    }

    .single-services-card h5 {

        font-weight: 600;
        font-size: 20px;
        margin-bottom: 10px;
        font-family: Dosis, sans-serif;

    }

    .features-list {
        list-style: none;
        padding: 0;
        text-align: left;
    }

    .features-list li {
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
        font-family: Open Sans, sans-serif;
        color: rgb(113, 123, 142);
    }

    /* Custom bullets */
    .features-list li::before {
        content: "•";
        /* Bullet */
        font-size: 20px;
        position: absolute;
        left: 0;
        top: 0;
        color: #fe5555;
        /* Red Gradient */

    }

    .image-iconn {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;
        background-color: #f1f1f1;
    }

    .image-iconn img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }

    .image-iconn.bg-red {
        /* background: linear-gradient(135deg, #fe5555, #ff9999); */
        background: linear-gradient(135deg, #65b1fd, #80c1ff);
    }

    .image-iconn.bg-blue {
        background: linear-gradient(135deg, #65b1fd, #80c1ff);
    }

    @media (max-width: 768px) {
        .col-sm-6 {
            width: 100%;
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        .single-services-card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
            padding: 15px;
        }

        .icon-title-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .image-iconn {
            width: 50px;
            height: 50px;
            margin: 0;
            flex-shrink: 0;
        }

        .icon-title-wrapper h5 {
            margin: 0;
            padding-left: 15px;
            font-size: 18px;
            flex: 1;
        }

        .features-list {
            margin-top: 10px;
            /* Ensure list moves to next row */
        }
    }

    .theme-section {
        font-family: Arial, sans-serif;
        padding: 20px;
        background-color: #f7fbff;

    }

    .theme-container {
        max-width: 1300px;
        margin: 0 auto;
        overflow: hidden;
    }

    .theme-container .section-titlee h2 {
        font-size: 35px;
        /* Slightly larger heading */
        font-weight: 700;
        color: #12037f;
        font-family: Dosis, sans-serif;
        margin-bottom: 10px;
        margin-top: 25px;
        text-align: center;
    }

    .theme-container h5 {
        font-weight: 600;
        font-size: 20px;
        margin-bottom: 10px;
        font-family: Dosis, sans-serif;

    }

    .theme-boxes-container {
        display: flex;
        gap: 20px;
        padding: 10px 0;
    }

    .features-list {
        list-style: none;
        padding: 0;
        text-align: left;
    }

    .features-list li {
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
        font-family: Open Sans, sans-serif;
        color: rgb(113, 123, 142);
    }

    /* Custom bullets */
    .features-list li::before {
        content: "•";
        /* Bullet */
        font-size: 20px;
        position: absolute;
        left: 0;
        top: 0;
        color: #fe5555;
        /* Red Gradient */

    }

    .boxs {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        min-width: 300px;
        flex: 1;
    }

    .box-images {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 15px;
        display: block;
        background-color: #f1f1f1;
    }

    .box-images.bg-red {
        /* background: linear-gradient(135deg, #fe5555, #ff9999); */
        background: linear-gradient(135deg, #65b1fd, #80c1ff);
    }

    .boxs h2 {
        text-align: center;
        margin-bottom: 15px;
        color: #333;
    }


    @media (max-width: 768px) {

        .theme-container {
            padding: 0 5px;
        }

        .theme-boxes-container {
            overflow-x: auto;
            flex-wrap: nowrap;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            /* padding-bottom: 20px; */

            margin: 0 -15px;
            width: calc(100% + 30px);
        }

        .boxs {
            scroll-snap-align: center;
            flex: 0 0 calc(100% - 30px);
            margin: 0 15px;
            min-width: calc(100% - 30px);
            width: calc(100% - 30px);
            padding: 7px;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .theme-boxes-container::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .theme-boxes-container {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .theme-container h5 {
            margin: 0;
            padding-left: 15px;
            font-size: 15px;
            flex: 1;
        }

        .features-list li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
            font-family: Open Sans, sans-serif;
            color: rgb(113, 123, 142);
            font-size: 15px;
        }

        /* Custom bullets */
        .features-list li::before {
            content: "";
            /* Bullet */
            font-size: 20px;
            position: absolute;
            left: 0;
            top: 0;
            color: #fe5555;
            /* Red Gradient */
            padding-left: 10px;

        }



    }

    @media (min-width: 769px) {
        .theme-boxes-container {
            flex-wrap: wrap;
            justify-content: center;
        }

        .boxs {
            max-width: calc(33.333% - 20px);
        }
    }



    /*This is why attend section      */


    .computer-vision-ai-area {
        background: url('assets/images/wa_bg_edit.jpeg') no-repeat center center/cover;
        padding-top: 20px;

    }

    .computer-vision-ai-content h3 {
        font-size: 40px;
        font-weight: 700;
        color: rgb(255, 255, 255);
        font-family: Dosis, sans-serif;
        margin-bottom: 10px;
    }

    .computer-vision-ai-content p {

        font-family: Open Sans, sans-serif;
        font-size: 15px;
        color: rgb(225, 225, 225);
        margin-bottom: 15px;
        line-height: 1.8;
    }


    .computer-vision-ai-image img {
        width: 100%;
        border-radius: 10px;
    }



    .vision-ai-inner-card {
        display: flex;
        align-items: center;
        /* Aligns icon and text in the center */

        border-radius: 10px;
        text-align: left;
        margin-bottom: 5px;
        background: transparent;
        /* Add background if needed */
    }

    .vision-ai-inner-card .image-icon {
        width: 17px;
        height: 17px;
        background-color: rgb(242, 233, 233);
        /* Light background for the circle */
        border-radius: 50%;
        /* Makes the icon container circular */
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        /* Prevent shrinking */
        margin-right: -2px;
        /* Space between icon and text */
    }

    .vision-ai-inner-card .image-icon img {
        width: 8px;
        /* Adjust icon size */
        height: auto;
    }

    .vision-ai-inner-card .content {
        display: flex;
        align-items: flex-start;
        /* Align content to the top */
        /* gap: 10px; Adds space between h4 and p */
        flex-direction: column;
        /* Stack h4 and p vertically */

    }

    .vision-ai-inner-card .content-wrapper {
        display: flex;
        align-items: center;
        /* Align icon and h4 in the same row */
        gap: 10px;
        justify-content: flex-start;
        /* Align items to the left */
        width: 100%;
    }

    .vision-ai-inner-card h4 {
        font-weight: bold;
        color: whitesmoke;
        font-family: Dosis, sans-serif;
        font-size: 20px;
        margin: 0;
        /* Remove margin to align properly */
        white-space: nowrap;
        /* Prevents text from wrapping */
        text-align: left;
        /* Align text to the left */
    }

    .vision-ai-inner-card p {
        font-family: Open Sans, sans-serif;
        font-size: 15px;
        color: rgb(232, 232, 232);
        margin: 0;
        line-height: 1.6;
        margin-top: 5px;
        /* Adjust spacing */
    }

    /* Mobile styles */
    @media (max-width: 767px) {



        .computer-vision-ai-area {
            background: url('assets/images/wa_bg_edit.jpeg') no-repeat center center/cover;


        }

        .vision-ai-inner-card h4 {
            font-weight: bold;
            color: whitesmoke;
            font-family: Dosis, sans-serif;
            font-size: 14px;
            margin: 0;
            /* Remove margin to align properly */
            white-space: nowrap;
            /* Prevents text from wrapping */
            text-align: left;
            /* Align text to the left */
        }

        .vision-ai-inner-card p {
            font-family: Open Sans, sans-serif;
            font-size: 12px;
            color: rgb(232, 232, 232);
            margin: 0;
            line-height: 1.2;


        }

        .computer-vision-ai-area .col-lg-6 {
            margin-bottom: 10px;
        }



        .vision-ai-inner-card .image-icon {
            width: 20px;
            height: 20px;
            background-color: rgb(242, 233, 233);
            /* Light background for the circle */
            border-radius: 50%;
            /* Makes the icon container circular */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            /* Prevent shrinking */
            margin-right: -1px;
            /* Space between icon and text */

        }

        .vision-ai-inner-card .image-icon img {
            width: 10px;
            /* Adjust icon size */
            height: auto;

        }


    }



    /* Ensures full-width background */
    .scrolling-text-container {
        width: 100%;
        /* Full viewport width */
        height: 40px;
        overflow: hidden;
        background-color: rgb(121, 54, 72);
        color: white;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 10px 0;
    }

    /* Scrolling text setup */
    .scrolling-text {
        display: flex;
        width: max-content;
        white-space: nowrap;
        animation: scrollText 10s linear infinite;
        font-size: 16px;
    }

    /* Keyframes for infinite scrolling */
    @keyframes scrollText {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(-100%);
        }
    }

    /* Desktop styles */
    @media (min-width: 768px) {
        .scrolling-text {
            animation-duration: 17s;
            /* Slower on larger screens */
            font-size: 15px;
        }
    }

    /* Mobile styles */
    @media (max-width: 767px) {
        .scrolling-text {
            animation-duration: 20s;
            /* Faster on smaller screens */
            font-size: 15px;
        }
    }








    /* This is ticket Section */
    #ticket {
        background-color: rgb(248, 247, 255);
        padding: 30px;
    }

    .ticket-card {

        border-radius: 10px;
        padding: 20px;
        text-align: center;
        transition: 0.3s;
        background-color: #fff;
    }

    .ticket-card.sold-out {
        background-color: rgb(255, 255, 255);
        /* box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3); */
    }

    .ticket-card p {
        font-family: "Open Sans", sans-serif;

    }

    .ticket-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        font-family: Dosis, sans-serif;
        padding-bottom: 10px;
    }

    .price {
        font-size: 2rem;
        font-weight: bold;
        color: #28a745;
        padding: 0px;
    }

    .sold-out .price {
        text-align: center;
        font-size: 40px;
        font-weight: 700;
        color: rgb(255, 72, 0);
        font-family: Dosis, sans-serif;
    }

    .tick-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tick-list li {
        font-size: 17px;
        font-family: Dosis, sans-serif;
        font-weight: 500;
        color: black;
        line-height: 1.6;
        background-color: white;
        padding: 10px;
        display: flex;
        align-items: flex-start;
        /* Aligns text to the top */
        text-align: center;
        /* Ensures text starts at the left */
    }

    .tick-list li i {
        color: #28a745;
        margin-right: 10px;
        flex-shrink: 0;
        /* Prevents icon from resizing */
        margin-top: 3px;
        /* Adjust icon positioning slightly */
    }



    #ticket .section-titlee {
        margin: 10px 0px;


    }

    #ticket .col-md-4 {

        margin: 0px;
    }

    #ticket .section-titlee p {
        font-size: 19px;
        /* Slightly larger heading */

        font-family: Dosis, sans-serif;
        margin-bottom: 10px;
        text-align: center;
    }

    #ticket .section-titlee h6 {
        font-size: 20px;
        /* Slightly larger heading */
        margin-bottom: 10px;
        font-family: Dosis, sans-serif;
        font-weight: 600;

        text-align: center;
    }


    .sold-in-btn {
        display: inline-block;
        color: white;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
        pointer-events: auto;
        /* Ensures it's clickable */
        background-color: rgb(56, 116, 255);
    }

    .sold-in-btn:hover {
        background-color: rgb(115, 72, 7);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .sold-out-btn {
        display: inline-block;
        color: white;
        padding: 10px 25px;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
        pointer-events: auto;
        /* Ensures it's clickable */
        background-color: rgb(197, 197, 197);
    }

    .sold-out-btn:hover {

        color: white;
        background-color: rgb(197, 197, 197);
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    @media (min-width: 768px) {

        /* Apply only for medium screens and above */
        #ticket .col-md-4 {
            max-width: 500px;
            flex: 0 0 500px;
        }
    }

    @media (max-width: 767px) {

        #ticket {
            background-color: rgb(248, 247, 255);
            padding-top: 30px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .ticket-card {

            border-radius: 10px;
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 15px;
            text-align: center;
            transition: 0.3s;
            background-color: #fff;
        }

        #ticket .section-titlee p {
            font-size: 15px;
            /* Slightly larger heading */

            font-family: Dosis, sans-serif;
            margin-bottom: 10px;
            text-align: center;
        }

        #ticket .section-titlee h6 {
            font-size: 16px;
            /* Slightly larger heading */
            margin-bottom: 10px;
            font-family: Dosis, sans-serif;
            font-weight: 600;

            text-align: center;
        }

        .tick-list li {
            font-size: 15px;
            font-family: Dosis, sans-serif;
            font-weight: 500;

            color: black;

            line-height: 1.5;
            background-color: white;
            padding: 5px;
            display: flex;
            align-items: flex-start;
            /* Aligns text to the top */
            text-align: left;
            /* Ensures text starts at the left */
        }

    }

    /* Save the Date */

    /* Speaker section */


    /* Speaker section end */


 /* Save the date end */

    /* Agenda Section start */

    .schedule-container {
        max-width: 800px;
        margin: auto;
    }

    .card {
        background-color: #ffffff;
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        cursor: pointer;
    }

    .card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        display: flex;
        align-items: center;
        padding: 16px 20px;
    }

    .avatar-section {
        width: 56px;
        height: 56px;
        background-color: #f8fafc;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
    }

    .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }

    .content-section {
        flex: 1;
    }

    .title {
        font-size: 16.5px;
        font-weight: 600;
        margin: 0;
        color: #1e293b;
    }

    .time {
        font-size: 13px;
        font-weight: 500;
        color: rgb(3, 2, 80);
        /* background-color: #ecfdf5; */
        padding: 3px 2px;
        border-radius: 999px;
        display: inline-block;
        margin-top: 4px;
    }

    .arrow-section {
        font-size: 20px;
        color: #64748b;
        transition: transform 0.3s ease;
    }

    .card.active .arrow-section {
        transform: rotate(180deg);
    }

    .agenda_card-body {
        padding: 0 20px;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease, padding 0.3s ease;
        background-color: #f9fafb;
    }

    .card.active .agenda_card-body {
        padding: 12px 20px 18px 95px;
        max-height: 220px;
    }

.vhrd-speaker-wrapper {
    display: flex;
    /* gap: 12px; */
    margin-top: 12px;
}

.vhrd-speaker-tooltip {
    position: relative;
    display: inline-block;
}

.vhrd-speaker-tooltip img {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    border: 2px solid #ccc;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.vhrd-speaker-tooltip:hover img {
    transform: scale(1.05);
}

.vhrd-tooltip-text {
    visibility: hidden;
    background-color: #333;
    color: #fff;
    font-size: 10px;
    padding: 3px 6px;
    border-radius: 4px;
    position: absolute;
    z-index: 5;
    bottom: -20%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.2s;
    white-space: nowrap;
}

.vhrd-speaker-tooltip:hover .vhrd-tooltip-text {
    visibility: visible;
    opacity: 1;
}

    .agenda_card-body p {
        margin: 0;
        font-size: 14px;
        color: #475569;
    }

    @media (max-width: 640px) {
        .agenda_card-body {
            padding-left: 20px !important;
        }
    }

    /* Agenda section end */

    /* Community sponsors section */

/* New Sponsers Style */

.sponsor-section {
      padding: 3rem 1rem;
      /* background: #64748b; */
      background: linear-gradient(135deg, #64748b,rgb(111, 128, 152));
      text-align: center;
    }

    .sponsor-section h2 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: #140058;
    }

    .sponsor-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      /* margin-bottom: 3rem; */
    }

    .sponsor-logo {
      width: 200px;
      aspect-ratio: 4 / 2;
      background-color:rgb(255, 255, 255);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .sponsor-logo img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .sponsor-logo:hover {
      transform: scale(1.1);
    }

    @media (max-width: 600px) {
  .sponsor-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.8rem;
    margin-bottom: 0.8rem;
  }
  .sponsor-logo {
    flex: 1 1 45%;
    max-width: 48vw;
    min-width: 120px;
    margin: 0;
  }
}


/* New Sponsers Style End */

    .sponsors_logo {
        padding: 50px 0;
        background-color: rgb(177, 187, 236);
        text-align: center;
        margin-bottom: 30px;

    }

    .sponsors_heading h2 {
        font-size: 32px;
        font-weight: 700;
        color: black;
        font-family: Dosis, sans-serif;
        margin-bottom: 15px;
        margin-top: 15px;
    }

    .silver_sponsors_heading h2{
        font-size: 32px;
        font-weight: 700;
        color: black;
        font-family: Dosis, sans-serif;
        margin-bottom: 15px;
        margin-top: 50px;

    }
    .sponsors_slider {
        display: flex;
        justify-content: center;
        /* Center when only 1 image */
        flex-wrap: wrap;
        gap: 20px;
        padding-bottom: 15px;
        padding-top: 15px;
    }

    .sponsor_item {
        position: relative;
        width: calc(100% / 2 - 20px);
        /* 5 columns layout for larger screens */
        max-width: 160px;
        height : 50px
        /* Prevents images from getting too large */
        overflow: hidden;
        border-radius: 8px;
    }

    .sponsor_item img {
        width: 100%;
        max-width: 200px;
        /* max-height: fit-content; */
        /* height: auto; */
        width: 100%;
        display: flex;
        justify-content: center;
        transition: transform 0.3s ease-in-out;
    }

    .platinum_sponsors_item img {
        width: fit-content;
        max-width: 300px;
        /* height: auto; */
        align-content: center;
        padding-bottom: 15px;
        display: inline-block;
        padding-left: 18px;
        transition: transform 0.3s ease-in-out;

    }

    .sponsor_item_green {
        width: fit-content;
        max-width: 250px;
        display: inline-block;
        transition: transform 0.3s ease-in-out;
    }

    .sponsor_item_green:hover img {
        transform: scale(1.1);
    }

    .platinum_sponsors_item:hover img {
        transform: scale(1.1);
    }

    .sponsor_item:hover img {
        transform: scale(1.1);
    }

    /* Responsive layout: 2 columns on mobile */
    @media (max-width: 768px) {
        .sponsor_item {
            width: calc(100% / 2 - 20px);
            /* 2 columns per row */

        }
         .sponsor_item_green {
           width: calc(100% / 2 - 20px);
        }
    }






    /* This was attendees section */


    #attendees-section {
        background-color: #f9f9f9;
        padding: 20px;
    }

    #attendees-section h2 {
        font-size: 35px;
        /* Slightly larger heading */
        font-weight: 700;
        color: #12037f;
        font-family: Dosis, sans-serif;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
    }



    /* Large logo container but small logos inside */
    .logo-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 5px;
        /* More space between logos */



    }


    .logo-container img {
        width: 50px;
        /* Small logos */

        transition: transform 0.3s ease-in-out;
        background-color: rgb(255, 255, 255);
        padding: 30px;
        object-fit: contain;

    }


    .logo-container img:hover {
        transform: scale(0.9);
        box-shadow: inset 8px 8px 15px rgba(91, 167, 255, 0.6),
            inset -8px -8px 15px rgba(25, 144, 255, 0.6);

    }




    /* Desktop View (5 logos per row) */
    @media (min-width: 768px) {
        .logo-container {
            justify-content: space-between;
            padding: 20px;
            /* Some extra spacing around */
        }

        .logo-container img {
            width: calc(20% - 5px);
            /* Keeping 5 logos per row */
            height: 100px;
        }

        .attendees-section {
            padding: 20px;
            padding-bottom: 5px;
        }

    }

    /* Mobile View (2 logos per row) */
    @media (max-width: 767px) {
        .logo-container {
            justify-content: center;
        }

        .logo-container img {
            width: calc(50% - 5px);
            /* Keeping 2 logos per row */
            max-height: 100px;
        }
    }




    /* Styling for the animated text */
    .counting-text {
        font-size: 24px;
        font-weight: 900;

        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 20px;
        font-family: Open Sans, sans-serif;

    }


    .gradient-text {
        background: black;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;

    }

    /* Animation for each letter */
    .counting-text span {
        opacity: 0;
        animation: fadeInOut 4s linear infinite;
        animation-delay: calc(var(--delay) * 0.2s);
    }

    /* Keyframes for smooth animation with a pause */
    @keyframes fadeInOut {
        0% {
            opacity: 0;
        }

        20% {
            opacity: 1;
        }

        80% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    /* Assign delay to each letter for sequential effect */
    .counting-text span:nth-child(1) {
        --delay: 1;
    }

    .counting-text span:nth-child(2) {
        --delay: 2;
    }

    .counting-text span:nth-child(3) {
        --delay: 3;
    }

    .counting-text span:nth-child(4) {
        --delay: 4;
    }

    .counting-text span:nth-child(5) {
        --delay: 5;
    }

    .counting-text span:nth-child(6) {
        --delay: 6;
    }

    .counting-text span:nth-child(7) {
        --delay: 7;
    }

    .counting-text span:nth-child(8) {
        --delay: 8;
    }

    .counting-text span:nth-child(9) {
        --delay: 9;
    }

    .counting-text span:nth-child(10) {
        --delay: 10;
    }

    .counting-text span:nth-child(11) {
        --delay: 11;
    }

    .counting-text span:nth-child(12) {
        --delay: 12;
    }

    .counting-text span:nth-child(13) {
        --delay: 13;
    }

    .counting-text span:nth-child(14) {
        --delay: 14;
    }

    .counting-text span:nth-child(15) {
        --delay: 15;
    }

    .counting-text span:nth-child(16) {
        --delay: 16;
    }

    .counting-text span:nth-child(17) {
        --delay: 17;
    }

    .counting-text span:nth-child(18) {
        --delay: 18;
    }

    .counting-text span:nth-child(19) {
        --delay: 19;
    }

    .counting-text span:nth-child(20) {
        --delay: 20;
    }

    .counting-text span:nth-child(21) {
        --delay: 21;
    }

    .counting-text span:nth-child(22) {
        --delay: 22;
    }

    .counting-text span:nth-child(23) {
        --delay: 23;
    }


    @media (max-width: 768px) {

        .counting-text {
            font-size: 15px;
            font-weight: 900;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            margin-top: 20px;
            font-family: Open Sans, sans-serif;
        }

        .gradient-text {
            background: black;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

    }


    /* This was venue section */



    .about-area {
        padding: 50px 0;

    }

    .section-titlee {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-titlee h2 {
        font-size: 35px;
        /* Slightly larger heading */
        font-weight: 700;
        color: #12037f;
        font-family: Dosis, sans-serif;
        margin-bottom: 20px;
        text-align: center;
    }

    .venue-img {
        width: 100%;
        height: auto;
        border-radius: 20px;
    }

    .venue-text {
        padding: 20px;
        border-radius: 8px;

    }

    .venue-text h2 {

        font-size: 35px;
        /* Slightly larger heading */
        font-weight: 700;
        color: #333;
        font-family: Dosis, sans-serif;
        margin-bottom: 20px;
        text-align: center;
    }

    .venue-text p {
        margin: 5px 0;
        font-size: 16px;
        color: #555;
        font-family: Dosis, sans-serif;

    }

    .venue-iframe {
        width: 100%;
        height: 180px;
        border: none;
        border-radius: 8px;
        margin-top: 15px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #venue .row {
            display: flex;
            flex-direction: column;
        }

        .venue-img {
            margin-bottom: 15px;
        }

        .venue-text {
            text-align: center;
        }
    }

    /* New Speaker Model Styles start*/

    .speaker-card-unique p,
.speaker-modal-role-unique,
.speaker-modal-desc-unique,
.speaker-modal-session-title,
.speaker-modal-session-box,
.speaker-modal-session-row,
.speaker-modal-session-stage {
  font-family: 'Nunito', Arial, sans-serif;
}
.speaker-overlay-unique {
  font-family: 'Montserrat', Arial, sans-serif;
}
.speakers-section-unique {
  position: relative;
  overflow: hidden;
  z-index: 1;
  /* Add a very light background image */
  background: url('assets/images/81310.jpg') center center/cover no-repeat;
}

/* .speakers-section-unique::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('assets/images/tech-bg-animated.svg') center top/cover no-repeat;
  opacity: 0.18;
  z-index: 0;
  animation: bgMove 18s linear infinite alternate;
  pointer-events: none;
}
@keyframes bgMove {
  0% { background-position: 0% 0%; }
  100% { background-position: 100% 0%; }
} */

.speakers-section-unique::before {
  content: "";
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: inherit;
  opacity: 0.12; /* Very light overlay */
  z-index: 0;
  pointer-events: none;
}

/* Ensure speaker cards and content are above the background */
.speakers-container, .speakers-grid {
  position: relative;
  z-index: 2;
}

/* Mobile compatibility */
@media (max-width: 600px) {
  .speakers-section-unique {
    background-position: center top;
    background-size: cover;
  }
  .speakers-section-unique::before {
    opacity: 0.18;
  }
}

.speakers-container {
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  padding: 0 16px;
  box-sizing: border-box;
}

.speakers-title {
  font-size: 2rem;
  font-weight: 700;
  color: #12037f;
  margin: 32px 0 24px 0;
  font-family: 'Montserrat', Arial, sans-serif;
  text-align: left;
}

.speakers-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 32px;
  justify-items: center;
  margin-bottom: 48px;
}

@media (max-width: 991px) {
  .speakers-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 600px) {
  .speakers-title {
    font-size: 1.4rem;
    margin: 24px 0 16px 0;
  }
  .speakers-grid {
    gap: 20px;
  }
}

.speaker-card-unique {
  background: #fff;
  border-radius: 12px;
  width: 100%;
  max-width: 260px;
  padding: 24px 16px 16px 16px;
  text-align: center;
  box-shadow: 0 6px 24px rgba(0,0,0,0.08);
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
}

.speaker-photo-wrapper-unique {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  overflow: hidden;
  margin-bottom: 16px;
  background: #f3f6ff;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  cursor: pointer;
}

.speaker-photo-unique {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  border-radius: 50%;
  display: block;
  background: #f3f6ff;
  aspect-ratio: 1 / 1;
}

/* Overlay effect */
.speaker-overlay-unique {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  opacity: 0;
  pointer-events: none;
  border-radius: 50%;
  transition: opacity 0.3s;
  z-index: 2;
  font-family: 'Montserrat', Arial, sans-serif;
  font-size: 1rem;
  font-weight: 300;
  letter-spacing: 0.5px;
}
.speaker-photo-wrapper-unique:hover .speaker-overlay-unique,
.speaker-photo-wrapper-unique:focus .speaker-overlay-unique {
  opacity: 1;
  pointer-events: auto;
}
.speaker-overlay-unique span {
  display: block;
}
.speaker-overlay-arrow {
  margin-top: 10px;
  font-size: 2rem;
  color: #fff;
  opacity: 0.7;
}

.speaker-card-unique h3 {
  font-size: 1rem;
  font-weight: 700;
  margin: 10px 0 4px 0;
  color: #12037f;
  font-family: 'Montserrat', Arial, sans-serif;
  position: relative;
  overflow: hidden;
}

/* Reflection animation effect */
.speaker-card-unique h3::after {
  content: '';
  position: absolute;
  left: -75%;
  top: 0;
  width: 50%;
  height: 100%;
  background: linear-gradient(120deg, rgba(255,255,255,0.0) 0%, rgba(255,255,255,0.7) 50%, rgba(255,255,255,0.0) 100%);
  transform: skewX(-20deg);
  pointer-events: none;
  animation: none;
}
.speaker-card-unique:hover h3::after,
.speaker-card-unique:focus-within h3::after {
  animation: name-reflection 1.2s linear;
}
@keyframes name-reflection {
  0% { left: -75%; }
  80% { left: 120%; }
  100% { left: 120%; }
}

.speaker-card-unique p {
  font-size: 0.98rem;
  color: #555;
  margin-bottom: 12px;
  margin-top: 0;
  font-family: 'Nunito', Arial, sans-serif;
}

.company-logo-unique {
  width: 100px;
  height: 57px;
  object-fit: contain;
  margin: 0 auto 8px auto;
  display: block;
  background: #fff;
  border-radius: 12px;
  padding: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  border: 1px solid #e3e7ee;
  aspect-ratio: 1 / 1;
  transition: box-shadow 0.3s, border-color 0.3s;
}
.speaker-card-unique:hover .company-logo-unique,
.speaker-card-unique:focus-within .company-logo-unique {
  box-shadow: 0 0 0 4px #e0d7ff, 0 0 18px 4px #a084f5;
  border-color: #a084f5;
}

/* --- Modal Header --- */
.speaker-modal-header-unique {
  position: relative;
  height: 120px;
  background: transparent;
  display: flex;
  align-items: center;
  padding: 0;
  margin-bottom: 0;
  overflow: visible;
}
.speaker-modal-header-bg {
  position: absolute;
  left: 0; top: 0; width: 100%; height: 100%;
  /* background: #232a3d; */
  border-radius: 16px 16px 0 0;
  z-index: 1;
  opacity: 1;
}
.speaker-modal-photo-unique {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  background: #fff;
  border: 4px solid #66696b;
  box-shadow: 0 4px 18px rgba(0,0,0,0.13);
  margin-left: 32px;
  position: relative;
  z-index: 2;
  flex-shrink: 0;
}

/* --- Modal Name + Logo Row --- */
.speaker-modal-header-main {
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  gap: 22px;
  margin-left: 32px;
  padding-right: 32px;
  height: 100%;
  min-width: 0;
  justify-content: flex-start;
}

/* Speaker Name */
.speaker-modal-title-unique {
  font-size: 1.1rem;
  font-weight: 700;
  /* color: #fff; */
  margin-bottom: 4px;
  margin-top: 0;
  font-family: 'Montserrat', Arial, sans-serif;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
  vertical-align: middle;
}

/* Speaker Role */
.speaker-modal-role-unique {
  font-size: 0.75rem;
  /* color: #e3e7ee; */
  margin-bottom: 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* --- Modal Company Logo: Next to Name, Larger, Animated --- */
.speaker-modal-logo-big-unique {
  width: 165px;
  height: 50px;
  object-fit: scale-down;
  background: #fff;
  border-radius: 16px;
  margin-left: 18px;
  margin-right: 0;
  box-shadow: 0 0 0 0 #a084f5, 0 2px 16px 0 #e3e0fa;
  border: 3px solid #66696b;
  display: inline-block;
  vertical-align: middle;
  position: relative;
  z-index: 3;
  transition: box-shadow 0.3s, border-color 0.3s, transform 0.3s;
}

@media (max-width: 600px) {
  .speaker-modal-logo-big-unique {
    width: 90px;
    height: 40px;
    border-radius: 10px;
    margin-left: 8px;
  }
  .speaker-modal-header-main {
    gap: 8px;
    padding-right: 6px;
  }
  .speaker-modal-title-unique {
    font-size: 1rem;
  }
}

/* --- Modal Close Button --- */
.speaker-modal-close-unique {
  position: absolute;
  top: 12px;
  right: 12px;
  font-size: 1.6rem;
  /* color: #a084f5; */
  background: #fff;
  border-radius: 50%;
  width: 34px;
  height: 34px;
  /* border: 1.5px solid #e3e0fa; */
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  /* font-weight: bold; */
  z-index: 10;
  /* box-shadow: 0 2px 8px rgba(160,132,245,0.08); */
  /* transition: background 0.2s, color 0.2s, border 0.2s, box-shadow 0.2s; */
}
.speaker-modal-close-unique:hover {
  /* background: #a084f5; */
  /* color: #fff; */
  /* border-color: #a084f5; */
  /* box-shadow: 0 4px 16px #a084f5; */
}

@media (max-width: 600px) {
  .speaker-modal-close-unique {
    top: 6px;
    right: 10px;
    font-size: 1.3rem;
    width: 28px;
    height: 28px;
  }
  .speaker-modal-header-unique {
    height: 70px;
  }
  .speaker-modal-photo-unique {
    width: 40px;
    height: 40px;
    margin-left: 6px;
    border-width: 2px;
  }
  .speaker-modal-header-main {
    margin-left: 8px;
    padding-right: 6px;
  }
  .speaker-modal-title-unique {
    font-size: 0.85rem;
    margin-bottom: 2px;
  }
  .speaker-modal-role-unique {
    font-size: 0.7rem;
    margin-bottom: 2px;
  }
  .speaker-modal-content-unique {
    max-width: 94vw;
    width: 97vw;
    padding: 0 2vw 10px 2vw;
    border-radius: 12px;
  }
  .speaker-modal-session-box {
    padding: 8px 6px;
    font-size: 0.78rem;
  }
  .speaker-modal-session-label {
    font-size: 0.68rem;
    padding: 2px 7px;
    margin-left: 8px;
    margin-top: 8px;
    margin-bottom: 4px;
  }
  .speaker-modal-session-title {
    font-size: 0.8rem;
    margin-bottom: 4px;
  }
  .speaker-modal-session-desc-list div,
  .speaker-modal-session-desc-list span {
    font-size: 0.68rem !important;
  }
  .speaker-modal-session-row {
    font-size: 0.65rem;
    gap: 6px;
    margin-bottom: 4px;
  }
  .speaker-modal-session-stage {
    font-size: 0.65rem;
    padding: 2px 7px;
    margin-top: 2px;
    border-radius: 8px;
  }
}

/* Modal Styles */
.speaker-modal-session-label {
  font-size: 0.93rem;
  font-weight: 700;
  color: #212529;
  margin: 10px 0 6px 0;
  letter-spacing: 0.2px;
  text-transform: uppercase;
  display: inline-block;
  background: #f3f0ff;
  padding: 3px 14px;
  border-radius: 8px;
  box-shadow: 0 1px 6px 0 rgba(124,58,237,0.07);
}

.speaker-modal-session-box {
  border: 1px solid #e3e7ee;
  border-radius: 8px;
  padding: 12px 14px;
  margin-bottom: 0;
  background: #fafbff;
  font-size: 0.95rem;
  color: #3b2562;
  box-shadow: 0 2px 10px 0 rgba(124,58,237,0.04);
}

.speaker-modal-session-title {
  font-size: 1.01rem;
  font-weight: 700;
  color: #222;
  margin-bottom: 10px;
  letter-spacing: 0.1px;
}

.speaker-modal-session-desc-list {
  margin-bottom: 10px;
}
.speaker-modal-session-desc-list div {
  font-size: 0.75rem;
  color: #66696b;
  font-style: italic;
  font-weight: 600;
  margin-bottom: 4px;
  display: flex;
  align-items: flex-start;
}
.speaker-modal-session-desc-list span {
  display: inline-block;
}

.speaker-modal-unique {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0; top: 0; width: 100vw; height: 100vh;
  background: rgba(0,0,0,0.45);
  justify-content: center;
  align-items: center;
}
.speaker-modal-unique.active {
  display: flex;
}
.speaker-modal-content-unique {
  background: #fff;
  border-radius: 18px;
  max-width: 650px;
  width: 95vw;
  padding: 0;
  box-shadow: 0 8px 40px rgba(0,0,0,0.18);
  position: relative;
  animation: modalPopIn 0.2s;
  display: flex;
  flex-direction: column;
  gap: 0;
  overflow: hidden;
}
@keyframes modalPopIn {
  from { transform: scale(0.95); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}
.speaker-modal-session-row {
  display: flex;
  align-items: center;
  gap: 5px;
  margin-bottom: 8px;
  color: #222;
  font-size: 0.75rem;
  font-weight: 600;
}
.speaker-modal-session-row i {
  color: #888;
  /* margin-right: 6px; */
}
.speaker-modal-session-stage {
  display: inline-block;
  background: #e3e0fa;
  color: #4b2996;
  font-size: 0.75rem;
  border-radius: 12px;
  padding: 3px 14px;
  margin-top: 6px;
  font-weight: 800;
}
@media (max-width: 600px) {
  .speaker-card-unique {
    padding: 14px 6px 10px 6px;
    max-width: 160px;
    min-width: 0;
    width: 100%;
    border-radius: 10px;
  }
  .speaker-photo-wrapper-unique {
    width: 90px;
    height: 90px;
    margin-bottom: 10px;
  }
  .company-logo-unique {
    width: 95px;
    height: 30px;
    margin-bottom: 6px;
    padding: 1px;
  }
  .speaker-card-unique h3 {
    font-size: 0.75rem;
    margin: 7px 0 2px 0;
  }
  .speaker-card-unique p {
    font-size: 0.65rem;
    margin-bottom: 7px;
  }
}

@media (max-width: 600px) {
  .speaker-modal-header-unique {
    flex-direction: column !important;
    align-items: center !important;
    height: auto !important;
    padding: 18px 0 0 0 !important;
    gap: 0 !important;
  }
  .speaker-modal-photo-unique {
    margin: 0 auto 10px auto !important;
    display: block !important;
    width: 70px !important;
    height: 70px !important;
  }
  .speaker-modal-header-main {
    margin: 0 !important;
    padding: 0 0 0 0 !important;
    gap: 0 !important;
    align-items: center !important;
    flex-direction: column !important;
    width: 100% !important;
  }
  .speaker-modal-title-unique {
    margin: 0 0 4px 0 !important;
    font-size: 1rem !important;
    text-align: center !important;
    width: 100% !important;
    white-space: normal !important;
  }
  .speaker-modal-role-unique {
    margin: 0 0 8px 0 !important;
    font-size: 0.85rem !important;
    text-align: center !important;
    width: 100% !important;
    white-space: normal !important;
  }
  .speaker-modal-logo-big-unique {
    margin: 0 auto 10px auto !important;
    display: block !important;
    width: 90px !important;
    height: 40px !important;
    border-radius: 10px !important;
    border: none !important;
     border-width: 0 !important;
  }
  .speaker-modal-session-label,
  .speaker-modal-session-box {
    margin-left: 0 !important;
    margin-right: 0 !important;
    padding-left: 8px !important;
    padding-right: 8px !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }
}

@media (max-width: 600px) {
  /* Hide company logo in modal for speakers 14, 15, 16 on mobile */
  #modal-logo-big.speaker-no-logo {
    display: none !important;
  }
}

@media (max-width: 600px) {
  .speaker-modal-photo-unique {
    width: 90px !important;
    height: 90px !important;
    max-width: 90px !important;
    max-height: 90px !important;
  }

  .speaker-modal-content-unique {
  max-height: 90vh;
  overflow-y: auto;
}

/* Make modal content scrollable if overflow */

  /* Keeps modal size fixed, allows inner scroll */
}

    /* New Speaker Model Styles  end*/

</style>

<div id="event" class="event section">


    <!-- Upcoming Events -->
    <section id="upcoming" class="mt-1">
        <!-- <h2 class="text-center mb-4" style="color: #12037f;">Upcoming Events</h2> -->

        <div class="new_event">
            <!-- <img src="assets/images/Vanakkam HRD Logo 11 (1).png"> -->
            <img src="assets/images/Vanakkam HRD Logo 11.png" data-aos="zoom-in" loading="lazy" alt="Vanakkam HRD Logo">
            <p style="color: rgb(222, 185, 0); " data-aos="zoom-in">INDIA'S LARGEST</p>
            <h3 data-aos="zoom-in">HR FESTIVAL 2025</h3>
            <p data-aos="zoom-in">05 July, 2025</p>
            <p data-aos="zoom-in">Chennai Trade Centre, Chennai.</p>

            <!-- Centered Button -->
            <div data-aos="zoom-in">
                <a href="#ticket" class="btn-register">Get Ticket</a>
            </div>
            <!--<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_Q8DxCQU9sidRCo"  async></script>-->
        </div>
        </section>


        <!-- Countdown Timer -->
        
        <div class="countdown">
            <div class="time-box">
                <svg class="progress-ring" viewBox="0 0 150 150">
                    <circle class="bg-circle" cx="75" cy="75" r="65"></circle>
                    <circle class="fg-circle days" cx="75" cy="75" r="65" stroke-dasharray="408" stroke-dashoffset="0">
                    </circle>
                </svg>
                <span id="days">00</span>
                <p>DAYS</p>
            </div>
            <div class="time-box">
                <svg class="progress-ring" viewBox="0 0 150 150">
                    <circle class="bg-circle" cx="75" cy="75" r="65"></circle>
                    <circle class="fg-circle hours" cx="75" cy="75" r="65" stroke-dasharray="408" stroke-dashoffset="0">
                    </circle>
                </svg>
                <span id="hours">00</span>
                <p>HOURS</p>
            </div>
            <div class="time-box">
                <svg class="progress-ring" viewBox="0 0 150 150">
                    <circle class="bg-circle" cx="75" cy="75" r="65"></circle>
                    <circle class="fg-circle minutes" cx="75" cy="75" r="65" stroke-dasharray="408"
                        stroke-dashoffset="0"></circle>
                </svg>
                <span id="minutes">00</span>
                <p>MINS</p>
            </div>
            <div class="time-box">
                <svg class="progress-ring" viewBox="0 0 150 150">
                    <circle class="bg-circle" cx="75" cy="75" r="65"></circle>
                    <circle class="fg-circle seconds" cx="75" cy="75" r="65" stroke-dasharray="408"
                        stroke-dashoffset="0"></circle>
                </svg>
                <span id="seconds">00</span>
                <p>SECS</p>
            </div>
        </div>
    </section>


    <div class="container mt-3">

        <div class="counter-wrapper mt-2 mb-4">
            <div class="counterr">

                <h1 class="count small-number" data-target="1000">0</h1>
                <p>Attendees</p>
            </div>
            <div class="counterr">

                <h1 class="count small-number" data-target="1">0</h1>
                <p>Day</p>
            </div>
            <div class="counterr">

                <h1 class="count small-number" data-target="20">0</h1>
                <p>Speakers</p>
            </div>
            <div class="counterr">

                <h1 class="count small-number" data-target="5">0</h1>
                <p>Sessions</p>
            </div>
        </div>


    </div>

    <div id="about" class="top-featured-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="ai-about-content">
                        <h3 data-aos="zoom-in">About</h3>
                        <p data-aos="fade-right" data-aos-duration="1000">Vanakkam HRD's HR Festival is a premier event
                            that brings together inspiring speakers, cutting-edge innovations, and a passionate
                            community of HR professionals. Our mission is to explore, educate, and shape the future of
                            human resources through dynamic theme: HR 5.0: Humanizing Work in the Digital Age.</p>
                        <ul class="about-list">
                            <li data-aos="fade-right" data-aos-duration="1000"><i class="fa-solid fa-check"></i>
                                Industry recognized flagship HR Conference from India.</li>
                            <li data-aos="fade-right" data-aos-duration="1500"><i class="fa-solid fa-check"></i>
                                Keynotes by renowned industry leaders.</li>
                            <li data-aos="fade-right" data-aos-duration="2000"><i class="fa-solid fa-check"></i> Panel
                                discussions and fireside chat sessions.</li>
                            <li data-aos="fade-right" data-aos-duration="2500"><i class="fa-solid fa-check"></i>
                                Participants from 1000+ Companies.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="theme-section">
        <div class="theme-container">
            <div class="section-titlee">
                <h2 data-aos="zoom-in">The Event Themes</h2>
            </div>
            <div class="theme-boxes-container">

                <div class="boxs">
                    <img src="assets/images/icon2-4.png" alt="Service 1" class="box-images bg-red" loading="lazy">
                    <h5 class="text-center">HR 5.0: Humanizing Work in the Digital Age</h5>
                    <ul class="features-list">
                        <li>Putting Humans at the Centre</li>
                        <li>Technology-Enabled, Human-Centric </li>
                        <li>Fostering a Culture of Belonging</li>
                    </ul>
                </div>
                <div class="boxs">
                    <img src="assets/images/icon2-1.png" alt="Service 2" class="box-images bg-red" loading="lazy">
                    <h5 class="text-center">Redefining HR: Innovation, Impact, Inclusion</h5>
                    <ul class="features-list">
                        <li>Measuring Impact, Driving Results</li>
                        <li>Leadership Development</li>
                        <li>Data-Driven Decision Making</li>
                    </ul>
                </div>
                <div class="boxs">
                    <img src="https://vectorified.com/images/icon-performance-1.png" alt="Service 3"
                        class="box-images bg-red" loading="lazy">
                    <h5 class="text-center">The Evolving HR: People, Purpose, Performance</h5>
                    <ul class="features-list">
                        <li>HR Technology and Innovation</li>
                        <li>Leadership Development and Succession Planning</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="computer-vision-ai-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="computer-vision-ai-content text-center">
                        <h3 data-aos="zoom-in" data-aos-duration="500">Why attend?</h3>
                        <p data-aos="zoom-in" data-aos-duration="1000">Unlock Explore Sponsorship to connect, network,
                            learn, and grow at Vanakkam HRD.</p>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6" data-aos="fade-up" data-aos-duration="1000">
                                <div class="vision-ai-inner-card">
                                    <div class="content">
                                        <div class="content-wrapper">
                                            <div class="image-icon">
                                                <img src="assets/images/icon1.png" alt="icon" loading="lazy">
                                            </div>

                                            <h4>Connect</h4>
                                        </div>
                                        <p>Meet and collaborate with professionals & speakers in our networking lounges.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6" data-aos="fade-up" data-aos-duration="1500">
                                <div class="vision-ai-inner-card">
                                    <div class="content">
                                        <div class="content-wrapper">
                                            <div class="image-icon">
                                                <img src="assets/images/icon2.png" alt="icon" loading="lazy">
                                            </div>

                                            <h4>Network</h4>
                                        </div>
                                        <p>Engage with guests, share ideas, and build meaningful connections.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6" data-aos="fade-up" data-aos-duration="2000">
                                <div class="vision-ai-inner-card">
                                    <div class="content">
                                        <div class="content-wrapper">
                                            <div class="image-icon">
                                                <img src="assets/images/icon3.png" alt="icon" loading="lazy">
                                            </div>
                                            <h4>Learn</h4>
                                        </div>
                                        <p>Gain insights from experts through workshops and keynotes.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-4" data-aos="fade-up" data-aos-duration="2500">
                                <div class="vision-ai-inner-card">
                                    <div class="content">
                                        <div class="content-wrapper">
                                            <div class="image-icon">
                                                <img src="assets/images/icon4.png" alt="icon" loading="lazy">
                                            </div>

                                            <h4>Grow</h4>
                                        </div>
                                        <p>Strengthen your brand, generate leads, and stay ahead.</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Auto Scrolling Register Now Text -->
        <div class="scrolling-text-container">
            <div class="scrolling-text">
                <p>SECURE YOUR PASSES NOW > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SECURE YOUR PASSES NOW > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SECURE YOUR PASSES NOW
                    > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; SECURE YOUR PASSES NOW > &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SECURE YOUR PASSES NOW > &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; </p>
            </div>
        </div>
    </section>

    <section id="speakers-unique-section" class="speakers-section-unique">
    <div class="speakers-container">
        <h2 data-aos="zoom-in" class="section-title wow fadeInUp" data-wow-delay=".2s"
                style="color:rgb(7, 0, 102); font-weight: 600; font-size: 32px; margin-bottom: 30px; margin-top: 30px; font-family: 'Poppins', sans-serif;">
                Speakers</h2>
        <div class="speakers-grid">
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker1')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Krishna_Javaji.jpg" alt="Krishna Javaji" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://media.licdn.com/dms/image/v2/D560BAQF7TP_NhMu2-Q/company-logo_200_200/company-logo_200_200/0/1699546464450/impacteers_com_logo?e=2147483647&v=beta&t=TwSPK1BJ_jZk2a4hblGs4po1awK5qx_Ob5nQOH3Pt7k" alt="Impacteers" loading="lazy">
                <h3>Krishna Javaji</h3>
                <p>Chairman & CEO</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker2')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Srinivasa_Bharathy.jpg" alt="Srinivasa Bharathy" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://mma.prnewswire.com/media/1173223/Adrenalin_Logo.jpg?p=facebook" alt="Adrenalin" loading="lazy">
                <h3>Srinivasa Bharathy</h3>
                <p>MD & CEO</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker3')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/A_Rathinaswamy.jpg" alt="A Rathinaswamy" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://www.midnaglobal.com/images/midna-logo.jpg" alt="Midna" loading="lazy">
                <h3>A Rathinaswamy</h3>
                <p>First Mentor</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker4')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/arun_prakash.jpg" alt="Arun Prakash M" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4J8XiHRjH2e8iie5-gWyayxF984rd-XiGaA&s" alt="Guvi" loading="lazy">
                <h3>Arun Prakash M</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker5')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Bharathan_Prahalad.jpg" alt="Bharathan Prahalad" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://www.aziro.com/wp-content/uploads/2025/05/aziro-logo.png" alt="Aziro" loading="lazy">
                <h3>Bharathan Prahalad</h3>
                <p>Vice President - HR</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker6')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Chackochen_Mathai.jpg" alt="Dr. Chackochen Mathai" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="assets/images/Franchising Rightway.png" alt="Franchising Rightway" loading="lazy">
                <h3>Dr. Chackochen Mathai</h3>
                <p>Founder & CEO</p>
            </div>
             <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker7')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/KM_Suceendran.jpg" alt="Dr.KM Suceendran" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTPAWYqoR1E-YMPwd869I0X2WuToOjTrPXgQ&s" alt="Tcs" loading="lazy">
                <h3>Dr.KM Suceendran</h3>
                <p>Head - Academic Alliances Group</p>
            </div>
             <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker8')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Ganapathy_Sankarabaaham.jpg" alt="Ganapathy Sankarabaaham" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://3011891.fs1.hubspotusercontent-na1.net/hubfs/3011891/__hs-marketplace__/green%20(4)-1.png" alt="Vajra Global" loading="lazy">
                <h3>Ganapathy Sankarabaaham</h3>
                <p>Founder & CEO</p>
            </div>
             <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker9')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Vaijayanthi_Srinivasaraghavan.jpg" alt="Vaijayanthi Srinivasaraghavan" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://media.glassdoor.com/sqll/3012/ups-squareLogo-1633526374765.png" alt="Ups" loading="lazy">
                <h3>Vaijayanthi Srinivasaraghavan</h3>
                <p>Senior Director</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker10')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Hariharan_Subramanian.jpg" alt="Hariharan Subramanian" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://d2q79iu7y748jz.cloudfront.net/s/_squarelogo/256x256/78ead7a8a4fc0ac78bf1fd3aed8b06fd" alt="Iris" loading="lazy">
                <h3>Hariharan Subramanian</h3>
                <p>HR Head India</p>
            </div>
             <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker11')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Visukumar_Gopal.jpg" alt="Visukumar Gopal" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://media.licdn.com/dms/image/v2/D560BAQFfQPGyJ-PXbQ/company-logo_200_200/company-logo_200_200/0/1727947049854?e=2147483647&v=beta&t=JfPaSTeZgmrA_8qdO9Xl1di4LEgMwJblZzHStsCc8Mc" alt="Stark Corp" loading="lazy">
                <h3>Visukumar Gopal</h3>
                <p>Vice President</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker12')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Bharathiraja_Thangappapalm.jpg" alt="Bharathiraja Thangappapalm" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://media.licdn.com/dms/image/v2/C510BAQGZvyD4QaTm7A/company-logo_200_200/company-logo_200_200/0/1630570967474/payperresource_logo?e=2147483647&v=beta&t=yR1Q8kHBwR8XVaSwtAlIcTcuRhhz9KPHJFRrAYaQxmQ" alt="Touchmark" loading="lazy">
                <h3>Bharathiraja Thangappapalm</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker13')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Sree_Prathap.jpg" alt="Dr M Sree Prathap" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <img data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500" class="company-logo-unique" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEKV5LBWBwjXo4SYvAGX6xxohIVhYUaKl5Q&s" alt="Shadithya" loading="lazy">
                <h3>Dr M Sree Prathap</h3>
                <p>Founder & Chairman</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker14')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Rajmohan_Arumugam.jpg" alt="Rajmohan Arumugam" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <!-- <img class="company-logo-unique" src="" alt="R"> -->
                <h3>Rajmohan <br> Arumugam</h3>
                <p>Motivational Speaker <br>&<br> Writer</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker15')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/Lokesh_Ambigapathy.jpg" alt="Lokesh Ambigapathy" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <!-- <img class="company-logo-unique" src="" alt="R"> -->
                <h3>Lokesh <br> Ambigapathy</h3>
                <p>HR Head <br>&<br> Stand-Up Comedian</p>
            </div>
            <div class="speaker-card-unique" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2500">
                <div class="speaker-photo-wrapper-unique" tabindex="0" onclick="showSpeakerModal('speaker16')">
                    <img class="speaker-photo-unique" src="assets/images/Speakers/mr_bosskey.jpg" alt="Mr Bosskey" loading="lazy">
                    <div class="speaker-overlay-unique">
                        <span>View Profile</span>
                    </div>
                </div>
                <!-- <img class="company-logo-unique" src="" alt="R"> -->
                <h3>Mr Bosskey</h3>
                <p>Cricketer <br>&<br> Humorologist</p>
            </div>
        </div>
    </div>
</section>
<!-- Speaker Modal -->
<div id="speaker-modal" class="speaker-modal-unique">
  <div class="speaker-modal-content-unique">
    <button class="speaker-modal-close-unique" onclick="closeSpeakerModal()" aria-label="Close">&times;</button>
    <div class="speaker-modal-header-unique">
      <div class="speaker-modal-header-bg"></div>
      <img id="modal-photo" class="speaker-modal-photo-unique" src="" alt="" loading="lazy">
      <div class="speaker-modal-header-main">
        <div>
          <h2 id="modal-name" class="speaker-modal-title-unique"></h2>
          <div id="modal-role" class="speaker-modal-role-unique"></div>
        </div>
        <img id="modal-logo-big" class="speaker-modal-logo-big-unique" src="" alt="" loading="lazy">
      </div>
    </div>
    <div class="speaker-modal-session-label">Session by the speaker</div>
    <div class="speaker-modal-session-box">
      <div id="modal-session-title" class="speaker-modal-session-title"></div>
      <div id="modal-session-desc-list" class="speaker-modal-session-desc-list"></div>
      <div class="speaker-modal-session-row">
        <i class="fa-regular fa-calendar"></i>
        <span id="modal-session-date"></span>
        <i class="fa-regular fa-clock"></i>
        <span id="modal-session-time"></span>
      </div>
      <span id="modal-session-stage" class="speaker-modal-session-stage"></span>
    </div>
  </div>
</div>

    <!-- Agenda Start -->

    <section class="agenda-section" style="margin-top: 1px; padding: 40px 0; background-color: #f9fafb;">
        <div class="container">
            <h2 id="agenda" data-aos="zoom-in" class="section-title wow fadeInUp" data-wow-delay=".2s"
                style="color:rgb(7, 0, 102); font-weight: 600; font-size: 32px; margin-bottom: 30px; font-family: 'Poppins', sans-serif;">
                Event Agenda</h2>
                
                <div class="counting-text">
                <span class="gradient-text">S</span><span class="gradient-text">a</span><span
                    class="gradient-text">v</span><span class="gradient-text">e</span><span
                    class="gradient-text"></span>
                <span>&nbsp;</span>
                <span class="gradient-text">t</span><span class="gradient-text">h</span><span
                    class="gradient-text">e</span><span class="gradient-text"></span>
                <span>&nbsp;</span>
                <span class="gradient-text">D</span><span class="gradient-text">a</span><span
                    class="gradient-text">t</span><span class="gradient-text">e:</span><span
                    class="gradient-text"></span><span class="gradient-text">&nbsp;5th</span><span
                    class="gradient-text">&nbsp;J</span><span class="gradient-text">u</span><span
                    class="gradient-text">l</span><span class="gradient-text">y,</span><span
                    class="gradient-text">&nbsp;20</span><span class="gradient-text">25.</span>
            </div>
            <div class="schedule-container">
                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy">
                        </div>
                        <div class="content-section">
                            <h3 class="title">Registration</h3>
                            <div class="time">🕒 08:30 AM - 10:00 AM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Participant registration verification.</p>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy">
                        </div>
                        <div class="content-section">
                            <h3 class="title">Welcome Address</h3>
                            <div class="time">🕒 10:00 AM - 10:10 AM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Welcome.</p>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy">
                        </div>
                        <div class="content-section">
                            <h3 class="title">Keynote Address</h3>
                            <div class="time">🕒 10:15 AM - 10:40 AM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Keynote Session.</p>
                        <div class="vhrd-speaker-wrapper">
                            <div class="vhrd-speaker-tooltip">
                                <img src="assets/images/Speakers/Srinivasa_Bharathy.jpg" alt="Srinivasa Bharathy.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker2')" style="cursor:pointer;" loading="lazy" />
                                <span class="vhrd-tooltip-text">Srinivasa Bharathy</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">The mind behind the role - Hiring beyond the resume</h3>
                            <div class="time">🕒 10:40 AM - 11:00 AM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p><i class="fa-solid fa-check"></i>&nbsp;&nbsp;Focus on Potential, Not Just Paper.<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;Assessing Real-World Thinking.<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;Cultural Fit &Growth Mindset.
                        </p>
                        <div class="vhrd-speaker-wrapper">
                            <div class="vhrd-speaker-tooltip">
                                <img src="assets/images/Speakers/Bharathiraja Thangappapalm AB.jpg" alt="Bharathiraja Thangappapalm.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker12')" style="cursor:pointer;" loading="lazy" />
                                    <span class="vhrd-tooltip-text">Bharathiraja Thangappapalm</span>
                            </div>
                            <div class="vhrd-speaker-tooltip">
                                <img src="assets/images/Speakers/Dr M Sree Prathap AB.jpg" alt="Dr M Sree Prathap.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker13')" style="cursor:pointer;" loading="lazy" />
                                <span class="vhrd-tooltip-text">Dr M Sree Prathap</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">Panel Discussion by "Leadership in the Digital Age: The CEOs Perspective
                                on People Strategy"</h3>
                            <div class="time">🕒 11:00 AM - 12:15 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p><i class="fa-solid fa-check"></i>&nbsp;&nbsp;How has leadership evolved with digital
                            transformation?<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;The role of HR in supporting leadership
                            development and cultural transformation.<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;Strategies for fostering a human-first culture
                            while leveraging AI and digital tools.
                        </p>
                        <div class="vhrd-speaker-wrapper">
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Krishna Javaji AB.jpg" alt="Krishna Javaji.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker1')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Krishna Javaji</span>
                          </div>    
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Ganapathy Sankarabaaham AB.jpg" alt="Ganapathy Sankarabaaham.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker8')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Ganapathy Sankarabaaham</span>
                          </div>
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Dr. Chackochen Mathai AB.jpg" alt="Dr. Chackochen Mathai.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker6')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Dr. Chackochen Mathai</span>
                          </div>
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Arun Prakash M AB.jpg" alt="Arun Prakash M.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker4')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Arun Prakash M</span>
                          </div>
                        </div>
                    </div>
                </div>

                 <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">H"umo"R"ology</h3>
                            <div class="time">🕒 12:30 PM - 01:00 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                       <p><i class="fa-solid fa-check"></i>&nbsp;&nbsp;Humor relieves stress and anxiety.<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;Laughter boosts endorphins and mood.<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;Humor fosters socialconnections.
                        </p>
                        <div class="vhrd-speaker-wrapper">
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Mr. Bosskey AB.jpg" alt="Mr. Bosskey.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker16')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Mr. Bosskey</span>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">Lunch & Networking</h3>
                            <div class="time">🕒 01:00 PM - 02:00 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Meaningful Networking over lunch.</p>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">Panel Discussion by "Ethical AI in HR: Balancing Automation with Human
                                Judgement"</h3>
                            <div class="time">🕒 02:00 PM - 03:00 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p><i class="fa-solid fa-check"></i>&nbsp;&nbsp;How can HR ensure fairness and transparency in
                            AI-driven decision-making?<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;Risks of AI bias in hiring, performance
                            evaluation, and promotions.<br>
                            <i class="fa-solid fa-check"></i>&nbsp;&nbsp;HRs role in setting ethical guidelines for AI
                            implementation.
                        </p>
                         <div class="vhrd-speaker-wrapper">
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Dr.KM Suceendran AB.jpg" alt="Dr.KM Suceendran.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker7')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Dr.KM Suceendran</span>
                          </div>
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Hariharan Subramanian AB.jpg" alt="Hariharan_Subramanian.png" onclick="event.stopPropagation(); showSpeakerModal('speaker10')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Hariharan Subramanian</span>
                          </div>
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Vaijayanthi Srinivasaraghavan AB.jpg" alt="Vaijayanthi Srinivasaraghavan.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker9')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Vaijayanthi Srinivasaraghavan</span>
                          </div>
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Bharathan Prahalad AB.jpg" alt="Bharathan Prahalad.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker5')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Bharathan Prahalad</span>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">HR Stories</h3>
                            <div class="time"> 03:00 PM - 03:30 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>The Power of Storytelling for HR Professionals.</p>
                        <div class="vhrd-speaker-wrapper">
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Rajmohan Arumugam AB.jpg" alt="Rajmohan Arumugam.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker14')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Rajmohan Arumugam</span>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">Fireside Chat</h3>
                            <div class="time"> 03:30 PM - 04:00 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Unlocking Human Potential: The Role of Genetic Brain Profiling in HR.</p>
                        <div class="vhrd-speaker-wrapper">
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Visukumar Gopal AB.jpg" alt="Visukumar Gopal.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker11')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Visukumar Gopal</span>
                          </div>
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/A Rathinaswamy AB.jpg" alt="A Rathinaswamy.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker3')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">A Rathinaswamy</span>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">Stand-Up Comedy Show</h3>
                            <div class="time">🕒 04:00 PM - 04:45 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Fun Show.</p>
                        <div class="vhrd-speaker-wrapper">
                          <div class="vhrd-speaker-tooltip">
                           <img src="assets/images/Speakers/Lokesh Ambigapathy AB.jpg" alt="Lokesh Ambigapathy.jpg" onclick="event.stopPropagation(); showSpeakerModal('speaker15')" style="cursor:pointer;" loading="lazy" />
                           <span class="vhrd-tooltip-text">Lokesh Ambigapathy</span>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="2000" onclick="toggleCard(this)">
                    <div class="card-header">
                        <div class="avatar-section">
                            <img src="assets/images/verification_8216858.png" alt="Avatar" class="avatar" loading="lazy" />
                        </div>
                        <div class="content-section">
                            <h3 class="title">Vote of Thanks</h3>
                            <div class="time">🕒 04:50 PM - 05:00 PM</div>
                        </div>
                        <div class="arrow-section">⌃</div>
                    </div>
                    <div class="agenda_card-body">
                        <p>Networking Tea.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Agenda End -->





    <section id="ticket">
        <div class="container">
            <div class="row g-4 justify-content-center">

                <div class="section-titlee">
                    <h2 data-aos="zoom-in" data-aos-duration="500">Tickets</h2>
                    <h6 data-aos="zoom-in" data-aos-duration="1000">Don't miss out on this incredible opportunity to
                        connect, learn, and grow within the HR industry. Secure your ticket today!</h6>
                    <p data-aos="zoom-in" data-aos-duration="1500"><strong>Note: </strong> Ticket prices may change at
                        any time.</p>
                </div>

                <div class="col-md-4" data-aos="flip-left">
                    <div class="ticket-card sold-out">
                        <h3 class="ticket-title">SPOT REGISTRATION</h3>
                        <p>Available</p>
                        <p class="price" data-aos="flip-left">₹999</p>

                        <ul class="tick-list">
                            <li><i class="fa-solid fa-check"></i>Full access to all insightful sessions</li>
                            <li><i class="fa-solid fa-check"></i>All-Access Pass-Attend every impactful discussion</li>
                            <li><i class="fa-solid fa-check"></i>Meaningful Networking over lunch & tea</li>
                            <li><i class="fa-solid fa-check"></i>Meet select speakers & industry icons</li>
                            <li><i class="fa-solid fa-check"></i>Standup Comedy Show</li>

                        </ul>

                        <div class="pricing-btn">
                            <!-- <a href="hr_festival_2025.php" class="sold-in-btn">Book Your Pass</a> -->
                            <a href="#" class="sold-in-btn" style="background-color: grey;" >SOLD OUT</a>

                            <!-- <div class="ml-2 w-100">
                            <p>Available Tickets: 1/1000</p>
                        </div> -->
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>


    <section id="sponsors_logo" style="margin-top: 1px; padding: 40px 0; background-color:rgba(228, 230, 250, 0.3);">
            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Platinum Sponsor</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://www.royalsundaram.in/" target="blank"><img src="assets/images/Royal_Sudaram.png" alt="Royal_Sudaram.png" loading="lazy"></a></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Gold Sponsors</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://www.impacteers.com/" target="blank"><img src="assets/images/IMPACTEERS copy 1.png" alt="IMPACTEERS1.png" style="height: 80px;" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://www.myadrenalin.com/" target="blank"><img src="assets/images/Adrenalin.png" alt="Adrenalin.png" style="height: 80px;" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://www.keka.com/" target="blank"><img src="assets/images/Keka.png" alt="Keka.png" style="height: 50px;" loading="lazy"></a></div>
                        </div>
                    </div>
            </div>

             <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Silver Sponsors</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://egspec.org/" target="blank"><img src="assets/images/EGS.png" alt="EGS.png" style="height: 80px;" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://www.novactech.com/" target="blank"><img src="assets/images/novac.png" alt="novac.png" style="height: 80px;" loading="lazy"></a></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Strategic HR Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://www.guvi.in/" target="blank"><img src="assets/images/Guvi.jpg" alt="Guvi.jpg" loading="lazy"></a></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" loading="lazy">English Certification Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://www.britishcouncil.org/" target="blank"><img src="assets/images/Aptis_ESOL_Logo.png" alt="Aptis_ESOL_Logo.png" loading="lazy"></a></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Associate Sponsors</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://npsbcet.edu.in/" target="blank"><img src="assets/images/New-Prince.png" alt="New-Prince.png" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://rvscet.ac.in/" target="blank"><img src="assets/images/RVS-N.png" alt="RVSC.png" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://www.psnacet.edu.in/" target="blank"><img src="assets/images/PSNA.png" alt="PSNA.png" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://www.axisbank.com/" target="blank"><img src="assets/images/axis.png" alt="axis.png" loading="lazy"></a></div>
                            <div class="sponsor-logo"><a href="https://jibasju.com/" target="blank"><img src="assets/images/JIBA.png" alt="JIBA.png" loading="lazy" style="height: 80px;"></a></div>
                            <div class="sponsor-logo"><a href="https://dsuniversity.edu.in/" target="blank"><img src="assets/images/DSU N.png" alt="DSU N.png" loading="lazy"></a></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" loading="lazy">Media Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/Naanayam-Vikatan.png" alt="Naanayam-Vikatan.png" loading="lazy"></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" loading="lazy">Silver Exhibitors</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/NTL.jpeg" alt="NTL.jpeg" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/GR.png" alt="GR.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/Arivz.png" alt="Arivz.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/Xpohr.png" alt="Xpohr.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/Datalligence.png" alt="Datalligence.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/Many-Jobs.png" alt="Many-Jobs.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/Go-Floaters.png" alt="Go-Floaters.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/Lystloc.png" alt="Lystloc.png" loading="lazy"></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Exhibitors</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/Mnc.png" alt="Mnc.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/iscale2.png" alt="iscale2.png" loading="lazy"></div>
                        </div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Mental Wellness Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/Origin-BI.png" alt="Origin-BI.png" loading="lazy" style="height: 40px;"></div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Skilling Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/ICT.png" alt="ICT.png" loading="lazy"></div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Community Partners</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/hr_festival_sponsor_1.png" alt="hr_festival_sponsor_1.png" loading="lazy"></div>
                            <div class="sponsor-logo"><img src="assets/images/hr_festival_sponsor_2.png" alt="hr_festival_sponsor_2.png" loading="lazy"></div>
                    </div>
            </div>
    </section>



    <div id="attendees-section">
        <h2 id="attendees" class="text-center" data-aos="zoom-in" data-aos-duration="500">Attendees From</h2>




        <section class="attendees-section">

            <div class="logo-container">
                <!-- Logos will be inserted here dynamically -->


                <img src="assets/images/ABB.png" alt="ABB.png" loading="lazy">
                <img src="assets/images/Accenture.png" alt="Accenture.png" loading="lazy">
                <img src="assets/images/Microsoft.png" alt="Microsoft.png" loading="lazy">
                <img src="assets/images/Oracle.jpg" alt="Oracle.jpg" loading="lazy">
                <img src="assets/images/Google.png" alt="Google.png" loading="lazy">
                <img src="assets/images/EPAM.png" alt="EPAM.png" loading="lazy">
                <img src="assets/images/sony.png" alt="sony.png" loading="lazy">
                <img src="assets/images/Intel-Logo.png" alt="Intel-Logo.png" loading="lazy">
                <img src="assets/images/Aws.png" alt="Aws.png" loading="lazy">
                <img src="assets/images/Capgemini.png" alt="Capgemini.png" loading="lazy">
                <img src="assets/images/Bankofamerica.png" alt="Bankofamerica.png" loading="lazy">
                <img src="assets/images/Cognizant.png" alt="Cognizant.png" loading="lazy">
                <img src="assets/images/Hcl.png" alt="Hcl.png" loading="lazy">
                <img src="assets/images/Techmahindra.png" alt="Techmahindra.png" loading="lazy">
                <img src="assets/images/Databricks.png" alt="Databricks.png" loading="lazy">
                <img src="assets/images/Ibm.png" alt="Ibm.png" loading="lazy">
                <img src="assets/images/Infosys.png" alt="Infosys.png" loading="lazy">
                <img src="assets/images/Paypal.png" alt="Paypal.png" loading="lazy">
                <img src="assets/images/Wipro.png" alt="Wipro.png" loading="lazy">
                <img src="assets/images/EY.png" alt="EY.png" loading="lazy">
                <img src="assets/images/Zoho.png" alt="Zoho.png" loading="lazy">
                <img src="assets/images/Tcs.png" alt="Tcs.png" loading="lazy">
                <img src="assets/images/tree.png" alt="tree.png" loading="lazy">
                <img src="assets/images/kissflow_logo_web.svg" alt="kissflow_logo_web.svg" loading="lazy">
                <img src="assets/images/Kovai.png" alt="Kovai.png" loading="lazy">
                <img src="assets/images/Zoho_Corp.png" alt="Zoho_Corp.png" loading="lazy">
                <img src="assets/images/Zoho_Corp_2.png" alt="Zoho_Corp_2.png" loading="lazy">
                <img src="assets/images/Sopra.png" alt="Sopra.png" loading="lazy">
                <img src="assets/images/Accolite.png" alt="Accolite.png" loading="lazy">
                <img src="assets/images/Accolite_2.png" alt="Accolite_2.png" loading="lazy">
                <img src="assets/images/Accolite_3.png" alt="Accolite_3.png" loading="lazy">
                <img src="assets/images/Freshworks.png" alt="Freshworks.png" loading="lazy">
                <img src="assets/images/Presidio.png" alt="Presidio.png" loading="lazy">
                <img src="assets/images/PROIndia.png" alt="PROIndia.png" loading="lazy">
                <img src="assets/images/caterpiller.png" alt="caterpiller.png" loading="lazy">
                <img src="assets/images/ramco-logo-blue.png" alt="ramco-logo-blue.png" loading="lazy">
                <img src="assets/images/siemens.png" alt="siemens.png" loading="lazy">
                <img src="assets/images/atos.png" alt="atos.png" loading="lazy">
                <img src="assets/images/Daimler.png" alt="Daimler.png" loading="lazy">
                <img src="assets/images/nokia.png" alt="nokia.png" loading="lazy">
                <img src="assets/images/mphasis-logo.png" alt="mphasis-logo.png" loading="lazy">
                <img src="assets/images/MSC_technology.png" alt="MSC_technology.png" loading="lazy">
                <img src="assets/images/Thoughtworks-logo.svg" alt="Thoughtworks-logo.svg" loading="lazy">
                <img src="assets/images/Aspire.png" alt="Aspire.png" loading="lazy">
                <img src="assets/images/Flyers Softt.png" alt="Flyers Softt.png" loading="lazy">
                <img src="assets/images/Glance.png" alt="Glance.png" loading="lazy">
                <img src="assets/images/Securra.png" alt="Securra.png" loading="lazy">
                <img src="assets/images/syncfusion.png" alt="syncfusion.png" loading="lazy">
                <img src="assets/images/Sagent.png" alt="Sagent.png" loading="lazy">
                <img src="assets/images/Confluent_Logo.png" alt="Confluent_Logo.png" loading="lazy">
                <img src="assets/images/elastic.png" alt="elastic.png" loading="lazy">
                <img src="assets/images/Philips.png" alt="Philips.png" loading="lazy">
                <img src="assets/images/Impiger.png" alt="Impiger.png" loading="lazy">
                <img src="assets/images/CES.png" alt="CES.png" loading="lazy">
                <img src="assets/images/Logitech-G-Logo-PNG.png" alt="Logitech-G-Logo-PNG.png" loading="lazy">
                <img src="assets/images/Deloitte_Logo.png" alt="Deloitte_Logo.png" loading="lazy">
                <img src="assets/images/Logo_Global_NTT_DATA_Future_Blue_RGB.png" alt="Logo_Global_NTT_DATA_Future_Blue_RGB.png" loading="lazy">
                <img src="assets/images/HP_logo_2012.svg" alt="HP_logo_2012.svg" loading="lazy">
                <img src="assets/images/Standard_Chartered.png" alt="Standard_Chartered.png" loading="lazy">
                <img src="assets/images/Sify.png" alt="Sify.png" loading="lazy">
                <img src="assets/images/Wells_Fargo_Logo.png" alt="Wells_Fargo_Logo.png" loading="lazy">
                <img src="assets/images/EXL.png" alt="EXL.png" loading="lazy">
                <img src="assets/images/flipkart.png" alt="flipkart.png" loading="lazy">
                <img src="assets/images/contus.png" alt="contus.png" loading="lazy">
                <img src="assets/images/novac.png" alt="novac.png" loading="lazy">
                <img src="assets/images/Infiniti.png" alt="Infiniti.png" loading="lazy">
                <img src="assets/images/flatirons.png" alt="flatirons.png" loading="lazy">
                <img src="assets/images/ADP.svg" alt="ADP.svg" loading="lazy">
                <img src="assets/images/Zafin_Logo.svg" alt="Zafin_Logo.svg" loading="lazy">
                <img src="assets/images/foodhub_logo.png" alt="foodhub_logo.png" loading="lazy">
                <img src="assets/images/prochant.svg" alt="prochant.svg" loading="lazy">
                <img src="assets/images/tagit.png" alt="tagit.png" loading="lazy">
                <img src="assets/images/IDP_Education.png" alt="IDP_Education.png" loading="lazy">
                <img src="assets/images/Kanini-Logo.svg" alt="Kanini-Logo.svg" loading="lazy">
                <img src="https://www.softsuave.com/new-assets/common/images/softsuave_logo.webp" alt="softsuave_logo.webp" loading="lazy">
                <img
                    src="https://maveric-systems.com/wp-content/uploads/2023/08/Maveric-AN-Logo_Original-e1691386593927.png" alt="Maveric-AN-Logo_Original" loading="lazy">
                <img src="https://visailabs.com/wp-content/uploads/Visai-Labs-Dimensioner.webp" alt="Visai-Labs-Dimensioner" loading="lazy">
                <img src="assets/images/logo_photon.svg" alt="logo_photon.svg" loading="lazy">
                <img src="https://framerusercontent.com/images/UqvHfb4Vz4wHFxUkP6AiL54CE.png?scale-down-to=512" alt="Framer Image" loading="lazy">
                <img src="assets/images/Softsquare-logo.png" alt="Softsquare-logo.png" loading="lazy">
                <img
                    src="https://cdn.prod.website-files.com/6091406ee82ddd9e918bf489/67405bdf6160162fd04ecb54_Primary%20logo_with_tagline_guide-02%2014.avif" alt="Primary logo with tagline" loading="lazy">
                <img src="https://newtglobal.com/wp-content/uploads/2024/10/newtglobal_logo.png" alt="newtglobal_logo.png" loading="lazy">
                <img src="https://newgensoft.com/wp-content/uploads/2023/07/logo-newgen.svg" alt="logo-newgen.svg" loading="lazy">
                <img
                    src="https://cdn.prod.website-files.com/6749d969d7db33901df0a61b/6773a8446b10600055b83456_PHOTO-2024-12-31-13-28-14-removebg-preview.avif" alt="PHOTO-2024-12-31-13-28-14-removebg-preview.avif" loading="lazy">
                <img
                    src="https://cdn.cookielaw.org/logos/c2e51c50-8594-41cd-a02a-67907a0f7e2e/db1befd6-4128-407d-9dca-edf52e36169e/18fb6f93-030a-4636-8cd1-aacc90eb9a87/Genpact_logo_resized.png" alt="Genpact_logo_resized.png" loading="lazy">
                <img src="assets/images/REN_NISSAN_LOGO.png" alt="REN_NISSAN_LOGO.png" loading="lazy">
                <img src="assets/images/itech-new-logo.png" alt="itech-new-logo.png" loading="lazy">
                <img src="https://www.itcinfotech.com/wp-content/uploads/2025/03/itc-logo-1.webp" alt="itc-logo-1.webp" loading="lazy">
                <img src="assets/images/inspirisys.png" alt="inspirisys.png" loading="lazy">
                <img src="assets/images/grootan2.png" alt="grootan2.png" loading="lazy">
                <img src="assets/images/ktv.png" alt="ktv.png" loading="lazy">

            </div>

            <!-- Animated "Still Counting..." text -->
            <div class="counting-text">
                <span class="gradient-text">S</span><span class="gradient-text">t</span><span
                    class="gradient-text">i</span><span class="gradient-text">l</span><span
                    class="gradient-text">l</span>
                <span>&nbsp;</span>
                <span class="gradient-text">m</span><span class="gradient-text">o</span><span
                    class="gradient-text">r</span><span class="gradient-text">e</span>
                <span>&nbsp;</span>
                <span class="gradient-text">C</span><span class="gradient-text">o</span><span
                    class="gradient-text">m</span><span class="gradient-text">p</span><span
                    class="gradient-text">a</span><span class="gradient-text">n</span><span
                    class="gradient-text">i</span><span class="gradient-text">e</span><span
                    class="gradient-text">s</span><span class="gradient-text">.</span><span
                    class="gradient-text">.</span><span class="gradient-text">.</span>
            </div>

        </section>
    </div>


    <section id="venue" class="about-area pt-50">
        <div class="container">
            <div class="section-titlee">
                <h2 data-aos="zoom-in" data-aos-duration="500">Venue</h2>
            </div>
            <div class="row">
                <div class="col-md-6" data-aos="zoom-in">
                    <img src="assets/images/venue-1.jpg" alt="Venue Image 1" class="venue-img" loading="lazy">
                </div>
                <div class="col-md-6" data-aos="zoom-in">
                    <img src="assets/images/venue-2.jpg" alt="Venue Image 2" class="venue-img" loading="lazy">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6" data-aos="zoom-in">
                    <img src="assets/images/venue-3.jpg" alt="Venue Image 3" class="venue-img" loading="lazy">
                </div>
                <div class="col-md-6 venue-text" data-aos="zoom-in">
                    <h2>Chennai Convention Centre</h2>
                    <p>3, Karumariamman Koil St, Ganapathi Colony,</p>
                    <p>Wood Creek County, Tulasingapuram, Nandambakkam,</p>
                    <p>Chennai, Tamil Nadu 600 089.</p>
                    <iframe title="venue-map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2305.5800548276793!2d80.18918160244463!3d13.013711645675395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a526744cc81dfdb%3A0xda545775ea161729!2sChennai%20Trade%20Centre%20New%20Building!5e1!3m2!1sen!2sin!4v1720767331159!5m2!1sen!2sin"
                        height="220" style="border: 0; width: 100%;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>


    <!-- Past Events -->

    <div class="container">
        <section id="past" class="mt-1">
            <h2 class="text-center" style="color: #12037f;font-family: Dosis, sans-serif;font-weight: 700;"
                data-aos="zoom-in">Past Events</h2>
            <div class="row mt-4 mb-4">


                <div class="col-md-3 mb-4">
                    <div class="card h-100" data-aos="zoom-in">
                        <img src="assets/images/HRF2025_BG_1.JPG" class="card-img-top img-fluid"
                            alt="upcoming Event 1" loading="lazy">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center mb-2">HR Festival 2025</h6>
                            <p class="card-text mb-2 mt-auto">
                                <i class="fas fa-calendar-alt me-2"></i> July 05, 2025 - 9:30 AM
                            </p>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i> Chennai Trade Centre, Chennai.
                            </p>
                            <div class="mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="hr_festival_2025_details.php" class="btn mb-3"
                                            style="background-color: #12037f; color: white;">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card h-100" data-aos="zoom-in">
                        <img src="assets/images/hr_conference_2025_bg.JPG" class="card-img-top img-fluid"
                            alt="upcoming Event 1" loading="lazy">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center mb-2">HR Conference 2025</h6>
                            <p class="card-text mb-2 mt-auto">
                                <i class="fas fa-calendar-alt me-2"></i> February 22, 2025 - 9:30 AM
                            </p>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i> Hotel Grand Mercure, Bengaluru.
                            </p>
                            <div class="mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="hrconference2025details.php" class="btn mb-3"
                                            style="background-color: #12037f; color: white;">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 mb-4">
                    <div class="card h-100" data-aos="zoom-in">
                        <img src="assets/images/secong_bg.jpeg" class="card-img-top img-fluid" alt="past Event 1" loading="lazy">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center">Second Annual Conference & The Excellence Achiever Awards
                                2024</h6>
                            <p class="card-text mb-2 mt-auto">
                                <i class="fas fa-calendar-alt me-2"></i> December 21, 2024 - 9:30 AM
                            </p>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i> Green Park Hotel,Chennai.
                            </p>
                            <div class="mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="second_annual_2024.php" class="btn mb-3"
                                            style="background-color: #12037f; color: white;">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 mb-4">
                    <div class="card h-100" data-aos="zoom-in">
                        <img src="assets/images/7H3A9004-min.JPG" class="card-img-top" alt="Past Event 1" loading="lazy">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center">HR Meet 2024</h6><br>
                            <p class="card-text mb-2 mt-auto">
                                <i class="fas fa-calendar-alt me-2"></i> September 21, 2024 - 9:30 AM
                            </p>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt me-2 "></i> Kasthuri Sreenivasan Trust Auditorium,
                                Coimbatore.
                            </p>
                            <div class="mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="hrmeet_2024.php" class="btn mb-3"
                                            style="background-color: #12037f; color: white;">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="col-md-3 mb-4">
                    <div class="card h-100 mb-3" data-aos="zoom-in">
                        <img src="assets/images/campus_bg.JPG" class="card-img-top img-fluid" alt="past Event 1" loading="lazy">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center">Campus Recruiters Confluence 2024</h6>
                            <p class="card-text mb-2 mt-auto">
                                <i class="fas fa-calendar-alt me-2"></i> August 31, 2024 - 9:30 AM
                            </p>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i> Hotel Ramada Plaza, Guindy, Chennai.
                            </p>
                            <div class="mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="campus_recruiters_2024.php" class="btn mb-3"
                                            style="background-color: #12037f; color: white;">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </section>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
  
//   Speaker Animation start

const speakerData = {
  speaker1: {
    photo: "assets/images/Speakers/Krishna_Javaji.jpg",
    name: "Krishna Javaji",
    role: "Chairman & CEO",
    companyLogo: "https://media.licdn.com/dms/image/v2/D560BAQF7TP_NhMu2-Q/company-logo_200_200/company-logo_200_200/0/1699546464450/impacteers_com_logo?e=2147483647&v=beta&t=TwSPK1BJ_jZk2a4hblGs4po1awK5qx_Ob5nQOH3Pt7k",
    session: {
      title: 'Panel Discussion by "Leadership in the Digital Age: The CEOs Perspective on People Strategy"',
      sessionDesc: [
        "How has leadership evolved with digital transformation?",
        "The role of HR in supporting leadership development and cultural transformation.",
        "Strategies for fostering a human-first culture while leveraging AI and digital tools."
      ],
      date: "Jul 05, 2025",
      time: "11:00 AM - 12:15 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker2: {
    photo: "assets/images/Speakers/Srinivasa_Bharathy.jpg",
    name: "Srinivasa Bharathy",
    role: "MD & CEO",
    companyLogo: "https://mma.prnewswire.com/media/1173223/Adrenalin_Logo.jpg?p=facebook",
    session: {
      title: 'Keynote Address',
      sessionDesc: [
        "Keynote Session."
      ],
      date: "Jul 05, 2025",
      time: "10:15 AM - 10:40 AM (IST)",
      stage: "Main Stage"
    }
  },
  speaker3: {
    photo: "assets/images/Speakers/A_Rathinaswamy.jpg",
    name: "A Rathinaswamy",
    role: "First Mentor",
    companyLogo: "https://www.midnaglobal.com/images/midna-logo.jpg",
    session: {
      title: 'Fireside Chat',
      sessionDesc: [
        "Unlocking Human Potential: The Role of Genetic Brain Profiling in HR."
      ],
      date: "Jul 05, 2025",
      time: "03:30 PM - 04:00 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker4: {
    photo: "assets/images/Speakers/arun_prakash.jpg",
    name: "Arun Prakash M",
    role: "Founder & CEO",
    companyLogo: "https://www.guvi.in/assets/CPYoUJqK-guvilogo-hcl.webp",
   session: {
      title: 'Panel Discussion by "Leadership in the Digital Age: The CEOs Perspective on People Strategy"',
      sessionDesc: [
        "How has leadership evolved with digital transformation?",
        "The role of HR in supporting leadership development and cultural transformation.",
        "Strategies for fostering a human-first culture while leveraging AI and digital tools."
      ],
      date: "Jul 05, 2025",
      time: "11:00 AM - 12:15 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker5: {
    photo: "assets/images/Speakers/Bharathan_Prahalad_BP.jpg",
    name: "Bharathan Prahalad",
    role: "Vice President - HR",
    companyLogo: "https://www.aziro.com/wp-content/uploads/2025/05/aziro-logo.png",
   session: {
      title: 'Panel Discussion by "Ethical AI in HR: Balancing Automation with Human Judgement"',
      sessionDesc: [
        "How can HR ensure fairness and transparency in AI-driven decision-making?",
        "Risks of AI bias in hiring, performance evaluation, and promotions.",
        "HRs role in setting ethical guidelines for AI implementation."
      ],
      date: "Jul 05, 2025",
      time: "02:00 PM - 03:00 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker6: {
    photo: "assets/images/Speakers/Chackochen_Mathai.jpg",
    name: "Dr. Chackochen Mathai",
    role: "Founder & CEO",
    companyLogo: "assets/images/Franchising Rightway.png",
   session: {
      title: 'Panel Discussion by "Leadership in the Digital Age: The CEOs Perspective on People Strategy"',
      sessionDesc: [
        "How has leadership evolved with digital transformation?",
        "The role of HR in supporting leadership development and cultural transformation.",
        "Strategies for fostering a human-first culture while leveraging AI and digital tools."
      ],
      date: "Jul 05, 2025",
      time: "11:00 AM - 12:15 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker7: {
    photo: "assets/images/Speakers/KM_Suceendran.jpg",
    name: "Dr.KM Suceendran",
    role: "Head - Academic Alliances Group",
    companyLogo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTPAWYqoR1E-YMPwd869I0X2WuToOjTrPXgQ&s",
   session: {
      title: 'Panel Discussion by "Ethical AI in HR: Balancing Automation with Human Judgement"',
      sessionDesc: [
        "How can HR ensure fairness and transparency in AI-driven decision-making?",
        "Risks of AI bias in hiring, performance evaluation, and promotions.",
        "HRs role in setting ethical guidelines for AI implementation."
      ],
      date: "Jul 05, 2025",
      time: "02:00 PM - 03:00 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker8: {
    photo: "assets/images/Speakers/Ganapathy_Sankarabaaham.jpg",
    name: "Ganapathy Sankarabaaham",
    role: "Founder & CEO",
    companyLogo: "https://3011891.fs1.hubspotusercontent-na1.net/hubfs/3011891/__hs-marketplace__/green%20(4)-1.png",
  session: {
      title: 'Panel Discussion by "Leadership in the Digital Age: The CEOs Perspective on People Strategy"',
      sessionDesc: [
        "How has leadership evolved with digital transformation?",
        "The role of HR in supporting leadership development and cultural transformation.",
        "Strategies for fostering a human-first culture while leveraging AI and digital tools."
      ],
      date: "Jul 05, 2025",
      time: "11:00 AM - 12:15 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker9: {
    photo: "assets/images/Speakers/Vaijayanthi_Srinivasaraghavan.jpg",
    name: "Vaijayanthi Srinivasaraghavan",
    role: "Senior Director",
    companyLogo: "https://media.glassdoor.com/sqll/3012/ups-squareLogo-1633526374765.png",
  session: {
      title: 'Panel Discussion by "Ethical AI in HR: Balancing Automation with Human Judgement"',
      sessionDesc: [
        "How can HR ensure fairness and transparency in AI-driven decision-making?",
        "Risks of AI bias in hiring, performance evaluation, and promotions.",
        "HRs role in setting ethical guidelines for AI implementation."
      ],
      date: "Jul 05, 2025",
      time: "02:00 PM - 03:00 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker10: {
    photo: "assets/images/Speakers/Hariharan_Subramanian.jpg",
    name: "Hariharan Subramanian",
    role: "HR Head India",
    companyLogo: "https://d2q79iu7y748jz.cloudfront.net/s/_squarelogo/256x256/78ead7a8a4fc0ac78bf1fd3aed8b06fd",
   session: {
      title: 'Panel Discussion by "Ethical AI in HR: Balancing Automation with Human Judgement"',
      sessionDesc: [
        "How can HR ensure fairness and transparency in AI-driven decision-making?",
        "Risks of AI bias in hiring, performance evaluation, and promotions.",
        "HRs role in setting ethical guidelines for AI implementation."
      ],
      date: "Jul 05, 2025",
      time: "02:00 PM - 03:00 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker11: {
    photo: "assets/images/Speakers/Visukumar_Gopal.jpg",
    name: "Visukumar Gopal",
    role: "Vice President",
    companyLogo: "https://media.licdn.com/dms/image/v2/D560BAQFfQPGyJ-PXbQ/company-logo_200_200/company-logo_200_200/0/1727947049854?e=2147483647&v=beta&t=JfPaSTeZgmrA_8qdO9Xl1di4LEgMwJblZzHStsCc8Mc",
   session: {
      title: 'Fireside Chat',
      sessionDesc: [
        "Unlocking Human Potential: The Role of Genetic Brain Profiling in HR."
      ],
      date: "Jul 05, 2025",
      time: "03:30 PM - 04:00 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker12: {
    photo: "assets/images/Speakers/Bharathiraja_Thangappapalm.jpg",
    name: "Bharathiraja Thangappapalm",
    role: "Founder & CEO",
    companyLogo: "https://media.licdn.com/dms/image/v2/C510BAQGZvyD4QaTm7A/company-logo_200_200/company-logo_200_200/0/1630570967474/payperresource_logo?e=2147483647&v=beta&t=yR1Q8kHBwR8XVaSwtAlIcTcuRhhz9KPHJFRrAYaQxmQ",
   session: {
      title: 'The mind behind the role - Hiring beyond the resume',
      sessionDesc: [
        "Focus on Potential, Not Just Paper.",
        "Assessing Real-World Thinking.",
        "Cultural Fit & Growth Mindset."
      ],
      date: "Jul 05, 2025",
      time: "10:40 AM - 11:00 AM (IST)",
      stage: "Main Stage"
    }
  },
   speaker13: {
    photo: "assets/images/Speakers/Sree_Prathap.jpg",
    name: "Dr M Sree Prathap",
    role: "Founder & Chairman",
    companyLogo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEKV5LBWBwjXo4SYvAGX6xxohIVhYUaKl5Q&s",
   session: {
      title: 'The mind behind the role - Hiring beyond the resume',
      sessionDesc: [
        "Focus on Potential, Not Just Paper.",
        "Assessing Real-World Thinking.",
        "Cultural Fit & Growth Mindset."
      ],
      date: "Jul 05, 2025",
      time: "10:40 AM - 11:00 AM (IST)",
      stage: "Main Stage"
    }
  },
  speaker14: {
    photo: "assets/images/Speakers/Rajmohan_Arumugam.jpg",
    name: "Rajmohan Arumugam",
    role: "Motivational Speaker & Writer",
    // companyLogo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEKV5LBWBwjXo4SYvAGX6xxohIVhYUaKl5Q&s",
   session: {
      title: 'HR Stories',
      sessionDesc: [
        "The Power of Storytelling for HR Professionals."
      ],
      date: "Jul 05, 2025",
      time: "03:00 PM - 03:30 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker15: {
    photo: "assets/images/Speakers/Lokesh_Ambigapathy.jpg",
    name: "Lokesh Ambigapathy",
    role: "HR Head & Stand-Up Comedian",
    // companyLogo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEKV5LBWBwjXo4SYvAGX6xxohIVhYUaKl5Q&s",
   session: {
      title: 'Stand-Up Comedy Show',
      sessionDesc: [
        "Fun Show."
      ],
      date: "Jul 05, 2025",
      time: "04:00 PM - 04:45 PM (IST)",
      stage: "Main Stage"
    }
  },
  speaker16: {
    photo: "assets/images/Speakers/mr_bosskey.jpg",
    name: "Mr Bosskey",
    role: "Cricketer & Humorologist",
    // companyLogo: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyEKV5LBWBwjXo4SYvAGX6xxohIVhYUaKl5Q&s",
   session: {
      title: 'H"umo"R"ology',
      sessionDesc: [
        "Humor relieves stress and anxiety.",
        "Laughter boosts endorphins and mood.",
        "Humor fosters social connections."
      ],
      date: "Jul 05, 2025",
      time: "12:30 PM - 01:00 PM (IST)",
      stage: "Main Stage"
    }
  },
};

function showSpeakerModal(speakerKey) {
  const s = speakerData[speakerKey];
  if (!s) return;
  document.getElementById('modal-photo').src = s.photo;
  document.getElementById('modal-photo').alt = s.name;
  document.getElementById('modal-name').textContent = s.name;
  document.getElementById('modal-role').textContent = s.role;

  // Hide company logo for speakers 14, 15, 16 (desktop & mobile)
  const logoEl = document.getElementById('modal-logo-big');
  logoEl.classList.remove('speaker-no-logo');
  if (['speaker14', 'speaker15', 'speaker16'].includes(speakerKey)) {
    logoEl.style.display = 'none';
    logoEl.classList.add('speaker-no-logo');
  } else {
    logoEl.style.display = '';
    logoEl.src = s.companyLogo;
    logoEl.alt = s.name + " Company";
  }

  // Session details
  document.getElementById('modal-session-title').textContent = s.session.title;
  if (Array.isArray(s.session.sessionDesc)) {
    document.getElementById('modal-session-desc-list').innerHTML = s.session.sessionDesc.map(line =>
      `<div><span style="color:#4baf50;font-size:1.1em;margin-right:8px;line-height:1.2;">&#10003;</span><span>${line}</span></div>`
    ).join('');
  } else {
    document.getElementById('modal-session-desc-list').textContent = s.session.sessionDesc || '';
  }
  document.getElementById('modal-session-date').textContent = s.session.date;
  document.getElementById('modal-session-time').textContent = s.session.time;
  document.getElementById('modal-session-stage').textContent = s.session.stage;
  document.getElementById('speaker-modal').classList.add('active');
}

function closeSpeakerModal() {
  document.getElementById('speaker-modal').classList.remove('active');
}

// Ensure close button works even if event bubbling is stopped
document.querySelectorAll('.speaker-modal-close-unique').forEach(btn => {
  btn.onclick = function(e) {
    e.stopPropagation();
    closeSpeakerModal();
  };
});

// Close modal on outside click
document.addEventListener('click', function(e) {
  const modal = document.getElementById('speaker-modal');
  if (modal && modal.classList.contains('active') && e.target === modal) {
    closeSpeakerModal();
  }
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
  if (e.key === "Escape") closeSpeakerModal();
});

//   Speaker Animation end

    // Set the event date (Year, Month (0-based), Day, Hours, Minutes, Seconds)
    const eventDate = new Date(2025, 12, 20, 0, 0, 0).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const timeLeft = eventDate - now;

        if (timeLeft > 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;

            // Update the circular progress rings
            updateProgressRing("days", days, 365);
            updateProgressRing("hours", hours, 24);
            updateProgressRing("minutes", minutes, 60);
            updateProgressRing("seconds", seconds, 60);
        } else {
            document.querySelector(".countdown").innerHTML = "<h4>Grand Success!</h4>";
        }
    }

    function updateProgressRing(type, value, maxValue) {
        const circles = document.querySelectorAll(".progress-ring .fg-circle");
        let index = 0;
        if (type === "days") index = 0;
        else if (type === "hours") index = 1;
        else if (type === "minutes") index = 2;
        else if (type === "seconds") index = 3;

        const totalLength = 408; // Circumference of the circle
        const progress = (value / maxValue) * totalLength;
        circles[index].style.strokeDashoffset = totalLength - progress;
    }

    // Update countdown every second
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Run initially

    // Function to start counter animation
    function startCounterAnimation(counter) {
        const target = Number(counter.getAttribute('data-target'));
        const duration = 1800; // Duration in milliseconds
        const frameDuration = 100; // Time between frames in milliseconds
        const totalFrames = duration / frameDuration;
        const increment = Math.ceil(target / totalFrames); // Calculate increment value

        function update(frame) {
            const count = Number(counter.innerText.replace('+', '')); // Remove "+" for calculation
            const newCount = Math.min(count + increment, target); // Ensure count does not exceed target

            // Check if the target is 1 (for "Days"), do not add "+"
            if (target === 1) {
                counter.innerText = newCount < 10 ? '0' + newCount : newCount; // Ensure two-digit format for single digits
            } else {
                counter.innerText = (newCount < 10 ? '0' + newCount : newCount) + '+'; // Append "+" for other numbers
            }

            if (newCount < target) {
                setTimeout(() => update(frame + 1), frameDuration); // Recursive call with frame duration
            } else {
                counter.innerText = target + (target === 1 ? '' : '+'); // Ensure final value is formatted correctly
            }
        }

        // Initialize counter
        counter.innerText = target === 1 ? '00' : '00+'; // Start at "00" for Days, "00+" for others
        update(0); // Start the animation
    }

    // Initialize Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.count');
                counters.forEach(counter => {
                    if (!counter.classList.contains('animated')) {
                        startCounterAnimation(counter);
                        counter.classList.add('animated'); // Add class to prevent re-triggering
                    }
                });
                observer.unobserve(entry.target); // Stop observing after animation starts
            }
        });
    }, { threshold: 0.5 }); // Adjust the threshold to control when the animation starts

    // Observe the counter section
    const counterSection = document.querySelector('.counter-wrapper');
    observer.observe(counterSection);

    document.addEventListener("DOMContentLoaded", function () {
        let eventSection = document.querySelector(".new_event");
        let images = [
            "assets/images/background111.jpeg",
            "assets/images/background2.jpeg"
        ];
        let currentIndex = 0;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            eventSection.style.backgroundImage = `url('${images[currentIndex]}')`;
        }, 3000); // Change background every 3 seconds
    });


    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.theme-boxes-container');
        const boxes = document.querySelectorAll('.boxs');
        let currentIndex = 0;
        let autoScrollInterval;
        let isDragging = false;
        let startX;
        let scrollLeft;

        function startAutoScroll() {
            if (window.innerWidth > 768) return; // Only auto-scroll on mobile

            autoScrollInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % boxes.length;

                if (currentIndex === 0) {
                    // When we reach the end, instantly scroll back to start (hidden from user)
                    container.scrollLeft = 0;
                    // Then animate to the first box
                    setTimeout(() => {
                        scrollToBox(currentIndex);
                    }, 50);
                } else {
                    scrollToBox(currentIndex);
                }
            }, 3000);
        }

        function scrollToBox(index) {
            const box = boxes[index];
            container.scrollTo({
                left: box.offsetLeft - container.offsetLeft,
                behavior: 'smooth'
            });
            currentIndex = index;
        }

        function handleDragStart(e) {
            isDragging = true;
            startX = e.pageX || e.touches[0].pageX;
            scrollLeft = container.scrollLeft;
            clearInterval(autoScrollInterval);
        }

        function handleDragMove(e) {
            if (!isDragging) return;
            e.preventDefault();
            const x = (e.pageX || e.touches[0].pageX) - container.offsetLeft;
            const walk = (x - startX) * 2;
            container.scrollLeft = scrollLeft - walk;
        }

        function handleDragEnd() {
            isDragging = false;

            // Find which box is now centered
            const containerCenter = container.scrollLeft + (container.offsetWidth / 2);
            let closestBox = null;
            let minDistance = Infinity;

            boxes.forEach((box, index) => {
                const boxCenter = box.offsetLeft + (box.offsetWidth / 2);
                const distance = Math.abs(boxCenter - containerCenter);

                if (distance < minDistance) {
                    minDistance = distance;
                    closestBox = box;
                    currentIndex = index;
                }
            });

            // Snap to the closest box
            if (closestBox) {
                container.scrollTo({
                    left: closestBox.offsetLeft - container.offsetLeft,
                    behavior: 'smooth'
                });
            }

            // Restart auto-scroll after a delay
            setTimeout(startAutoScroll, 7000);
        }

        // Mouse events
        container.addEventListener('mousedown', handleDragStart);
        container.addEventListener('mousemove', handleDragMove);
        container.addEventListener('mouseup', handleDragEnd);
        container.addEventListener('mouseleave', handleDragEnd);

        // Touch events
        container.addEventListener('touchstart', handleDragStart);
        container.addEventListener('touchmove', handleDragMove);
        container.addEventListener('touchend', handleDragEnd);

        // Start auto-scroll on mobile
        if (window.innerWidth <= 768) {
            startAutoScroll();
        }

        // Handle window resize
        window.addEventListener('resize', function () {
            if (window.innerWidth <= 768) {
                if (!autoScrollInterval) {
                    startAutoScroll();
                }
            } else {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
                container.scrollLeft = 0;
                currentIndex = 0;
            }
        });
    });

</script>

<!-- Agenda scripts -->

<script>
function toggleCard(clickedCard) {
    if (clickedCard.classList.contains('active')) {
        clickedCard.classList.remove('active');
    } else {
        document.querySelectorAll('.card').forEach(card => card.classList.remove('active'));
        clickedCard.classList.add('active');
    }
}
</script>


<!-- End of Agenda scripts -->

<?php 
    include('includes/footer.php'); 
?>
