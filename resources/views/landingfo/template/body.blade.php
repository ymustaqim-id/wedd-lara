<body>
    <button class="btnSong" style="display: inline-block;"><i class="fa fa-pause"></i></button>
    
    <!-- <audio id="myAudio"> -->
    <audio id="myAudio" src="{{ asset('loveme/') }}/assets/lagu.mp3" type="audio/mpeg" loop="loop">
    <source src="{{ asset('loveme/') }}/assets/lagu.mp3" type='audio/mpeg'>
    </audio>

    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="{{ asset('loveme/') }}/assets/images/favicon.png" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->
        <!-- Start header -->