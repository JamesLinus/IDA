<nav class="navbar navbar-default" style='background-color:lightskyblue'>
<?php
//include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

$con = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($con,$dbsel);
// Select all entries from the menu table
$result=mysqli_query($con, "SELECT id, label, link, parent FROM menu WHERE permission <= '" . $access_level . "' ORDER BY parent, sort, label ");
// Create a multidimensional array to contain a list of items and parents
$menu = array(
    'items' => array(),
    'parents' => array()
);
// Builds the array lists with data from the menu table
while ($items = mysqli_fetch_assoc($result))
{
    // Creates entry into items array with current menu item id ie. $menu['items'][1]
    $menu['items'][$items['id']] = $items;
    // Creates entry into parents array. Parents array contains a list of all items with children
    $menu['parents'][$items['parent']][] = $items['id'];
}
// Menu builder function, parentId 0 is the root
function buildMenu($parent, $menu)
{
   $html = "";
   if (isset($menu['parents'][$parent]))
   {
      $html .= "
      <ul class='nav navbar-nav'>\n";
       foreach ($menu['parents'][$parent] as $itemId)
       {
          if(!isset($menu['parents'][$itemId]))
          {
             $html .= "<li class='".strtolower(str_replace(" ", "_",$menu['items'][$itemId]['label']))."'>\n  <a href='".$menu['items'][$itemId]['link']."' role='tab' data-toggle='tab'>".$menu['items'][$itemId]['label']."</a>\n</li> \n";
          }
          if(isset($menu['parents'][$itemId]))
          {
             $html .= "
             <li class='dropdown'>\n  <a class='dropdown-toggle' data-toggle='dropdown' href='".$menu['items'][$itemId]['link']."'>".$menu['items'][$itemId]['label']."</a> \n";
             $html .= "<ul class='dropdown-menu'>".buildMenu($itemId, $menu)."</ul>";
             $html .= "</li> \n";
          }
       }
       $html .= "</ul>\n";
   }
   return $html;
}
echo buildMenu(0, $menu);
?>
<ul class="nav navbar-nav navbar-right" style="padding-right:5px"><li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li></ul>
</nav>