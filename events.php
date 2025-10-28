<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap');
    /* @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'); */

    html {
        scroll-behavior: smooth;
        }
    body {
        overflow-x: hidden;
        background: #fafbfc;
        font-family: 'Poppins', sans-serif;
    }

/* --- HERO BANNER FIXES --- */
.eventup-hero {
    position: relative;
    min-height: 530px;
    background: transparent;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    justify-content: flex-start;
    padding: 0;
}
.eventup-hero-bg {
    background: url('assets/images/2U2A9450.jpg') center center/cover no-repeat;
    min-height: 530px;
    width: 100%;
    position: absolute;
    inset: 0;
    z-index: 0;
}
.eventup-hero-bg::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(18,3,127,0.75) 0%, rgba(0,0,0,0.65) 100%);
    z-index: 1;
}
.eventup-hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    color: #fff;
    padding: 110px 10px 0 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 420px;
}
.eventup-hero-icon img {
    width: 260px;
    height: auto;
    margin: -50px auto 18px auto;
    filter: brightness(0) invert(1);
}
.eventup-hero-edition {
    font-size: 1.2rem;
    font-weight: 700;
    color: #fff;
    opacity: 0.95;
    margin-bottom: 3px;
    text-align: left;
    width: 100%;
    max-width: 900px;
    margin-left: 270px;
}
.eventup-hero-title {
    font-size: 3.2rem;
    font-weight: 800;
    letter-spacing: 1px;
    margin-bottom: 10px;
    text-transform: none;
    font-family: 'Dosis', sans-serif;
    line-height: 1.1;
}
.eventup-hero-date,
.eventup-hero-location {
    font-size: 1.6rem;
    font-weight: 500;
    margin-bottom: 2px;
    color: #fff;
    opacity: 0.95;
}
.eventup-hero-location {
    margin-bottom: 28px;
}
.eventup-hero-btn {
    background: #ffb300;
    color: #fff;
    font-size: 1.2rem;
    font-weight: 700;
    padding: 14px 38px;
    border-radius: 32px;
    margin-top: 0px;
    text-decoration: none;
    box-shadow: 0 4px 24px rgba(255,179,0,0.13);
    transition: background 0.2s, transform 0.2s;
    display: inline-block;
    border: none;
}
.eventup-hero-btn:hover {
    background: #12037f;
    color: #fff;
    transform: translateY(-2px);
}

/* --- COUNTDOWN SECTION (OVERLAPPING HERO, NO BLACK BG, PROPER ALIGNMENT) --- */
.eventup-countdown-section {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    position: relative;
    z-index: 10;
    margin-top: -90px; /* Overlap the hero section more */
    pointer-events: none;
}
.eventup-countdown-bar {
    position: relative;
    background: #fff;
    border-radius: 28px;
    box-shadow: 0 8px 32px rgba(18,3,127,0.10);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 38px 18px 28px 18px;
    min-width: 900px;
    max-width: 1040px;
    z-index: 20;
    gap: 0;
    margin: 0 auto;
    top: 0;
    left: 0;
    right: 0;
    pointer-events: auto;
    background-image: repeating-linear-gradient(
        120deg,
        #f6f7fb 0px,
        #f6f7fb 8px,
        #fff 8px,
        #fff 32px
    );
}
.eventup-countdown-box {
    text-align: center;
    min-width: 170px;
    margin: 0 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.eventup-countdown-progress {
    position: relative;
    width: 90px;
    height: 90px;
    margin: 0 auto 8px auto;
    background: none;
}
.eventup-countdown-progress svg {
    width: 90px;
    height: 90px;
    transform: rotate(-90deg);
    background: none;
}
.eventup-countdown-bg {
    stroke: #e5e7eb;
    stroke-width: 8;
    fill: none;
}
.eventup-countdown-fg {
    stroke-width: 8;
    stroke-linecap: round;
    transition: stroke-dasharray 0.5s;
    fill: none;
}
.fg-days {
    stroke: #1a2a80; /* darkest blue */
}
.fg-hours {
    stroke: #3b38a0; /* medium dark blue */
}
.fg-minutes {
    stroke: #7a85c1; /* lighter blue */
}
.fg-seconds {
    stroke: #b2b0e8; /* medium light blue */
}
.eventup-countdown-num {
    font-size: 2.4rem;
    font-weight: 800;
    color: #1a237e;
    line-height: 1;
    font-family: 'Dosis', sans-serif;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -55%);
    width: 100%;
    text-align: center;
    background: none;
}
.eventup-countdown-label {
    font-size: 1.25rem;
    color: #222;
    font-weight: 800;
    margin-top: 8px;
    letter-spacing: 1px;
    font-family: 'Dosis', sans-serif;
    background: none;
}
.eventup-countdown-sep {
    display: none;
}

