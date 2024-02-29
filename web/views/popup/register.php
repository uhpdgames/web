<div class="modal register" id="registerModal">

	<div class="modal-dialog login animated">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Register with</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div class="content">
						<div class="social" data-turbolinks="false">
							<a id="github_login" class="circle github" rel="nofollow"
							   href="/social/github?destination=product_page&amp;subscribed=1&amp;url=https%253A%252F%252Fwww.creative-tim.com%252Fproduct%252Flogin-and-register-modal">
								<i class="icon-github"></i>
							</a> <a id="google_login" class="circle google" rel="nofollow"
									href="/social/google_oauth2?destination=product_page&amp;subscribed=1&amp;url=https%253A%252F%252Fwww.creative-tim.com%252Fproduct%252Flogin-and-register-modal">
								<i class="fa fa-google"></i>
							</a> <a id="facebook_login" class="circle facebook" rel="nofollow"
									href="/social/facebook?destination=product_page&amp;subscribed=1&amp;url=https%253A%252F%252Fwww.creative-tim.com%252Fproduct%252Flogin-and-register-modal">
								<i class="icon-facebook-alt"></i>
							</a></div>
						<div class="division">
							<div class="line l"></div>
							<span>or</span>
							<div class="line r"></div>
						</div>
						<div class="error inside-alert"></div>
						<div class="form loginBox" style="display: none;">
							<form html="multipart true" action="/login" accept-charset="UTF-8" data-remote="true"
								  method="post">
								<input type="text" name="email" class="form-control" placeholder="Email">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<input type="hidden" name="destination" value="product_page" autocomplete="off">
								<input type="hidden" name="url"
									   value="https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Flogin-and-register-modal"
									   autocomplete="off">
								<div class="row">
									<div class="col-md-12">
										<input type="submit" name="commit" value="Login"
											   class="btn btn-default btn-login" data-disable-with="Login">
									</div>
									<div class="col-md-12 mt-24 d-flex justify-content-center">
										<script src="https://www.recaptcha.net/recaptcha/api.js" async=""
												defer=""></script>
										<div data-sitekey="6LfJvgsTAAAAALbDuISbCDo1l6qyX_YrPT59xaVk"
											 class="g-recaptcha ">
											<div style="width: 304px; height: 78px;">
												<div>
													<iframe title="reCAPTCHA" width="304" height="78"
															role="presentation" name="a-s5go2lsia9xd" frameborder="0"
															scrolling="no"
															sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"
															src="https://www.recaptcha.net/recaptcha/api2/anchor?ar=1&amp;k=6LfJvgsTAAAAALbDuISbCDo1l6qyX_YrPT59xaVk&amp;co=aHR0cHM6Ly93d3cuY3JlYXRpdmUtdGltLmNvbTo0NDM.&amp;hl=vi&amp;v=u-xcq3POCWFlCr3x8_IPxgPu&amp;size=normal&amp;cb=w6kscvd5xe9s"></iframe>
												</div>
												<textarea id="g-recaptcha-response" name="g-recaptcha-response"
														  class="g-recaptcha-response"
														  style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
											</div>
											<iframe style="display: none;"></iframe>
										</div>
										<noscript>
											<div>
												<div style="width: 302px; height: 422px; position: relative;">
													<div style="width: 302px; height: 422px; position: absolute;">
														<iframe
															src="https://www.recaptcha.net/recaptcha/api/fallback?k=6LfJvgsTAAAAALbDuISbCDo1l6qyX_YrPT59xaVk"
															name="ReCAPTCHA"
															style="width: 302px; height: 422px; border-style: none; border: 0; overflow: hidden;">
														</iframe>
													</div>
												</div>
												<div style="width: 300px; height: 60px; border-style: none;
                bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
                background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
                <textarea id="g-recaptcha-response" name="g-recaptcha-response"
						  class="g-recaptcha-response"
						  style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
                  margin: 10px 25px; padding: 0px; resize: none;">
                </textarea>
												</div>
											</div>
										</noscript>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="box">
					<div class="content registerBox" style="">
						<div class="form">
							<form html="multipart true" action="/register" accept-charset="UTF-8" data-remote="true"
								  method="post">
								<input type="text" name="email" class="form-control" placeholder="Email">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<input type="password" name="password_confirmation" class="form-control"
									   placeholder="Repeat Password">
								<input type="hidden" name="destination" value="product_page" autocomplete="off">
								<input type="hidden" name="url"
									   value="https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Flogin-and-register-modal"
									   autocomplete="off">
								<label class="checkbox">
									<span class="icons"><span class="first-icon fa fa-square-o"></span><span
											class="second-icon fa fa-check-square-o"></span></span><input
										type="checkbox" value="1" data-toggle="checkbox" name="subscribed"
										class="ct-info checkbox-subscribe">
									Subscribe me to the Newsletter
								</label>
								<input type="submit" name="commit" value="Create account"
									   class="btn btn-default btn-register" data-disable-with="Create account">
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="forgot login-footer" style="display: none;">
<span>Looking to
<a href="javascript: showRegisterForm();" rel="nofollow">create an account</a>
?</span>
					<br>
					<span><a rel="nofollow" href="/forgot-password">Forgot password</a> ?</span>
				</div>
				<div class="forgot register-footer" style="">
					<span>Already have an account?</span>
					<a href="javascript: showLoginForm();">Login</a>
				</div>
			</div>
		</div>
	</div>

</div>
