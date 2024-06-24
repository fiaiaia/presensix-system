<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'self-monitoring',
            'add-permission',
            'student-monitoring-permission',
            'student-monitoring-absent-guru',
            'add-user',
            'edit-user',
            'read-user',
            'student-monitoring-absent-kesiswaan'
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Roles with display names
        $roles = [
            'super-admin' => 'Super Admin',
            'siswa' => 'Siswa',
            'walikelas' => 'Wali Kelas',
            'guru-bk' => 'Guru BK',
            'kesiswaan' => 'Bagian Kesiswaan',
        ];

        foreach ($roles as $name => $displayName) {
            if (!Role::where('name', $name)->exists()) {
                Role::create(['name' => $name, 'display_name' => $displayName]);
            }
        }

        // Assign permissions to roles
        $roleAdmin = Role::findByName('super-admin');
        $roleAdmin->givePermissionTo(['add-user', 'edit-user', 'read-user']);

        $roleSiswa = Role::findByName('siswa');
        $roleSiswa->givePermissionTo(['self-monitoring', 'add-permission']);

        $roleGuruBK = Role::findByName('guru-bk');
        $roleGuruBK->givePermissionTo(['student-monitoring-permission', 'student-monitoring-absent-guru']);

        $roleWalikelas = Role::findByName('walikelas');
        $roleWalikelas->givePermissionTo(['student-monitoring-permission', 'student-monitoring-absent-guru']);

        $roleKesiswaan = Role::findByName('kesiswaan');
        $roleKesiswaan->givePermissionTo(['student-monitoring-absent-kesiswaan']);
    }
}