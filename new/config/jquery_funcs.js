


function submit_form(formName, btnName, btnOValue, btnInput=false, url, bMsg, sMsg, redirectTo)
{
    $('#'+btnName).click(function (e) {
        e.preventDefault();
        $.ajax({
            url:"ajax/"+url+".php",
            method: "POST",
            data:$('#'+formName).serialize(),
            beforeSend: function(){
                $('#'+btnName).attr('disabled', true);
                if(btnInput == false) $('#'+btnName).html(bMsg);
                if(btnInput == true) $('#'+btnName).val(bMsg);
            },
            success:function(data){
                if(data == 200){
                    toastr.success(sMsg, "Success!");
                    setTimeout( function(){ 
                        window.location.href = redirectTo; 
                    }, 3000);
                }
                else{
                    toastr.error(data, "Caution!");
                }
                $('#'+btnName).attr('disabled', false);
                if(btnInput == false) $('#'+btnName).html(btnOValue);
                if(btnInput == true) $('#'+btnName).val(btnOValue);
            }
        });     
    });
}





function submit_form_get(formName, btnName, btnOValue, btnInput=false, url, bMsg, sMsg, redirectTo)
{
    $('#'+btnName).click(function (e) {
        e.preventDefault();
        $.ajax({
            url:"ajax/"+url+".php",
            method: "GET",
            data:$('#'+formName).serialize(),
            beforeSend: function(){
                $('#'+btnName).attr('disabled', true);
                if(btnInput == false) $('#'+btnName).html(bMsg);
                if(btnInput == true) $('#'+btnName).val(bMsg);
            },
            success:function(data){
                if(data == 200){
                    toastr.success(sMsg, "Success!");
                    setTimeout( function(){ 
                        window.location.href = redirectTo; 
                    }, 3000);
                }
                else{
                    toastr.error(data, "Caution!");
                }
                $('#'+btnName).attr('disabled', false);
                if(btnInput == false) $('#'+btnName).html(btnOValue);
                if(btnInput == true) $('#'+btnName).val(btnOValue);
            }
        });     
    });
}





$('#dataTable').DataTable( {
    dom: 'lBfrtip',
    buttons: [
        'csv', 'excel', 'print'
    ]
});
$('#dataTableFull').DataTable( {
    dom: 'lBfrtip',
    buttons: [
        'csv', 'pdf', 'excel', 'print'
    ]
});

$('#toPDF').click(function(){
    var tableN = $(this).data('table');
    var cols = $(this).data('cols');
    // alert(tableN+' '+cols);
    $.ajax({
        url:"ajax/toPDF.php",
        method:'post',
        data:{table:tableN, cols:cols},
        beforeSend:function()
        {
            toastr.warning('Preparing to download . . .','Caution!');
        },
        success:function(data){
            if(window.confirm('About to open: \n'+data)){
                toastr.success('Downloaded', 'Success!');
                window.open(data,'_blank');
            }else{
                var unlink = "<?php unlink("+data+"); ?>";
                unlink;
                toastr.error('Download cancelled', 'Error!');
            }
        }
    })
});


$(document).on('click', '#action_button', function(){
    var action = $(this).data('action');
    var page = $(this).data('page');
    var url = $(this).data('url');
    var id = $(this).data('id');
    var refresh = $(this).data('refresh');
    var ref = $(this).data('ref');
    var val = $(this).data('val');

    $.ajax({
        url:'ajax/'+url+'.php',
        method:'post',
        data:{page:page, action:action, id:id, ref:ref, value:val},
        type:'json',
        success:function(data){
            data = JSON.parse(data);
            // alert(data);
            if(data.success == true){
                toastr.success(data.succMsg, 'Success!');
                if(refresh == true) location.reload(true);
            }
            else{
                toastr.error(data.errMsg, 'Error!');
            }
        }
    })
})