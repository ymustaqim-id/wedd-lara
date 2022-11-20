<!-- start of wpo-contact-section -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <section class="wpo-contact-section">
            <div class="container">
                <div class="wpo-contact-section-wrapper">
                    <div class="wpo-contact-form-area">
                        <div class="wpo-section-title-s2">
                            <div class="section-title-simg">
                                <img src="loveme/assets/images/section-title2.png" alt="">
                            </div>
                            <h2>WILL YOU ATTEND?</h2>
                            <div class="section-title-img">
                                <div class="round-ball"></div>
                            </div>
                        </div>
                        <form class="contact-validation-active">
                            @csrf

                            <div>
                                <input type="text" class="form-control" name="nama" id="namaUndangan" placeholder="Your Beautiful Name" required>
                            </div>
                            <div>
                                <select name="kehadiran" id="kehadiranUndangan" class="form-control" required>
                                    <option disabled="disabled" selected>Attended</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Uncertain">Uncertain</option>
                                </select>
                            </div>
                             <div>
                                <input type="text" class="form-control" name="wish" id="wish" placeholder="Your Wish" required>
                            </div>

                            <div class="submit-area">
                                <button id="simpan-wishes" onclick="return SimpanWishes()" class="theme-btn-s3">Send Wishes</button>
                                <div id="c-loader">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>

                            <div class="clearfix error-handling-messages">
                                <div id="success">Thank you</div>
                                <div id="error"> Error occurred while sending your wish. Please try again later.
                                </div>
                            </div>

                        </form>
                        <div class="border-style"></div>
                    </div>
                    <div class="vector-1">
                        <img src="loveme/assets/images/contact/1.png" alt="">
                    </div>
                    <div class="vector-2">
                        <img src="loveme/assets/images/contact/2.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- end of wpo-contact-section -->
        <script type="text/javascript">

            function SimpanWishes() {
                var nama = $('#namaUndangan').val();
                var kehadiran = $('#kehadiranUndangan').val();
                var wish = $('#wish').val();

                console.log('nama',nama);
                console.log('kehadiran',kehadiran);
                console.log('wish',wish);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('rsvps.storeRsvp') }}",
                    type: "POST",
                    data: {
                        nama:nama,
                        kehadiran:kehadiran,
                        wish:wish,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.response == "1") {
                            alert('Well thank you for your wishes.');

                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else {
                            alert('Oh dang, we have a problem, you can try again.');
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                });

                return false;
            }
        </script>
