<?php
include('includes/dbconnection.php');
if (!empty($_POST["classid"])) {
  
    $cid = intval($_POST['classid']);  // Changed 'classid' to match the AJAX request
   echo $cid;
    if (!is_numeric($cid)) {
        echo htmlentities("Invalid Class");
        exit;
    } else {
        
        // Fetch students based on ClassId
        $stmt = $dbh->prepare("SELECT StudentName, id FROM stnstudents WHERE ClassId = :id ORDER BY StudentName");
        $stmt->execute(array(':id' => $cid)); ?>
        
        <option value="">Select Student</option> <!-- Default Option -->
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <option value="<?php echo htmlentities($row['id']); ?>">
                <?php echo htmlentities($row['StudentName']); ?>
            </option>
        <?php }
        
    }
}


// Fetch Subjects based on ClassId
if (!empty($_POST["classid1"])) {
    $cid1 = intval($_POST['classid1']);

    if (!is_numeric($cid1)) {
        echo htmlentities("Invalid Class");
        exit;
    } else {
        // Fetch subjects related to the ClassId
        $stmt = $dbh->prepare("SELECT stnsubjects.SubjectName, stnsubjects.id FROM stnsubjectcombination 
                                JOIN stnsubjects ON stnsubjects.id = stnsubjectcombination.SubjectId 
                                WHERE stnsubjectcombination.ClassId = :cid ORDER BY stnsubjects.SubjectName");
        $stmt->execute(array(':cid' => $cid1)); ?>

        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="form-group">
                <label for="subject" class="form-control-label">
                    <?php echo htmlentities($row['SubjectName']); ?>
                </label>
                <input type="hidden" name="subjectid[]" value="<?php echo htmlentities($row['id']); ?>" />
                <input type="text" name="fullmarks[]" value="" placeholder="Enter Full Marks" class="form-control" required>
                <input type="text" name="passmarks[]" value="" placeholder="Enter Pass Marks" class="form-control" required>
                <input type="text" name="obtainedmarks[]" value="" placeholder="Enter Obtained Marks" class="form-control" required>
            </div>
        <?php }
    }
}


// Check if result already declared for student
if (!empty($_POST["stnclasses"])) {
    $cid = $_POST['stnclasses'];
    list($classid, $studentid) = explode("$", $cid);

    $stmt = $dbh->prepare("SELECT StudentId FROM stnresult WHERE ClassId = :cid AND StudentId = :sid");
    $stmt->execute(array(':cid' => $classid, ':sid' => $studentid));

    if ($stmt->rowCount() > 0) {
        echo "<p style='color:red'>Result already declared for this student.</p>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        echo "<p style='color:green'>Result not declared yet for this student.</p>";
        echo "<script>$('#submit').prop('disabled', false);</script>";
    }
}
?>
