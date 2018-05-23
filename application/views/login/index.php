<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/header'); ?>

	<?=form_open('login/authentication');?>
		<div class="login">
			<div class="login__container">
				<div class="login__fields">
					<h2 class="title">Pledges</h2>
					<div class="form-group">
						<input type="text" name="email" class="form-control" placeholder="MUSIC Tribe ID">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<input type="submit" name="login" class="btn btn--standard btn-block" value="Sign In">
				</div>
				<div class="login__avatar">
					<img src="<?=base_url('public/images/assets/jd-avatar.png');?>">
				</div>
			</div>
		</div>
	<?=form_close();?>

<?php $this->load->view('components/footer'); ?>