@extends('landingfo.template.head')
@include('landingfo.template.body')
@include('landingfo.template.header')
<!-- start wpo-event-section -->
<section class="wpo-event-section" id="event">
	<div class="container">
		<div class="row">
			<div class="wpo-section-title-s2">
				<div class="section-title-simg">
					<img src="loveme/assets/images/section-title2.png" alt="">
				</div>
				<h2>TIME & PLACE</h2>
				<div class="section-title-img">
					<div class="round-ball"></div>
				</div>
			</div>
		</div>
		<div class="wpo-event-wrap">
			<div class="row" style="align-items: center;">
				<div class="col col-lg-6 col-md-6 col-12">
					<div class="wpo-event-item">
						<div class="wpo-event-text">
							<h2>Mariage Ceremony (AKAD)</h2>
							<ul>
								<li>{!! isset($akad->waktu) ? $akad->waktu : '' !!}</li>
								<li>{!! isset($akad->tempat) ? $akad->tempat : '' !!}</li>
								<li> <a class="popup-gmaps" href="{!! isset($akad->maps) ? $akad->maps : '' !!}">See Locations</a></li>
							</ul>
						</div>
						<div class="event-shape-1">
							<img src="loveme/assets/images/event-shape-1.png" alt="">
						</div>
						<div class="event-shape-2">
							<img src="loveme/assets/images/event-shape-2.png" alt="">
						</div>
					</div>
				</div>
				<div class="col col-lg-6 col-md-6 col-12">
					<div class="wpo-event-item">
						<div class="wpo-event-text">
							<h2>Reception</h2>
							<ul>
								<li>{!! isset($resepsi->waktu) ? $resepsi->waktu : '' !!}</li>
								<li>{!! isset($resepsi->tempat) ? $resepsi->tempat : '' !!}</li>
								<li> <a class="popup-gmaps" href="{!! isset($resepsi->maps) ? $resepsi->maps : '' !!}">See Locations</a></li>
							</ul>
						</div>
						<div class="event-shape-1">
							<img src="loveme/assets/images/event-shape-1.png" alt="">
						</div>
						<div class="event-shape-2">
							<img src="loveme/assets/images/event-shape-2.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>

		

		<div class="wpo-event-wrap">
			<div class="row" style="align-items: center;">
				<div class="col col-lg-12 col-md-12 col-12">
					<div class="wpo-event-item">
						<div class="wpo-event-text">
							<ul>
								<li><h4 align="center" style="color:red">"MOHON MAAF, KAMI HANYA MENERIMA TAMU SATU HARI YAITU PADA ACARA RESEPSI, TERIMAKASIH"</h4></li>
						</ul>
					</div>
					<div class="event-shape-1">
						<img src="loveme/assets/images/event-shape-1.png" alt="">
					</div>
					<div class="event-shape-2">
						<img src="loveme/assets/images/event-shape-2.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

		<div class="wpo-event-wrap">
			<div class="row" style="align-items: center;">
				<div class="col col-lg-12 col-md-12 col-12">
					<div class="wpo-event-item">
						<div class="wpo-event-text">
							<ul>
								<li><b>
									وَمِنۡ اٰيٰتِهٖۤ اَنۡ خَلَقَ لَكُمۡ مِّنۡ اَنۡفُسِكُمۡ اَزۡوَاجًا لِّتَسۡكُنُوۡۤا اِلَيۡهَا وَجَعَلَ بَيۡنَكُمۡ مَّوَدَّةً وَّرَحۡمَةً  ؕ اِنَّ فِىۡ ذٰ لِكَ لَاٰيٰتٍ لِّقَوۡمٍ يَّتَفَكَّرُوۡنَ
								</b>
							</li>
							<li>
								“Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tentram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berpikir.”
							</li>
							<li>
								<b>QS Ar-Rum: 21 </b>
							</li>
							<hr>
							<li>Ungkapan terima kasih yang tulus dari kami apabila Bapak/Ibu/Teman-teman berkenan hadir dan memberikan do’a restu.</li>
							<li><b>Jazakumullah Khairan Katsiran</b></li>
							<li><b>Wassalamuallaikum Warrahmatullahi Wabarakatuh</b></li>
							<hr>
							<li>Kami yang berbahagia,</li>
							<li><b>Ayu & Mustaqim</b></li>
							<li>Beserta keluarga besar kedua mempelai</li>
						</ul>
					</div>
					<div class="event-shape-1">
						<img src="loveme/assets/images/event-shape-1.png" alt="">
					</div>
					<div class="event-shape-2">
						<img src="loveme/assets/images/event-shape-2.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

</div> <!-- end container -->
</section>
<!-- end wpo-event-section -->
@include('landingfo.template.footer')
