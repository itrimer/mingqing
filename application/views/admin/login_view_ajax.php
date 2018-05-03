<div id="form_div" title="用户登录">
<form action="<?php echo base_url('/admin/login/login_do')?>" method="post" id="formEdit" name="formEdit"
 onsubmit="return validate(this);">
	<ul>
		<li>
			<label for="email" class="desc">用户名:</label>
			<div>
				<input name="username" type="text" tabindex="1" maxlength="255" value="" class="field text full required" title="用户名"/>
			</div>
		</li>
		<li style="margin-top: 25px;">
			<label for="password" class="desc">密码:</label>
			<div>
				<input name="password" type="password" tabindex="2" maxlength="255" value="" class="field text full required" title="密码"/>
			</div>
		</li>
	</ul>
</form>
</div>