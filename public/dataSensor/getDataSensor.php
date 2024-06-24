<?php
require 'connectDB.php';
date_default_timezone_set('Asia/Jakarta');
$d = date("Y-m-d");
$t = date("H:i:s");
$time = date("Y-m-d H:i:s");


if (isset($_GET['Check_mode']) && isset($_GET['device_token'])) {
    
    $device_uid = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $device_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            if ($_GET['Check_mode'] == "get_mode") {
                $sql= "SELECT device_mode FROM table_device WHERE device_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $device_uid);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        echo "mode".$row['device_mode'];
                        exit();
                    }
                    else{
                        echo "Nothing";
                        exit();
                    }
                }
            }
            else{
                exit();
            }
        }
        else{
            echo "Invalid Device";
            exit();
        }
    }  
}

if (isset($_GET['Get_Fingerid']) && isset($_GET['device_token'])) {
    
    $device_uid = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $device_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            $device_id = $row['id'];
            if ($_GET['Get_Fingerid'] == "get_id") {
                $sql= "SELECT fingerprint_id FROM all_data WHERE add_fingerid=1 AND device_uid=? LIMIT 1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $device_uid);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        echo "add-id".$row['fingerprint_id'];
                        exit();
                    }
                    else{
                        echo "Nothing";
                        exit();
                    }
                }
            }
            else{
                exit();
            }
        }
        else{
            echo "Invalid Device";
            exit();
        }
    }
}

