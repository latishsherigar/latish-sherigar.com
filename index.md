---
layout: default
title: Home
---

<section class="hero">
    <div class="hero-content container">
        <div class="code-quote">
            <pre><code>if (you_visited_this_site == INTENTIONALLY) {
    printf("You surely have nothing better to do.");
} else {
    printf("God Bless You");
}</code></pre>
        </div>
        <div class="hero-image">
            <img src="{{ '/img/profile_bw.jpg' | relative_url }}" alt="Latish Sherigar" class="hero-profile-img">
        </div>
                <p class="hero-intro">
            Welcome to my corner of the internet. I like to solve problems and build things. Occasionally i share my thoughts on life and technology here.
        </p>

                 <p class="hero-intro">
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


    </div>
</section>




