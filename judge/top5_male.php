<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <?php include 'includes/topnavbar.php'; ?>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <?php include 'includes/sidenavbar.php'; ?>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?php
                    if (isset($_SESSION['success_message'])) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                        unset($_SESSION['success_message']);
                    }
                    if (isset($_SESSION['error_message'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                        unset($_SESSION['error_message']);
                    }
                    ?>
                    <h1 class="mt-4">Top 5 Candidates</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Top 5 Candidates</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3>Top 5 Candidates</h3>
                            <form action="./function/top5_male_function.php" method="post">
                                <table class="table table-striped table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Cand No</th>
                                            <th>Full Name</th>
                                            <th>Team</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../partial/connection.php';

                                        $sql = "SELECT `cand_no`, `cand_fn`, `cand_ln`, `cand_team` FROM `top5_candidate_male` WHERE 1";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $fullName = $row['cand_fn'] . ' ' . $row['cand_ln'];
                                                echo "<tr>
                                                    <td>{$row['cand_no']}</td>
                                                    <td>{$fullName}</td>
                                                    <td>{$row['cand_team']}</td>
                                                    <td>
                                                        <select class='form-select' name='score[{$row['cand_no']}]'>
                                                            <option value=''>Select Score</option>
                                                            <option value='7'>7</option>
                                                            <option value='8'>8</option>
                                                            <option value='9'>9</option>
                                                            <option value='10'>10</option>
                                                        </select>
                                                    </td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>No results found</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Submit Scores</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include 'includes/script.php'; ?>
</body>
</html>
