<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Jadwal;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
        ]);

        $daftar_kelas = [
            ['kode_kelas' => 'X-IPA-A', 'nama_kelas' => 'Sepuluh IPA A'],
            ['kode_kelas' => 'X-IPA-B', 'nama_kelas' => 'Sepuluh IPA B'],
            ['kode_kelas' => 'X-IPA-C', 'nama_kelas' => 'Sepuluh IPA C'],
            ['kode_kelas' => 'X-IPA-D', 'nama_kelas' => 'Sepuluh IPA D'],
            ['kode_kelas' => 'XI-IPA-A', 'nama_kelas' => 'Sebelas IPA A'],
            ['kode_kelas' => 'XI-IPA-B', 'nama_kelas' => 'Sebelas IPA B'],
            ['kode_kelas' => 'XI-IPA-C', 'nama_kelas' => 'Sebelas IPA C'],
            ['kode_kelas' => 'XI-IPA-D', 'nama_kelas' => 'Sebelas IPA D'],
            ['kode_kelas' => 'XII-IPA-A' , 'nama_kelas'=> 'DuaBelas IPA A'],
            ['kode_kelas' => 'XII-IPA-B' , 'nama_kelas'=> 'DuaBelas IPA B'],
            ['kode_kelas' => 'XII-IPA-C' , 'nama_kelas'=> 'DuaBelas IPA C'],
            ['kode_kelas' => 'XII-IPA-D' , 'nama_kelas'=> 'DuaBelas IPA D'],
        ];

        foreach ($daftar_kelas as $k) Kelas::create($k);

        $daftar_mapel = [
            ['kode_mapel' => 'MTK-1', 'nama_mapel' => 'Matematika Wajib'],
            ['kode_mapel' => 'MTK-2', 'nama_mapel' => 'Matematika Peminatan'],
            ['kode_mapel' => 'IPA-1', 'nama_mapel' => 'Fisika Wajib'],
            ['kode_mapel' => 'IPA-2', 'nama_mapel' => 'Fisika Peminatan'],
            ['kode_mapel' => 'ENG-1', 'nama_mapel' => 'Bahasa Inggris'],
            ['kode_mapel' => 'IND-1', 'nama_mapel' => 'Bahasa Indonesia'],
        ];

        foreach ($daftar_mapel as $m) Mapel::create($m);

        for ($i = 0; $i < 10; $i++) {
            $user = User::factory()->create(['type' => 'guru']);
            Guru::factory()->create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
            ]);
        }

        $kelasIds = Kelas::pluck('id');
        foreach ($kelasIds as $id_kelas) {
            // 10 siswa per kelas
            Siswa::factory()->count(10)->create([
                'kelas_id' => $id_kelas
            ]);
        }

        $mapelIds = Mapel::pluck('id');
        $guruIds = Guru::pluck('id');

        foreach ($kelasIds as $id_kelas) {
            foreach ($mapelIds as $id_mapel) {
                Jadwal::create([
                    'kelas_id' => $id_kelas,
                    'mapel_id' => $id_mapel,
                    'guru_id' => $guruIds->random(),
                    'hari' => fake()->randomElement(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']),
                    'jam_pelajaran' => '07:00 - 09:00',
                ]);
            }
        }
    }
}
