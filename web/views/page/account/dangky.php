	<?= create_BreadCrumbs('account/dang-ky', 'Đăng ký') ?>

	<p id="profile"></p>




	<?php

    ?>



	<div class="main_fix my-0 my-md-5">
	    <div class="inner-dang-ky">
	        <div class="image-holder">
	            <img class="img-fluid h-100 w-100" src="<?= MYSITE ?>assets/images/dang-ky.webp" alt="<?= $seo_alt ?>">
	        </div>
	        <form class="form-user validation-user" novalidate method="post" action="account/dang-ky"
	            enctype="multipart/form-data">

	            <div class="text-center flex-row m-auto"
	                style="background-color: #365c26; padding-top: 0.5rem;padding-bottom: 0.1rem;">
	                <h3>
	                    <span style="color:#fff;font-size: 1.5rem;font-weight: bolder;">ĐĂNG KÝ THÀNH VIÊN CKD</span>
	                </h3>
	            </div>

	            <div class="wp-input">
	                <div class="form-holder">
	                    <div class="input-group input-user">

	                        <input type="email" class="form-control" id="email" name="email" onblur="checkEmail()"
	                            placeholder="*Email" required>
	                        <div class="invalid-feedback email"><?= getLang('vuilongnhapdiachiemail') ?></div>
	                    </div>
	                </div>
	                <div class="form-holder">
	                    <div class="input-group input-user">

	                        <input type="password" class="form-control" id="password" name="password"
	                            placeholder="*Mật khẩu" required>
	                        <div class="input-group-prepend password">
	                            <div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"
	                                    id="togglePassword"></i></div>
	                        </div>
	                        <div class="invalid-feedback"><?= getLang('vuilongnhapmatkhau') ?></div>
	                    </div>
	                </div>
	                <div class="form-holder">
	                    <div class="input-group input-user">

	                        <input type="password" class="form-control" id="repassword" name="repassword"
	                            placeholder="*Nhập lại mật khẩu" required>
	                        <div class="input-group-prepend password">
	                            <div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"
	                                    id="togglePassword2"></i></div>
	                        </div>
	                        <div class="invalid-feedback repassword"><?= getLang('vuilongnhaplaimatkhau') ?></div>
	                    </div>
	                </div>

	                <div class="form-holder checkdieukhoan">

	                    Đồng ý với <a href="<?= site_url('chinh-sach-bao-mat-thong-tin') ?>" target="_blank"
	                        style="font-weight: bold; color: #2b4c1f;">Chính sách</a> và <a
	                        style="font-weight: bold; color: #2b4c1f;" href="<?= site_url('chinh-sach-ban-hang') ?>"
	                        target="_blank">Điều khoản Dịch vụ</a> của CKD
	                </div>

	            </div>
	            <div class="wp-action w-100 vw-100 my-2">
	                <div class="button-user">
	                    <input type="submit" class="btn btn-action btn-primary btn-block" onclick="check_validate()"
	                        name="dangky" value="<?= getLang('dangky') ?>" disabled>
	                </div>




	                <div id="fb-root"></div>

	            </div>

	            <div class="wp-action w-100 vw-100 mt-0 d-flex flex-column mb-0 mb-md-2">
	                <div class="mb-2 p-0">Hoặc Đăng Ký thông qua</div>
	                <div style="max-width: 4rem;">
	                    <a href=" javascript:void(0)" onclick="fb_login();"><img src="assets/images/fb.png" border="0"
	                            alt=""></a>
	                </div>
	        </form>
	    </div>
	</div>



	<link rel="stylesheet" href="<?= site_url() ?>/assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
	<script src="<?= site_url() ?>/assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"> </script>
	<style>
.input-group-prepend.password,
.password .input-group-text {
    width: 34px;
    cursor: pointer
}

.togglePassword {
    /* margin-left: -30px; */
    cursor: pointer;
    /* height: 2rem; */
    position: absolute;
    right: 0;
    top: 13px;
    width: 34px;
    font-size: 14px;
    height: 100%;
    padding: 0 .25rem;
    justify-content: center;

    align-items: center;
    text-align: center;
    vertical-align: middle;
}

.focus {
    border-color: red;
    -webkit-box-shadow: 0px 0px 0px 1px rgba(255, 0, 0, 1);
    -moz-box-shadow: 0px 0px 0px 1px rgba(255, 0, 0, 1);
    box-shadow: 0px 0px 0px 1px rgba(255, 0, 0, 1);

}
	</style>



	<style>
.g-signin {
    margin-top: 1rem;
    height: 3.5rem;
    width: 3.5rem;
    border: 1px solid;
    border-radius: 15px;
    background-color: black;

}

.g-signin:hover {
    transform: scale(1.1);
    transition: transform 0.4s ease-in-out;
}

