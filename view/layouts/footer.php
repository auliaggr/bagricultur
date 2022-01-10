<div class="site-footer">
        <div class="inner first">
            <div class="container">
                <div class="row">   
                    <div class="col-md-6 col-lg-4">
                        <div class="widget">
                            <h3 class="heading">About Us</h3>
                            <p>BAGRICULTUR is a market place that everyone really needs.</p>
                        </div>
                        <div class="widget">
                            <ul class="list-unstyled social">
                                <li><a href="#"><span class="iconify" data-icon="ph:twitter-logo" data-width="30" data-height="30"></span></a></li>
                                <li><a href="#"><span class="iconify" data-icon="ph:instagram-logo" data-width="30" data-height="30"></span></a></li>
                                <li><a href="#"><span class="iconify" data-icon="ph:facebook-logo" data-width="30" data-height="30"></span></a></li>
                            </ul>
                        </div>
                </div>
                <div class="col-md-6 col-lg-2 pl-lg-5">
                    <div class="widget">
                        <h3 class="heading">Pages</h3>
                        <ul class="links list-unstyled">
                            <li><a href="#home" class="text-decoration-none">Home</a></li>
                            <li><a href="#category" class="text-decoration-none">Category</a></li>
                            <li><a href="#product" class="text-decoration-none">Product</a></li>
                            <li><a href="#discounts" class="text-decoration-none">Discounts</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-2">
                    <div class="widget">
                        <h3 class="heading">Categories</h3>
                        <ul class="links list-unstyled">
                            <li><a href="#" class="text-decoration-none">Plant</a></li>
                            <li><a href="#" class="text-decoration-none">Vegetables</a></li>
                            <li><a href="#" class="text-decoration-none">Seed</a></li>
                            <li><a href="#" class="text-decoration-none">Fertilizer</a></li>
                            <li><a href="#" class="text-decoration-none">Fruits</a></li>
                            <li><a href="#" class="text-decoration-none">Tools</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <h3 class="heading">Contact</h3>
                        <ul class="list-unstyled links">
                            <li><a href="#" class="text-decoration-none">bagricultur@gmail.com</a></li>
                            <li><a href="#" class="text-decoration-none">+62-895-3301-88539</a></li>
                            <li><a href="#" class="text-decoration-none">SMKN 12 Jakarta</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="inner dark">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p>Aulia Anggraeni &copy; <script>document.write(new Date().getFullYear());</script> | All rights reserved</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="mx-2 text-decoration-none">Terms</a>
                    <a href="#" class="mx-2 text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <script src="src/js/jquery-3.4.1.min.js"></script> 
    <script src="src/js/bootstrap.min.js"></script>
    <script src="src/js/owl.carousel.min.js"></script>
    <script src="src/js/jquery.animateNumber.min.js"></script>
    <script src="src/js/jquery.waypoints.min.js"></script>
    <script src="src/js/jquery.fancybox.min.js"></script> 
    <script src="src/js/aos.js"></script>
    <script src="src/js/moment.min.js"></script>
    <script src="src/js/daterangepicker.js"></script>

    <script src="src/js/typed.js"></script>
    <script>
        $(function() {
            var slides = $('.slides'),
            images = slides.find('img');

            images.each(function(i) {
                $(this).attr('data-id', i + 1);
            })
// ini buat bagian home yg ad gambar slide sama nama tmpt yg diketik
            var typed = new Typed('.typed-words', {
                strings: ["Leaders In Agricultur","Vegetables Growing","Fresh Fruits", "Healthy Life", "Organic Product"],
                typeSpeed: 80,
                backSpeed: 80,
                backDelay: 4000,
                startDelay: 1000,
                loop: true,
                showCursor: true,
                preStringTyped: (arrayPos, self) => {
                    arrayPos++;
                    console.log(arrayPos);
                    $('.slides img').removeClass('active');
                    $('.slides img[data-id="'+arrayPos+'"]').addClass('active');
                }
            });
        })
	</script>

    <script src="src/js/custom.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
    </script>