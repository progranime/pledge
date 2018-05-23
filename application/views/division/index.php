<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/header'); ?>
	
		
	<div class="division">
		
		<div class="container division__container">
		
			<h2 class="division__title">Select Division</h2>

			<div class="row">
				<?php foreach($divisions as $key => $value) { ?>
					<div class="col-6 col-md-3 division__item">
						<a href="<?=base_url('division/dashboard/') . $value;?>">
							<img src="<?=base_url('public/images/assets/divisions/'. $value .'.png');?>">
							<p><?=$value;?></p>
						</a>
					</div>
				<?php } ?>
			</div>

		</div>


	</div>

	
<?php $this->load->view('components/footer'); ?>