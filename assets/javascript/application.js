$('.edit_template').click(function(){
  $('.navbar').children().removeClass('active');
  $('.tab-content').children().removeClass('active');
  $('#template').addClass('active');  
  console.log('template page loaded');
});
$('.home').click(function(){
  $('.navbar').children().removeClass('active');
  $('.tab-content').children().removeClass('active');
  $('#dashboard').addClass('active');  
  console.log('template page loaded');
});
$('.view_edit_scorecards').click(function(){
  $('.navbar').children().removeClass('active');
  $('.tab-content').children().removeClass('active');
  $('#scorecard').addClass('active');  
  console.log('template page loaded');
});
$('.user_maintenance').click(function(){
  $('.navbar').children().removeClass('active');
  $('.tab-content').children().removeClass('active');
  $('#users').addClass('active');  
  console.log('template page loaded');
  load_users();
});
$('.branch_list').click(function(){
  $('.navbar').children().removeClass('active');
  $('.tab-content').children().removeClass('active');
  $('#branchlist').addClass('active'); 
  console.log('branch page loaded'); 
  load_branches();
});

function checkVersion()
{
  var msg = "You're not using Internet Explorer.";
  var ver = getInternetExplorerVersion();

  if ( ver > -1 )
  {
    if ( ver >= 8.0 ) 
      msg = "It appears you are using Internet Explorer " + ver + "\nIt is recommended that you use either Google Chrome or Mozilla Firefox to use this site. \nContact michael.anuszewski@gmail.com if you have any questions."
    else
      msg = "It appears you are using Internet Explorer " + ver + "\nIt is recommended that you use either Google Chrome or Mozilla Firefox to use this site. \nContact michael.anuszewski@gmail.com if you have any questions. \nBy the way, you should upgrade your copy of Internet Explorer.";
	alert( msg );
  }
  
}

function getInternetExplorerVersion()
{
  var rv = -1;
  if (navigator.appName == 'Microsoft Internet Explorer')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  else if (navigator.appName == 'Netscape')
  {
    var ua = navigator.userAgent;
    var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null)
      rv = parseFloat( RegExp.$1 );
  }
  return rv;
}