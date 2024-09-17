<?php 
include('includes/dbconnection.php');

// Fetching data from the URL (sent from checkResult.php)
$rollid = $_GET['rollid'];
$dob = $_GET['dob'];
$examyear = $_GET['examyear'];
$examterms = $_GET['examterms'];

// Prepare and execute query for fetching student details based on the provided criteria
$sql_student = "SELECT stnstudents.*, stnclasses.ClassName, stnclasses.Section 
                FROM stnstudents
                JOIN stnclasses ON stnstudents.ClassId = stnclasses.id
                WHERE RollId = :rollid 
                AND DOB = :dob 
                AND ExamYear = :examyear 
                AND ExaminationTerms = :examterms";


$stmt = $dbh->prepare($sql_student);
$stmt->bindParam(':rollid', $rollid, PDO::PARAM_STR);
$stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
$stmt->bindParam(':examyear', $examyear, PDO::PARAM_STR);
$stmt->bindParam(':examterms', $examterms, PDO::PARAM_STR);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the student exists
if (!$student) {
    echo '
    <style>
        .error-container {
            display: flex;
            margin-top: 35px;
            justify-content: center;
            // align-items: center;
            height: 10vh; /* Full height */
        }
        .error-message {
            border: 2px solid black;
            padding: 20px;
            text-align: center;
            font-size: 30px;
            color: red;
            // background-color: #ffe6e6;
        }
    </style>
    <div class="error-container">
        <div class="error-message">
            Sorry! No Record Found !!!
        </div>
    </div>';
    exit();
}

// Fetch the results
$sql_result = "
    SELECT stnsubjects.SubjectName, stnresult.FullMarks, stnresult.PassMarks, stnresult.ObtainedMarks, stnresult.PracticalMarks
    FROM stnresult
    JOIN stnsubjects ON stnresult.SubjectId = stnsubjects.id
    WHERE stnresult.StudentId = :studentid";
