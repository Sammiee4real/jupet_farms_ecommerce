 <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="./logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>


  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 

  <script type="text/javascript">
    $(document).ready(function () {
         // toastr.info('Page Loaded!');
         $('.js-example-basic-single').select2();
         $('.js-example-basic-multiple').select2();
         $('.js-example-basic-multiple2').select2();

      
        $('#dataTable').DataTable();
        


          var products_list = $('#products_table').DataTable({
          "scrollX": true,
          "processing": true,
          "serverSide": true,
          "ajax": "server_tables/view_products.php",
          // 'pagingType': 'numbers'
            // "order": [[ 2, "asc" ]],
            // "columnDefs": [
            // { "render": products_list,
            // "data": null,         
            // "targets": [0], "width": "9%", "targets": 0 },
            // ]
          } );

          var all_orders = $('#orders_table').DataTable({
          "scrollX": true,
          "processing": true,
          "serverSide": true,
          "ajax": "server_tables/view_orders.php",
          // 'pagingType': 'numbers'
            // "order": [[ 2, "asc" ]],
            // "columnDefs": [
            // { "render": products_list,
            // "data": null,         
            // "targets": [0], "width": "9%", "targets": 0 },
            // ]
          } );



          var all_customers = $('#all_customers_table').DataTable({
              "scrollX": true,
              "processing": true,
              "serverSide": true,
              "ajax": "server_tables/view_customers.php",
              // 'pagingType': 'numbers'
                // "order": [[ 2, "asc" ]],
                // "columnDefs": [
                // { "render": all_sns,
                // "data": null,         
                // "targets": [0], "width": "9%", "targets": 0 },
                // ]
          } );



               $('.mark_as_delivered').click(function(e){
                        e.preventDefault();
                         var orderid = $(this).attr('id');
                         // alert(orderid);
                  
                        $.ajax({
                            url:"ajax/mark_as_delivered.php",
                            method: "GET",
                            data:{orderid:orderid},
                            beforeSend: function(){
                                // $(this).attr('disabled', true);
                                $(this).text('please wait...');
                            },
                            success:function(data){
                                if(data == 111){
                                    $('#approve'+orderid).modal('hide');
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Perfect!',
                                    text: 'Order was successfully marked as delivered',
                                    });

                                    setTimeout( function(){ 
                                        window.location.href = 'completed_orders.php'; 
                                    }, 3000);
                                }
                                else{
                                    // toastr.error(data, "Caution!");
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }
                            
                            }
                        });    
                 });


                  $('.mark_as_completed').click(function(e){
                        e.preventDefault();
                        var orderid = $(this).attr('id');
                        // alert(orderid);
                        $.ajax({
                            url:"ajax/mark_as_completed.php",
                            method: "GET",
                            data:{orderid:orderid},
                            beforeSend: function(){
                                // $(this).attr('disabled', true);
                                $(this).text('please wait...');
                            },
                            success:function(data){
                                if(data == 111){
                                    $('#approve'+orderid).modal('hide');
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Perfect!',
                                    text: 'Order was successfully marked as completed',
                                    });
                                    setTimeout( function(){ 
                                        window.location.href = 'pending_orders.php'; 
                                    }, 3000);
                                }
                                else{
                                    // toastr.error(data, "Caution!");
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Caution...',
                                    text: ''+data+'',
                                    });
                                }
                            
                            }
                        });    
                 });




      
            $('#cmd_login').click(function (e) {
            e.preventDefault();

                $.ajax({
                url:"ajax/login.php",
                method: "POST",
                data:$('#login_form').serialize(),
                beforeSend: function(){
                //$(this).html('loading...');
                $("#cmd_login").attr('disabled', true);
                $("#cmd_login").text('logging in...');
                },
                success:function(data){
                //alert(data);
                if(data == 200){
                Swal.fire({
                icon: 'success',
                title: 'Perfect!',
                text: 'Login was successful...',
                });
               setTimeout( function(){ window.location.href = "home.php"; }, 2000);

                }else{
                //toastr.error(data, "Caution!");
                
                Swal.fire({
                icon: 'error',
                title: 'Caution!',
                text: ''+data+'',
                });
               


                }

                $('#cmd_login').attr('disabled', false);
                $('#cmd_login').text('Login');

                }


                });

            });



});


</script>

</body>

</html>