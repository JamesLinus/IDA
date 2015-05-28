var drawerIsOpen = false;

function openDrawer()
{
    $(".devdrawer ul").show();
	$(".main_page").animate({width: "280px"}, 300);
	$(".main_page").css("overflow", "hidden");
	$(".devdrawer").animate({width: "280px"}, 300);
}
function closeDrawer()
{
    $(".devdrawer ul").hide();
	$( ".main_page" ).animate({width: "280px"}, 300);
	$(".main_page").css("overflow", "auto");
	$(".devdrawer").animate({width: "-280px"}, 300);
}	
function toggleDrawer()
{
	if(drawerIsOpen)
	{
		closeDrawer();
		drawerIsOpen = false;
	}
	else
	{
		openDrawer();
		drawerIsOpen = true;
	}
}