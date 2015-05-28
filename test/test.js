$(document).ready(function(){
	$.ajax({
       type: "GET",
       url: "image.html",
       success: function(result){
       	
       		$.ajax({
       			type: "POST",
       			url: "embed.php",
       			data: {html: result},
       			success: function(result){
       				$('.result').html(result);
       	 		}
       		});
   		}
	});
});          