/* Responsive for mobile */
@media (max-width: 900px) {
  .eventup-hero {
    width: 100vw !important;
    min-width: 100vw !important;
    max-width: 100vw !important;
    position: relative !important;
    left: 0 !important;
    transform: none !important;
    margin: 0 !important;
    padding: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: flex-start !important;
    min-height: 520px !important;
    height: auto !important;
    overflow: visible !important;
  }
  .eventup-hero-bg {
    width: 100vw !important;
    min-width: 100vw !important;
    left: 0 !important;
    transform: none !important;
    position: absolute !important;
    inset: 0 !important;
    min-height: 520px !important;
    height: 100% !important;
    z-index: 0 !important;
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat !important;
  }
  .eventup-hero-content {
    max-width: 100vw !important;
    width: 100vw !important;
    margin: 0 auto !important;
    padding: 60px 8px 0 8px !important;
    text-align: center !important;
    align-items: center !important;
    justify-content: center !important;
    display: flex !important;
    flex-direction: column !important;
    position: relative !important;
    z-index: 2 !important;
    min-height: 270px !important;
  }
  .eventup-hero-icon img {
    width: 180px !important;
    margin: -30px auto 12px auto !important;
  }
  .eventup-hero-edition {
    font-size: 1rem !important;
    margin-bottom: 2px !important;
    text-align: center !important;
    margin-left: 0 !important;
    max-width: 100vw !important;
    width: 100vw !important;
  }
  .eventup-hero-title {
    font-size: 2rem !important;
    margin-bottom: 8px !important;
    line-height: 1.15 !important;
    font-weight: 700 !important;
  }
  .eventup-hero-date,
  .eventup-hero-location {
    font-size: 1.1rem !important;
    margin-bottom: 2px !important;
    font-weight: 500 !important;
  }
  .eventup-hero-location {
    margin-bottom: 18px !important;
  }
  .eventup-hero-btn {
    font-size: 1.1rem !important;
    padding: 12px 32px !important;
    border-radius: 24px !important;
    margin-top: 18px !important;
    box-shadow: 0 2px 12px rgba(255,179,0,0.13) !important;
    background: #ffb300 !important;
    color: #fff !important;
    font-weight: 700 !important;
    border: none !important;
    display: inline-block !important;
    text-align: center !important;
  }

  /* COUNTDOWN BAR MOBILE FIX */
   .eventup-countdown-bar {
    min-width: 92vw !important;
    max-width: 98vw !important;
    padding: 18px 4px 18px 4px !important;
    border-radius: 18px !important;
    /* margin: 0 auto !important; */
    margin-top: -35px !important;
    box-shadow: 0 4px 16px rgba(18,3,127,0.10) !important;
    background: rgba(255,255,255,0.92) !important;
    border: 1px solid #e5e7eb !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.5rem !important;
  }
  .eventup-countdown-box {
    min-width: 70px !important;
    max-width: 80px !important;
    margin: 0 2px !important;
    text-align: center !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
  }
  .eventup-countdown-progress {
    width: 54px !important;
    height: 54px !important;
    margin: 0 auto 4px auto !important;
    background: none !important;
    position: relative !important;
    display: block !important;
  }
  .eventup-countdown-progress svg {
    width: 54px !important;
    height: 54px !important;
    background: none !important;
    display: block !important;
    margin: 0 !important;
    position: relative !important;
    transform: none !important; /* No rotation on mobile */
  }
  .eventup-countdown-num {
    font-size: 1.3rem !important;
    font-weight: 900 !important;
    color: #12037f !important;
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    width: 54px !important;
    height: 54px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    transform: translate(-50%, -50%) !important;
    pointer-events: none !important;
    background: none !important;
    z-index: 2 !important;
    margin: 0 !important;
    padding: 0 !important;
  }
  .eventup-countdown-label {
    font-size: 0.95rem !important;
    margin-top: 2px !important;
    color: #222 !important;
    font-weight: 700 !important;
    text-align: center !important;
    width: 100% !important;
  }
  .eventup-countdown-sep {
    display: none !important;
  }
  .coming-soon-highlight {
    margin: 30px auto 18px auto !important;
    text-align: center !important;
  }
  .coming-soon-highlight span {
    font-size: 1.1rem !important;
    padding: 0 6px !important;
  }
}

@media (max-width: 600px) {
  .eventup-countdown-progress svg {
    display: none !important;
  }
}

/* Event Highlights Section Styles */
.eventup-stats-section {
  width: 100%;
  background: #fff;
  padding: 38px 0 18px 0;
}

.eventup-stats-title {
  text-align: center;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  font-weight: 800;
  font-size: 2rem;
  margin-bottom: 32px;
}

.eventup-stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px 32px;
  max-width: 950px;
  margin: 0 auto;
}

.eventup-stat-card {
  background: #f1f4fe;
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(18,3,127,0.08);
  padding: 38px 0 28px 0;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 120px;
  transition: box-shadow 0.2s;
}

.eventup-stat-count-card {
  font-size: 2.3rem;
  font-weight: 800;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  margin-bottom: 8px;
  letter-spacing: 1px;
  transition: color 0.2s, font-size 0.2s;
}

.eventup-stat-card:hover {
  box-shadow: 0 8px 32px rgba(18,3,127,0.13);
}

.eventup-stat-number {
  font-size: 2.3rem;
  font-weight: 800;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  margin-bottom: 8px;
  letter-spacing: 1px;
}

.eventup-stat-label {
  font-size: 1.15rem;
  color: #222;
  font-family: 'Dosis', sans-serif;
  font-weight: 500;
  letter-spacing: 0.5px;
}

/* Responsive */
@media (max-width: 900px) {
  .eventup-stats-title { font-size: 1.3rem; }
  .eventup-stats-grid { grid-template-columns: repeat(2, 1fr); gap: 22px 16px; }
  .eventup-stat-card { padding: 24px 0 18px 0; min-height: 90px; }
  .eventup-stat-number { font-size: 1.5rem; }
  .eventup-stat-label { font-size: 1rem; }
}
@media (max-width: 600px) {
  .eventup-stats-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 columns per row */
    gap: 14px 8px;
  }
  .eventup-stats-section {
    padding: 18px 0 8px 0;
  }
  .eventup-stat-card {
    border-radius: 10px;
  }
}

/* About the Event Section */

.about-event-gradient-bg {
  width: 100vw;
  position: relative;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
  background: linear-gradient(135deg, #f1f4ff 0%, #ffffff 100%);
  padding: 48px 0 32px 0;
  z-index: 1;
}
.about-event-section.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 24px;
}
.about-event-title {
  font-size: 2.3rem;
  font-weight: 800;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  margin-bottom: 18px;
}
.about-event-desc {
  font-size: 1.15rem;
  color: #222;
  margin-bottom: 18px;
}
.about-event-list-bullets {
  margin-left: 0;
  padding-left: 22px;
  list-style-type: disc;
  margin-bottom: 0;
}
.about-event-list-bullets li {
  font-size: 1.08rem;
  margin-bottom: 10px;
  color: #222;
  font-family: 'Dosis', sans-serif;
  line-height: 1.7;
}
.about-event-img {
  /* border-radius: 18px; */
  box-shadow: 0 4px 24px rgba(18,3,127,0.10);
  max-width: 100%;
  margin-top: 12px;
  margin-bottom: 12px;
}
@media (max-width: 900px) {
  .about-event-section.container {
    padding: 0 8px;
  }
  .about-event-title { font-size: 1.5rem; }
  .about-event-desc { font-size: 1rem; }
  .about-event-list-bullets li { font-size: 0.98rem; }
  .about-event-gradient-bg { padding: 24px 0 18px 0; }
}
@media (max-width: 600px) {
  .about-event-section.container {
    padding: 0 2px;
  }
  .about-event-title { font-size: 1.2rem; }
  .about-event-img { border-radius: 10px; }
  .about-event-gradient-bg { padding: 12px 0 8px 0; }
}

