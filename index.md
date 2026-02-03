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
            <img src="{{ '/img/calvin_life.jpg' | relative_url }}" alt="Calvin and Hobbes - Life" class="calvin-img">
        </div>
        
        <p class="hero-intro">
            Welcome to my corner of the internet. I write code, solve problems, 
            and occasionally share my thoughts on life and technology.
        </p>
    </div>
</section>

<section class="featured-posts container">
    <div class="section-header">
        <h2>Latest Thoughts</h2>
        <a href="{{ '/blog/' | relative_url }}" class="view-all">View All →</a>
    </div>
    
    <div class="posts-grid">
        {% for post in site.posts limit:3 %}
        <article class="post-card">
            <div class="post-meta">
                <span class="post-category {{ post.categories | first }}">{{ post.categories | first }}</span>
                <time>{{ post.date | date: "%b %d, %Y" }}</time>
            </div>
            <h3><a href="{{ post.url | relative_url }}">{{ post.title }}</a></h3>
            <p>{{ post.excerpt | strip_html | truncatewords: 20 }}</p>
        </article>
        {% endfor %}
    </div>
</section>
