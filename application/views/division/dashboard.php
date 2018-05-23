<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/header'); ?>
	

	<div class="flash-message <?=$this->session->flashdata('status');?>">
		<p><?=$this->session->flashdata('message');?></p>
	</div>
	
	<div class="container jd-table__container"> 

		<div class="page-data" data-division="<?=strtolower($division);?>"></div>

		<a href="<?=base_url('division');?>" class="float-left"><img src="<?=base_url('public/images/icons/back.png');?>"></a>
		<h3 class="jd-table__title"><?=str_replace("/", " ", $divisionAndSub) . " " . $divisionsLabel[strtolower($divisionAndSub)];?></h3>
		
		<div class="jd-table__options">
			<label class="jd-label__search">Search</label>
			<input type="text" id="dataTableSearch" class="jd-search form-control">
		

			<label class="jd-label__filter">Filter</label>
			<select class="jd-filter_select form-control jd-filter <?=$permission->create_permission ? '' : 'w-xs-100' ;?>">
				<option value="all">Show All</option>
				<option value="leader">Leaders Only</option>
				<option value="contributor">Contributors Only</option>
			</select>
			
			<?php if ($permission->create_permission) { ?>
			<a href="<?=base_url('division/create/') . $divisionAndSub ;?>" class="btn jd-add"><span>+</span> Create</a>
			<?php } ?>
		</div>

		<div class="table-responsive" data-role="leader">
			<hr class="jd-hr">
			
			<img src="<?=base_url('public/images/assets/division-pledges-leaders.png');?>">
			<h3 class="mb-3 d-inline-block">Leaders</h3>

			<table class="table jd-table" id="jd-table-leaders">
				<thead>
					<tr>
						<th>Sub-Division</th>
						<th>Internal Job Title</th>
						<th>External Job TItle</th>
						<th>Primary Service</th>
						<th>Specialization</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($divisions['leader'] as $key => $value) { ?>
						<tr>
							<td><?=$value->sub_division;?></td>
							<td><?=$value->internal_job_title;?></td>
							<td><?=$value->external_job_title;?></td>
							<td><?=$value->primary_service;?></td>
							<td><?=$value->specialization;?></td>
							<td class="p-2 dt-action text-center">
								<a href="<?=base_url('division/view/') . $value->id . "/" . $divisionAndSub;?>" class="table-state">
									<img src="<?=base_url('public/images/icons/view.png');?>">
								</a>
								<a href="#" class="delete-confirmation-modal <?=$permission->delete_permission ? '' : 'disabled' ;?>" data-id="<?=$value->id;?>" data-toggle="modal">
									<img src="<?=base_url('public/images/icons/delete.png');?>">
								</a>
								<a href="<?=base_url('division/duplicate/') . $value->id . "/" . $divisionAndSub;?>" class="<?=$permission->duplicate_permission ? '' : 'disabled' ;?> table-state">
									<img src="<?=base_url('public/images/icons/duplicate.png');?>">
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="table-responsive" data-role="contributor">

			<hr class="jd-hr">

			<img src="<?=base_url('public/images/assets/division-pledges-contributors.png');?>">
			<h3 class="mb-3 d-inline-block">Contributors</h3>

			<table class="table jd-table" id="jd-table-contributors" data>
				<thead>
					<tr>
						<th>Sub-Division</th>
						<th>Internal Job Title</th>
						<th>External Job TItle</th>
						<th>Primary Service</th>
						<th>Specialization</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($divisions['contributor'] as $key => $value) { ?>
						<tr>
							<td><?=$value->sub_division;?></td>
							<td><?=$value->internal_job_title;?></td>
							<td><?=$value->external_job_title;?></td>
							<td><?=$value->primary_service;?></td>
							<td><?=$value->specialization;?></td>
							<td class="p-2 dt-action text-center">
								<a href="<?=base_url('division/view/') . $value->id . "/" . $divisionAndSub;?>" class="table-state">
									<img src="<?=base_url('public/images/icons/view.png');?>">
								</a>
								<a href="#" class="delete-confirmation-modal  <?=$permission->delete_permission ? '' : 'disabled' ;?>" data-id="<?=$value->id;?>" data-toggle="modal">
									<img src="<?=base_url('public/images/icons/delete.png');?>">
								</a>
								<a href="<?=base_url('division/duplicate/') . $value->id . "/" . $divisionAndSub;?>" class="<?=$permission->duplicate_permission ? '' : 'disabled' ;?> table-state">
									<img src="<?=base_url('public/images/icons/duplicate.png');?>">
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>


	

<?php $this->load->view('components/confirmation-modal'); ?>
<?php $this->load->view('components/footer'); ?>