.checkdieukhoan {
    font-size: .85rem;
    margin-left: 6rem;
}

input::placeholder {
    opacity: 0.5;
    font-size: .85rem;
    font-weight: normal;
    text-transform: none !important;
    color: #2b4c1f !important;
}

.input-group>.custom-file,
.input-group>.custom-select,
.input-group>.form-control {
    margin-bottom: 0;
    border: none;
    border-bottom: 1px solid;
    border-radius: 0;
}

.input-group-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    /* padding: 0.375rem 0.75rem; */
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: transparent !important;

    border: none !important;
    border-bottom: 1px solid !important;
    border-radius: 0;
}

.wp-input {
    margin: 5rem 0 0
}

.wp-action {
    width: 50%;
    align-items: center;
    display: inline-flex;
    text-align: center;
    justify-content: center;
    vertical-align: middle;
}

.row.gx-0 {
    margin: 0;
    gap: 0;
}

.row.gx-0 [class*="col-"] {
    margin: 0;
    padding: 0;
}

.inner-dang-ky {
    padding: 0;
    margin: auto;
    background: #fff;
    display: flex;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    -ms-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
    -o-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
}

.image-holder {
    width: 50%;
    padding-right: 0;
}

form {
    width: 100%;
    padding-top: 77px;
    padding-right: 60px;
    padding-left: 15px;
}

.form-user {
    padding: 0 !important;
}

.form-holder {
    padding-left: 24px;
    position: relative;
    padding: 0 8rem;
}

.form-holder:before {}

.form-holder.active:before {}

.form-control {
    display: block;
    width: 100%;
    border-radius: 23.5px;
    height: 47px;
    padding: 0 24px;
    color: #808080;
    font-size: 1rem;
    border: none;
    background: #f7f7f7;
    margin-bottom: 25px;
}

.form-control::-webkit-input-placeholder {
    font-size: 1rem;
    color: #808080;
    text-transform: uppercase;

}

.form-control::-moz-placeholder {
    font-size: 1rem;
    color: #808080;
    text-transform: uppercase;

}

.form-control:-ms-input-placeholder {
    font-size: 1rem;
    color: #808080;
    text-transform: uppercase;

}

.form-control:-moz-placeholder {
    font-size: 1rem;
    color: #808080;
    text-transform: uppercase;

}

@-webkit-keyframes hvr-wobble-horizontal {
    16.65% {
        -webkit-transform: translateX(8px);
        transform: translateX(8px);
    }

    33.3% {
        -webkit-transform: translateX(-6px);
        transform: translateX(-6px);
    }

    49.95% {
        -webkit-transform: translateX(4px);
        transform: translateX(4px);
    }

    66.6% {
        -webkit-transform: translateX(-2px);
        transform: translateX(-2px);
    }

    83.25% {
        -webkit-transform: translateX(1px);
        transform: translateX(1px);
    }

    100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
}

@keyframes hvr-wobble-horizontal {
    16.65% {
        -webkit-transform: translateX(8px);
        transform: translateX(8px);
    }

    33.3% {
        -webkit-transform: translateX(-6px);
        transform: translateX(-6px);
    }

    49.95% {
        -webkit-transform: translateX(4px);
        transform: translateX(4px);
    }

    66.6% {
        -webkit-transform: translateX(-2px);
        transform: translateX(-2px);
    }

    83.25% {
        -webkit-transform: translateX(1px);
        transform: translateX(1px);
    }

    100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
    }
}

.btn-action {
    letter-spacing: 2px;
    border: none;
    width: 133px;
    height: 47px;
    margin-right: 19px;
    border-radius: 23.5px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    background: #ff9a9c;
    font-size: 15px;
    color: #fff;
    text-transform: uppercase;

    -webkit-transform: perspective(1px) translateZ(0);
    transform: perspective(1px) translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);

}

.btn:not(:disabled):not(.disabled) {
    border-radius: 30px !important;
    background-color: #233e14;
}

.button-user {
    margin-bottom: 1rem;
    margin-top: 0.5rem;
}

.btn-action:hover {
    -webkit-animation-name: hvr-wobble-horizontal;
    animation-name: hvr-wobble-horizontal;
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-timing-function: ease-in-out;
    animation-timing-function: ease-in-out;
    -webkit-animation-iteration-count: 1;
    animation-iteration-count: 1;
}

.checkbox {
    position: relative;
    padding-left: 19px;
    margin-bottom: 37px;
    margin-left: 26px;
}

.checkbox label {
    cursor: pointer;
    color: #999;
}

.checkbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkbox input:checked~.checkmark:after {
    display: block;
}

