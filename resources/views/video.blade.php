@extends('layouts.app')
@section('title', 'Video')
@section('content')
<div class="container" style="background: #fff">
	<div class="row justify-content-center">


		<ul class="wrap">
			<li><video width="320" height="240" controls  class="video">
				<source src="{{URL::asset('/public/video/becky1.mp4')}}" type="video/mp4">
					<p>Becky muisc1</p>
				</video></li>


				<li><video width="320" height="240" controls>
					<source src="{{URL::asset('/public/video/eminem1.mp4')}}" type="video/mp4">
								<p>Eminem muisc1</p>
					</video></li>

					<li><video width="320" height="240" controls>
						<source src="{{URL::asset('/public/video/becky2.mp4')}}" type="video/mp4">
								<p>Becky muisc2</p>
						</video></li>

						<li><video width="320" height="240" controls>
							<source src="{{URL::asset('/public/video/black_eyed_peas.mp4')}}" type="video/mp4">
										<p>Black eyed music</p>
							</video></li>
						</ul>

					</div>
				</div>


				@endsection
