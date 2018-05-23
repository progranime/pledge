<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/header'); ?>
	
	<div class="pdf-data" data-division="<?=strtolower($divisionAndSub);?>" data-ijt="<?=$jdData[0]->internal_job_title;?>" data-location="<?=$jdData[0]->location;?>"></div>

	<div class="flash-message <?=$this->session->flashdata('status');?>">
		<p><?=$this->session->flashdata('message');?></p>
	</div>

	<div id="pdf-container" class="jd-view">	

		<?php $this->load->view('components/banner'); ?>
	
		<section class="bg-white jd_summary py-4 px-3">
			<div class="jd_summary-con jd-container container">
				<ul>
					<li>
						<p class="left">Classification</p>
						<span>:</span>
						<p class="right text-capitalize"><?=$jdData[0]->role;?></p>
					</li>
					<li>
						<p class="left">Division</p>
						<span>:</span>
						<p class="right">
							<span class="text-uppercase"><?=$jdData[0]->division;?></span>
							<span><?=$divisionsLabel[strtolower($jdData[0]->division)];?></span>
						</p>
					</li>
					<li>
						<p class="left">Sub-Division</p>
						<span>:</span>
						<p class="right text-capitalize"><?=$jdData[0]->sub_division;?></p>
					</li>
					<li>
						<p class="left">External Job Title</p>
						<span>:</span>
						<p class="right"><?=$jdData[0]->external_job_title;?></p>
					</li>
					<li>
						<p class="left">Internal Job Title</p>
						<span>:</span>
						<p class="right"><?=$jdData[0]->internal_job_title;?></p>
					</li>
				</ul>
				<ul>
					<li>
						<p class="left">Primary Service</p>
						<span>:</span>
						<p class="right"><?=$jdData[0]->primary_service;?></p>
					</li>
					<li>
						<p class="left">Secondary Service</p>
						<span>:</span>
						<p class="right"><?=$jdData[0]->secondary_service;?></p>
					</li>
					<li>
						<p class="left">Specialization</p>
						<span>:</span>
						<p class="right"><?=$jdData[0]->specialization;?></p>
					</li>
					<li>
						<p class="left">Location</p>
						<span>:</span>
						<p class="right text-capitalize"><?=$jdData[0]->location;?></p>
					</li>
				</ul>
			</div>
		</section>

		<section class="bg--gray py-4 px-3">
			<div class="jd_item jd-container container">
				<h3 class="heading">Your Promise</h3>
				<hr>
				<ul>
				<?php 
					$promiseItem = $jdData[0]->promises_statement;
					$promiseItem = json_decode($promiseItem);

					foreach($promiseItem->items as $key => $value) { ?>
					<li class="<?php echo $promiseItem->items[$key]->status == '' ? '' : 'to-be-edit' ; ?>"><span>&#9679;</span><?=$promiseItem->items[$key]->item ;?></li>
				<?php } ?>
				</ul>
			</div>
		</section>

		<section class="bg--white py-4 px-3">
			<div class="jd_item jd-container container">
				<h3 class="heading">Your Contribution</h3>
				<hr>
				
				<ul>
				<?php 
					$deliveryItem = $jdData[0]->deliveries_statement;
					$deliveryItem = json_decode($deliveryItem);
					
					foreach($deliveryItem->items as $key => $value) { ?>
					
					<li class="<?php echo $deliveryItem->items[$key]->status == '' ? '' : 'to-be-edit' ; ?>"><span>&#9679;</span><?=$deliveryItem->items[$key]->item ;?></li>
				<?php } ?>
				</ul>
			</div>
		</section>

		<section class="bg--gray py-4 px-3">
			<div class="jd_item jd-container container">
				<h3 class="heading">Your Rewards</h3>
				<hr>
				
				<ul>
				<?php 
					$rewardItem = $jdData[0]->rewards_statement;
					$rewardItem = json_decode($rewardItem);
					
					foreach($rewardItem->items as $key => $value) { ?>
					
					<li class="<?php echo $rewardItem->items[$key]->status == '' ? '' : 'to-be-edit' ; ?>"><span>&#9679;</span><?=$rewardItem->items[$key]->item ;?></li>
				<?php } ?>
				</ul>
			</div>
		</section>

	</div>

	<div class="text-center my-4 px-4 d-print-none">
		<?php if ($permission->update_permission) { ?>
		<a href="<?=base_url('division/update/') . $id . "/" . $divisionAndSub ;?>" class="btn btn-primary btn--standard mb-4 mb-sm-0">Edit</a>
		<?php } ?>
		<a href="#" class="btn btn--secondary btn-generate-pdf mb-4 mb-sm-0">Generate PDF</a>
		<a href="<?=base_url('division/dashboard/') . $divisionAndSub;?>" class="btn btn--secondary mb-4 mb-sm-0">Exit</a>
	</div>

	<div class="jd-info" data-toggle="modal" data-target="#jdInfo"><span></span>&imath;</div>
	
	<!-- Logs/History Modal -->
	<?php $this->load->view('components/history-modal');?>

	
<?php $this->load->view('components/footer'); ?>