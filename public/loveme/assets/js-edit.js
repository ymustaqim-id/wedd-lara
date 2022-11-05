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


        $(document).ready(function () {

            var playing = true;
            $('.btnSong').click(function () {
                if (playing == false) {
                    document.getElementById('myAudio').play();
                    playing = true;
                    $(this).html('<i class="fa fa-pause"></i>');

                } else {
                    document.getElementById('myAudio').pause();
                    playing = false;
                    $(this).html('<i class="fa fa-play"></i>');
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