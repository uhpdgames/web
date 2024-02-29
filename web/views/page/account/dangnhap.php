<?= create_BreadCrumbs('account/dang-nhap', 'Đăng nhập') ?>
<div class="main_fix my-5">
    <div class="wrap-user">
        <div class="title-user d-flex align-items-end justify-content-between">
            <span><?= getLang('dangnhap') ?></span>
            <a href="account/quen-mat-khau" title="<?= getLang('quenmatkhau') ?>"><?= getLang('quenmatkhau') ?></a>
        </div>
        <form class="form-user validation-user" novalidate method="post" action="account/dang-nhap"
            enctype="multipart/form-data">
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                <div class="invalid-feedback"><?= getLang('vuilongnhaptaikhoan') ?></div>
            </div>
            <div class="input-group input-user">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="<?= getLang('matkhau') ?>" required>
                <div class="input-group-prepend password">
                    <div class="input-group-text"><i class="fa fa-eye-slash togglePassword" aria-hidden="true"
                            id="togglePassword"></i></div>
                </div>
                <div class="invalid-feedback"><?= getLang('vuilongnhapmatkhau') ?></div>
            </div>
            <div class="button-user d-flex align-items-center justify-content-between">
                <input type="submit" class="btn btn-primary" name="dangnhap" value="<?= getLang('dangnhap') ?>"
                    disabled>
                <div style="max-width: 2.8rem;margin-right: auto; margin-left: 1rem;">
                    <a href=" javascript:void(0)" onclick="fb_login();"><img src="assets/images/fb.png" border="0"
                            alt=""></a>
                </div>
                <div class="checkbox-user custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember-user" id="remember-user"
                        value="1">
                    <label class="custom-control-label" for="remember-user"><?= getLang('nhomatkhau') ?></label>
                </div>

            </div>


            <!--<div class="note-user d-flex justify-content-center flex-column">
				<div>
					<span><?php /*= getLang('banchuacotaikhoan') */ ?> ! </span>
					<a href="account/dang-ky" title="<?php /*= getLang('dangkytaiday') */ ?>"><?php /*= getLang('dangkytaiday') */ ?></a>

				</div>
				<div style="font-weight: bold; color: #2b4c1f; font-size: .85rem">Hoặc Đăng nhập bằng</div>

				<div class="g-signin">
					<a href="<?php /*= $this->gg->createAuthUrl() */ ?>">
						<img src="<?php /*= MYSITE */ ?>assets/images/svg/google.svg" alt="<?php /*= $seo_alt */ ?>"/>

					</a>
				</div>
			</div>-->
        </form>
    </div>
</div>
<style>
.g-signin {
    margin-top: 1rem;
    height: 3.5rem;
    width: 3.5rem;
    border: 1px solid;
    border-radius: 15px;
    background-color: black;
}

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
</style>
<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');


togglePassword.addEventListener("click", function() {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    //this.classList.toggle("fa-eye");
});
$("body").on('click', '.togglePassword', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
});
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