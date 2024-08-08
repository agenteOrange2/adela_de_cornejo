<div class="slider_adela">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <picture>
                    <source media="(min-width: 1024px)" srcset="{{ $slider->image_url }}">
                    <source media="(min-width: 768px)" srcset="{{ $slider->image_url }}">
                    <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}">
                </picture>
                <div class="slide-content">
                    <h2>{{ $slider->title }}</h2>
                    <p>{{ $slider->paragraph }}</p>
                    <div class="buttons">
                        <a href="{{ $slider->link }}" class="default-btn"><i class='bx bx-move-horizontal icon-arrow before'></i><span class="label">Más Información</span><i class="bx bx-move-horizontal icon-arrow after"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Paginación y navegación -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 30000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                slideChangeTransitionStart: function() {
                    document.querySelectorAll('.swiper-slide .slide-content').forEach(function(content) {
                        content.style.opacity = '0';
                        content.style.transform = 'translateY(20px)';
                    });
                },
                slideChangeTransitionEnd: function() {
                    document.querySelectorAll('.swiper-slide-active .slide-content').forEach(function(content) {
                        content.style.opacity = '1';
                        content.style.transform = 'translateY(0)';
                    });
                }
            }
        });

        // Mostrar el slider después de inicializar Swiper.js
        document.querySelector('.swiper-container').style.display = 'block';
    });
</script>
