<?php

if (isset($_GET['FingerID']) && isset($_GET['device_token'])) {

    $fingerID = $_GET['FingerID'];
    $device_token = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    } else {
        mysqli_stmt_bind_param($result, "s", $device_token);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {
            $device_id = $row['id'];
            $device_mode = $row['device_mode'];
            $device_kelas = $row['device_kelas'];

            if ($device_mode == 1) {
                $sql = "SELECT * FROM all_data WHERE fingerprint_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "s", $fingerID);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        if ($row['username'] != "None" && $row['add_fingerid'] == 0) {
                            $Uname = $row['username'];
                            $Number = $row['serialnumber'];
                            $sql = "SELECT * FROM users_logs WHERE fingerprint_id=? AND checkindate=? AND timeout=''";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_Select_logs";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($result, "ss", $fingerID, $d);
                                mysqli_stmt_execute($result);
                                $resultl = mysqli_stmt_get_result($result);

                                if (!$row = mysqli_fetch_assoc($resultl)) {
                                    $sql = "INSERT INTO users_logs (username, serialnumber, fingerprint_id, device_id, device_kelas, checkindate, timein, timeout) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_Insert_login1";
                                        exit();
                                    } else {
                                        $timeout = "00:00:00";
                                        mysqli_stmt_bind_param($result, "sdisssss", $Uname, $Number, $fingerID, $device_id, $device_kelas, $d, $t, $timeout);
                                        mysqli_stmt_execute($result);

                                        echo "login" . $Uname;
                                        exit();
                                    }
                                } else {
                                    $sql = "UPDATE users_logs SET timeout=?, fingerout=1 WHERE fingerprint_id=? AND checkindate=? AND fingerout=0";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_Insert_logout1";
                                        exit();
                                    } else {
                                        mysqli_stmt_bind_param($result, "sis", $t, $fingerID, $d);
                                        mysqli_stmt_execute($result);

                                        echo "logout" . $Uname;
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
            } else if ($device_mode == 0) {
                $sql = "SELECT * FROM all_data WHERE fingerprint_id=? AND device_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "si", $fingerID, $device_id);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        echo "available";
                        exit();
                    } else {
                        $sql = "INSERT INTO all_data (device_id, device_kelas, fingerprint_id, add_fingerid) VALUES (?, ?, ?, 0)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_add";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($result, "iss", $device_id, $device_kelas, $fingerID);
                            mysqli_stmt_execute($result);

                            echo "successful";
                            exit();
                        }
                    }
                }
            }
        } else {
            echo "Invalid Device!";
            exit();
        }
    }
}

if (isset($_GET['Check_mode']) && isset($_GET['device_token'])) {
    $device_token = $_GET['device_token'];

    $sql = "SELECT device_mode FROM table_device WHERE device_uid=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode(array("success" => false, "message" => "SQL_Error_Select_device"));
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $device_token);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $device_mode = $row['device_mode'];
            echo json_encode(array("success" => true, "mode" => $device_mode));
        } else {
            echo json_encode(array("success" => false, "message" => "Invalid Device"));
        }
        exit();
    }
}

if (isset($_GET['Get_Fingerid']) && isset($_GET['device_token'])) {

    $device_token = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    } else {
        mysqli_stmt_bind_param($result, "s", $device_token);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {
            $device_id = $row['device_id'];

            if ($_GET['Get_Fingerid'] == "get_id") {
                $sql = "SELECT fingerprint_id FROM all_data WHERE add_fingerid=1 AND device_id=? LIMIT 1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_all_data";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "i", $device_id);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        echo "add-id" . $row['fingerprint_id'];
                        exit();
                    } else {
                        echo "Nothing";
                        exit();
                    }
                }
            } else {
                exit();
            }
        } else {
            echo "Invalid Device";
            exit();
        }
    }
}

if (!empty($_GET['confirm_id']) && isset($_GET['device_token'])) {

    $fingerid = $_GET['confirm_id'];
    $device_token = $_GET['device_token'];

    $sql = "SELECT * FROM table_device WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    } else {
        mysqli_stmt_bind_param($result, "s", $device_token);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {
            $device_id = $row['device_id'];

            $sql = "UPDATE all_data SET fingerprint_select=0 WHERE fingerprint_select=1 AND device_id=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_Select";
                exit();
            } else {
                mysqli_stmt_bind_param($result, "i", $device_id);
                mysqli_stmt_execute($result);

                $sql = "UPDATE all_data SET add_fingerid=0, fingerprint_select=1 WHERE fingerprint_id=? AND device_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "si", $fingerid, $device_id);
                    mysqli_stmt_execute($result);
                    echo "Fingerprint has been added!";
                    exit();
                }
            }
        } else {
            echo "Invalid Device";
            exit();
        }
    }
}

if (isset($_GET['DeleteID']) && isset($_GET['device_token'])) {

    $device_token = $_GET['device_token'];
    if ($_GET['DeleteID'] == "check") {
        $sql = "SELECT * FROM table_device WHERE device_uid=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select_device";
            exit();
        } else {
            mysqli_stmt_bind_param($result, "s", $device_token);
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                $device_id = $row['device_id'];

                $sql = "SELECT fingerprint_id FROM all_data WHERE del_fingerid=1 AND device_id=? LIMIT 1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                } else {
                    mysqli_stmt_bind_param($result, "i", $device_id);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)) {

                        echo "del-id" . $row['fingerprint_id'];

                        $sql = "DELETE FROM all_data WHERE del_fingerid=1 AND device_id=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_delete";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($result, "i", $device_id);
                            mysqli_stmt_execute($result);
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
}

?>