.checkmark {
    position: absolute;
    top: 2px;
    left: 0;
    height: 10px;
    width: 10px;
    border-radius: 50%;
    border: 1px solid #e7e7e7;
}

.checkmark:after {
    content: "";
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: #ff9a9c;
    position: absolute;
    display: none;
}

.form-login {
    display: flex;
    align-items: center;
    margin-left: 23px;
}

@media (max-width: 767px) {
    .form-holder {

        padding: 0 1rem;
    }

    .checkdieukhoan {
        margin-left: 0;
    }

    .inner-dang-ky {
        display: block;
    }

    .image-holder {
        width: 100%;
        padding-right: 0;
    }


    form {
        width: 100%;
        padding: 0px 15px 70px;
    }

    .inner-dang-ky {
        display: flex;
        flex-direction: column-reverse;
    }

    .image-holder {
        width: 100%;
        padding-right: 0;
        margin: 2rem 0 0 0;
    }

    .wrapper {
        background: none;
    }
}
	</style>

	<script>
function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function() {
        console.log('User signed out.');
    });
}

$(function() {
    $('.form-holder').delegate("input", "focus", function() {
        $('.form-holder').removeClass("active");
        $(this).parent().addClass("active");
    })
})
	</script>

	<script>
const togglePassword = document.querySelector('#togglePassword');
const togglePassword_repassword = document.querySelector('#togglePassword2');
const password = document.querySelector('#password');
const repassword = document.querySelector('#repassword');


togglePassword.addEventListener("click", function() {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    // this.classList.toggle("fa-eye");
});
togglePassword_repassword.addEventListener("click", function() {
    const typex = repassword.getAttribute("type") === "password" ? "text" : "password";
    repassword.setAttribute("type", typex);
    //  this.classList.toggle("fa-eye");
})

$("body").on('click', '.togglePassword', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
});

function checkEmail() {
    $email = $('#email').val();

    $.ajax({
        type: "POST",
        url: site_url() + `ajax/checkEmail`,

        data: {
            email: $email
        },
        success: function(result) {
            if (result == 'true') {

                $('#email').val(" ");
                $('.invalid-feedback.email').text("Email đã tồn tại, vui lòng thử lại.")
                    .show();

            } else {
                $('.invalid-feedback.email').text("").hide();
            }


        },

    });
}

function checkAccount() {
    $username = $('#username').val();

    $.ajax({
        type: "POST",
        url: site_url() + `ajax/checkAccount`,

        data: {
            username: $username
        },
        success: function(result) {
            if (result == 'true') {

                $('#username').val(" ");
                $('.invalid-feedback.username').text("Tài khoản đã tồn tại, vui lòng thử lại.")
                    .show();

            } else {
                $('.invalid-feedback.username').text("").hide();
            }


        },

    });
}

$('#check-confrim').change(function() {
    kiemtradongy();
});

function check_validate() {
    kiemtradongy();

    const password = $('#password').val();
    const repassword = $('#repassword').val();


    if (password != repassword) {
        $('#repassword').val("");
        $('.invalid-feedback.repassword').text("Mật khẩu không khớp nhau, vui lòng thử lại!");
    }
    const email = $('#email').val();
    if (/@gmail\.com$/.test(email)) {
        $('.invalid-feedback.email').val(" ");

    } else {
        $('#email').val(" ");
        $('.invalid-feedback.email').text("Vui lòng nhập email hợp lệ");
    }
}


$('#ngaysinh').datepicker({
    format: 'dd/mm/yyyy',
    endDate: '0y',
    datesDisabled: '0y',
});

$("#city-dangky").change(function() {
    var id = $(this).val();
    load_district(id);

});
$("#district-dangky").change(function() {
    var id = $(this).val();
    load_wards(id);
});

function kiemtradongy() {
    if ($('#check-confrim').is(":checked")) {
        $('#check-confrim').removeClass("focus");

    } else {

        $('#check-confrim').addClass("focus")


    }
}
	</script>

	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js"></script>

	<script>
window.fbAsyncInit = function() {
    FB.init({
        appId: '1763297500811269',
        oauth: true,
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse XFBML
        version: 'v18.0'
    });

    FB.AppEvents.logPageView();
};
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function fb_login() {
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', {
                    fields: 'name, email'
                }

                ,
                function(response) {
                    user_email = response.email; //get user email
                    // you can store this data into your database             


                    $.ajax({
                        type: "POST",
                        url: site_url() + `ajax/saveFB`,
                        dataType: 'json',
                        data: {
                            id_social: response.id || "",
                            ten: response.name || "",
                            email: response.email || "",
                        },
                        success: function(result) {
                            if (result) {
                                window.location.href = "account/dang-ky?uidfb=" + result;

                            }


                        },

                    });
                });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'email,public_profile'
    });
}
(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());
	</script>