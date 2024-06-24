<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\UserLog;
use App\Models\MasterHoliday;
use Carbon\Carbon;

class AttendanceScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mencatat kehadiran siswa';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->scheduleAttendance();
        $time = Carbon::now()->format('Y-m-d H:i:s');

        
        $this->info('Scheduler kehadiran siswa telah dijalankan.');
        $this->info('Jam Sekarang '.$time);
    }

    /**
     * Schedule the attendance recording process.
     *
     * @return void
     */
    private function scheduleAttendance()
    {
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
            // Get all students with "siswa" position
            $students = User::where('position', 'siswa')->get();
            $this->info('Number of students found: ' . $students->count());

            // Record attendance for each student
            foreach ($students as $student) {
                UserLog::create([
                    'name' => $student->name,
                    'credential_number' => $student->credential_number,
                    'checkindate' => $today,
                    'user_id' => $student->id,
                    'created_at' =>$time,
                    'updated_at' =>$time,
                    'remark'=>'ABSENT'
                ]);
            }
        }
    }
}