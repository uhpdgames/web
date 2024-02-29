<?php

function dienthoai_chuan($dt)
{
	$dt_array = (str_split($dt));
	for ($i = 0; $i < count($dt_array); $i++) {
		if (($dt_array[$i] != "0") && ($dt_array[$i] != "1") && ($dt_array[$i] != "2") && ($dt_array[$i] != "3") && ($dt_array[$i] != "4")
			&& ($dt_array[$i] != "5") && ($dt_array[$i] != "6") && ($dt_array[$i] != "7") && ($dt_array[$i] != "8")
			&& ($dt_array[$i] != "9")) {
			$dt_array[$i] = "del";
		}

	}
	$dt_chuan = "";
	for ($i = 0; $i < count($dt_array); $i++) {
		if ($dt_array[$i] != "del") {
			$dt_chuan = $dt_chuan . $dt_array[$i];
		}
	}
	return $dt_chuan;
}


// $twig = new Twig();
// $twig->render('review_markup',
// [
// 	 'product'=>[
// 		'link'=>'1','icon'=>'1','name'=>'1',
// 	 ],
// 	 'star'=>5,
// 	 'date'=>1,
// 	 'content'=>'dsdsds'
// ]
// );


?>


<div class="main_fix">
	<div class="titleArea">
		<h2><font color="#555555">REVIEW</font></h2>
		<p>Sản phẩm chính hãng CKD</p>
	</div>

	<div class="wp-video">

		<div class="swiper">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="items"></div>
				</div>
			</div>
		</div>


	</div>


	<div class="video-container review-top w-60 m-auto">


		<div class="item_rv">

			<div class="video m-0 p-0 img_post zoom_hinh" data-id="601">
				<video data-id="601" src="assets/webm/300da.mp4" class="" playsinline="" autoplay="" loop=""
					   muted=""></video>
			</div>


			<div class="px-2 wp-desc">
				<p class="hinh_sp">
					<img
						src="https://ckdvietnam.com/upload/news/z4853975067091065170a3a0c72264af0ce867583476f5-2467-9442-1036-2148.webp"
						alt="Ngọc Hiếu">
					<span>Ngọc Hiếu</span>
				</p>
				<p class="mota catchuoi6">Tui mới dùng em nước thần này 1 tuần thôi mà thấy bật tông thấy rõ ấy. Chấm
					10/10 nha</p>
			</div>
		</div>
		<div class="item_rv">

			<div class="video m-0 p-0 img_post zoom_hinh" data-id="601">
				<video data-id="601" src="assets/webm/300da.mp4" class="" playsinline="" autoplay="" loop=""
					   muted=""></video>
			</div>


			<div class="px-2 wp-desc">
				<p class="hinh_sp">
					<img
						src="https://ckdvietnam.com/upload/news/z4853975067091065170a3a0c72264af0ce867583476f5-2467-9442-1036-2148.webp"
						alt="Ngọc Hiếu">
					<span>Ngọc Hiếu</span>
				</p>
				<p class="mota catchuoi6">Tui mới dùng em nước thần này 1 tuần thôi mà thấy bật tông thấy rõ ấy. Chấm
					10/10 nha</p>
			</div>
		</div>
		<div class="item_rv">

			<div class="video m-0 p-0 img_post zoom_hinh" data-id="601">
				<video data-id="601" src="assets/webm/300da.mp4" class="" playsinline="" autoplay="" loop=""
					   muted=""></video>
			</div>


			<div class="px-2 wp-desc">
				<p class="hinh_sp">
					<img
						src="https://ckdvietnam.com/upload/news/z4853975067091065170a3a0c72264af0ce867583476f5-2467-9442-1036-2148.webp"
						alt="Ngọc Hiếu">
					<span>Ngọc Hiếu</span>
				</p>
				<p class="mota catchuoi6">Tui mới dùng em nước thần này 1 tuần thôi mà thấy bật tông thấy rõ ấy. Chấm
					10/10 nha</p>
			</div>
		</div>



	</div>


</div>
<div class="all_review">

