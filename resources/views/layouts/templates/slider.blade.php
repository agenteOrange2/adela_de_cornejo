<div class="slider_adela">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">                
                <a href="{{ $slider->link }}" class="slide-link">
                <picture>
                    @php
                        $desktopImage = $slider->getDesktopImage();
                        $tabletImage = $slider->getTabletImage();
                        $mobileImage = $slider->getMobileImage();
                    @endphp
                    
                    @if($desktopImage)
                        <source media="(min-width: 1024px)" srcset="{{ asset('storage/' . $desktopImage->path) }}">
                    @endif
                    
                    @if($tabletImage)
                        <source media="(min-width: 768px) and (max-width: 1023px)" srcset="{{ asset('storage/' . $tabletImage->path) }}">
                    @endif
                    
                    @if($mobileImage)
                        <source media="(max-width: 767px)" srcset="{{ asset('storage/' . $mobileImage->path) }}">
                    @endif
                    
                    <!-- Fallback image in case none of the above match -->
                    <img src="{{ $slider->getImageUrlAttribute() }}" alt="{{ $slider->title }}">
                </picture>   
            </a>             
                
                {{-- <div class="slide-content">
                    <div class="buttons">
                        <a href="{{ $slider->link }}" class="default-btn">
                            <i class='bx bx-move-horizontal icon-arrow before'></i>
                            <span class="label">Más Información</span>
                            <i class="bx bx-move-horizontal icon-arrow after"></i>
                        </a>
                    </div>
                </div> --}}
                
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
