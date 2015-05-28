<?
$conf = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/includes/config.ini.php");
$dbhost = $conf['dbhost'];
$dbuser = $conf['dbuser'];
$dbpass = $conf['dbpass'];
$dbsel = $conf['dbsel'];

//Get Version Number
$version = $conf['version'];

//Set Default Time zone
date_default_timezone_set('UTC');

//Get Announcement Limits
$pbms_limit = $conf['pbms_limit'];
$sys_limit = $conf['sys_limit'];

function admin_announcements($show) {
//RSS feed for System messages
	$conf = parse_ini_file("config.ini.php");
	$feedurl = $conf['adminfeed'];

    $rss = new DOMDocument();
    $rss->load($feedurl);

    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array(
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        array_push($feed, $item);
        //print_r ($rss);
        
    }

    if (count($feed) < $show)
        $limit = count($feed);
    else
        $limit = $show;
    for ($x = 0; $x < $limit; $x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $content = $feed[$x]['content'];
        $date = date('l F d, Y', strtotime($feed[$x]['date']));
        echo '<h4>' . $title . '</h4><br />';
        echo '<small><em>Posted on ' . $date . '</em></small></p>';
        echo '<p>'.$content.'</p>';
        echo '<hr>';
    }
}

function PBMS_announcements($show) {
//RSS feed for PBMS
	$conf = parse_ini_file("config.ini.php");
	$feedurl = $conf['pbmsfeed'];
	
			$sValidator = 'http://feedvalidator.org/check.cgi?url=';

		if( $sValidationResponse = @file_get_contents($sValidator . urlencode($feedurl)) )
		{
			if( stristr( $sValidationResponse , 'This is a valid RSS feed' ) !== false )
			{
				$rss = new DOMDocument();
				$rss->load($feedurl);

				$feed = array();
				foreach ($rss->getElementsByTagName('item') as $node) {
					$item = array(
					'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
					'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
					'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
					'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
				);
				array_push($feed, $item);
				}
				if (count($feed) < $show)
				$limit = count($feed);
				else
					$limit = 3;
					for ($x = 0; $x < $limit; $x++) {
						$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
						$link = $feed[$x]['link'];
						$content = $feed[$x]['content'];
						$date = date('l F d, Y', strtotime($feed[$x]['date']));
						echo '<p><strong><a href="' . $link . '" title="' . $title . '">' . $title . '</a></strong><br />';
						echo '<small><em>Posted on ' . $date . '</em></small></p>';
						echo $content;
					}		
				return true;
			}
			else
			{
				Echo "<span style='color:red'>The URL provided is not a valid RSS feed. Please check your entry for 'PBMS Feed' on the config page. If you have any questions contact your Web Master for assistance </span>";
				return false;
			}
		}
		else
		{
			Echo "<span style='color:red'>The URL provided is not a valid RSS feed. Please notify web Master if you have any questions</span>";
			return false;
		}
	
	IF ($feedurl = 'NULL'){
		echo "PBMS Feed is not yet configured. Please Contact Webmaster for more information";
		}
	ELSE
	{
    $rss = new DOMDocument();
    $rss->load($feedurl);

    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array(
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'content' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        array_push($feed, $item);
    }
    if (count($feed) < $show)
        $limit = count($feed);
    else
        $limit = 3;
    for ($x = 0; $x < $limit; $x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $content = $feed[$x]['content'];
        $date = date('l F d, Y', strtotime($feed[$x]['date']));
        echo '<p><strong><a href="' . $link . '" title="' . $title . '">' . $title . '</a></strong><br />';
        echo '<small><em>Posted on ' . $date . '</em></small></p>';
        echo $content;
    }
	}
}

//Populate a drop down with all the available Fiscal Years
//name = "fiscal_year"
function fy_dropdown() {
    require 'dbconnect.php';
    echo "<select name='fiscal_year' id='fiscal_year'>";
    $sql = "SELECT DISTINCT fiscal_year FROM Main";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        echo'<option value="' . $row['fiscal_year'] . '">' . $row['fiscal_year'] . '</option>';
    }
    echo"</select>";
}

