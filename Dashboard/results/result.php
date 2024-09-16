

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mark Sheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">

<style>
    body {
        margin:0 auto;
    }
    div {
        border: 0px solid #000;
    }
    .container {
        border: 0px solid #000;
        padding:10px 0;
        margin:0 auto;
        width:750px;
        height: 980px;
        border: 0px solid #000;
    }
    .header_1 {
        float: left;
        width:150px;
        text-align: center;
    }
    .header_2 {
        float: left;
        width:600px;
        text-align: center;
    }
    .header_3 {
        float: left;
        width:750px;
        background: #000;
        color: #fff;
        text-align: center;
        font-size:24px;
        height: 40px;
        vertical-align: middle;
        line-height: 40px;


    }
    .sub_head {
        font-size: 14px;
    }
    .symbol_number {
        letter-spacing: 2px;
    }
    .download{
        border: 1px solid #07C;
        padding: 3px 5px;
        text-decoration: none;
        background: buttonface;
        color: #000;
        font-size: 12px;
        border-radius: 5px;
    }

</style>

</head>
<body>
    <!-- <div style="height:155px;"></div> -->
    <div class="container">
        <div style="clear: both">
            <h4 align="center" style="margin: 0px;padding-bottom: 10px;">School Level Certificate</h4>
        </div>
    <div>
    <div style="text-align:center;font-size:24px;line-height:40px;vertical-align:middle;background-color:#cccccc;width:100%">
        <span style="text-transform:uppercase" ><strong>Mark sheet</strong></span>
    </div>
    <div style="float:left;  margin-top:20px;">
    <?php
    $examYear=$_POST['examyear'];
    $classid=$_POST['examterms'];
    $rollid=$_POST['rollno'];
    $DOB=$_POST['dob']; 
    $_SESSION['examyear']=$examYear;
    $_SESSION['examterms']=$classid;
    $_SESSION['rollno']=$rollid;
    $_SESSION['dob']=$DOB;
    $qery = "SELECT   stnstudents.StudentName,stnstudents.DOB,stnstudents.RollId,stnstudents.RegDate,stnstudents.StudentId,stnstudents.Status,stnclasses.ClassName,stnclasses.Section from stnstudents join stnclasses on stnclasses.id=stnstudents.ClassId where stnstudents.RollId=:rollid and stnstudents.ClassId=:classid ";
    $stmt = $dbh->prepare($qery);
    $stmt->bindParam(':examyear',$examYear,PDO::PARAM_STR);
    $stmt->bindParam(':examterms',$classid,PDO::PARAM_STR);
    $stmt->bindParam(':rollno',$rollid,PDO::PARAM_STR);
    $stmt->bindParam(':dob',$DOB,PDO::PARAM_STR);
    $stmt->execute();
    $resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($stmt->rowCount() > 0)
    {
    foreach($resultss as $row)
    {   ?>
        <table width="100%" border="0" style="border:!important;">
            <tr>
                <td width="55%">Name of the Student : <?php echo htmlentities($row->StudentName);?></td>
                <td>Registration No : <?php echo htmlentities($row->RegNo);?></td>
            </tr>
            <tr>
                <td>Father's Name : <?php echo htmlentities($row->FatherName);?></td>
                <td>Roll No. : <?php echo htmlentities($row->RollId);?> (<?php echo htmlentities($row->StudentName);?>)</td>
            </tr>
            <tr>
                <td>Grade : <?php echo htmlentities($row->ClassName);?> (<?php echo htmlentities($row->Section);?>)</td>
                <td>Examination Held in Year : <?php echo htmlentities($row->ExamYear);?></td>
            </tr>
        </table>
        <table width="100%"border="0" class="table_name" style="margin-top:10px; border-collapse: collapse;">
            <tr>
                <td height="25" colspan="9" align="center" style="font-size:24px; border: 1px solid black;"><strong><?php echo htmlentities($row->ExaminationTerms);?></strong></td>
                <?php } ?>
            </tr>
            <tr>
                <th rowspan="2" style="border: 1px solid black;">S.N.</th>
                <th rowspan="2" style="border: 1px solid black;">Subject</th>
                <th rowspan="2" style="border: 1px solid black;">Full Mark</th>
                <th rowspan="2" style="border: 1px solid black;">Pass Mark</th>
                <th width="130px" colspan="2" style="border: 1px solid black;">Marks Obtained</th>
                <th style="border: 1px solid black;" width="55">Total</th>
            </tr>
            <tr align="center">
                <th style="border: 1px solid black;" width="55">Int.</th>
                <th style="border: 1px solid black;" width="55">Ext.</th>
                <th style="border: 1px solid black;">&nbsp;</th>
            </tr>
            <tr>
            <?php                                              
                                                        // Code for result

                                                        $query ="select t.StudentName,t.RollId,t.ClassId,t.marks,SubjectId,stnsubjects.SubjectName from (select sts.StudentName,sts.RollId,sts.ClassId,tr.marks,SubjectId from stnstudents as sts join  stnresult as tr on tr.StudentId=sts.StudentId) as t join stnsubjects on stnsubjects.id=t.SubjectId where (t.RollId=:rollid and t.ClassId=:classid)";
                                                        $query= $dbh -> prepare($query);
                                                        $stmt->bindParam(':examyear',$examYear,PDO::PARAM_STR);
    $stmt->bindParam(':examterms',$classid,PDO::PARAM_STR);
    $stmt->bindParam(':rollno',$rollid,PDO::PARAM_STR);
    $stmt->bindParam(':dob',$DOB,PDO::PARAM_STR);
                                                        $query-> execute();  
                                                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                        $cnt=1;
                                                        if($countrow=$query->rowCount()>0)
                                                        { 

                                                        foreach($results as $result){

                                                        ?>
                                <td height="35" style="border: 0.9px solid black; padding:10px;"  ><?php echo htmlentities($cnt);?></td>
                                <td  style="border: 0.9px solid black;padding:5px;" ><?php echo htmlentities($result->SubjectName);?></td>
                                
                                <td style="border: 0.5px solid black;" align="center"><?php echo htmlentities($result->FullMarks);?></td>
                                
                                <td style="border: 0.5px solid black;" align="center"><?php echo htmlentities($result->PassMarks);?></td>

                                <td style="border: 0.5px solid black;" align="center"><?php echo htmlentities($result->PracticalMarks);?></td>

                                <?php
                                $oMarks = $result->ObtainedMarks;
                                $pmarks = $result->PassMarks;
                                $failColor = ($Marks < $pmarks) ? 'background-color: #7e7c87; color: white;' : '';
                                ?>
                                <td style="<?php echo $failColor; ?>"><?php echo htmlentities($oMarks); ?></td>
                                <?php 
                                $ptMarks = $result->PracticalMarks;
                                $totlcount = $oMarks + $ptMarks;
                                ?>
                                <td style="border: 0.5px solid black;" align="center"><?php echo htmlentities($totlcount); ?></td>
                            </tr>
                            <tr>
                                <?php
                                $fmarks = $result->FullMarks;
                                ?>
                                <td height="29" colspan="2"  style="border: 0.9px solid black;" align="right"><strong>Grand Total&nbsp;</strong></td>
                                <th style="border: 0.5px solid black;" align="center"><?php $outof = (($cnt-1)*$fmarks); ?></th>
                                <th style="border: 0.5px solid black;" align="center"><?php (($cnt-1)*$pmarks); ?></th>
                                <th style="border: 0.5px solid black;" align="center"><?php (($cnt-1)*$ptMarks); ?></th>
                                <th style="border: 0.5px solid black;" align="center"><?php $totObtain = (($cnt-1)*$oMarks); ?></th>
                                <?php 
                                $totlnumber += $totlcount;
                                $cnt++;}?>
                                <td align="center"  style="border: 0.9px solid black;"><?php echo htmlentities($totlnumber); ?></td>
                            </tr>
                        </table>
                        

                        <table width="100%" border="0" style="margin-top:20px;">
                            <tr>
                                <td width="56%" height="35" >
                                    Abs=Absent<br/>
                                    CL=Cancelled<br/>
                                    NQ=Not Qualified<br/>
                                    Th.=Theory<br/>
                                    Pr.=Practical<br/>
                                    Int.= Internal<br/>
                                    Ext.=External<br/> <br/><br/>
                                </td>

                                <td width="44%" style="float:right;">
                                    Result:<strong><?php
    // Check if any subject has marks less than 40
    $failed = false;
    foreach ($results as $result) {
        if ($result->ObtainedMarks < $pmarks) {
            $failed = true;
            break; // No need to check further once failed is detected
        }
    }

    // Display result based on the failed flag
    if ($failed) {
        echo 'Failed';
    } else {
        echo 'Passed';
    }
    ?></strong><br/><br/>
                                    Percentage:<?php echo  htmlentities($totlnumber*(100)/$outof); ?>%<br/><br/>
                                    Division : <?php
                                                            // Determine division based on percentage
                                                            if (($totlnumber*(100)/$outof) >= 80) {
                                                                echo 'Distinction';
                                                            } elseif (($totlnumber*(100)/$outof) >= 60) {
                                                                echo 'First Division';
                                                            } elseif (($totlnumber*(100)/$outof) >= 45) {
                                                                echo 'Second Division';
                                                            } elseif (($totlnumber*(100)/$outof) >=32) {
                                                                echo 'Third Division';
                                                            }else {
                                                                echo 'Not Found Division';
                                                            }
                                                            ?>                                            
                                </td>
                            </tr>

                            
                            <tr><td colspan="2"><span style="font-size: 13px;font-weight: bold"> <br/>NOTE: This is not for official use. If any mistakes on the marksheet, it will be corrected according to the original record of CTEVT, the Office of the Controller of Examinations.</span></td></tr>
                            </tr>
                        </table> 
                        <?php } } ?>                       

                    </div>

                    
                    <div  class="header_1" style="padding-top:10px; float: right;">
                        <div id="print_holder">
                                <button class="btn btn-primary btn-lg " id="print_btn" >Print</button>
                                <a href="#" class="btn btn-primary btn-lg download" id="download_btn" >Download</a>
                        </div>
                    </div>
                    
                    <div style="clear:both;"></div>
                </div>
                <div>

                    <div style="clear:both;"></div>
                </div>

            </div>
            


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $("#print_btn").click(function () {
            $("#print_holder").hide();
            window.print();
            $("#print_holder").show();
        });
    });
</script>
            
            
</body>
</html>

