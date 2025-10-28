
<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

<style>
  

  .navbar-nav{
    margin-left: 150px;
  }

  @media (min-width: 1000px){
    .navbar-nav{
      margin-left: 350px;
    }
  }

  @media (max-width: 600px){
    .main-banner .left-content h1,
    #con{
      font-size: 50px;
      font-weight: 700;
      position: relative;
      left: 20px;
      text-transform: uppercase;
    }
  }



  .border-first-buttonn a {
  display: inline-block !important;
  padding: 10px 20px !important;
  color: black;
  border: 1px solid #12037f !important;
  border-radius: 23px;
  font-weight: 600 !important;
  letter-spacing: 0.3px !important;
  transition: all .5s;
}

.border-first-buttonn a:hover {
  background-color: #0d6efd;
  color: #fff !important;
}






  
 /* Slide section styles */
.slide-section {
  position: relative;
  width: 100%;
  height: 100vh; /* Full viewport height */
  overflow: hidden;
  display: flex; /* Enable flexbox */
  align-items: center; /* Center vertically */
  justify-content: center; /* Center horizontally */
}

.slide {
  position: absolute;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  transition: opacity 1s ease-in-out;
  opacity: 0; /* Start as hidden */
}

.slide.active {
  opacity: 1;
}

.slide.inactive {
  opacity: 0;
}



/* Arrow buttons styles */
.arrow {
  position: absolute;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 50%; /* Make the arrow button circular */
  height: 40px;
  width: 40px;
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  font-size: 2rem;
  z-index: 1000;
  display: flex; /* Enable flexbox */
  align-items: center; /* Center icon vertically */
  justify-content: center; /* Center icon horizontally */
}


.left-arrow {
  left: 10px;
}

.right-arrow {
  right: 10px;
}

.custom-width {
    max-width: 90%;
    margin: 0 auto;
  }
/*
  .count-box{
  
    background-color: #f3f6ff;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 100%;
    padding: 10px 0px;
    text-align: center;
    position: relative;
    z-index: 2;
  
  
  }
  
  .count-box .section-heading {
    margin-bottom: 60px;
  }
  
  .count-box .section-heading h6,
  .count-box .section-heading h4 {
    color: #fff;
  }
  
  .count-box .section-heading .line-dec {
    margin: 0 auto;
    background-color: #fff;
  }



  .counter1 {

    height: 250px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s;
  }
  
  .counter1:hover {
    transform: translateY(-10px);
  }
  
  .counter1 i {
    color: #007bff;
    margin-bottom: 20px;
  }
  
  
  .counter1 p {
    font-size: 1.2rem;
    color: #000000;
  }
  .counter1 img {
    max-width: 20%;
    height: auto;
    margin-bottom: 10px;
  }

  .counter1 .count {
    font-weight: 600;

    margin: 10px 0;
  }


 
 

    @media (max-width: 500px) {
  .row {
    display: flex;
    flex-wrap: wrap;
  }
  .col-6 {
    flex: 0 0 50%;
    max-width: 50%;
  }
}

*/

.counter-wrapper{
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-column-gap: 1.5rem;
    padding: 30px;
    position: relative;
}
.counter-wrapper::before{
    position: absolute;
    content: '';
    content: 0;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #f3f6ff;
    z-index: 1;
}
.counterr{
   text-align: center;   
   z-index: 2;
   position: relative;
}
.counterr::before{
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

.counterr p{
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
            font-size: 40px; /* Adjust this value as needed */
            font-weight: 700;
        }




@media (max-width: 768px) {
   .counter-wrapper{
       grid-template-columns: repeat(2, 1fr);
       grid-row-gap: 8rem;
   }
}
@media (max-width: 550px) {
    .counter-wrapper{
      grid-template-columns: repeat(2, 1fr);
      grid-row-gap: 3rem;
        
    }
    .small-number {
            font-size: 20px; /* Adjust this value as needed */
            font-weight: 700;
        }

        .counterr p{
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
}
.counterr img {
    max-width: 25%;
    height: auto;

  }



}



  
  


.event-image img{
  border-radius: 3px;
}

 

 

 

  .event-video {
        display: flex;
        justify-content: center;
    }
    .video-container {
            position: relative;
            width: 100%;
            margin: 0 auto; /* Center horizontally */
        }
        .video-container iframe {
            width: 100%;
            height: 395px; /* Default height */
        }
        .cover-photo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/bg3.jpeg'); /* Replace with your cover photo */
            background-size: cover;
            background-position: center;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1; /* Ensure the cover photo is above the iframe */
        }
        .cover-photo:after {
            content: '';
            display: block;
            width: 100px;
            height: 100px;
            background: url('http://clipart-library.com/images/6Tp5aga7c.png') no-repeat center center;
            background-size: contain;
        }

        /* Mobile Styles */
        @media (max-width: 600px) {
            .video-container {
                width: 100%; /* Full width on mobile */
            }
            .video-container iframe {
                height: 200px; /* Adjust height for mobile */
            }
            .cover-photo {
                background-size: contain; /* Adjust the background size to fit the mobile view */
            }
            .cover-photo:after {
                width: 90px; /* Adjust size of play button for mobile */
                height: 90px;
            }
        }


  
/* Mobile styles */
@media (max-width: 600px) {
  .slide-section {
    height: 35vh; /* Half viewport height for mobile */
  }

  .arrow {
  position: absolute;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 50%; /* Make the arrow button circular */
  height: 30px;
  width: 30px;
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
  font-size: 2rem;
  z-index: 1000;
  display: flex; /* Enable flexbox */
  align-items: center; /* Center icon vertically */
  justify-content: center; /* Center icon horizontally */
}


}