//Populate a drop down with all branches
//name = "branch"
function branch_dropdown($dbhost, $dbuser, $dbpass) {
    $con = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($con, "IDA");

    echo "<select class='form-control' name='branch' id='branch'>";
    
    $sql = "SELECT * FROM branch";
    $result = mysqli_query($con, $sql);
    
    
    while ($row = mysqli_fetch_array($result)) {
        echo'<option value="' . $row['branchid'] . '">' . $row['branch'] . '</option>';
    }

    echo "</select>";
}

function user_branch_dropdown($dbhost, $dbuser, $dbpass, $branch) {
    $con = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($con, "IDA");

    echo "<select class='form-control' name='branch' id='branch'>";
    
    $sql = "SELECT * FROM branch";
    $result = mysqli_query($con, $sql);   
    
    while ($row = mysqli_fetch_array($result)) {
		if ($branch == $row['branchid'])
			$selected = "selected";
		else
			$selected = "";
        echo'<option value="' . $row['branchid'] . '"'.$selected.'>' . $row['branch'] . '</option>';
    }

    echo "</select>";
}

function focarea_dropdown($dbhost, $dbuser, $dbpass, $type) {
    $con = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($con, "IDA");
	
    echo "<select class='form-control' name='focarea' id='focarea'>";
    
    $sql = "SELECT * FROM Focus_areas WHERE (`type` = '$type') OR (`type` = 'All')";
    $result = mysqli_query($con, $sql);
    
	If (!mysqli_query($con, $sql))
		echo("Error description: " . mysqli_error($con));
	else    
    while ($row = mysqli_fetch_array($result)) {
        echo'<option value="' . $row['focus_id'] . '">' . $row['foc_area'] . '</option>';
    }

    echo "</select>";	
}
//function to determine if user is a branch, admin, or branchadmin 
function is_loggedin() {
    if (is_user_logged_in()) {
        
    } else {
        header('Location: http://myserver.dyndns-home.com/wp-login.php');
    };
}

function rssfeed() {
    ?>
    <div style="margin:auto; margin-top: 40px; width:95%;">
        <fieldset id="PBMSannouncements" style="float:left; width:60%">
            <legend style="font-size:25px">PBMS Announcements</legend>
            <? PBMS_announcements(5); ?>
        </fieldset>
        <fieldset id="systemmessages" style="float:right; width:30%; border:1px solid">
            <legend style="font-size:25px">System Announcements</legend>
            <? admin_announcements(5); ?>
        </fieldset>
    </div>
    <?
}

function navigation($dbhost, $dbuser, $dbpass, $access_level) {
    ?>
    <nav>
    <?php
    
//include_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    $con = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($con, "IDA");
// Select all entries from the menu table
    $result = mysqli_query($con, "SELECT id, label, link, parent FROM menu WHERE permission <= '" . $access_level . "' ORDER BY parent, sort, label ");
// Create a multidimensional array to contain a list of items and parents
    $menu = array(
        'items' => array(),
        'parents' => array()
    );
// Builds the array lists with data from the menu table
    while ($items = mysqli_fetch_assoc($result)) {
        // Creates entry into items array with current menu item id ie. $menu['items'][1]
        $menu['items'][$items['id']] = $items;
        // Creates entry into parents array. Parents array contains a list of all items with children
        $menu['parents'][$items['parent']][] = $items['id'];
    }

// Menu builder function, parentId 0 is the root
    function buildMenu($parent, $menu) {
        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "
      <ul>\n";
            foreach ($menu['parents'][$parent] as $itemId) {
                if (!isset($menu['parents'][$itemId])) {
                    $html .= "<li>\n  <a href='" . $menu['items'][$itemId]['link'] . "'>" . $menu['items'][$itemId]['label'] . "</a>\n</li> \n";
                }
                if (isset($menu['parents'][$itemId])) {
                    $html .= "
             <li>\n  <a href='" . $menu['items'][$itemId]['link'] . "'>" . $menu['items'][$itemId]['label'] . "</a> \n";
                    $html .= buildMenu($itemId, $menu);
                    $html .= "</li> \n";
                }
            }
            $html .= "</ul>\n";
        }
        return $html;
    }

    echo buildMenu(0, $menu);
    ?>
    </nav>
        <?
    }
    ?>

