<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class GetDataSensorController extends Controller
{
    // public function receiveData(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'FingerID' => 'required',
    //         'device_token' => 'required',
    //     ]);

    //     $fingerID = $validatedData['FingerID'];
    //     $device_uid = $validatedData['device_token'];
    //     $device = Device::where('device_uid', $device_uid)->first();

    //     if (!$device) {
    //         return response('Invalid Device!', 400);
    //     }

    //     if ($device->device_mode == 1) {
    //         $user = User::where('fingerprint_id', $fingerID)->first();
    //         if ($user && $user->username != "None" && !$user->add_fingerid) {
    //             $log = UserLog::where('fingerprint_id', $fingerID)
    //                 ->where('checkindate', Carbon::today())
    //                 ->whereNull('timeout')
    //                 ->first();

    //             if (!$log) {
    //                 UserLog::create([
    //                     'username' => $user->username,
    //                     'serialnumber' => $user->serialnumber,
    //                     'fingerprint_id' => $fingerID,
    //                     'device_uid' => $device_uid,
    //                     'device_dep' => $device->device_dep,
    //                     'checkindate' => Carbon::today(),
    //                     'timein' => Carbon::now(),
    //                     'timeout' => '00:00:00',
    //                 ]);

    //                 return response("login".$user->username, 200);
    //             } else {
    //                 $log->update([
    //                     'timeout' => Carbon::now(),
    //                     'fingerout' => true,
    //                 ]);

    //                 return response("logout".$user->username, 200);
    //             }
    //         } else {
    //             return response('Not registered!', 400);
    //         }
    //     } elseif ($device->device_mode == 0) {
    //         $user = User::where('fingerprint_id', $fingerID)
    //             ->where('device_uid', $device_uid)
    //             ->first();

    //         if ($user) {
    //             return response('available', 200);
    //         } else {
    //             User::create([
    //                 'device_uid' => $device_uid,
    //                 'device_kelas' => $device->device_kelas,
    //                 'fingerprint_id' => $fingerID,
    //                 'add_fingerid' => false,
    //             ]);

    //             return response('successful', 200);
    //         }
    //     }
    // }

    // public function receiveData(Request $request)
    // {
    //     $device_uid = $request->input('device_token');
    //     $device = Device::where('device_uid', $device_uid)->first();

    //     if (!$device) {
    //         return response('Invalid Device!', 400);
    //     }

    //     if ($request->input('Check_mode') == "get_mode") {
    //         return response("mode" . $device->device_mode, 200);
    //     }

    //     $validatedData = $request->validate([
    //         'FingerID' => 'required',
    //         'device_token' => 'required',
    //     ]);

    //     $fingerID = $validatedData['FingerID'];
        
    //     if ($device->device_mode == 1) {
    //         $user = User::where('fingerprint_id', $fingerID)->first();
    //         if ($user && $user->username != "None" && !$user->add_fingerid) {
    //             $log = UserLog::where('fingerprint_id', $fingerID)
    //                 ->where('checkindate', Carbon::today())
    //                 ->whereNull('timeout')
    //                 ->first();

    //             if (!$log) {
    //                 UserLog::create([
    //                     'username' => $user->username,
    //                     'serialnumber' => $user->serialnumber,
    //                     'fingerprint_id' => $fingerID,
    //                     'device_uid' => $device_uid,
    //                     'device_dep' => $device->device_dep,
    //                     'checkindate' => Carbon::today(),
    //                     'timein' => Carbon::now(),
    //                     'timeout' => '00:00:00',
    //                 ]);

    //                 return response("login".$user->username, 200);
    //             } else {
    //                 $log->update([
    //                     'timeout' => Carbon::now(),
    //                     'fingerout' => true,
    //                 ]);

    //                 return response("logout".$user->username, 200);
    //             }
    //         } else {
    //             return response('Not registered!', 400);
    //         }
    //     } elseif ($device->device_mode == 0) {
    //         $user = User::where('fingerprint_id', $fingerID)
    //             ->where('device_uid', $device_uid)
    //             ->first();

    //         if ($user) {
    //             return response('available', 200);
    //         } else {
    //             User::create([
    //                 'device_uid' => $device_uid,
    //                 'device_dep' => $device->device_dep,
    //                 'fingerprint_id' => $fingerID,
    //                 'add_fingerid' => false,
    //             ]);

    //             return response('successful', 200);
    //         }
    //     }

    //     // Get FingerID Functionality
    //     if ($request->input('Get_Fingerid') == "get_id") {
    //         $user = User::where('add_fingerid', 1)
    //             ->where('device_uid', $device_uid)
    //             ->first();

    //         if ($user) {
    //             return response("add-id" . $user->fingerprint_id, 200);
    //         } else {
    //             return response("Nothing", 200);
    //         }
    //     }

    //     // Confirm ID Functionality
    //     if ($request->has('confirm_id')) {
    //         $confirmId = $request->input('confirm_id');
    //         User::where('fingerprint_select', 1)
    //             ->where('device_uid', $device_uid)
    //             ->update(['fingerprint_select' => 0]);

    //         User::where('fingerprint_id', $confirmId)
    //             ->where('device_uid', $device_uid)
    //             ->update(['add_fingerid' => 0, 'fingerprint_select' => 1]);

    //         return response('Fingerprint has been added!', 200);
    //     }

    //     // Delete ID Functionality
    //     if ($request->input('DeleteID') == "check") {
    //         $user = User::where('del_fingerid', 1)
    //             ->where('device_uid', $device_uid)
    //             ->first();

    //         if ($user) {
    //             $fingerID = $user->fingerprint_id;
    //             $user->delete();

    //             return response("del-id" . $fingerID, 200);
    //         } else {
    //             return response("nothing", 200);
    //         }
    //     }
    // }

    // public function checkMode(Request $request)
    // {
    //     \Log::info('checkMode called', ['query' => $request->query()]);

    //     $deviceToken = $request->query('device_token');

    //     if (!$deviceToken) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Device token is required'  
    //         ], 400);
    //     }

    //     $device = Device::where('token', $deviceToken)->first();

    //     if ($device) {
    //         $deviceMode = $device->mode;
    //         return response()->json([
    //             'status' => 'success',
    //             'mode' => $deviceMode,
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Device not found or no mode set',
    //     ], 404);
    // }

    /**
     * Mendapatkan data sensor dari perangkat Arduino.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSensorData(Request $request)
    {
        $deviceToken = $request->input('device_token');

        // Cari data berdasarkan device token
        $device = Device::where('device_uid', $deviceToken)->first();

        if (!$device) {
            return response()->json(['error' => 'Device token not found'], 404);
        }

        // Ambil mode dari data device
        $mode = $device->device_mode;

        // Format respons sesuai dengan yang diharapkan oleh perangkat Anda
        $response = [
            'mode' => $mode
            // Anda dapat menambahkan data lainnya sesuai kebutuhan
        ];

        return response()->json($response);
    }
}
