
//function init() {
// var dv = document.getElementsByClassName('add-image');
// for (i = 0; i < dv.length; i++) {
//
//     const key = dv[i].getAttribute('data-img');
//     const _class = dv[i].getAttribute('data-class');
//     let _id = dv[i].getAttribute('data-id');
//     let _src = dv[i].getAttribute('data-src');
// 	if(_src == '' || 'null' == typeof _src){
// 		_src= all_image[key];
// 	}else{
// 		dv[i].removeAttribute("data-src");
// 	}
//
//
//     var img = document.createElement("IMG");
//     img.src = _src;
//     img.alt = WEBSITE_NAME;
//     img.className = _class;
// 	if(_id != '' || 'null' != typeof _id){
// 		img.id = _id;
// 	}
//     img.onerror = empty_image;
//
//     dv[i].appendChild(img);
// 	dv[i].classList.add('init');
//
// 	dv[i].removeAttribute("data-class");
// }

// }
//window.onload = init;



/*
class SaveImage {
constructor(name) {
this.img = '';
this.name = name;
}

set(i) {
this.img = i

localStorage.setItem(this.name, this.img);
}

get() {
return this.img
}

check() {
return localStorage.getItem(this.name);

}
}

var empty_image = ''

var key_all_image = 'myImage';
$all_imgae = new SaveImage(key_all_image);

var all_image = $all_imgae.check(key_all_image);
if (all_image === null) {
all_image = '<?=image_default('all')?>';

if (typeof all_image != 'undefined' && all_image != '') {
$all_imgae.set(all_image);
console.log('store')
}
}
if (typeof all_image != 'undefined' && all_image != '') {
all_image = JSON.parse(all_image)

}*/
