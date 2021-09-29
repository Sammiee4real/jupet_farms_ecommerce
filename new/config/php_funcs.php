<?php
    global $dbc;

    function getGroupName($uid)
    {
        global $dbc;

        

        $sql = mysqli_query($dbc, "SELECT group_name from user_groups where `unique_id`='$uid'");

        return ucwords(mysqli_fetch_array($sql)['group_name']);
    }

      function getProjectName($uid)
    {
        global $dbc;

        $sql = mysqli_query($dbc, "SELECT project_name from projects where `unique_id`='$uid'");

        return ucwords(mysqli_fetch_array($sql)['project_name']);
    }

       function getWhoAdded($uid)
    {
        global $dbc;

        $sql = mysqli_query($dbc, "SELECT fname,lname from users where `unique_id`='$uid'");

        return ucwords(mysqli_fetch_array($sql)['fname']);
    }

    

    function getCoopName($uid)
    {
        global $dbc;

        $sql = mysqli_query($dbc, "SELECT coop_name from cooperative_groups where `unique_id`='$uid'");

        return ucwords(mysqli_fetch_array($sql)['coop_name']);
    }

    function getRoleName($rid)
    {
        global $dbc;

        $sql = mysqli_query($dbc, "SELECT role_name from role_privileges where `role_id` = '$rid'");

        return ucwords(mysqli_fetch_array($sql)['role_name']);
    }

    function getData($ref, $tblName, $fid, $fval)
    {
        global $dbc;

        if($fval == null){
            return '-';
        }else{
            
            $sql = mysqli_query($dbc, "SELECT `$ref` from `$tblName` where `$fid` = '$fval'") or die(mysqli_error($dbc));

              $count = mysqli_num_rows($sql);
            if($count == 0){
            return '-';

            }else{
            return ucwords(mysqli_fetch_array($sql)[$ref]);

            }
        }
        

    }

     function getDataOne($ref, $tblName, $fid, $fval)
    {
        global $dbc;

        if($fval == null){
            return '-';
        }else{
            
            $sql = mysqli_query($dbc, "SELECT `$ref` from `$tblName` where `$fid` = '$fval' limit 1") or die(mysqli_error($dbc));
            $count = mysqli_num_rows($sql);
            if($count == 0){
            return '-';

            }else{
            return ucwords(mysqli_fetch_array($sql)[$ref]);

            }

        }
        

    }

    function updateTableData($tblName, $rows, $values, $refName, $refValue)
    {
        global $dbc;

        $rows = explode(', ', $rows);
        $values = explode(', ', $values);
        
        if(count($rows) !== count($values)){
            return 'Number of rows does not match with values to be updated';
        }
        else{
            $sql = "UPDATE `".$tblName."` set ";

            for($i = 0; $i<=(count($rows)-1); $i++)
            {
                $sql.= '`'.$rows[$i].'` = '.$values[$i].' ';
            }

            $sql.= 'where `'.$refName.'` = "'.$refValue.'"';

            if(mysqli_query($dbc, $sql)){
                return 'success';
            }else{
                return 'Unable to update table: '.$tblName.'\n Sql: '.$sql;
            }
        }
    }


    function tableToPdf($tblName, $cols)
    {
        global $dbc;
        require('../vendor/toPDF/vendor/autoload.php');
        $res=mysqli_query($dbc,"select * from $tblName");

        $cols = explode(', ', $cols);

        if(mysqli_num_rows($res)>0){
            $index = 1;
            $header = '<center><h1>'.strtoupper(str_replace("_", " ", $tblName)).'</h1></center>';
            $header .= '<table class="table" border="1" cellpadding="10" cellspacing="0" width="100%"><tr>';
            $header.="<th>ID</th>";
            foreach($cols as $col)
            {
                $header.="<th>".ucwords(str_replace("_", " ", $col))."</th>";
            }
            $header.='</tr>';

            $body = '';
            $footer = '';

            while($row = mysqli_fetch_array($res))
            {
                $body.='<tr>';
                $body.='<td>'.$index.'</td>';
                foreach($cols as $col)
                {
                    $body.='<td>'.ucwords($row[$col]).'</td>';
                }
                $body.='</tr>';

                $index++;
            }

            $footer.='</table>';

            $html = $header.$body.$footer;

            return $html;
        }else{
            return false;
        }
    }
?>