/*

const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
	direction: "vertical",
	slidesPerView: 3,
	spaceBetween: 32,
	navigation: {
		nextEl: ".slider__next",
		prevEl: ".slider__prev",
	},
	autoplay: {
		delay: 3500,
	},
	freeMode: true,
	breakpoints: {
		0: {
			slidesPerView: 2,
			direction: "vertical",
		},
		768: {
			slidesPerView: 2,
			direction: "vertical",
		},
		990: {
			slidesPerView: 3,
			direction: "vertical",
		},

	},
});

const sliderImages = new Swiper(".slider__images.detail-swiper .swiper-container", {
	autoplay: {
		delay: 3500,
	},
	direction: "horizontal",
	slidesPerView: 1,
	spaceBetween: 16,
	mousewheel: true,
	// navigation: {
	// 	nextEl: ".slider__next",
	// 	prevEl: ".slider__prev",
	// },
	grabCursor: true,
	thumbs: {
		swiper: sliderThumbs,
	},
	breakpoints: {
		0: {
			slidesPerView: 1,
			spaceBetween: 16,
			direction: "horizontal",
		},
		768: {
			slidesPerView: 1,
			spaceBetween: 16,
			direction: "horizontal",
		},
	},
});

const sliderReivew = new Swiper('.review-swiper', {
	direction: "horizontal",
	slidesPerView: 4,
	spaceBetween: 0,
	freeMode: true,
	loop: true,
	autoplay: {
		delay: 3000,
	},
	breakpoints: {
		0: {
			loop: false,
		},
		768: {
			loop: false,
		},
		990: {
			loop: false,
		},
	},
});

*/

// JavaScript để xử lý Scrollspy
window.addEventListener("scroll", function () {
	const sections = document.querySelectorAll(".section");
	let currentSection = "";

	sections.forEach((section) => {
		const sectionTop = section.offsetTop - 100;
		const sectionHeight = section.clientHeight;
		if (
			pageYOffset >= sectionTop &&
			pageYOffset < sectionTop + sectionHeight
		) {
			currentSection = section.getAttribute("id");
		}
	});

	const navLinks = document.querySelectorAll(".nav-link");

	// khi click vào tab thì sẽ scroll đến section tương ứng và active tab đó ngay lập tức và khi scroll thì tab đó sẽ active theo section tương ứng
	navLinks.forEach((link) => {
		link.addEventListener("click", () => {
			for (let i = 0; i < navLinks.length; i++) {
				navLinks[i].classList.remove("active");
			}
			link.classList.add("active");
			const target = link.getAttribute("href").substring(1);
			const targetSection = document.getElementById(target);
			window.scrollTo({
				top: targetSection.offsetTop - 180,
				behavior: "smooth",
			});
		});
	});

	navLinks.forEach((link) => {

		link.classList.remove("active");
		if (link.getAttribute("href").substring(1) == (currentSection)) {
			link.classList.add("active");
		}
	});

	const navbar = document.getElementById("navbar");
	const cover_nav_link = document.querySelectorAll(".cover-nav-link");
	var block = $('#details').outerHeight();


	if (window.scrollY > block) {
		//  cover-nav-link thêm class not_fixed
		cover_nav_link.forEach((link) => {
			link.classList.remove("not_fixed");
			link.classList.remove("fix-padding-one");

		});

		navbar.style.position = "fixed";
		//box-shadow: 0 2px 5px #dfdbdb
		navbar.style.boxShadow = "0 2px 5px #dfdbdb";
		spnarbar.style.display = "block";


	} else {
		cover_nav_link.forEach((link) => {
			link.classList.add("not_fixed");
			link.classList.add("fix-padding-one");
		});

		navbar.style.position = "static";
		navbar.style.boxShadow = "none";
		spnarbar.style.display = "none";
	}
});