if (isset($_GET['FingerID']) && isset($_GET['device_token'])) {
    
    $fingerID = $_GET['FingerID'];
    $device_uid = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $device_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            $device_mode = $row['device_mode'];
            $device_kelas = $row['device_kelas'];
            $device_id = $row['id'];
            // if ($device_mode == 1) {
            //     $sql = "SELECT * FROM users WHERE fingerprint_id=?";
            //     $result = mysqli_stmt_init($conn);
            //     if (!mysqli_stmt_prepare($result, $sql)) {
            //         echo "SQL_Error_Select_card";
            //         exit();
            //     }
            //     else{
            //         mysqli_stmt_bind_param($result, "s", $fingerID);
            //         mysqli_stmt_execute($result);
            //         $resultl = mysqli_stmt_get_result($result);
            //         if ($row = mysqli_fetch_assoc($resultl)){
            //             //*****************************************************
            //             //An existed fingerprint has been detected for Login or Logout
            //             if ($row['name'] != "None" && $row['add_fingerid'] == 0) {
            //                 $Uname = $row['name'];
            //                 $Number = $row['credential_number'];
            //                 $id_user = $row['id'];
            //                 $sql = "SELECT * FROM user_log WHERE fingerprint_id=? AND checkindate=? AND fingerout=0 AND user_id=?" ;
            //                 $result = mysqli_stmt_init($conn);
            //                 if (!mysqli_stmt_prepare($result, $sql)) {
            //                     echo "SQL_Error_Select_logs";
            //                     exit();
            //                 } else {
            //                     mysqli_stmt_bind_param($result, "sss", $fingerID, $d, $id_user);
            //                     mysqli_stmt_execute($result);
            //                     $resultl = mysqli_stmt_get_result($result);
            //                     // Login
            //                     if (!$row = mysqli_fetch_assoc($resultl)) {
            //                         // Correct the SQL query by adding the table name after UPDATE
            //                         $sql = "UPDATE user_log SET fingerprint_id=?, device_uid=?, device_kelas=?, timein=?, timeout=?, remark=?, created_at=? WHERE user_id=? AND checkindate=?";
            //                         $stmt = mysqli_stmt_init($conn); // Use $stmt instead of $result
            //                         if (!mysqli_stmt_prepare($stmt, $sql)) {
            //                             echo "SQL_Error_Select_login1";
            //                             exit();
            //                         } else {
            //                             $timeout = "00:00:00";
            //                             $remark = ""; 
            //                             // Check if ON TIME, LATE, or OVERTIME
            //                             if (strtotime($t) < strtotime('07:15:00')) {
            //                                 $remark = "ON-TIME";
            //                             } elseif (strtotime($t) > strtotime('07:15:00')) {
            //                                 $remark = "LATE";
            //                             }
            //                             if (strtotime($t) > strtotime('14:30:00')) {
            //                                 $remark = "OVERTIME";
            //                             }
            //                             mysqli_stmt_bind_param($stmt, "sssssssss", $fingerID, $device_uid, $device_kelas, $t, $timeout, $remark, $time, $id_user, $d);
            //                             mysqli_stmt_execute($stmt); // Use $stmt instead of $result
            //                             echo "login " . $Uname;
            //                             exit();
            //                         }
            //                     } else {
            //                         // Logout
            //                         $sql = "UPDATE user_log SET timeout=?, remark=?, fingerout=1, updated_at=? WHERE fingerprint_id=? AND checkindate=? AND fingerout=0 AND user_id=?";
            //                         $stmt = mysqli_stmt_init($conn); // Use $stmt instead of $result
            //                         if (!mysqli_stmt_prepare($stmt, $sql)) {
            //                             echo "SQL_Error_insert_logout1";
            //                             exit();
            //                         } else {
            //                             $remark = ""; // Default value for remark
            //                             // Check if OVERTIME
            //                             if (strtotime($t) > strtotime('14:30:00')) {
            //                                 $remark = "OVERTIME";
            //                             }
            //                             mysqli_stmt_bind_param($stmt, "sssssi", $t, $remark, $time, $fingerID, $d, $id_user);
            //                             mysqli_stmt_execute($stmt); // Use $stmt instead of $result
            //                             echo "logout " . $Uname;
            //                             exit();
            //                         }
            //                     }                                
            //                 }
            //             } else {
            //                 echo "Not registered!";
            //                 exit();
            //             }
            //         }
            //         else{
            //             echo "Not found!";
            //             exit();
            //         }
            //     }
            // }

            if ($device_mode == 1) {
                $sql = "SELECT * FROM users WHERE fingerprint_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "s", $fingerID);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        if ($row['name'] != "None" && $row['add_fingerid'] == 0) {
                            $Uname = $row['name'];
                            $Number = $row['credential_number'];
                            $id_user = $row['id'];
            
                            // Check if the user has logged in today
                            $sql = "SELECT * FROM user_log WHERE fingerprint_id=? AND checkindate=? AND user_id=? ORDER BY id DESC LIMIT 1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_Select_logs";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($result, "sss", $fingerID, $d, $id_user);
                                mysqli_stmt_execute($result);
                                $resultl = mysqli_stmt_get_result($result);
            
                                if ($row = mysqli_fetch_assoc($resultl)) {
                                    if ($row['fingerout'] == 1) {
                                        // User is logging in after logging out
                                        $sql = "INSERT INTO user_log (name, credential_number, fingerprint_id, device_uid, device_kelas, checkindate, timein, timeout, fingerout, created_at, user_id, remark) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                        $stmt = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                                            echo "SQL_Error_Insert_login_after_logout";
                                            exit();
                                        } else {
                                            $timeout = "00:00:00";
                                            $remark = "";
                                            if (strtotime($t) < strtotime('07:15:00')) {
                                                $remark = "ON-TIME";
                                            } elseif (strtotime($t) > strtotime('07:15:00')) {
                                                $remark = "LATE";
                                            }
                                            if (strtotime($t) > strtotime('14:30:00')) {
                                                $remark = "OVERTIME";
                                            }
                                            // Set fingerout to 0 for new login
                                            $fingerout = 0;
                                            mysqli_stmt_bind_param($stmt, "sssssssssssi", $Uname, $Number, $fingerID, $device_uid, $device_kelas, $d, $t, $timeout, $fingerout, $time, $id_user, $remark);
                                            mysqli_stmt_execute($stmt);
                                            echo "login setelah logout " . $Uname;
                                            exit();
                                        } 
                                    } else {
                                        // User is logging out
                                        $sql = "UPDATE user_log SET timeout=?, remark=?, fingerout=1, updated_at=? WHERE user_id=? AND fingerout=0";
                                        $stmt = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                                            echo "SQL_Error_Update_logout";
                                            exit();
                                        } else {
                                            $remark = "";
                                            if (strtotime($t) > strtotime('14:30:00')) {
                                                $remark = "OVERTIME";
                                            }
                                            mysqli_stmt_bind_param($stmt, "sssi", $t, $remark, $time, $id_user);
                                            mysqli_stmt_execute($stmt);
                                            echo "logout " . $Uname;
                                            exit();
                                        }
                                    }
                                } else {
                                    // User is logging in for the first time today
                                    $sql = "UPDATE user_log SET fingerprint_id=?, device_uid=?, device_kelas=?, timein=?, timeout=?, remark=?, created_at=? WHERE user_id=? AND checkindate=?";
                                    $stmt = mysqli_stmt_init($conn); // Use $stmt instead of $result
                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        echo "SQL_Error_Select_login1";
                                        exit();
                                    } else {
                                        $timeout = "00:00:00";
                                        $remark = ""; 
                                        // Check if ON TIME, LATE, or OVERTIME
                                        if (strtotime($t) < strtotime('07:15:00')) {
                                            $remark = "ON-TIME";
                                        } elseif (strtotime($t) > strtotime('07:15:00')) {
                                            $remark = "LATE";
                                        }
                                        if (strtotime($t) > strtotime('14:30:00')) {
                                            $remark = "OVERTIME";
                                        }
                                        mysqli_stmt_bind_param($stmt, "sssssssss", $fingerID, $device_uid, $device_kelas, $t, $timeout, $remark, $time, $id_user, $d);
                                        mysqli_stmt_execute($stmt); // Use $stmt instead of $result
                                        echo "login pertama " . $Uname;
                                        exit();
                                    }
                                }
                            }
                        } else {
                            echo "Not registered!";
                            exit();
                        }
                    } else {
                        echo "Not found!";
                        exit();
                    }
                }
            }            
            
            
            else if ($device_mode == 0) {
                //New Fingerprint has been added
                $sql = "SELECT * FROM all_data WHERE fingerprint_id=? AND device_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "ss", $fingerID, $device_id);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)){
                        echo "available";
                        exit();
                    }
                    else {
                        $sql = "INSERT INTO all_data (device_id, fingerprint_id, add_fingerid, del_fingerid, fingerprint_select) VALUES (?, ?, '0', '0', '0')";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_add";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($result, "ss", $device_id, $fingerID); 
                            mysqli_stmt_execute($result);

                            echo "successful";
                            exit();
                        }
                    }
                }    
            }
        }
        else{
            echo "Invalid Device!";
            exit();
        }
    }          
}

