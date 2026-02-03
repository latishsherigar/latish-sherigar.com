---
layout: default
title: Blog
permalink: /blog/
---

<section class="page-header-minimal container">
    <div class="header-content">
        <h1 class="page-title-minimal">iLatish</h1>
        <p class="page-subtitle-minimal">Thoughts on life, technology, and everything in between.</p>
    </div>
</section>

<section class="blog-filters container">
    <div class="filter-buttons">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="personal">Personal</button>
        <button class="filter-btn" data-filter="tech">Tech</button>
    </div>
</section>

<section class="all-posts container">
    <div class="posts-list">
        {% for post in site.posts %}
        <article class="post-item" data-category="{{ post.categories | join: ' ' }}">
            <time class="post-date">{{ post.date | date: "%b %d, %Y" }}</time>
            <div class="post-info">
                <h3 class="post-item-title">
                    <a href="{{ post.url | relative_url }}">{{ post.title }}</a>
                </h3>
                <div class="post-tags">
                    {% for category in post.categories %}
                    <span class="post-tag {{ category }}">{{ category }}</span>
                    {% endfor %}
                </div>
            </div>
        </article>
        {% endfor %}
    </div>
</section>

<script>
// Simple filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const postItems = document.querySelectorAll('.post-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter posts
            postItems.forEach(post => {
                if (filter === 'all') {
                    post.style.display = '';
                } else {
                    const categories = post.dataset.category;
                    if (categories.includes(filter)) {
                        post.style.display = '';
                    } else {
                        post.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>