/* Event Themes Section */

/* Event Themes Section Styles */
.event-themes-bg {
  width: 100vw;
  position: relative;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
  background: #fff;
  padding: 48px 0 32px 0;
  z-index: 1;
}
.event-themes-section {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 24px;
}
.event-themes-title {
  text-align: center;
  color: #2d2d7f;
  font-family: 'Dosis', sans-serif;
  font-weight: 800;
  margin-bottom: 32px;
  font-size: 2.1rem;
}
.event-themes-row {
  gap: 32px;
}
.event-theme-card {
  background: #f7f8fa;
  border-radius: 18px;
  box-shadow: 0 8px 32px rgba(18,3,127,0.14), 0 2px 12px rgba(18,3,127,0.08);
  padding: 32px 24px;
  max-width: 370px;
  width: 100%;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: box-shadow 0.3s;
}
.event-theme-card:hover {
  box-shadow: 0 16px 48px rgba(18,3,127,0.18), 0 4px 24px rgba(18,3,127,0.12);
}
.event-theme-icon {
  width: 72px;
  height: 72px;
  margin-bottom: 18px;
}
.event-theme-heading {
  font-size: 1.18rem;
  font-weight: 700;
  color: #12037f;
  margin-bottom: 12px;
  font-family: 'Dosis', sans-serif;
}
.event-theme-list {
  text-align: left;
  padding-left: 0;
  list-style: none;
  font-size: 1rem;
  color: #222;
  margin-bottom: 0;
}

.event-theme-list li {
  margin-bottom: 8px;
  font-family: 'Dosis', sans-serif;
  position: relative;
  padding-left: 22px; /* Space for bullet */
  text-indent: -12px; /* Pull first line back to bullet */
}

/* Optional: If you want to use a custom bullet */
/* .event-theme-list li::before {
  content: "•";
  position: absolute;
  left: 0;
  color: #12037f;
  font-weight: bold;
  font-size: 1.2em;
  top: 0;
} */

/* Responsive */
@media (max-width: 900px) {
  .event-themes-section { padding: 0 8px; }
  .event-themes-title { font-size: 1.5rem; }
  .event-theme-card { padding: 18px 10px; }
  .event-theme-icon { width: 54px; height: 54px; }
  .event-theme-heading { font-size: 1rem; }
  .event-theme-list { font-size: 0.98rem; }
  .event-themes-bg { padding: 24px 0 18px 0; }
}
@media (max-width: 600px) {
  .event-themes-section { padding: 0 2px; }
  .event-theme-card { border-radius: 10px; }
  .event-theme-icon { width: 44px; height: 44px; }
  .event-themes-bg { padding: 12px 0 8px 0; }
}
@media (max-width: 600px) {
  .why-attend-section {
    text-align: center !important;
  }
  .why-attend-title,
  .why-attend-desc,
  .why-attend-list,
  .why-attend-inline {
    text-align: center !important;
    justify-content: center !important;
    align-items: center !important;
  }
}

/* Why Attend Section Styles - Updated for No Card BG, Icon+Title Inline, Left Illustration */

