<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../../dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $club_id = $_POST['club_id'];
    $candidate_id = $_POST['candidate_id'];
    $candidate_name = $_POST['candidate_name'];
    $candidate_year = $_POST['candidate_year'];
    $candidate_branch = $_POST['candidate_branch'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $q5 = $_POST['q5'];
    $remarks = $_POST['remarks'];

    $insertQuery = $conn->prepare("INSERT INTO member_recruitments (club_id, candidate_id, candidate_name, candidate_year, candidate_branch, q1, q2, q3, q4, q5, remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insertQuery->bind_param("iisssiiiiis", $club_id, $candidate_id, $candidate_name, $candidate_year, $candidate_branch, $q1, $q2, $q3, $q4, $q5, $remarks);
    $insertResult = $insertQuery->execute();

    if (!$insertResult) {
        die("Error: " . $insertQuery->error);
    }

    $insertQuery->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Recruitment Form</title>
    <link rel="stylesheet" href="admin_recruitments.css">
</head>
<body>
    <div class="recruitment-form">
        <div class="recruitment-form-in">
            <div class="recruitment-form-header">
                <div class="recruitment-form-header-in">
                    <h1>Member Recruitment Form</h1>
                    <p>Phase 02 of Recruitments for TEC clubs - Department of Student Activity Center</p>
                </div>
            </div>
            <div class="recruitment-form-one">
                <div class="recruitment-form-one-one">
                    <form method="post" action="">
                        <div class="recruitment-form-one-one-one recruitment-form-one-one-cmn">
                            <label for="candidate_id">Candidate ID:</label>
                            <input type="number" id="candidate_id" name="candidate_id" pattern="[0-9]{10}" required>
                        </div>
                        <div class="recruitment-form-one-one-two recruitment-form-one-one-cmn">
                            <label for="candidate_name">Candidate Name:</label>
                            <input type="text" id="candidate_name" name="candidate_name" required>
                        </div>
                        <div class="recruitment-form-one-one-three recruitment-form-one-one-cmn">
                            <label for="candidate_year">Candidate Year:</label>
                            <select id="candidate_year" name="candidate_year" required>
                                <option value="1">First Year</option>
                                <option value="2">Second Year</option>
                                <option value="3">Third Year</option>
                                <option value="4">Fourth Year</option>
                            </select>
                        </div>
                        <div class="recruitment-form-one-one-four recruitment-form-one-one-cmn">
                            <label for="candidate_branch">Candidate Branch:</label>
                            <select id="candidate_branch" name="candidate_branch" required>
                                <option value="CSE-H">CSE Hons</option>
                                <option value="CSE-R">CSE Regular</option>
                                <option value="AIDS">AIDS</option>
                                <option value="CSIT">CSIT</option>
                                <option value="ECE">ECE</option>
                                <option value="EEE">EEE</option>
                                <option value="ME">ME</option>
                                <option value="Civil">Civil</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="recruitment-form-one-one-five recruitment-form-one-one-cmn">
                            <label for="q1">Why do you want to join this club?</label>
                            <input type="number" id="q1" name="q1" required value="0" min="0" max="10">
                        </div>
                        <div class="recruitment-form-one-one-six recruitment-form-one-one-cmn">
                            <label for="q2">What do you think you can contribute to this club?</label>
                            <input type="number" id="q2" name="q2" required value="0" min="0" max="10">
                        </div>
                        <div class="recruitment-form-one-one-seven recruitment-form-one-one-cmn">
                            <label for="q3">What are your expectations from this club?</label>
                            <input type="number" id="q3" name="q3" required value="0" min="0" max="10">
                        </div>
                        <div class="recruitment-form-one-one-eight recruitment-form-one-one-cmn">
                            <label for="q4">Technical knowledge of th candidate:</label>
                            <input type="number" id="q4" name="q4" required value="0" min="0" max="10">
                        </div>
                        <div class="recruitment-form-one-one-nine recruitment-form-one-one-cmn">
                            <label for="q5">English Language proficiency of the candidate</label>
                            <input type="number" id="q5" name="q5" required value="0" min="0" max="10">
                        </div>
                        <div class="recruitment-form-one-one-ten recruitment-form-one-one-cmn">
                            <label for="remarks">Remarks:</label>
                            <textarea id="remarks" name="remarks" required></textarea>
                        </div>
                        <div class="recruitment-form-one-one-eleven recruitment-form-one-one-cmn">
                            <input type="submit" name="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
