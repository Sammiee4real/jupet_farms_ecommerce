<?php session_start();
      require_once('../config/database_functions.php'); 
      $uid2 = $_SESSION['uid'];
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'wp_mobile_serial_numbers';
 
// Table's primary key
$primaryKey = 'serial_key';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    // array( 'db' => 'unique_id', 'dt' => 0 ),
    // array( 'db' => 'product_id', 'dt' => 0 ),
    // array(
    //     'db'        => 'product_id',
    //     'dt'        => 0,
    //     'formatter' => function( $d, $row ) {
    //         $prod_det = get_one_row_from_one_table_by_id('custom_product_tbl','product_id',$d,'date_added');
    //         $product_name = $prod_det['product_name'];
    //        return $product_name;
    //     }
    //  ),
    array(
        'db'        => 'product_id',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
            $cate_det = get_one_row_from_one_table_by_id('custom_product_tbl','product_id',$d,'date_added');
            $category_id = $cate_det['category_id'];
            $product_name = $cate_det['product_name'];

            $cate_det2 = get_one_row_from_one_table_by_id('custom_category_tbl','category_id',$category_id,'date_added');
            $category_name = $cate_det2['category_name'];
            $category_slug = $cate_det2['category_slug'];

           return $product_name.' ( '.$category_slug.' ) ';
        }
     ),
     array(
        'db'        => 'status',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            if($d == 'available'){
              return "<span style='color:green;'>available(unused)</span>";            
            }else{
              return "<span style='color:red;'>assigned</span>";
            }

        }
     ),
    array( 'db' => 'serial_key', 'dt' => 2 ),
    array(
        'db'        => 'vendor_id',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            if($d !== null){
                   $customer_det = get_one_row_from_one_table_by_id('wp_wc_customer_lookup','customer_id',$d,'date_registered');
                   $customer_name_email = $customer_det['first_name'].' '.$customer_det['last_name'].'('.$customer_det['email'].')';
                   return $customer_name_email;
            }else{
                return 'nil';
            }
        }
     ),
    array(
        'db'        => 'created_date',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            // return date( 'jS M y', strtotime($d));
            return date( 'd F Y', strtotime($d));
        }
     )
  
);
 
// SQL server connection information
$sql_details = array(
    'user' => USER,
    'pass' => PASSWORD,
    'db'   => DB_NAME,
    'host' => HOST
);
 
// $sql_details = array(
//     'user' => 'root',
//     'pass' => '',
//     'db'   => 'churchworld1',
//     'host' => 'localhost'
// );
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);