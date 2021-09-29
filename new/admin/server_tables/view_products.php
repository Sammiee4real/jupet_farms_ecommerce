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
$table = 'product_tbl';
 
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
             $pro_det = get_one_row_from_one_table_by_id('product_tbl','unique_id',$d,'date_added');
             $product_name = $pro_det['product_name'];
             $imgpath = $pro_det['product_path'];
            return $product_name.'<br><img width="90" height="50" src="./'.$imgpath.'"><a style="margin:10px;" href="edit_product.php?pid='.$d.'" class="btn btn-sm btn-primary">Edit Product</a><a style="margin:10px;" href="view_products.php?pid='.$d.'" class="btn btn-sm btn-danger">Delete Product</a>';
        }
     ),
    array( 'db' => 'unit_price', 'dt' => 1 ),
    array(
        'db'        => 'visibility_status',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            return $d == 1 ? '<span style="color:green;">visible</span>':'<span style="color:red;">hidden</span>';
        }
     ),
    array( 'db' => 'quantity', 'dt' => 3 ),
    array( 'db' => 'measure_type', 'dt' => 4 ),
    array(
        'db'        => 'date_added',
        'dt'        => 5,
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