<?php

$con = mysqli_connect("localhost","u529809730_readfoundation","@ReadFoundation12","u529809730_readfoundation");

if(date('N',strtotime(date("Y-m-d"))) >= 6)
{
    mysqli_query($con,"INSERT INTO student_attendance (id, student_id, date, status, remark, branch_id, check_in_time, check_out_time, created_at, updated_at) select null, id, CURRENT_DATE,'H',null,branch_id,null,null, NOW()+INTERVAL 5 HOUR, NOW()+INTERVAL 5 HOUR from enroll");
    
}
else{
     mysqli_query($con,"INSERT INTO student_attendance (id, student_id, date, status, remark, branch_id, check_in_time, check_out_time, created_at, updated_at) select null, id, CURRENT_DATE,'A',null,branch_id,null,null, NOW()+INTERVAL 5 HOUR, NOW()+INTERVAL 5 HOUR from enroll");
}

?>
