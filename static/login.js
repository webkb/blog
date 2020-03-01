document.getElementsByClassName("loginform")[0].onsubmit = function () {
	var username = document.getElementsByName("username")[0].value;
	var password = document.getElementsByName("password")[0].value;
	var data = 'action=login&username=' + username + '&password=' + password;

	var loginHeader = document.querySelector(".loginnotice h1");
	var loginNotice = document.querySelector(".loginnotice div");
	var loginSubtmit = document.getElementsByClassName("submit")[0];

	loginHeader.className = 'submitStatus';
	loginNotice.className = '';
	loginNotice.innerHTML = '';

	loginSubtmit.value = '登录中。。。';
	loginSubtmit.disabled = true; 



	xc_ajax.post(this.action, data ,function(response) {
		response = JSON.parse(response);
		if (response.success) {
			if (document.referrer.indexOf('reg.php')<0 || document.referrer.indexOf('login.php')<0 || document.referrer.indexOf('logout.php')<0) {
				location = 'index.php';
			} else {
				location = document.referrer;
			}
		} else {
			setTimeout(() => {
				loginHeader.className = '';
			}, 3000);
			loginNotice.className = 'errorStatus';
			loginNotice.innerHTML = response.msg;

			loginSubtmit.value = '登录';
			loginSubtmit.disabled = false; 
		}
	});
	return false;
}