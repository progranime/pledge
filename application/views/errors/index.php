<?php $this->load->view('components/head'); ?>

	<header>
		<div class="container">
			<nav class="global-header">
				<div class="global-header__logo" style="flex: 100%; max-width: 100%;">
					<a href="<?=base_url('division');?>"><img src="<?=base_url('public/images/logos/musictribe.png');?>"></a>
				</div>
			</nav>	
		</div>

	</header>

	<div class="container error__container">
		<div class="row">
			<div class="error__avatar">
				<img src="<?=base_url('public/images/assets/jd-avatar.png');?>">
			</div>
			<div class="error__message">
				<h1 class="error__message-title">Oops!</h1>
				<h2 class="error__message-subtitle">We can't seem to find the page you're looking for.</h2>
				<!-- <p>Click here to go back <a href="#" class="go-back"><b>HERE</b></a></p> -->
				<a href="#" class="btn btn--standard go-back">GO BACK</a>
			</div>
		</div>
	</div>

<?php $this->load->view('components/footer'); ?>