.why-attend-gradient-bg {
  width: 100vw;
  position: relative;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
  background: linear-gradient(135deg, #f1f4ff 0%, #ffffff 100%);
  padding: 48px 0 32px 0;
  z-index: 1;
}

.why-attend-section {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 24px;
}

.why-attend-title {
  font-size: 2.3rem;
  font-weight: 800;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  margin-bottom: 18px;
  text-align: left;
}

.why-attend-desc {
  font-size: 1.15rem;
  color: #222;
  margin-bottom: 28px;
  text-align: left;
}

.why-attend-illustration {
  max-width: 100%;
  width: 380px;
  margin: 0 auto 18px auto;
  display: block;
}

.why-attend-inline {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 6px;
}

.why-attend-icon-inline {
  width: 38px;
  height: 38px;
  display: inline-block;
}

.why-attend-heading-inline {
  font-size: 1.08rem;
  font-weight: 700;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  display: inline-block;
}

.why-attend-list {
  padding-left: 18px;
  margin-bottom: 0;
  font-size: 1rem;
  color: #222;
  font-family: 'Dosis', sans-serif;
}

.why-attend-list li {
  margin-bottom: 7px;
  line-height: 1.6;
}

/* Responsive */
@media (max-width: 900px) {
  .why-attend-section { padding: 0 8px; }
  .why-attend-title { font-size: 1.5rem; }
  .why-attend-desc { font-size: 1rem; }
  .why-attend-illustration { width: 220px; }
  .why-attend-heading-inline { font-size: 1rem; }
  .why-attend-icon-inline { width: 28px; height: 28px; }
}

@media (max-width: 600px) {
  .why-attend-section {
    text-align: center !important;
  }
  .why-attend-title,
  .why-attend-desc {
    text-align: center !important;
  }
  .why-attend-list,
  .why-attend-list li {
    text-align: left !important;
    margin-left: 0 !important;
    padding-left: 18px !important;
    list-style-position: outside !important;
  }
  .why-attend-inline,
  .why-attend-heading-inline {
    justify-content: flex-start !important;
    align-items: center !important;
    text-align: left !important;
    margin-left: 0 !important;
    width: 100%;
    display: flex !important;
  }
}

/* Agenda section */

.event-agenda-section {
  background: #fff;
  padding: 48px 0 32px 0;
  width: 100vw;
  position: relative;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
  z-index: 1;
}
.event-agenda-title {
  text-align: center;
  font-family: 'Dosis', sans-serif;
  font-weight: 800;
  font-size: 2.3rem;
  margin-bottom: 32px;
  color: #12037f;
}
.event-agenda-table {
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  border-collapse: separate;
  border-spacing: 18px 12px;
}
.event-agenda-row {
  display: flex;
  gap: 18px;
  margin-bottom: 12px;
}
.event-agenda-cell {
  background: #f7f8fa;
  border-radius: 16px;
  box-shadow: 0 2px 12px rgba(18,3,127,0.08);
  padding: 22px 12px;
  text-align: center;
  font-family: 'Dosis', sans-serif;
  font-size: 1.18rem;
  font-weight: 600;
  color: #222;
  flex: 1;
  min-width: 120px;
  min-height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.event-agenda-header-row {
  display: flex;
  gap: 18px;
  margin-bottom: 18px;
}
.event-agenda-header-cell {
  background: #12037f;
  color: #fff;
  font-size: 1.3rem;
  font-weight: 700;
  border-radius: 12px;
  padding: 18px 0;
  flex: 1;
  text-align: center;
  font-family: 'Dosis', sans-serif;
}
.event-agenda-highlight {
  background: linear-gradient(90deg, #7a85c1 0%, #b2b0e8 100%);
  color: #fff;
  font-size: 1.3rem;
  font-weight: 700;
  border-radius: 12px;
  padding: 18px 0;
  flex: 1;
  text-align: center;
  font-family: 'Dosis', sans-serif;
}
@media (max-width: 900px) {
  .event-agenda-title { font-size: 1.5rem; }
  .event-agenda-table { max-width: 98vw; }
  .event-agenda-row, .event-agenda-header-row { gap: 8px; }
  .event-agenda-cell, .event-agenda-header-cell, .event-agenda-highlight { font-size: 1rem; padding: 12px 4px; min-width: 70px; }
}
@media (max-width: 600px) {
  .event-agenda-table { border-spacing: 6px 6px; }
  .event-agenda-row, .event-agenda-header-row { flex-direction: column; gap: 6px; }
  .event-agenda-cell, .event-agenda-header-cell, .event-agenda-highlight { font-size: 0.98rem; padding: 10px 2px; min-width: 60px; }
}

/* Buy Tickets Section Styles */

.ticket-card {
  background: #f7f8fa;
  border-radius: 18px;
  box-shadow: 0 8px 32px rgba(18,3,127,0.14);
  padding: 32px 24px;
  max-width: 370px;
  width: 100%;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 15px;
}
.ticket-title {
  font-weight: 700;
  color: #12037f;
  margin-bottom: 12px;
  font-size: 1.5rem;
  font-family: 'Dosis', sans-serif;
}
.ticket-date {
  color: #222;
  margin-bottom: 8px;
  font-size: 1rem;
}
.ticket-price {
  font-size: 2.2rem;
  font-weight: 800;
  color: #12037f;
  margin-bottom: 18px;
  font-family: 'Dosis', sans-serif;
}
.ticket-list {
  list-style: none;
  padding: 0;
  text-align: left;
  color: #222;
  margin-bottom: 18px;
  font-size: 0.85rem;
}
.ticket-list li {
  margin-bottom: 8px;
  position: relative;
  padding-left: 22px;
}
.ticket-list li::before {
  content: "✔";
  position: absolute;
  left: 0;
  color: #22c55e;
  font-weight: bold;
  font-size: 1.1em;
  top: 0;
}
.ticket-btn {
  background: #12037f;
  color: #fff;
  font-weight: 700;
  border-radius: 24px;
  padding: 12px 38px;
  text-decoration: none;
  font-size: 1.08rem;
  margin-top: 8px;
  box-shadow: 0 4px 16px rgba(18,3,127,0.10);
  transition: background 0.2s, transform 0.2s;
  display: inline-block;
  border: none;
}
.ticket-btn:hover {
  background: #ffb300;
  color: #fff;
  transform: translateY(-2px);
}
@media (max-width: 900px) {
  .ticket-card { padding: 18px 10px; }
  .ticket-title { font-size: 1.2rem; }
  .ticket-price { font-size: 1.5rem; }
  .ticket-btn { padding: 10px 24px; font-size: 1rem; }
}
@media (max-width: 600px) {
  .ticket-card { border-radius: 10px; }
}

/* Sponsors style */

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
        height : 50px;
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

/* Venue Section Styles - Updated for your requirements */
.venue-gradient-bg {
  width: 100vw;
  position: relative;
  left: 50%;
  right: 50%;
  margin-left: -50vw;
  margin-right: -50vw;
  background: linear-gradient(135deg, #f1f4ff 0%, #ffffff 100%);
  padding: 32px 0 32px 0; /* Reduced top margin */
  z-index: 1;
  overflow: hidden;
}
.venue-bg-img {
  display: none; /* Remove the venue image background */
}
.venue-section.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 24px;
  position: relative;
  z-index: 1;
}
.venue-title {
  font-size: 2.3rem;
  font-weight: 800;
  color: #12037f;
  font-family: 'Dosis', sans-serif;
  margin-bottom: 18px;
}
.venue-hotel-name {
  font-size: 2rem;
  font-weight: 700;
  color: #222;
  font-family: 'Dosis', sans-serif;
  margin-bottom: 10px;
}
.venue-address {
  font-size: 1.1rem;
  color: #222;
  margin-bottom: 18px;
}
.venue-img {
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(18,3,127,0.10);
  max-width: 100%;
  margin-bottom: 12px;
  background: none !important;
}
.venue-map-wrap {
  max-width: 600px; /* Increased map iframe width for desktop */
  margin-top: 8px;
}
.venue-map,
.venue-map-wrap iframe {
  border-radius: 16px;
  box-shadow: 0 2px 12px rgba(18,3,127,0.08);
  width: 100%;
  border: 0;
  min-height: 300px; /* Increased map height */
}
@media (max-width: 900px) {
  .venue-section.container { padding: 0 8px; }
  .venue-title { font-size: 1.5rem; }
  .venue-hotel-name { font-size: 1.2rem; }
  .venue-gradient-bg { padding: 18px 0 18px 0; }
  .venue-map-wrap { max-width: 98vw; }
  .venue-map,
  .venue-map-wrap iframe { min-height: 220px; }
}
@media (max-width: 600px) {
  .venue-hotel-name,
  .venue-address,
  .venue-map-wrap {
    text-align: center !important;
    margin-left: auto !important;
    margin-right: auto !important;
    display: block !important;
  }
  .venue-map-wrap {
    max-width: 98vw !important;
  }
  .venue-map,
  .venue-map-wrap iframe { min-height: 180px; }
}



</style>

      <section class="eventup-hero">    
            <div class="eventup-hero-bg"></div>
            <div class="eventup-hero-content">
                <div class="eventup-hero-icon">
                    <img src="assets/images/Vanakkam HRD Logo 11.png" data-aos="fade-up" alt="Vanakkam HRD Logo">
                </div>
                <div class="eventup-hero-edition" data-aos="fade-down">(Edition 03)</div>
                <h1 class="eventup-hero-title" data-aos="zoom-in-up">Annual TN HR Summit 2025</h1>
                <div class="eventup-hero-date" data-aos="zoom-in-up">20<sup>th</sup> December, 2025</div>
                <div class="eventup-hero-location" data-aos="zoom-in-up">Hilton Hotel, Chennai</div>
                <a href="#" class="eventup-hero-btn" id="scrollToTicketsBtn" data-aos="flip-up">
                  <i class="fa fa-ticket" style="margin-right:8px;"></i>GET TICKET
                </a>
            </div>
        </section>  

<!-- Countdown Bar: now outside hero, always fully visible -->
<section class="eventup-countdown-section" data-aos="fade-up" data-aos-duration="2000">
    <div class="eventup-countdown-bar" id="eventup-countdown-bar">
        <div class="eventup-countdown-box">
            <div class="eventup-countdown-progress">
                <svg>
                    <circle class="eventup-countdown-bg" cx="45" cy="45" r="38"></circle>
                    <circle class="eventup-countdown-fg fg-days" id="circle-days" cx="45" cy="45" r="38"></circle>
                </svg>
                <div class="eventup-countdown-num" id="eventup-days">00</div>
            </div>
            <div class="eventup-countdown-label">Days</div>
        </div>
        <div class="eventup-countdown-box">
            <div class="eventup-countdown-progress">
                <svg>
                    <circle class="eventup-countdown-bg" cx="45" cy="45" r="38"></circle>
                    <circle class="eventup-countdown-fg fg-hours" id="circle-hours" cx="45" cy="45" r="38"></circle>
                </svg>
                <div class="eventup-countdown-num" id="eventup-hours">00</div>
            </div>
            <div class="eventup-countdown-label">Hours</div>
        </div>
        <div class="eventup-countdown-box">
            <div class="eventup-countdown-progress">
                <svg>
                    <circle class="eventup-countdown-bg" cx="45" cy="45" r="38"></circle>
                    <circle class="eventup-countdown-fg fg-minutes" id="circle-minutes" cx="45" cy="45" r="38"></circle>
                </svg>
                <div class="eventup-countdown-num" id="eventup-minutes">00</div>
            </div>
            <div class="eventup-countdown-label">Minutes</div>
        </div>
        <div class="eventup-countdown-box">
            <div class="eventup-countdown-progress">
                <svg>
                    <circle class="eventup-countdown-bg" cx="45" cy="45" r="38"></circle>
                    <circle class="eventup-countdown-fg fg-seconds" id="circle-seconds" cx="45" cy="45" r="38"></circle>
                </svg>
                <div class="eventup-countdown-num" id="eventup-seconds">00</div>
            </div>
            <div class="eventup-countdown-label">Seconds</div>
        </div>
    </div>
</section>

<!-- Event Highlights Section (Stats) -->
<div class="eventup-stats-section">
  <h2 class="eventup-stats-title">
    Tamil Nadu’s Biggest and Most Valuable Annual TN HR Summit 2025
  </h2>
  <div class="eventup-stats-grid">
    <div class="eventup-stat-card">
      <div class="eventup-stat-count-card" data-count="1">0</div>
      <div class="eventup-stat-label">Day</div>
    </div>
    <div class="eventup-stat-card">
      <div class="eventup-stat-count-card" data-count="5" data-plus>0</div>
      <div class="eventup-stat-label">Session</div>
    </div>
    <div class="eventup-stat-card">
      <div class="eventup-stat-count-card" data-count="3" >0</div>
      <div class="eventup-stat-label">Panel Discussion</div>
    </div>
    <div class="eventup-stat-card">
      <div class="eventup-stat-count-card" data-count="10" data-plus>0</div>
      <div class="eventup-stat-label">Industry Experts</div>
    </div>
    <div class="eventup-stat-card">
      <div class="eventup-stat-count-card" data-count="250">0</div>
      <div class="eventup-stat-label">Attendees</div>
    </div>
    <div class="eventup-stat-card">
      <div class="eventup-stat-number" style="font-size:2.3rem;">&#8734;</div>
      <div class="eventup-stat-label">Value</div>
    </div>
  </div>
</div>

       <!-- About the Event Section (Full-width Gradient BG, Visible Bullets) -->
<div class="about-event-gradient-bg">
  <section class="about-event-section container" >
    <div class="row align-items-center">
      <div class="col-md-7">
        <h2 class="about-event-title" data-aos="fade-up" data-aos-duration="1000">About the Event</h2>
        <p class="about-event-desc" data-aos="fade-up" data-aos-duration="1500">
          Vanakkam HRD Annual TN HR Summit is a flagship conference that brings together inspiring speakers, cutting-edge innovations, and a passionate community of HR professionals. Our mission is to explore, educate, and shape the future of human resources through our dynamic theme: "The Human Edge: Thriving in a Digitally Disrupted World."
        </p>
        <ul class="about-event-list-bullets" data-aos="fade-up" data-aos-duration="2000">
          <li>• Industry-recognized flagship event.</li>
          <li>• Keynotes by renowned industry leaders.</li>
          <li>• Panel discussions and fireside chats.</li>
          <li>• 200+ companies represented</li>
        </ul>
      </div>
      <div class="col-md-5 text-center" data-aos="fade-left" data-aos-duration="2000">
        <img src="assets/images/2U2A9822.JPG" alt="About Event" class="about-event-img img-fluid" />
      </div>
    </div>
  </section>
</div>

<!-- Event Themes Section (Full-width White BG) -->
<div class="event-themes-bg">
  <section class="container event-themes-section">
    <h2 class="event-themes-title" data-aos="fade-up">The Event Themes</h2>
    <div class="row justify-content-center event-themes-row">
      <div class="col-md-5 col-12 mb-4 d-flex justify-content-center">
        <div class="event-theme-card" data-aos="fade-right">
          <img src="assets/images/teamwork.png" alt="Human Edge Icon" class="event-theme-icon">
          <h4 class="event-theme-heading">The Human Edge: Thriving in a Digitally Disrupted World.</h4>
          <ul class="event-theme-list">
            <li>• When machines evolve, it’s humanity that gives organizations their edge.</li>
            <li>• Thrive at the Intersection of Human and Digital.</li>
            <li>• Human-Centric Leadership for a Digital Future</li>
          </ul>
        </div>
      </div>
      <div class="col-md-5 col-12 mb-4 d-flex justify-content-center">
        <div class="event-theme-card" data-aos="fade-left">
          <img src="assets/images/performance.png" alt="Beyond Algorithms Icon" class="event-theme-icon">
          <h4 class="event-theme-heading">Beyond Algorithms: The Future is Human.</h4>
          <ul class="event-theme-list">
            <li>• In a world of codes and data, people remain the true differentiator.</li>
            <li>• Empowering People, Beyond Code</li>
            <li>• The Future is Human-Centered</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Why Attend Section (Illustration on Right) -->
<div class="why-attend-gradient-bg">
  <section class="container why-attend-section">
    <div class="row align-items-center">
      <!-- Left Content -->
      <div class="col-md-7 col-12">
        <h2 class="why-attend-title" data-aos="fade-up">Why Attend?</h2>
        <p class="why-attend-desc" data-aos="fade-up" data-aos-duration="1000">
          Unlock Your Potential: Explore Sponsorship, Network, Learn, and Grow at TN HR Summit.
        </p>
        <div class="row">
          <div class="col-md-6 col-12 mb-3">
            <div class="why-attend-inline" data-aos="fade-right" data-aos-duration="1200">
              <img src="assets/images/connect_icon.png" alt="Connections Icon" class="why-attend-icon-inline">
              <span class="why-attend-heading-inline">Where Connections Matter</span>
            </div>
            <ul class="why-attend-list" data-aos="fade-right" data-aos-duration="1500">
              <li>• Peers from diverse industries</li>
              <li>• Renowned speakers and thought leaders</li>
              <li>• Professionals with shared interests</li>
            </ul>
          </div>
          <div class="col-md-6 col-12 mb-3">
            <div class="why-attend-inline" data-aos="fade-left" data-aos-duration="1200">
              <img src="assets/images/network.png" alt="Network Icon" class="why-attend-icon-inline">
              <span class="why-attend-heading-inline">Network with Purpose</span>
            </div>
            <ul class="why-attend-list" data-aos="fade-left" data-aos-duration="1500">
              <li>• Exchange ideas and best practices</li>
              <li>• Build valuable connections</li>
              <li>• Foster meaningful relationships</li>
            </ul>
          </div>
          <div class="col-md-6 col-12 mb-3">
            <div class="why-attend-inline" data-aos="fade-right" data-aos-duration="1200">
              <img src="assets/images/learn.png" alt="Learn Icon" class="why-attend-icon-inline">
              <span class="why-attend-heading-inline">Learn from the Best</span>
            </div>
            <ul class="why-attend-list" data-aos="fade-right" data-aos-duration="1500">
              <li>• Thought-provoking insights from industry leaders</li>
              <li>• Actionable strategies from real-world successes</li>
              <li>• Hands-on learning experiences to enhance your skills</li>
            </ul>
          </div>
          <div class="col-md-6 col-12 mb-3">
            <div class="why-attend-inline" data-aos="fade-left" data-aos-duration="1200">
              <img src="assets/images/grow.png" alt="Grow Icon" class="why-attend-icon-inline">
              <span class="why-attend-heading-inline">Stay Ahead, Grow Faster</span>
            </div>
            <ul class="why-attend-list" data-aos="fade-left" data-aos-duration="1500">
              <li>• Get the latest industry insights and trends</li>
              <li>• Connect with potential customers and partners</li>
              <li>• Stay ahead of the competition</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Right Illustration Image -->
      <div class="col-md-5 col-12 mb-4 text-center" data-aos="fade-left" data-aos-duration="2000">
        <img src="assets/images/why_attend_img.png" alt="Why Attend Illustration" class="why-attend-illustration img-fluid" />
      </div>
    </div>
  </section>
</div>

<!-- Agenda section -->

<!-- Replace your agenda section with this for perfect merging and alignment -->
<section class="event-agenda-section" data-aos="fade-up">
  <h2 class="event-agenda-title">Event Agenda</h2>
  <div class="event-agenda-table">
    <!-- Header Row -->
    <div class="event-agenda-row event-agenda-header-row">
      <div class="event-agenda-header-cell" style="flex:1;">Time</div>
      <div class="event-agenda-header-cell" style="flex:1;">Topic</div>
      <div class="event-agenda-header-cell" style="flex:1;">Speaker / Panel Discussion</div>
    </div>
    <!-- Registration Row (merged all cells) -->
    <div class="event-agenda-row">
      <div class="event-agenda-highlight" style="flex:3;display:flex;justify-content:center;align-items:center;">
        <span style="width:100%;text-align:center;">9:00 AM &nbsp; | &nbsp; Registration</span>
      </div>
    </div>
    <!-- Welcome Address Row (merged topic/speaker cells) -->
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">9:50 AM</div>
      <div class="event-agenda-cell" style="flex:2;display:flex;justify-content:center;align-items:center;">
        <span style="width:100%;text-align:center;">Welcome Address</span>
      </div>
    </div>
    <!-- Normal Agenda Rows -->
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">10:00 AM</div>
      <div class="event-agenda-cell" style="flex:1;">Keynote Session</div>
      <div class="event-agenda-cell" style="flex:1;">speaker</div>
    </div>
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">10:40 AM</div>
      <div class="event-agenda-cell" style="flex:1;">The Human Edge in Employer Branding & Talent Retention</div>
      <div class="event-agenda-cell" style="flex:1;">Panel Discussion <span style="margin-left:8px;"><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;margin-right:-8px;"></span><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;margin-right:-8px;"></span><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;"></span></span></div>
    </div>
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">12:15 PM</div>
      <div class="event-agenda-cell" style="flex:1;">The Power of Storytelling in HR: Bringing Human-Centric Leadership to Life</div>
      <div class="event-agenda-cell" style="flex:1;">speaker <span style="margin-left:8px;"><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;"></span></span></div>
    </div>
    <!-- Networking Lunch (merged all cells) -->
    <div class="event-agenda-row">
      <div class="event-agenda-highlight" style="flex:3;display:flex;justify-content:center;align-items:center;">
        <span style="width:100%;text-align:center;">1:00 PM &nbsp; | &nbsp; Networking Lunch</span>
      </div>
    </div>
    <!-- Post-lunch Sessions -->
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">2:00 PM</div>
      <div class="event-agenda-cell" style="flex:1;">Human Intelligence vs.Artificial Intelligence - Where HR Creates the Edge</div>
      <div class="event-agenda-cell" style="flex:1;">Panel Discussion <span style="margin-left:8px;"><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;margin-right:-8px;"></span><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;margin-right:-8px;"></span><span style="display:inline-block;width:32px;height:32px;background:#ddd;border-radius:50%;"></span></span></div>
    </div>
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">3:15 PM</div>
      <div class="event-agenda-cell" style="flex:2;display:flex;justify-content:center;align-items:center;">
        <span style="width:100%;text-align:center;">HR Hackathon Winners & Recognition</span>
      </div>
    </div>
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">3:45 PM</div>
      <div class="event-agenda-cell" style="flex:2;display:flex;justify-content:center;align-items:center;">
        <span style="width:100%;text-align:center;">Surprise Session</span>
      </div>
    </div>
    <div class="event-agenda-row">
      <div class="event-agenda-cell" style="flex:1;">4:30 PM</div>
      <div class="event-agenda-cell" style="flex:2;display:flex;justify-content:center;align-items:center;">
        <span style="width:100%;text-align:center;">Vote of Thanks & Networking Tea</span>
      </div>
    </div>
  </div>
</section>
<!-- Buy Tickets Section (Full-width White BG, after Why Attend) -->
<div class="event-themes-bg" id="buyTicketsSection">
  <section class="container">
    <h2 class="event-themes-title" data-aos="fade-up">Get Your Tickets Now</h2>
    <p class="text-center" style="max-width:600px;margin:0 auto 10px;font-size:1.08rem;color:#222;" data-aos="fade-up" data-aos-duration="1000">
      Secure your ticket for an exceptional opportunity to be inspired, connect, and network within the TN HRSummit.
    </p>
    <div class="text-center mb-2" style="font-size:0.98rem;color:#444;margin-bottom: 25px;" data-aos="fade-up" data-aos-duration="1200">
      <strong>Note:</strong> Ticket prices may change at any time.
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6 col-12 mb-4 d-flex justify-content-center">
        <div class="ticket-card" data-aos="flip-left" data-aos-duration="1500">
          <h3 class="ticket-title">EARLY BIRD</h3>
          <div class="ticket-date">Available till : 20<sup>th</sup> November, 2025</div>
          <div class="ticket-price" style="color: #FF4500;">₹1,999</div>
          <ul class="ticket-list">
            <li>1 Day Summit Pass</li>
            <li>Full access to all insightful sessions</li>
            <li>Meaningful Networking over lunch & tea</li>
            <li>Meet Select speakers & Industry Icons</li>
             <li>Conference Kit</li>
            <li>E-Certificate & Badges</li>
          </ul>
          <a href="hr_summit_2025.php" class="ticket-btn">
            <i class="fa fa-ticket" style="margin-right:8px;"></i>BUY TICKET</a>
        </div>
      </div>
    </div>
  </section>
</div>

<section id="sponsors_logo" style="margin-top: 1px; padding: 40px 0; background-color:rgba(228, 230, 250, 0.3);">

             <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Exclusive Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><a href="https://outstandingworkplaces.co" target="blank"><img src="assets/images/Outstanding_Workplaces_TM.jpg" alt="Outstanding_Workplaces_TM.png" loading="lazy" style="width:130px"></a></div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Gifting Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/GR.png" alt="GR.png" loading="lazy" style="width:130px"></div>
                    </div>
            </div>

            <div class="container">
                <div class="sponsors_heading text-center">
                    <h2 data-aos="zoom-in" style="color:rgb(7, 0, 102); font-weight: 800; font-size: 32px;" >Knowledge Partner</h2>
                </div>
                    <div class="sponsors_slider" data-aos="fade-up" data-aos-duration="2000">
                        <div class="sponsor-row">
                            <div class="sponsor-logo"><img src="assets/images/SuVi.jpg" alt="SuVi.jpg" loading="lazy"></div>
                    </div>
            </div>
    </section>

<!-- Venue Section (Full-width Gradient BG, styled like Why Attend) -->
<div class="venue-gradient-bg" style="position:relative;">
  <!-- Add a decorative background image behind the venue content -->
  <img src="assets/images/venue_bg.jpg" alt="" class="venue-bg-img" style="position:absolute; left:0; top:0; width:100%; height:100%; object-fit:cover; opacity:0.18; z-index:0; pointer-events:none;">
  <section class="container venue-section py-5" style="position:relative; z-index:1;">
    <h2 class="venue-title text-center mb-4" style="font-family: 'Dosis', sans-serif; font-weight: 800; color: #12037f;">Venue</h2>
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6 col-12 mb-3 text-center">
        <img src="assets/images/hilton_1.png" alt="Hilton Hotel" class="venue-img img-fluid" style="border-radius:18px; box-shadow:0 4px 24px rgba(18,3,127,0.10); max-width:100%;"/>
      </div>
      <div class="col-md-6 col-12 mb-3">
        <h3 class="venue-hotel-name" style="font-family: 'Dosis', sans-serif; font-weight: 700; color: #222; font-size:2rem; margin-bottom:10px;">Hilton Hotel</h3>
        <p class="venue-address" style="font-size:1.1rem; color:#222; margin-bottom:18px;">
          124, 1 Jawaharlal Nehru Salai, Poomagal Nagar, Guindy, Chennai, Tamil Nadu 600032.
        </p>
        <div class="venue-map-wrap" style="max-width:344px;">
          <!-- Google Maps iframe instead of image -->
          <iframe 
            src="https://www.google.com/maps?q=Hilton+Hotel+Chennai+124,+1+Jawaharlal+Nehru+Salai,+Poomagal+Nagar,+Guindy,+Chennai,+Tamil+Nadu+600032,+India.&output=embed"
            width="100%" height="220" style="border-radius:16px; box-shadow:0 2px 12px rgba(18,3,127,0.08); border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </section>
</div>

    <!-- Past Events -->

    <div class="container">
        <section id="past" class="mt-1">
            <h2 class="text-center" style="color: #12037f;font-family: Dosis, sans-serif;font-weight: 700;"
                data-aos="zoom-in">Past Events</h2>
            <div class="row mt-4 mb-4">

            <div class="col-md-3 mb-4">
                    <div class="card h-100" data-aos="zoom-in">
                        <img src="assets/images/316A7696.JPG" class="card-img-top img-fluid"
                            alt="upcoming Event 1" loading="lazy">
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title text-center mb-2">HR Confluence 2025</h6>
                            <p class="card-text mb-2 mt-auto">
                                <i class="fas fa-calendar-alt me-2"></i> August 23, 2025 - 9:30 AM
                            </p>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i> Zone by The Park Hotel, Coimbatore.
                            </p>
                            <div class="mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <a href="hr_confluence_2025_details.php" class="btn mb-3"
                                            style="background-color: #12037f; color: white;">Know More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card h-100" data-aos="zoom-in">
                        <img src="assets/images/HRF2025_BG_1.jpg" class="card-img-top img-fluid"
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

            </div>
        </section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
const speakers = [
  {
    name: "Mr. V.R. Muthu",
    title: "Chairman, Idhayam Group",
    img: "assets/images/Speakers/A Rathinaswamy.jpg",
    logo: "https://www.midnaglobal.com/images/midna-logo.jpg",
    bio: "Mr. Muthu has led Idhayam to become one of the most trusted oil brands in India with a legacy of quality and innovation.",
    linkedin: "https://linkedin.com"
  },
  {
    name: "Mr. CK Kumaravel",
    title: "Co-founder, Naturals",
    img: "https://via.placeholder.com/400x300.png?text=Speaker+2",
    logo: "https://via.placeholder.com/50x50.png?text=Logo",
    bio: "A visionary entrepreneur, Kumaravel revolutionized the beauty industry with Naturals Salon chains across India.",
    linkedin: "https://linkedin.com"
  }
];

let currentSlide = 0;

function openModal(index) {
  currentSlide = index;
  document.getElementById('speakerModal').style.display = 'flex';
  renderCarousel();
}

function closeModal() {
  document.getElementById('speakerModal').style.display = 'none';
}

function renderCarousel() {
  const container = document.getElementById('carousel');
  container.innerHTML = '';
  speakers.forEach((spk, i) => {
    const slide = document.createElement('div');
    slide.className = 'carousel-slide' + (i === currentSlide ? ' active' : '');
    slide.innerHTML = `
      <img src="${spk.img}" alt="${spk.name}" />
      <div class="company-logo-modern-wrap" style="position:relative; margin:0 auto; top:-40px;">
        <img src="${spk.logo}" class="company-logo-modern" />
      </div>
      <h3>${spk.name}</h3>
      <p style="color: gray;">${spk.title}</p>
      <p class="carousel-description">${spk.bio}</p>
    `;
    container.appendChild(slide);
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % speakers.length;
  renderCarousel();
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + speakers.length) % speakers.length;
  renderCarousel();
}
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

<script>
// Animate Stats Cards

function animateStatsCard() {
    document.querySelectorAll('.eventup-stat-count-card').forEach(function(el) {
        const end = parseInt(el.getAttribute('data-count'), 10);
        let start = 0;
        let duration = 1200;
        let step = Math.ceil(end / (duration / 24));
        if (end <= 5) step = 1;
        const showPlus = el.hasAttribute('data-plus') || end > 99;
        function update() {
            start += step;
            if (start >= end) {
                el.innerText = end + (showPlus ? '+' : '');
            } else {
                el.innerText = start + (showPlus ? '+' : '');
                requestAnimationFrame(update);
            }
        }
        update();
    });
}
window.addEventListener('DOMContentLoaded', animateStatsCard);
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (window.AOS) AOS.init({ once: true });
  });
</script>

<script>
// Countdown Timer for 20 December 2025, 00:00:00
const eventDate = new Date(2025, 11, 20, 0, 0, 0).getTime(); // December is 11 (0-indexed)
function updateEventupCountdown() {
    const now = new Date().getTime();
    const timeLeft = eventDate - now;
    let d=0,h=0,m=0,s=0;
    if (timeLeft > 0) {
        d = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        h = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        m = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        s = Math.floor((timeLeft % (1000 * 60)) / 1000);
    }
    document.getElementById("eventup-days").innerText = d.toString().padStart(2,'0');
    document.getElementById("eventup-hours").innerText = h.toString().padStart(2,'0');
    document.getElementById("eventup-minutes").innerText = m.toString().padStart(2,'0');
    document.getElementById("eventup-seconds").innerText = s.toString().padStart(2,'0');

    // Progress circles
    const circleLen = 2 * Math.PI * 38;
    // Days: show progress for 365 days max
    let daysProgress = Math.min(1, d / 365);
    document.getElementById("circle-days").setAttribute("stroke-dasharray", `${circleLen * daysProgress},${circleLen}`);
    // Hours: 0-23
    document.getElementById("circle-hours").setAttribute("stroke-dasharray", `${circleLen * (h/24)},${circleLen}`);
    // Minutes: 0-59
    document.getElementById("circle-minutes").setAttribute("stroke-dasharray", `${circleLen * (m/60)},${circleLen}`);
    // Seconds: 0-59
    document.getElementById("circle-seconds").setAttribute("stroke-dasharray", `${circleLen * (s/60)},${circleLen}`);
}
setInterval(updateEventupCountdown, 1000); updateEventupCountdown();

</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  var btn = document.getElementById('scrollToTicketsBtn');
  var target = document.getElementById('buyTicketsSection');
  if (btn && target) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
    });
  }
});
</script>

<!-- End of Agenda scripts -->



<?php 
    include('includes/footer.php'); 
?>