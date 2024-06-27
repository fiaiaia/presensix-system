<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserLog;
use App\Models\MasterHoliday;
use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;

class AttendanceNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirimkan Notifikasi Absensi ke Orang Tua Siswa yang Tidak Hadir di Kelas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deviceToken = env('FONNTE_DEVICE_TOKEN');
        $apiUrl = env('FONNTE_URL', 'https://api.fonnte.com/send');

        if (empty($deviceToken) || empty($apiUrl)) {
            $this->error('Device token or API URL is not set.');
            return;
        }

        $time = Carbon::now()->format('Y-m-d H:i:s');
        $this->info('Scheduler notifikasi kehadiran siswa telah dijalankan.');
        $this->info('Jam Sekarang '.$time);

        $this->scheduleNotification();
    }

    /**
     * Schedule the attendance notification process.
     *
     * @return void
     */
    private function scheduleNotification()
    {
        // Get device token and API URL
        $deviceToken = env('FONNTE_DEVICE_TOKEN');
        $apiUrl = env('FONNTE_URL', 'https://api.fonnte.com/send');

        // Get today's date in Y-m-d format
        $today = Carbon::now(('Asia/Jakarta'))->format('Y-m-d');
        $time = Carbon::now(('Asia/Jakarta'))->format('Y-m-d H:i:s');

        // Check if today is a holiday
        $isHoliday = MasterHoliday::where('date', $today)->exists();

        if ($isHoliday) {
            $this->info('Today is a holiday.');
            return;
        }

        if (!$isHoliday) {
            // Get students who are late today
            $students = User::where('position', 'siswa')
                ->whereHas('userLogs', function ($query) use ($today) {
                    $query->where('checkindate', $today)
                        ->where('remark', 'late');
                })
                ->get();
            $this->info('Jumlah siswa yang terlambat: ' . $students->count());

            // If there are no students who are late
            if ($students->count() == 0) {
                $this->info('Tidak ada siswa yang terlambat.');
                return;
            }

            // Send notification to parents
            $message = "Selamat Pagi Bpk/Ibu {var1}," . PHP_EOL .
                "Diberitahukan bahwa siswa/i atas nama {name} tidak hadir di sekolah pada tanggal {var2}, segera hubungi walikelas untuk konfirmasi dan membuat ticket perizinan resmi melalui website. Terimakasih";

            // Prepare the target phone numbers
            $target = '';
            foreach ($students as $student) {
                $target .= $student->no_telp_ortu . '|' . $student->name . '|' . $student->nama_ortu_siswa . '|' . $today . ',';
            }
            $target = rtrim($target, ',');
            $this->info('Target: ' . $target);

            // Send the notification
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => $deviceToken,
            ];

            // Send the notification
            $client = new GuzzleClient([
                'headers' => $headers
            ]);

            // Send the notification
            $response = $client->request('POST', $apiUrl, [
                'form_params' => [
                    'target' => $target,
                    'message' => $message,
                ],
            ]);

            if (json_decode($response->getBody())->status == 'true') {
                $this->info('Status: ' . json_decode($response->getBody())->detail);
            } else {
                $this->error('Failed to send notification: ' . json_decode($response->getBody())->reason);
            }
        }
    }
}
