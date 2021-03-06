<!DOCTYPE html>
<?php

include_once("../../assets/php/check_login.php");
if (isset($_SESSION['username']) and isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    if (make_check($username, $password) == 0 || $_SESSION['type'] != "normal") {
        $_SESSION = array();
        session_destroy();
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ../../register.php');
    }
} else {
    $_SESSION = array();
    session_destroy();
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ../../register.php');
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - HFB</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>HFB</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="./profile.php"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./games2.php"><i class="fa fa-gamepad"></i><span>Games</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./programs.php"><i class="fas fa-project-diagram"></i><span>Programs</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./activity_log.php"><i class="fas fa-history"></i><span>Activity Log</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="./others2.php"><i class="fas fa-user-circle"></i><span>Other Members</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                        <span class="badge badge-danger badge-counter">
                                            <?php 
                                                $sql = "SELECT COUNT(*) as Count FROM users t1 WHERE t1.IsOnline=1 AND t1.UserName IN (SELECT DISTINCT FriendName FROM Friends t2 WHERE t2.UserName='" . $username . "');";
                                                $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                                                $record = mysqli_fetch_assoc($result_set);
                                                echo $record['Count']."+";
                                            ?>
                                        </span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in" style="overflow-y: scroll !important;max-height: 336px !important;">
                                        <h6 class="dropdown-header">Online Friends</h6>
                                        <?php
                                        $sql = "SELECT t1.UserName, t1.Email, t1.UserPic, t1.IsOnline FROM users t1 WHERE t1.UserName IN (SELECT DISTINCT FriendName FROM Friends t2 WHERE t2.UserName='" . $username . "');";
                                        $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                                        while ($record = mysqli_fetch_assoc($result_set)) {
                                        ?>
                                            <a class="d-flex align-items-center dropdown-item" href="#">
                                                <div class="mr-3"><img class="rounded-circle border img-profile" src="../../assets/img/avatars/<?php echo $record['UserPic']; ?>" style="height: 50;" width="70" height="70"></div>
                                                <div class="">
                                                    <br>
                                                    <p><?php echo $record['UserName']; ?>
                                                        <br><?php echo $record['Email']; ?><br>
                                                        <?php
                                                        if ($record['IsOnline'] == 1) echo '<span style="color:#8dc859;"><i class="far fa-check-circle" > online</i></span>';
                                                        else echo '<span style="color:#d9534f;"><i class="far fa-clock" > offline</i></span>';
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <a class="text-center dropdown-item small text-gray-500" href="others.php">
                                            Follow other members
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $username; ?></span><img class="border rounded-circle img-profile" src="../../assets/img/avatars/<?php echo $profile_pic; ?>"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="activity_log.php"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="../../assets/php/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>