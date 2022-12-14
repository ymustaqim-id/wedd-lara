<!-- start couple-section -->
<section class="couple-section section-padding" id="couple">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-xs-12">
                <div class="couple-area clearfix">
                    <div class="text-grid bride">
                        <div class="couple-img">
                            <img src="loveme/assets/images/couple/2.jpg" alt="">
                        </div>
                        <h3>{!! isset($pria->nama) ? $pria->nama : '' !!}</h3>
                        <p>{!! isset($pria->biodata) ? $pria->biodata : '' !!}</p>
                        <div class="social">
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="middle-couple-pic">
                        <img src="loveme/assets/images/couple/1.jpg" alt="">
                        <div class="frame-img"><img src="loveme/assets/images/couple/shape.png" alt=""></div>
                    </div>
                    <div class="text-grid groom">
                        <div class="couple-img">
                            <img src="loveme/assets/images/couple/3.jpg" alt="">
                        </div>
                        <h3>{!! isset($wanita->nama) ? $wanita->nama : '' !!}</h3>
                        <p>{!! isset($wanita->biodata) ? $wanita->biodata : '' !!}</p>
                        <div class="social">
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
        <!-- end couple-section -->