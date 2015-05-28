<?
include 'header.php';

// Menu builder function, parentId 0 is the root
function buildDash($parent, $menu)
{
   $html = "";
   if (isset($menu['parents'][$parent]))
   {
      $html .= "
      <ul style='list-style:none'>\n";
       foreach ($menu['parents'][$parent] as $itemId)
       {
          if(!isset($menu['parents'][$itemId]))
          {
             $html .= "<div><a  class='dash_icon ".strtolower(str_replace(" ", "_",$menu['items'][$itemId]['label']))."' role='tab' data-toggle='tab' href='".$menu['items'][$itemId]['link']."'>  <img style='width:5em;' src='graphics/".$menu['items'][$itemId]['icon']."'></br>".$menu['items'][$itemId]['label']."</a></div>";
          }
       }
       $html .= "</ul>\n";
   }
   return $html;
}
?>
<html>
<head>
<title>IDA PBMS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="/assets/css/application.css"/>

<script data-main="/assets/javascript/main.js" src="/assets/javascript/require.js"></script>

<style>
#wrapper{
	max-width:1920px;
	margin:0 auto;
}
</style>

</head>
<body>
	<div class="container-fluid">
		<header>
			<h2><img src='/assets/images/IDA_Logo.png' style='max-height:150px' class='img-responsive logo'>
			<small>Annual Business Plan</small></h2>
		</header>
	
		<?
		include "includes/navigation.php"
		?>		
		<div class="tab-content" id='content-body'>			
			<div role='tabpanel' class='tab-pane  active' id='dashboard'>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/views/dashboard.php';?>
			</div><!--/tab-panel-->
			<div role='tabpanel' class='tab-pane' id='template'>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/views/template.php';?>
			</div><!--/tab-panel-->
			<div role='tabpanel' class='tab-pane' id='scorecard'>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/views/scorecard.php';?>
			</div><!--/tab-panel-->
			<div role='tabpanel' class='tab-pane' id='users'>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/views/users.php';?>
			</div><!--/tab-panel-->
			<div role='tabpanel' class='tab-pane' id='branchlist'>
				<?php include $_SERVER['DOCUMENT_ROOT'].'/views/branchlist.php';?>
			</div><!--/tab-panel-->
		</div><!--/tab-content -->
	</div><!--End Wrapper-->
</body>
</html>