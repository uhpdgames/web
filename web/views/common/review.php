<?php
function load_my_review($stt)
{
	$path = SHAREDPATH . "json/review{$stt}.json";
	$review = @file_get_contents($path);
	$review = (array)json_decode($review);


	$html = '<div class="my-3 swiper-review'.$stt.' swiper-container"> <div class="swiper-wrapper">';
	foreach ($review as $k => $v) {
		$v = (array)$v;
		$html .= '<div class="swiper-slide"> <div class="item_rv">';
		$html .= '<div class="m-0 p-0 img_post zoom_hinh p-1 item_img" data-id="' . $v['id'] . '">
			<img class="img viewimg img-fluid cover" data-id="' . $v['id'] . '" src="' . MYSITE . UPLOAD_NEWS_L . ($v['photo']) . '" alt="CKD COS VIET NAM - ' . $v['ten'] . '">
			</div>';
		$html .= '<div class="single_testimonial d-flex">
						<div class="testimonial_thumb item_img">
							<a class="w-100 h-100"
							   href="' . MYSITE . ($product_rv['tenkhongdauvi'] ?? '') . '">
								<img
									class="img img-fluid img-lazy"
									src="' . image_default() . '"
									data-src="' . UPLOAD_NEWS_L . ($v['icon']) . '"
									alt="CKD COS VIET NAM - ' . $v['ten'] . '"/>
							</a>
						</div>
						<div class="testimonial_content">
							<h3>' . $v['ten'] . '</h3>
							<p class="catchuoi5">' . $v['mota'] . '</p>
						</div>
					</div>';
		$html .= '</div>
			</div>';
	}

	$html .= '</div> <div class="prev slick-prev slick-arrow "></div> <div class="next slick-next slick-arrow "></div> </div>';

	echo $html;
}


load_my_review(0);
load_my_review(1);
load_my_review(2);
load_my_review(3);

?>


<style>

	.item_img{
		position: relative;
		height: 100%;
		box-shadow:rgba(233, 212, 255,50%) 0 0 1rem;

	}
	.item_img>a{
		display: block;
		width: 100%;
		height: 100%;
	}
	.item_img .img{
		width: 100%;
		height: 100%;
		object-position: center;
		object-fit: cover;
	}

</style>
