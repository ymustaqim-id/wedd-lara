@extends('landingfo.template.head')
@include('landingfo.template.body')
@include('landingfo.template.header')
<!-- start story-section -->
<section class="story-section" id="story">
	<div class="container">
		<div class="row">
			<div class="wpo-section-title-s2">
				<div class="section-title-simg">
					<img src="loveme/assets/images/section-title2.png" alt="">
				</div>
				<h2>Our Love Story</h2>
				<div class="section-title-img">
					<div class="round-ball"></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col col-xs-12">
				<div class="story-timeline">
					<div class="round-shape"></div>
					@foreach($stories as $p)
						@if($loop->iteration % 2 == 0)
							<div class="row">
								<div class="col col-lg-6 col-12">
									<div class="story-text right-align-text">
										<h3>{{ $p->judul }}</h3>
										<span class="date">{{ $p->waktu }}</span>
										<p>{{ $p->story }}</p>
									</div>
								</div>
								<div class="col col-lg-6 col-12">
									<div class="img-holder">
										<img src="{{ $p->foto }}" alt class="img img-responsive">
										<div class="story-shape-img">
											<img src="loveme/assets/images/story/shape.png" alt="">
										</div>
									</div>
								</div>
							</div>
						@else
							<div class="row">
								<div class="col col-lg-6 col-12">
									<div class="img-holder right-align-text left-site">
										<img src="loveme/assets/images/story/2.jpg" alt class="img img-responsive">
										<div class="story-shape-img">
											<img src="loveme/assets/images/story/shape.png" alt="">
										</div>
									</div>
								</div>
								<div class="col col-lg-6 col-12 text-holder">
									<span class="heart">
										<i class="fi flaticon-heart"></i>
									</span>
									<div class="story-text">
										<h3>{{ $p->judul }}</h3>
										<span class="date">{{ $p->waktu }}</span>
										<p>{{ $p->story }}</p>
									</div>
								</div>
							</div>
						@endif
					@endforeach

					<div class="row">
						<div class="col offset-lg-6 col-lg-6 col-12 text-holder">
							<span class="heart">
								<i class="fi flaticon-wedding-rings"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end row -->
	</div> <!-- end container -->
</section>
<!-- end story-section -->
@include('landingfo.template.footer')