if (!empty($_GET['confirm_id']) && isset($_GET['device_token'])) {

    $fingerid = $_GET['confirm_id'];
    $device_uid = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $device_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){

            $sql="UPDATE all_data SET fingerprint_select=0 WHERE fingerprint_select=1 AND device_uid=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_Select";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "s", $device_uid);
                mysqli_stmt_execute($result);
                
                $sql="UPDATE all_data SET add_fingerid=0, fingerprint_select=1 WHERE fingerprint_id=? AND device_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "ss", $fingerid, $device_uid);
                    mysqli_stmt_execute($result);
                    echo "Fingerprint has been added!";
                    exit();
                }
            }  
        }
        else{
            echo "Invalid Device";
            exit();
        }
    } 
}

if (isset($_GET['DeleteID']) && isset($_GET['device_token'])) {
    $device_uid = $_GET['device_token'];

    if ($_GET['DeleteID'] == "check") {
        $sql = "SELECT * FROM table_device WHERE device_uid=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL_Error_Select_device";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $device_uid);
            mysqli_stmt_execute($stmt);
            $resultl = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($resultl)) {
                $sql = "SELECT fingerprint_id FROM all_data WHERE del_fingerid=1 AND device_uid=? LIMIT 1";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $device_uid);
                    mysqli_stmt_execute($stmt);
                    $resultl = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        echo "del-id" . $row['fingerprint_id'];

                        $sql = "UPDATE all_data SET deleted_at=?, del_fingerid=0, fingerprint_id=0 WHERE del_fingerid=1 AND device_uid=? LIMIT 1";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL_Error_delete";
                            exit();
                        } else {    
                            mysqli_stmt_bind_param($stmt, "ss", $time, $device_uid);
                            mysqli_stmt_execute($stmt);
                            exit();
                        }
                    } else {
                        echo "nothing";
                        exit();
                    }
                }
            } else {
                echo "Invalid Device";
                exit();
            }
        }
    } else {
        exit();
    }
} else {
    exit();
}

?>