</style>

<!-- Slide Section -->
<div class="slide-section">
  
  <div class="slide active" style="background-image: url('assets/images/HRF2025_BG_1.jpg');"></div>
  <div class="slide inactive" style="background-image: url('assets/images/2U2A5022-min.jpg');"></div>
  <div class="slide inactive" style="background-image: url('assets/images/1K8A4389-min.JPG');"></div>
  
  


  <button class="arrow left-arrow">&lt;</button>
  <button class="arrow right-arrow">&gt;</button>
</div>


<!-- Main Banner Section -->
<div class="main-banner wow fadeIn pb-1" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                            <div class="row">
                                <div class="col-lg-12" data-aos="fade-right">
                                    <h1 class="text-primary">Connect.</h1>
                                    <h1 id="con" class="text-black">Inspire.</h1>
                                    <h1 style="color: #fa65b1;">Grow.</h1>
                                    <p class="text-black">Elevate Human Potential, Community-Driven People Success.</p>
                                </div>
                                <div class="col-lg-12" data-aos="fade-right">
                                  <div class="border-first-buttonn scroll-to-section">
                                      <a href="join.php">Join the Community</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up-left">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="assets/images/dribbble_shot_hd.png" alt="">
                        </div>
                    </div>
      
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Events Section -->
<!--<div class="section-heading mt-3 pt-3">-->
<!--  <h3 class="text-center mt-2 mb-3" style="color: #12037f;">Upcoming Events</h3>-->
<!--</div>-->
<!--<div id="upcoming-events" class="upcoming-events" style="background-color: #f3f6ff; background-size: cover; background-position: center; padding: 50px 0;overflow: hidden;">-->

<!--    <div class="row justify-content-center">-->
      

   
<!--     <div class="col-md-6 col-lg-5 custom-width bg-white shadow-sm mb-4" data-aos="zoom-in"> -->
<!--        <div class="row white1 rounded">-->
<!--          <div class="col-md-6 d-flex">-->
<!--            <div class="event-image w-100 py-3"> -->
<!--              <img src="assets/images/idea_bg.jpeg" alt="Upcoming Event " class="img-fluid w-100 h-100 object-fit-cover rounded-start">-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-md-6 d-flex align-items-center" data-aos="zoom-in">-->
<!--            <div class="event-content">-->
<!--              <div class="card-body d-flex flex-column">-->
<!--                <h6 class="card-title"><b>HR Conference 2025</b></h6>-->
<!--                <p class="card-text mb-2 mt-auto">-->
<!--                  <i class="fas fa-calendar-alt me-2"></i>  February 22, 2025 - 9:30 AM -->
<!--                </p>-->
<!--                <p class="card-text mb-2">-->
<!--                  <i class="fas fa-map-marker-alt me-2"></i> Hotel Grand Mercure, Bengaluru.-->
<!--                </p>-->
<!--                <div class="mt-auto">-->
<!--                  <div class="row">-->
<!--                    <div class="col-auto">-->
<!--                      <a href="hrconference2025details.php" class="btn btn-primary mb-3">Know More</a>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

<!--    </div>-->
 
<!--</div>-->



<div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 pb-3">
                <div class="video-container">
                    <iframe id="video" src="https://www.youtube.com/embed/WzWkXmUJGYU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="cover-photo" onclick="playVideo()"></div>
                </div>
            </div>
        </div>
    </div>
    

<!-- About Section -->
<div id="about" class="about section">
  <div class="container mb-4">
    <div class="col-md-12">
      <div class="about-right-content">
        <div class="section-heading mt-3 pt-3">
          <h3 class="text-center mt-2 mb-3" style="color: #12037f;">Who We are</h3>
        </div>
        <p class="text-black">Vanakkam HRD is a community of HR professionals and business leaders (and growing) who come together to learn from each other and discuss/ share talent and business-related matters. Vanakkam HRD is a community aimed at bringing together the best minds from the technology space to discuss and share about and Branding from Local to Global.</p>
        <p class="text-black">Our objective is to connect HR professionals across the world to make them better professionals every day. This platform shares ideas through social media and brings people together who have an interest in talent management, people management, and organisational development practices. From students to professionals to marketers and business owners, Vanakkam HRD is a community launched to learn, nurture & network for minds.</p>
      </div>
    </div>
  </div>
</div>

<!-- Counter Section -->


                    <div class="counter-wrapper">
        <div class="counterr">
            <img src="assets/images/community members.png" class="mb-2">
            <h1 class="count small-number" data-target="4000">0</h1>
            <p>Community Members</p>
        </div>
        <div class="counterr">
            <img src="assets/images/overall engagement.png" class="mb-2">
            <h1 class="count small-number" data-target="50">0</h1>
            <p>Overall Engagements</p>
        </div>
        <div class="counterr">
            <img src="assets/images/partners.png" class="mb-2">
            <h1 class="count small-number" data-target="30">0</h1>
            <p>Partners</p>
        </div>
        <div class="counterr">
            <img src="assets/images/volunteer.png" class="mb-2">
            <h1 class="count small-number" data-target="300">0</h1>
            <p>Volunteers</p>
        </div>
    </div>


    







<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="assets/js/main.js"></script>

<script>
  AOS.init();
</script>

<?php include('includes/footer.php'); ?>