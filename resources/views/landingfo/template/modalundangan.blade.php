    <div style="z-index: 20000;position: fixed;width: 100%;height: 100%;top: 0;left: 0;transform: translateY(0);background-image:url({{ asset('loveme/') }}/assets/images/slider/slide-6.jpg);
        background-size: cover;background-position: center center;background-repeat: no-repeat;" class="modalUndangan"></div>
        
    <div style="z-index: 20001;position: fixed;width: 100%;height: 100vh;top: 0;left: 0;overflow: auto;background:#080807d4" class="modalUndangan">
        <div class="container" style="height: 100vh;">

            <div class="row justify-content-center" style="height: 90vh;position:relative;top: 30px;">

                <div class="d-flex justify-content-center align-items-center col-lg-5 col-md-5 text-center" style="border-radius: 20px;margin-left: 20px;margin-right: 20px;opacity: .9">

                    <div>
                        <h4 class="text-white">The Wedding Of </h4>

                        <img src="{{ asset('loveme/') }}/assets/images/slider/slide-6.jpg" class="d-block mx-auto fit_pic_cover mb-3">

                        <h2 style="font-size: 3em;line-height:1.3em;margin-bottom: 20px;margin-bottom: 20px" class="text-white">Ayu & Mustaqim</h2>
                        <h3 style="font-size:18px;width:100%" class="text-white">Kpd. Bpk/Ibu/Saudara/i
                            <div style="font-size:18px;width:100%;font-weight: 600;" class="text-white"></div>
                        </h3>

                        <?php 
                        // error_reporting(0);
                        if (!empty($_GET['to'])) { ?>
                        <h3 style="font-size:18px;width:100%" class="text-white"><?php echo $_GET['to'];?>
                            <div style="font-size:18px;width:100%;font-weight: 600;" class="text-white"></div>
                        </h3>
                        <?php } ?>
                        
                        <button class="btn btn-primary btnColor" style="border-radius: 20px 20px 20px 20px;background: #fb6262" onclick="openInvitation();"><i class="fa fa-envelope"></i> Buka Undangan</button>

                    </div>

                </div>

            </div>
        </div>

    </div>