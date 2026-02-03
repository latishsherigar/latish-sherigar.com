---
layout: default
title: About
permalink: /about.html
---

<section class="about-section container">
    <div class="about-header">
        <h1>About Me</h1>
    </div>

    <div class="about-content">
        <div class="about-card">
            <div class="profile-image">
                <!-- Using the existing image path, adjusted for Jekyll -->
                <img src="{{ '/img/my_cur_pic_small.PNG' | relative_url }}" alt="Latish Sherigar" width="200" height="200" loading="lazy" onerror="this.src='https://ui-avatars.com/api/?name=Latish+Sherigar&size=200&background=random'">
            </div>
            
            <div class="bio-text">
                <p class="lead">My Name is <strong>Latish Sherigar</strong>.</p>
                
                <p>I develop software as my main job. On weekends I assist Superman in saving the world.</p>
                
                <hr class="divider">
                
                <h3>Connect</h3>
                <p>
                    You can drop a line at 
                    <span id="contact-email">[Loading email...]</span>
                    for any interesting projects, Superman's autograph, or even if you want to just say hello to me.
                </p>

                <script>
                    (function() {
                        var user = "latishsherigar";
                        var domain = "gmail.com";
                        var element = document.getElementById("contact-email");
                        element.innerHTML = '<a href="mailto:' + user + '@' + domain + '" class="email-link">' + user + '@' + domain + '</a>';
                    })();
                </script>

                <div class="social-links">
                    <a href="https://github.com/latishsherigar/publicCode" target="_blank" class="social-btn github">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                        GitHub
                    </a>
                    <a href="https://in.linkedin.com/in/latishsherigar" target="_blank" class="social-btn linkedin">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        LinkedIn
                    </a>
                    <a href="https://www.chess.com/member/latishsherigar" target="_blank" class="social-btn chess">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        Chess.com <span class="chess-rating-display"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
