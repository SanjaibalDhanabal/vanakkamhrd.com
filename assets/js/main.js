 //header background image 
 
 // JavaScript for slide transitions
 let currentSlide = 0;
 const slides = document.querySelectorAll('.slide');
 const totalSlides = slides.length;
 
 function showSlide(index) {
   slides[currentSlide].classList.remove('active');
   slides[currentSlide].classList.add('inactive');
   
   currentSlide = (index + totalSlides) % totalSlides;
   
   slides[currentSlide].classList.remove('inactive');
   slides[currentSlide].classList.add('active');
 }
 
 function showNextSlide() {
   showSlide(currentSlide + 1);
 }
 
 function showPreviousSlide() {
   showSlide(currentSlide - 1);
 }
 
 // Change slide every 3 seconds
 setInterval(showNextSlide, 3000);
 
 // Add event listeners to arrows
 document.querySelector('.right-arrow').addEventListener('click', showNextSlide);
 document.querySelector('.left-arrow').addEventListener('click', showPreviousSlide);

 












// Function to start counter animation
function startCounterAnimation(counter) {
    const target = Number(counter.getAttribute('data-target'));
    const duration = 500; // Duration in milliseconds
    const frameDuration = 50; // Time between frames in milliseconds
    const totalFrames = duration / frameDuration;
    const increment = Math.ceil(target / totalFrames); // Calculate increment value

    function update(frame) {
        const count = Number(counter.innerText.replace('+', '')); // Remove "+" for calculation
        const newCount = Math.min(count + increment, target); // Ensure count does not exceed target
        counter.innerText = (newCount < 10 ? '0' + newCount : newCount) + '+'; // Ensure two digits for single digits and append "+"

        if (newCount < target) {
            setTimeout(() => update(frame + 1), frameDuration); // Recursive call with frame duration
        } else {
            counter.innerText = target + '+'; // Ensure the final value has the "+"
        }
    }

    // Initialize counter
    counter.innerText = '00+';
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






//youtube video animation

function playVideo() {
    document.querySelector('.cover-photo').style.display = 'none';
    document.querySelector('#video').src += '?autoplay=1';
}