<div class="main-item">
	<div class="static-background">
		<div class="background-masker btn-divide-left"></div>
	</div>

	<div class="animated-background">
		<div class="background-masker btn-divide-left"></div>
	</div>

	<div class="shared-dom">
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
		<div class="sub-rect pure-background"></div>
	</div>

	<div class="css-dom"></div>
</div>

<style>

	.background-masker {
		background-color: #fff;
		position: absolute;
	}

	.btn-divide-left {
		top: 0;
		left: 25%;
		height: 100%;
		width: 5%;
	}

	@keyframes placeHolderShimmer {
		0% {
			background-position: -800px 0
		}
		100% {
			background-position: 800px 0
		}
	}

	.animated-background {
		animation-duration: 2s;
		animation-fill-mode: forwards;
		animation-iteration-count: infinite;
		animation-name: placeHolderShimmer;
		animation-timing-function: linear;
		background-color: #f6f7f8;
		background: linear-gradient(to right, #eeeeee 8%, #bbbbbb 18%, #eeeeee 33%);
		background-size: 800px 104px;
		height: 70px;
		position: relative;
	}

	.static-background {
		background-color: #f6f7f8;
		background-size: 800px 104px;
		height: 70px;
		position: relative;
		margin-bottom: 20px;
	}

	.shared-dom {
		width: 800px;
		height: 110px;
	}

	.sub-rect {
		border-radius: 100%;
		width: 70px;
		height: 70px;
		float: left;
		margin: 20px 20px 20px 0;
	}

	.pure-background {
		background-color: #eee;
	}

	.css-dom:empty {
		width: 280px;
		height: 220px;
		border-radius: 6px;
		box-shadow: 0 10px 45px rgba(0, 0, 0, .2);
		background-repeat: no-repeat;

		background-image: radial-gradient(circle 16px, lightgray 99%, transparent 0),
		linear-gradient(lightgray, lightgray),
		linear-gradient(lightgray, lightgray),
		linear-gradient(lightgray, lightgray),
		linear-gradient(lightgray, lightgray),
		linear-gradient(#fff, #fff);

		background-size: 32px 32px,
		200px 32px,
		180px 32px,
		230px 16px,
		100% 40px,
		280px 100%;

		background-position: 24px 30px,
		66px 30px,
		24px 90px,
		24px 142px,
		0 180px,
		0 0;
	}

	#slick4322_loading .row{
		gap: .125rem;
	}
</style>

<div class="main_fix" id="slick4322_loading" style="display:none;width: 100%;">
	<div class="row mt-2 pt-2 gx-0 gy-0">
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-2 pt-2 gx-0 gy-0">
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="box-item animated-background" style="height: 12rem; width: 100%; display: inline-block;">
				<div class="item item_i">
					<div class="background-masker btn-divide-left"></div>
				</div>
			</div>
		</div>
	</div>
</div>