</div>
<div class="popup-video all_review">
	<!--<span>&times;</span>-->

	<div class="review_l">
		<video muted autoplay controls></video>
	</div>

	<div class="review_r">
		<div class="close_review"><i class="fas fa-times"></i></div>

		<div class="img_p">
			<img src="{{}}">

			<p>
				{{ name}}
				<span><i class="fas fa-star"></i>5 Đánh giá</span>
			</p>
		</div>

		<div class="rattot">
			<ul class="rating-score" data-rating="5">
				<i aria-hidden="" class="fas fa-star active"></i><i aria-hidden="" class="fas fa-star active"></i><i
					aria-hidden="" class="fas fa-star active"></i><i aria-hidden="" class="fas fa-star active"></i><i
					aria-hidden="" class="fas fa-star active"></i>
			</ul>
			<a class="text-sm"> Rất tốt</a><span>20/01/2024</span>
		</div>

		<div class="noidung">Chăm chỉ sử dụng mặt nạ kem lột da đẹp hẵn ra, lỗ chân lông nhỏ, da đều màu, da mặt luôn
			mát không nóng , rất đáng để ủng hộ brand uy tín này
		</div>
		<p class="td">Các đánh giá khác về sản phẩm này</p>
		<div class="hinh_p">
			<img data-id="493" src="upload/news/z5016671240264942bff92655b5eb640068b7b664bd2ca-9560.webp"
				 alt="Trần Minh Thảo "><img data-id="481"
											src="upload/news/z501357004678149db7a15e5e9eaf5d1e288346a3e5f64-9429.webp"
											alt="Tiểu Hân "><img data-id="394" src="upload/news/2-5651.webp"
																 alt="Khách hàng Mỹ Mỹ"><img data-id="588"
																							 src="upload/news/anyconvcomz50671838473556a643bbc1410dbd27b27df114682aea5-7334.webp"
																							 alt="Lan Vy"><img
				data-id="564" src="upload/news/anyconvcomz505717622999488e1f1d388b83b3619d668122bcec651-7502.webp"
				alt="Kim Anh "><img data-id="439" src="upload/news/9-3489.webp" alt="Khách hàng Hoàng Phương"><img
				data-id="398" src="upload/news/2-3080.webp" alt="Khách hàng Lan Ngọc"><img data-id="431"
																						   src="upload/news/7-7185.webp"
																						   alt="Khách hàng Hoàng Mai"><img
				data-id="502" src="upload/news/anyconvcomz50167060570531e8b4824d3a195bdb246107452c3ee03-2520.webp"
				alt="Cẩm Tiên"><img data-id="464" src="upload/news/review-sua-rua-mat-lacto6-4610.webp"
									alt="Cao Kim Ngân"><img data-id="435" src="upload/news/5-6793.webp"
															alt="Khách hàng Khánh Hòa"><img data-id="366"
																							src="upload/news/021f9b5f55ebfb72-8531.webp"
																							alt="Khách hàng Ngọc Thảo">
		</div>
	</div>

</div>
<style>
	.wp-desc{
		border: 1px solid #ddd;
		background: linear-gradient(145deg, #ffffff, #ffff);
		box-shadow: 11px 11px 22px #fff, -11px -11px 22px #ffff;
	}
	.review-top {
		display: grid;
		grid-template-columns: repeat(3, 0fr);
		grid-gap: 50px;
	}

	.review-top .item_rv{
		width: 15rem;
	}

	.photo_review_thumbnail__review_title {
		font-size: 12px;
		line-height: 18px;
		padding-bottom: 5px;
		color: black;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.photo_review_thumbnail__review_author_info {
		height: 32px;
		padding: 12px 2px 15px 2px;
		margin: 0 10px;
		border-bottom: 1px solid #f3f3f3;
		position: relative;
	}

	.popup-video {
		position: fixed;
		top: 0;
		left: 0;

		z-index: 100;
		background: rgba(0, 0, 0, .8);
		height: 100%;
		width: 100%;
		display: none;

		justify-content: space-between;
		overflow: hidden;
		flex-direction: row;
	}

	.popup-video video {
		position: absolute;
		top: 50%;
		left: 25%;

		transform: translate(0, -50%);
		width: 650px;
		border-radius: 5px;
		border: 3px solid #fff;
		object-fit: cover;
	}

	.popup-video span {
		/*position: absolute;
		top:5px;
		right: 50px;
		font-size: 50px;
		color: #fff;
		font-weight: bolder;
		z-index: 1000;
		cursor: pointer;*/
	}

	.video-container {
		position: relative;
		display: flex;
		gap: 15px;
		justify-content: center;
		padding: 10px;
	}

	.video-container .d-flex {
		border: 1px solid #303030;
	}

	.video-container .video {
		height: 250px;
		width: 250px;

		overflow: hidden;
		cursor: pointer;

	}

	.video-container .video video {
		height: 100%;
		width: 100%;
		object-fit: cover;
		transition: 0.2s linear;
	}

	.video-container .video:hover video {
		transform: scale(1.2);
	}


</style>
<script>
	document.querySelectorAll('.video-container video').forEach(
		vide => {
			vide.onclick = () => {
				document.querySelector('.popup-video').style.display = 'flex';
				document.querySelector('.popup-video video').src = vide.getAttribute('src');
			}
		});

	document.querySelector('.close_review').onclick = () => {
		document.querySelector('.popup-video').style.display = 'none';
	}
</script>


