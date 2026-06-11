/**
 * Joostrap Ripped - Main JS (vanilla, no jQuery)
 * Bootstrap 5 compatible
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // ======= Carousel init (BS5 data attributes handle most of it) =======
        document.querySelectorAll('#myCarousel').forEach(function (el) {
            new bootstrap.Carousel(el, { interval: 6000 });
        });
        document.querySelectorAll('#testiCarousel').forEach(function (el) {
            new bootstrap.Carousel(el, { interval: 4000 });
        });

        // ======= Parallax background =======
        var parallaxElements = document.querySelectorAll('.testimonials .bg');
        if (parallaxElements.length) {
            window.addEventListener('scroll', function () {
                var scrollTop = window.pageYOffset;
                parallaxElements.forEach(function (el) {
                    var speed = 0.4;
                    el.style.backgroundPositionY = -(scrollTop * speed) + 'px';
                });
            });
        }

        // ======= Scroll animations with IntersectionObserver =======
        if ('IntersectionObserver' in window) {
            var animObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var items = entry.target.querySelectorAll('.recent-item');
                        items.forEach(function (item) {
                            item.classList.add('animated');
                        });
                        animObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });

            document.querySelectorAll('.recent-work').forEach(function (el) {
                animObserver.observe(el);
            });
        }

        // ======= Back to top =======
        var goTopBtn = document.querySelector('.go-top');
        if (goTopBtn) {
            window.addEventListener('scroll', function () {
                if (window.pageYOffset > 200) {
                    goTopBtn.style.display = 'block';
                } else {
                    goTopBtn.style.display = 'none';
                }
            });

            goTopBtn.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // ======= BS5 Tooltip init =======
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
                new bootstrap.Tooltip(el);
            });
        }

        // ======= Responsive video (CSS aspect-ratio replacement for FitVids) =======
        document.querySelectorAll('.video-container iframe, .video-container embed, .video-container object').forEach(function (el) {
            el.style.aspectRatio = '16 / 9';
            el.style.width = '100%';
            el.style.height = 'auto';
        });

    });
})();