$stmt_result = $dbh->prepare($sql_result);
$stmt_result->bindParam(':studentid', $student['id'], PDO::PARAM_INT);
$stmt_result->execute();
$results = $stmt_result->fetchAll(PDO::FETCH_ASSOC);
?>


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
    <div style="text-align:center; font-size:15px; line-height:5px; padding-top:1px; background-color:#EDF3F8; width:100%; height: 15vh;">
        <span style="text-transform:uppercase" >
        <h4>Hilal Public Sec. School</h4>
                  <h3>Controller of Examinations</h3>
                  <h5>Harinagar-7, Sunsari</h5>
                  <strong>[Estd: 2052]</strong>
    </span>
    </div>
    <div style="float:left;  margin-top:13px; font-size:18px;">
        <table width="100%" border="0">
                <tr>
                    <td width="55%">Name of the Student: <?= htmlspecialchars($student['StudentName']) ?></td>
                    <td>Registration No: <?= htmlspecialchars($student['RegNo']) ?></td>
                </tr>
                <tr>
                    <td>Father's Name: <?= htmlspecialchars($student['FatherName']) ?></td>
                    <td>Roll No.: <?= htmlspecialchars($student['RollId']) ?></td>
                </tr>
                <tr>
                    <td>Grade: <?= htmlspecialchars($student['ClassName']) ?> (<?= htmlspecialchars($student['Section']) ?>)</td>
                    <td>Examination Held in Year: <?= htmlspecialchars($student['ExamYear']) ?></td>
                </tr>
                <tr>
                    <td>Date of Birth: <?= htmlspecialchars($student['DOB']) ?></td>
                    <td>Issues Date: <?= htmlspecialchars($student['RegDate']) ?></td>
                </tr>
            </table>
        <table width="100%" border="0" class="table_name" style="margin-top:10px; border-collapse: collapse;">
    <tr>
        <td height="27" colspan="7" align="center" style="font-size:24px; border: 1px solid black;"><strong><?php echo htmlspecialchars($student['ExaminationTerms']); ?></strong></td>
    </tr>
    <tr>
        <th rowspan="2" style="border: 1px solid black;">S.N.</th>
        <th rowspan="2" style="border: 1px solid black;" width="400">Subject</th>
        <th rowspan="2" style="border: 1px solid black;">Full Mark</th>
        <th rowspan="2" style="border: 1px solid black;">Pass Mark</th>
        <th width="130px" colspan="2" style="border: 1px solid black;">Marks Obtained</th>
        <th style="border: 1px solid black;" width="55">Total</th>
    </tr>
    <tr align="center">
        <th style="border: 1px solid black;" width="55">TH.</th>
        <th style="border: 1px solid black;" width="55">PR.</th>
        <th style="border: 1px solid black;">&nbsp;</th>
    </tr>
    <?php 
    $sn = 1;
    $grandTotal = 0;
    $grandFullMarks = 0;
    $grandPassMarks = 0;
    $grandObtainedMarks = 0;
    $grandPracticalMarks = 0;

    foreach ($results as $result) { 
        $totalMarks = $result['ObtainedMarks'] + $result['PracticalMarks'];
        $grandTotal += $totalMarks;
        $grandFullMarks += $result['FullMarks'];
        $grandPassMarks += $result['PassMarks'];
        $grandObtainedMarks += $result['ObtainedMarks'];
        $grandPracticalMarks += $result['PracticalMarks'];
    ?>
    <tr>
        <td height="23" style="border: 0.9px solid black; padding:10px;"><?php echo $sn; ?></td>
        <td style="border: 0.9px solid black; padding-left: 10px"><?php echo htmlspecialchars($result['SubjectName']); ?></td>
        <td style="border: 0.5px solid black;" align="center"><?php echo htmlspecialchars($result['FullMarks']); ?></td>
        <td style="border: 0.5px solid black;" align="center"><?php echo htmlspecialchars($result['PassMarks']); ?></td>
        <td style="border: 0.5px solid black;" align="center"><?php echo htmlspecialchars($result['ObtainedMarks']); ?></td>
        <td style="border: 0.5px solid black;" align="center"><?php echo htmlspecialchars($result['PracticalMarks']); ?></td>
        <td style="border: 0.5px solid black;" align="center"><?php echo $totalMarks; ?></td>
    </tr>
    <?php 
        $sn++;
    } 
    ?>
    <tr>
        <td height="29" colspan="2" style="border: 0.9px solid black;" align="right"><strong>Grand Total&nbsp;</strong></td>
        <th style="border: 0.5px solid black;" align="center"><?php echo $grandFullMarks; ?></th>
        <th style="border: 0.5px solid black;" align="center"><?php echo $grandPassMarks; ?></th>
        <th style="border: 0.5px solid black;" align="center"><?php echo $grandObtainedMarks; ?></th>
        <th style="border: 0.5px solid black;" align="center"><?php echo $grandPracticalMarks; ?></th>
        <td align="center" style="border: 0.9px solid black;"><?php echo $grandTotal; ?></td>
    </tr>
</table>
                        

                        <table width="100%" border="0" style="margin-top:20px;">
                            <tr>
                                <td width="56%" height="35" >
                                    Abs=Absent<br/>
                                    CL=Cancelled<br/>
                                    NQ=Not Qualified<br/>
                                    Th.=Theory<br/>
                                    Pr.=Practical<br/> <br/><br/>
                                </td>

                                <td width="44%" style="float:right;">
            <?php
            $totalMarks = $grandFullMarks;
            $obtainedMarks = $grandTotal;
            $percentage = ($obtainedMarks / $totalMarks) * 100;
            $result = ($percentage >= 40) ? 'Pass' : 'Fail';

            if ($percentage >= 80) {
                $division = 'Distinction';
            } elseif ($percentage >= 60) {
                $division = '1st division';
            } elseif ($percentage >= 45) {
                $division = '2nd division';
            } elseif ($percentage >= 40) {
                $division = '3rd division';
            } else {
                $division = 'Fail';
            }
            ?>
            Result: <strong><?php echo $result; ?></strong><br/><br/>
            Percentage: <?php echo number_format($percentage, 2); ?>%<br/><br/>
            Division: <?php echo $division; ?>
        </td>
                            </tr>

                            
                            <tr><td colspan="2"><span style="font-size: 13px;font-weight: bold"> <br/>NOTE: This is not for official use. If any mistakes on the marksheet, it will be corrected according to the original record of HPSS, the Controller of Examinations.</span></td></tr>
                            </tr>
                        </table>                     

                    </div>

                    
                    <div  class="header_1" style="padding-top:10px; float: right;">
                        <div id="print_holder">
                                <button class="btn btn-primary btn-lg " id="print_btn" >Download</button>
                                
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