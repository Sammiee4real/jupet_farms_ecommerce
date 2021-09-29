<?php session_start();
      require_once('../../config/database_functions.php'); 
      $uid2 = $_SESSION['uuid'];
 
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
$table = 'orders';
 
// Table's primary key
$primaryKey = 'unique_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db'        => 'unique_id',
        'dt'        => 0,
        'formatter' => function( $d, $row ) {
             $get_product_id = get_one_row_from_one_table_by_id('orders','unique_id',$d,'date_added');
             $product_id = $get_product_id['product_id'];
             // $pro_det = get_one_row_from_one_table_by_id('product_tbl','unique_id',$product_id,'date_added');
             // $product_name = $pro_det['product_name'];
             $product_name = getData('product_name', 'product_tbl', 'unique_id', $product_id);
             $imgpath = getData('product_path', 'product_tbl', 'unique_id', $product_id);
             //$imgpath = $pro_det['product_path'];
            return $product_name.'<br><img width="90" height="50" src="./'.$imgpath.'"><br>';
            //return $product_name;
        }
     ),
    // array( 'db' => 'product_id', 'dt' => 0 ),
    array( 'db' => 'invoice_no', 'dt' => 1 ),
    array( 'db' => 'unit_price', 'dt' => 2 ),
    array( 'db' => 'quantity', 'dt' => 3 ),
    array( 'db' => 'total_amount', 'dt' => 4 ),
    array(
        'db'        => 'customer_id',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            $first_name = getData('first_name', 'users_tbl', 'unique_id', $d);
            $last_name = getData('last_name', 'users_tbl', 'unique_id', $d);
            return $first_name.' '.$last_name;
        }
     ),
    array(
        'db'        => 'payment_status',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
            return $d == 1 ? 'positive': 'pending';
        }
     ),
     array(
        'db'        => 'delivery_status',
        'dt'        => 7,
        'formatter' => function( $d, $row ) {
            return $d == 1 ? 'positive': 'pending';
        }
     ),
    array(
        'db'        => 'date_added',
        'dt'        => 8,
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