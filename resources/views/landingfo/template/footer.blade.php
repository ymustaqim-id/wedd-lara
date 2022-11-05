 <!-- start of wpo-site-footer-section -->
        <footer class="wpo-site-footer">
            <div class="wpo-upper-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <img src="{{ asset('loveme/') }}/assets/images/logo.png" alt="blog">
                                </div>
                                <p>Welcome to Our Wedding, thank you for sharing your happiness with us.</p>
                            </div>
                        </div>
                        <div class="col col-xl-3  col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Information</h3>
                                </div>
                                <ul>
                                    <li><a href="{{ url('/') }}/mempelai">Couple</a></li>
                                    <li><a href="{{ url('/') }}/acara">Agenda</a></li>
                                    <li><a href="{{ url('/') }}/story">Story</a></li>
                                    <li><a href="{{ url('/') }}/rsvp">Rsvp</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-xl-3  col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="widget wpo-service-link-widget">
                                <div class="widget-title">
                                    <h3>Contact </h3>
                                </div>
                                <div class="contact-ft">
                                    <p>Do you have any questions? please email me below, thank you very much.</p>
                                    <ul>
                                        <li><i class="fi flaticon-email"></i><a href="mailto:ymustaqim.id@gmail.com">ymustaqim.id@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col col-xl-3  col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="widget instagram">
                                <div class="widget-title">
                                    <h3>Instagram</h3>
                                </div>
                                <ul class="d-flex">
                                    <li><a href="portfolio-single.html"><img src="{{ asset('loveme/') }}/assets/images/instragram/1.jpg"
                                                alt=""></a></li>
                                    <li><a href="portfolio-single.html"><img src="{{ asset('loveme/') }}/assets/images/instragram/2.jpg"
                                                alt=""></a></li>
                                    <li><a href="portfolio-single.html"><img src="{{ asset('loveme/') }}/assets/images/instragram/3.jpg"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div> <!-- end container -->
            </div>
            <div class="wpo-lower-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-xs-12">
                            <b><p class="copyright" style="color:red;">Made with love <i class="fa fa-heart"></i> by <a
                                    href="https://www.instagram.com/ymustaqim.id/" target="_blank">@ymustaqim.id </a></p></b>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end of wpo-site-footer-section -->

    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('loveme/') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('loveme/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('loveme/') }}/assets/js/modernizr.custom.js"></script>
    <script src="{{ asset('loveme/') }}/assets/js/jquery.dlmenu.js"></script>
    <script src="{{ asset('loveme/') }}/assets/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('loveme/') }}/assets/js/script.js"></script>
    <script type="text/javascript">

    function openInvitation(){
        $( "body" ).removeClass( "modal-opened" );
        $(".modalUndangan").animate({top: '100vh',opacity: '0'});
        // $(".modalUndangan").fadeOut(1000);
        // $(".modalUndangan").css('display','none');

        // cari panjang halaman website
        var panjangHalaman = $(document).height();
        var totalPanjang = panjangHalaman*0.4;
        // console.log(panjangHalaman);

            // trigger when scroll over digit pixel
            var hasBeenTrigged = false;
            $(window).scroll(function() {
                if ($(this).scrollTop() >= totalPanjang && !hasBeenTrigged) { // if equal to or greater than 100 and hasBeenTrigged is set to false.
                    // alert("You've scrolled 100 pixels.");

                    $('#myModal').modal("show");
                    hasBeenTrigged = true;
                }
            });
            // end trigger when scroll
            
            $("#myAudio").get(0).play();
        }

        // $(document).ready(function (){
        //     $("#btnMyAudio").on("click",function() { 
        //         document.getElementById('myAudio').play();
        //         alert('oke');
        //     });
        // });


        $(document).ready(function () {

            var playing = true;
            $('.btnSong').click(function () {
                if (playing == false) {
                    document.getElementById('myAudio').play();
                    playing = true;
                    $(this).html('<i class="fa fa-pause"></i>');
                    console.log(playing);

                } else {
                    document.getElementById('myAudio').pause();
                    playing = false;
                    $(this).html('<i class="fa fa-play"></i>');
                    console.log(playing);
                }
            });
            
                // Scroll smooth
                $('a[href*="#"]')
                  // Remove links that don't actually link to anything
                  .not('[href="#"]')
                  .not('[href="#0"]')
                  .not('[href^="#collapse"]')
                  .not('[href^="#cek"]')
                  .click(function(event) {
                    // On-page links
                    if (
                        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
                        && 
                        location.hostname == this.hostname
                        ) {
                      // Figure out element to scroll to
                  var target = $(this.hash);

                  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                      // Does a scroll target exist?
                      if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                          // scrollTop: target.offset().top+cek
                          
                      }, 400, function() {
                          // Callback after animation
                          // Must change focus!
                          var $target = $(target);
                          $target.focus();
                          if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                          } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                    }
                }
            });




              });
</script>
</body>


<!-- Mirrored from wpocean.com/html/tf/loveme/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Aug 2022 03:21:00 GMT -->
</html>