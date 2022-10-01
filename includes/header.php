<?php
	$logado = $_SESSION['login'];
?>

<div id="wrapper">

	<header id="header">

		<span id="site-logo">
			<a href="<?php echo BASEURL_SGT; ?>">
				<img src="<?php echo BASEURL_SGT; ?>assets/img/logos/logo.png" alt="Site Logo" style="width:19%"/>
			</a>
		</span>

		<a href="javascript:;" data-toggle="collapse" data-target=".top-bar-collapse" id="top-bar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-cog"></i>
		</a>

		<a href="javascript:;" data-toggle="collapse" data-target=".sidebar-collapse" id="sidebar-toggle" class="navbar-toggle collapsed">
			<i class="fa fa-reorder"></i>
		</a>

	</header> <!-- header -->


	<nav id="top-bar" class="collapse top-bar-collapse">
		<ul class="nav navbar-nav pull-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
		        	<?php echo $_SESSION['nome']; ?>
		        	<span class="caret"></span>
		    	</a>

		    	<ul class="dropdown-menu" role="menu">
			        <!--<li>
			        	<a href="<?php echo BASEURL; ?>assets/page-profile.html">
			        		<i class="fa fa-user"></i>
			        		&nbsp;&nbsp;My Profile
			        	</a>
			        </li>
			        <li>
			        	<a href="<?php echo BASEURL; ?>assets/page-calendar.html">
			        		<i class="fa fa-calendar"></i>
			        		&nbsp;&nbsp;My Calendar
			        	</a>
			        </li>
			        <li>
			        	<a href="<?php echo BASEURL; ?>assets/page-settings.html">
			        		<i class="fa fa-cogs"></i>
			        		&nbsp;&nbsp;Settings
			        	</a>
			        </li>
			        <li class="divider"></li>-->
			        <li>
			        	<a href="<?php echo BASEURL_SGT?>logout">
			        		<i class="fa fa-sign-out"></i>
			        		&nbsp;&nbsp;Logout
			        	</a>
			        </li>
		    	</ul>
		    </li>
		</ul>

	</nav> <!-- /#top-bar -->



<!-- Encerra conexao -->
<?php
	//check if the get variable exists
	if (isset($_GET['fn']))
	{
		excluisessao();
	}
?>