<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/splitting/dist/splitting.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
<script src="{{ URL::asset('landing') }}/owl-carousel/owl.carousel.min.js"></script>
<!-- <script src="owl-carousel/custom.js"></script> -->
<script src="https://kit.fontawesome.com/e54cb87e9e.js" crossorigin="anonymous"></script>
@if (isset($dt))
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
@widget('datatable')
@endif
<script>
        $("#table").DataTable({
            "columnDefs": [
                {
                    "targets": [0,-1], // Menargetkan kolom terakhir
                    "visible": false // Menyembunyikan kolom
                }
            ]
        });
        $(`.__input-search-link`).click(function (e) {
            e.preventDefault();
            $(".__input-search").addClass("show")
            $(this).find(".backdrop").show()
        });
        $(`#close-search`).click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(".__input-search").removeClass("show")
            $(`.__input-search-link`).find(".backdrop").hide()
        });
        $(window).on('load', function() {
            const target = document.querySelector('.content-text');
            const results = Splitting({ target: target, by: 'lines' });

            results[0].lines.forEach((line, index) => {
                line.forEach((word) => {
                gsap.from(word, { opacity: 0, delay: index /  2 });
                })
            });
        })
        // $(".item-news h3").css({
        //     width:( $('.item-news .content').width()-50)+"px"
        // })
        $(document).ready(function () {
            var content = $('.item-news .content');
            var body = $("body").width();

            $.each(content, function (indexInArray, valueOfElement) {
                var bodyWidth = content[indexInArray].offsetWidth;
                $(valueOfElement).find("h3").css({
                    width:(bodyWidth-50)+"px"
                })
            });
            if(body<=767){
                $(".mou-1,.mou-2").hide();
                $(".owl-carousel-mou-1").show()
                $(".owl-carousel-mou-2").show()
            }else{
                $(".mou-1,.mou-2").show();
                $(".owl-carousel-mou-1").hide()
                $(".owl-carousel-mou-2").hide()
            }
        });
        $(window).on('resize', function() {
            var content = $('.item-news .content');
            var body = $("body").width();

            $.each(content, function (indexInArray, valueOfElement) {
                var bodyWidth = content[indexInArray].offsetWidth;

                $(valueOfElement).find("h3").css({
                    width:(body-50)+"px"
                })
            });
            if(body<=767){
                $(".mou-1,.mou-2").hide();
                $(".owl-carousel-mou-1").show()
                $(".owl-carousel-mou-2").show()
            }else{
                $(".mou-1,.mou-2").show();
                $(".owl-carousel-mou-1").hide()
                $(".owl-carousel-mou-2").hide()
            }
        });
        $(".slider-news-1").owlCarousel({
            loop:true,
            margin:25,
            animateIn:true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:2,
                    nav:false
                }
            },
            autoplay:true,
            dots:false,
            smartSpeed:450,
            autoWidth:true,
        });
        $(".slider-news-2").owlCarousel({
            loop:true,
            margin:25,
            animateIn:true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                }
            },
            autoplay:true,
            dots:false,
            smartSpeed:450,
            // autoWidth:true,
        });
        $(".owl-carousel-mou-1").owlCarousel({
            loop: true,
            margin: 25,
            autoplay: true,
            nav:false,
            dots:false,
            slideTransition: 'linear',
            // autoplayTimeout: 1000,
            autoplaySpeed: 500,
            autoplayHoverPause: true,
            smartSpeed:250,
            items:3,
        });
        $(".owl-carousel-mou-2").owlCarousel({
            loop: true,
            margin: 25,
            autoplay: true,
            nav:false,
            dots:false,
            slideTransition: 'linear',
            rtl: true,
            autoplaySpeed: 500,
            autoplayHoverPause: true,
            smartSpeed:250,
            items:2,
        });
        $(".owl-carousel-testimoni").owlCarousel({
            loop: true,
            margin: 25,
            autoplay: true,
            nav:false,
            dots:false,
            slideTransition: 'linear',
            // autoplayTimeout: 1000,
            autoplaySpeed: 500,
            autoplayHoverPause: true,
            smartSpeed:250,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:1,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:false
                }
            },
        });
        $('.owl-carousel-slide').owlCarousel({
            loop:true,
            margin:10,
            items:1,
            dots:true,
            nav:true,
            navText:['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>']
        });
       
        $(".owl-carousel-dosen-1,.owl-carousel-dosen-2").owlCarousel({
            // loop: true,
            margin: 25,
            autoplay: true,
            nav:false,
            dots:false,
            slideTransition: 'linear',
            // autoplayTimeout: 1000,
            autoplaySpeed: 500,
            autoplayHoverPause: true,
            smartSpeed:250,
            responsive:{
                0:{
                    items:2,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:false
                }
            },
        });

        function delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function loopingWithDelay(array,callback) {
            const items = array; // Misalnya, ini adalah array yang ingin Anda loop

            for (let i = 0; i < items.length; i++) {
                callback(items[i])
                await delay(500); // Jeda 1 detik sebelum iterasi berikutnya
            }

            console.log('Looping selesai');
        }
</script>

@stack('js')
