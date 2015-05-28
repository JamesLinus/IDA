//JavaScript functions for Users page
$(document).ready(function (){  
    
         
    $("input#submit").click(function(){
        $.ajax({
            type: "POST",
            url: "signup.php", //process to mail
            data: $('form.addUser').serialize(),
            success: function(msg){
                window.location.reload(true); 
                $("#thanks").html(msg) //show thank you
                $("#addUserModal").modal('hide'); //hide popup                                         
            },
            error: function(){
                alert("failure");
            }
        });
    });

    $('body').on('click', '.deleteUserButton',function(){
        userID = $(this).data('userid');        
        return $('#delete-User-Modal').attr('data-userid', userID);
    });

    $("#delete-User-Modal").click(function(){                       
        $.ajax({
            type: "POST",
            url: "/controllers/application/deleterecord.php", //process to mail
            data: 'userid='+ $(this).data('userid') + '&table=' + $(this).data('table'),
            success: function(msg){
                window.location.reload(true);
                $("#deleteUserModal").modal('hide'); //hide popup                                       
            },
            error: function(){
                alert("failure");
            }
        });
    });
  
});

function load_users(){
    $("#user_table_body").empty();
    $.ajax
    ({        
        dataType: "json",
        url: "/controllers/users/load_users.php",       
        success: function(data)
        {
            loading_hide();
            i=0;
            while(i < data.data.length){                
                $("#user_table_body").append(""+
                    "<tr>"+
                        "<td>" + data.data[i]['username'] + "</td>"+
                        "<td style='max-width:35%; overflow: hidden; text-overflow: ellipsis;'>" + data.data[i]['firstn'] + " " + data.data[i]['lastn'] + "</td>"+
                        "<td style='max-width:35%; overflow: hidden; text-overflow: ellipsis;'>" + data.data[i]['email']+"</td>"+
                        "<td>" + data.data[i]['branch']+"</td>"+
                        "<td>" + data.data[i]['role_name']+"</td>"+
                        "<td>" + data.data[i]['last_login']+"</td>"+
                        "<td>"+
                            "<div class='btn-group'>"+
                                "<a class='btn btn-primary' href ='useredit.php?id="+data.data[i]['userID']+"' title='Edit'><i class='glyphicon glyphicon-edit'></i></a>"+
                                "<button class='deleteUserButton btn btn-primary' data-toggle='modal' data-target='#deleteUserModal' data-table='users' data-userid="+data.data[i]['userID']+" title='Delete'><i class='glyphicon glyphicon-trash'></i></button>"+
                            "</div>"+
                        "</td>"+
                    "</tr>"+
                    "");                
                i++;               
            }
            $('#user_table').dataTable();
        }
    });
   
}

    function loading_show(){
        $('#loading').html("<span style = 'width:100%; text-align:center;'><img src='images/loading.gif'/></span>").fadeIn('fast');
    }
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }  