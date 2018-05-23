<?php 
	$controller = $this->uri->segment(1);
	$class = "";
	$visibility = "";
	if ($controller == "login" || $controller == "") {
		$class = "d-none";
		$visibility = "invisible";
	}

?>

<div class="header-overlay"></div>
<header>
	
	<div class="container">
		
		<nav class="global-header">
		
			<div class="global-header__menu <?=$visibility;?>">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<div class="global-header__logo">
				<a href="<?=base_url('division');?>"><img src="<?=base_url('public/images/logos/musictribe.png');?>"></a>
			</div>
			
			<div class="global-header__lists <?=$class;?>">
				<ul>
					<li class="d-none">
						<a href="#">Sign In<img src="<?=base_url('public/images/icons/account_login.svg');?>"></li></a>
					<li>
						<a href="#">Hi <span class="text-capitalize username"><b><?=$this->session->userdata("name");?></b></span></a>
					</li>
					<li class="mr-0">
						<a href="<?=base_url('login/logout');?>" class="text-dark m-md-0">Logout <img src="<?=base_url('public/images/icons/account_login.svg');?>" class="ml-2"></a>
					</li>
				</ul>
			</div>


		</nav>	
	

	</div>


</header>