<?php $this->load->view('components/head'); ?>
<?php $this->load->view('components/header'); ?>
<?php $this->load->view('components/banner'); ?>
	
	<div class="user-data" data-id="<?=$jdData[0]->id;?>" data-division="<?=strtolower($jdData[0]->division);?>" data-role="<?=strtolower($jdData[0]->role);?>"></div>
	<?=form_open('division/duplicateJd/' .  $id . "/" . $divisionAndSub);?>

		<section class="py-4">
			<div class="container">
				
				<div class="row">
					<div class="col-12 col-sm-6">

						<div class="form-group">
							<label for="role">Classification</label>
							<select class="form-control filter-role filter-select" name="role" id="role" required>
								<?php foreach ($roles as $role) { ?>
									<?php if (strtolower($role) == strtolower($jdData[0]->role)) { ?>
									<option value="<?=strtolower($role);?>" selected><?=$role;?></option>
									<?php } else { ?>
									<option value="<?=strtolower($role);?>" ><?=$role;?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-12 col-sm-6">
									<label for="division">Division</label>
									<select class="form-control filter-division filter-select" name="division" id="division" required>
										<?php foreach ($divisions as $key => $value) { ?>
											<?php if (strtolower($value) == strtolower($divisionAndSub)) { ?>
												<option value="<?=strtolower($value);?>" selected><?=strtoupper($value) . " " . $divisionsLabel[strtolower($value)];?></option>
											<?php } else { ?>
												<option value="<?=strtolower($value);?>" ><?=strtoupper($value) . " " . $divisionsLabel[strtolower($value)];?></option>
											<?php } ?>
										<?php } ?>
									</select> 
								</div>
								<div class="col-12 col-sm-6 pt-3 pt-sm-0">
									<label for="sub-division">Sub-Division</label>
									<input type="text" name="sub_division" id="sub_division" class="sub-division form-control" value="<?=$jdData[0]->sub_division;?>">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="external_job_title">External Job Title</label>
							<input type="text" name="external_job_title" id="external_job_title" class="form-control" value="<?=$jdData[0]->external_job_title;?>" maxlength="256" required/>
						</div>

						<div class="form-group">
							<label for="internal_job_title">Internal Job Title</label>
							<input type="text" name="internal_job_title" id="internal_job_title" class="form-control" value="<?=$jdData[0]->internal_job_title . ' (copy)';?>"  maxlength="256" required/>
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="primary_service">Primary Service</label>
							<input type="text" name="primary_service" id="primary_service" class="form-control" value="<?=$jdData[0]->primary_service;?>" maxlength="256" required/>
						</div>

						<div class="form-group">
							<label for="secondary_service">Secondary Service</label>
							<input type="text" name="secondary_service" id="secondary_service" class="form-control" value="<?=$jdData[0]->secondary_service;?>" maxlength="256" required/>
						</div>

						<div class="form-group">
							<label for="specialization">Specialization</label>
							<input type="text" name="specialization" id="specialization" class="form-control" value="<?=$jdData[0]->specialization;?>" maxlength="256" required/>
						</div>

						<div class="form-group">
							<label for="location">Location</label>
							<select class="form-control" name="location" id="location" data-bind="location" required>
								<option value="" selected disabled></option>
								<?php foreach ($countries as $country) { ?>
									<?php if (strtolower($country) == strtolower($jdData[0]->location)) { ?>
										<option value="<?=strtolower($country);?>" selected><?=$country;?></option>
									<?php } else { ?>
										<option value="<?=strtolower($country);?>"><?=$country;?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>

					</div>

				</div>

			</div>
		</section>

		<!-- Start of Your Template -->
		
		<?php $this->load->view("hbTemplates/jdTemplate.html"); ?>

		<!-- End of Your Template -->
		
		<div class="text-center my-4 px-4 form-buttons d-none">
			<input type="submit" name="submit" value="Save" class="btn btn-primary btn--standard mb-3 m-sm-0">
			<a href="<?=base_url('division/dashboard/') . $division;?>" class="btn btn--secondary">Cancel</a>
		</div>

	<?=form_close();?>

<?php $this->load->view('components/footer'); ?>