$(document).ready(function (){

    $("input#submit").click(function(){ 
        $(".message").empty();       
        $.ajax({
            type: "POST",
            url: "/controllers/branch/addbranch.php", //process to mail
            data: $('form.addBranch').serialize(),
            success: function(msg){                 
                $(".message").append(msg); //show thank you
                $("#addBranchModal").modal('hide'); //hide popup
                load_branches();                                        
            },
            error: function(){
                alert("failure");
            }
            });
    });

});

$(document).ready(function (){

    $('body').on('click', '.deleteBranchButton',function(){
        branchID = $(this).data('branchid');        
        return $('#delete-Branch-Modal').attr('data-branchid', branchID);
    });

    $("#delete-Branch-Modal").click(function(){
        $(".message").empty();                       
        $.ajax({
            type: "POST",
            url: "/controllers/application/deleterecord.php", //process to mail
            data: 'branchid='+ $(this).data('branchid') + '&table=' + $(this).data('table'),
            success: function(msg){                
                $("#deleteBranchModal").modal('hide'); //hide popup 
                $(".message").append(msg); 
                load_branches();                                     
            },
            error: function(){
                alert("failure");
            }
        });
    });
});

function load_branches(){
    try{
        $("#branch_table_body").empty();
    	$.ajax
        ({
            dataType: "json",
            url: "/controllers/branch/load_branches.php",        
            success: function(data)
            {
                i=0;
                while(i < data.data.length){
                    if(data.data[i]['branchid'] != 0){
                        fy_start = data.data[i]['FY_start']
                        $("#branch_table_body").append(""+
                            "<tr>"+
                                "<td>" + data.data[i]['branch'] + "</td>"+
                                "<td>" + data.data[i]['FY_start'] +"</td>"+
                                "<td>" + data.data[i]['branch_head']+"</td>"+
                                "<td>" + data.data[i]['branch_phone']+"</td>"+
                                "<td>"+
                                    "<div class='btn-group'>"+
                                        "<a class='btn btn-primary' href ='branchedit.php?id="+data.data[i]['branchid']+"'><i class='glyphicon glyphicon-edit'></i></a>"+
                                        "<button class='deleteBranchButton btn btn-primary' data-toggle='modal' data-target='#deleteBranchModal' data-table='branch' data-branchid="+ data.data[i]['branchid'] +" title='Delete'><i class='glyphicon glyphicon-trash'></i></button>"+
                                    "</div>"+
                                "</td>"+
                            "</tr>"+
                            "");
                    };
                    i++;
                }
                $('#branch_table').dataTable();
            }

        });
    } catch(err) {
            $('#branch').html('/errors/broken.html');
        }
}

