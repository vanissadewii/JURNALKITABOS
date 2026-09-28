<?php

namespace Tests\Feature;

use App\Models\JadwalPiketBulanan;
use App\Models\User;
use App\Models\Waka;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminJadwalPiketMode24JamTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    /** @return array{list<int>, Waka} */
    private function petugas(): array
    {
        $guru = collect(range(1, 6))->map(fn ($i) => User::factory()->create([
            'name' => "Guru Uji {$i}", 'role' => 'guru',
        ]));
        $waka = Waka::create(['nama' => 'Waka Uji', 'no_hp' => '081234567890']);

        return [$guru->pluck('id')->all(), $waka];
    }

    private function payload(string $tanggal, array $ids, Waka $waka, bool $mode24Jam): array
    {
        return [
            'bulan' => 9,
            'tahun' => 2026,
            'tanggal' => $tanggal,
            'mode_24_jam' => $mode24Jam ? '1' : '0',
            'jadwal' => [
                'pagi' => array_slice($ids, 0, 3),
                'siang' => array_slice($ids, 3, 3),
                'waka' => $waka->id,
            ],
        ];
    }

    public function test_admin_can_save_and_disable_24_hour_test_schedule(): void
    {
        [$ids, $waka] = $this->petugas();
        $this->actingAs($this->admin())
            ->post(route('admin.tambah.piket.store'), $this->payload('2026-09-28', $ids, $waka, true))
            ->assertRedirect(route('admin.tambah.piket', ['bulan' => 9, 'tahun' => 2026]));

        $jadwal24Jam = JadwalPiketBulanan::whereDate('tanggal', '2026-09-28')
            ->whereIn('sesi', ['pagi', 'siang'])->get();
        $this->assertCount(6, $jadwal24Jam);
        $this->assertTrue($jadwal24Jam->every(fn ($item) => $item->jam_mulai === '00:00:00' && $item->jam_selesai === '00:00:00'));

        $this->actingAs($this->admin())
            ->post(route('admin.tambah.piket.store'), $this->payload('2026-09-29', $ids, $waka, false))
            ->assertRedirect(route('admin.tambah.piket', ['bulan' => 9, 'tahun' => 2026]));

        $jadwalNormal = JadwalPiketBulanan::whereDate('tanggal', '2026-09-29')
            ->whereIn('sesi', ['pagi', 'siang'])->get()->keyBy('sesi');
        $this->assertSame('07:00:00', $jadwalNormal->get('pagi')?->jam_mulai);
        $this->assertSame('11:00:00', $jadwalNormal->get('pagi')?->jam_selesai);
        $this->assertSame('11:00:00', $jadwalNormal->get('siang')?->jam_mulai);
        $this->assertSame('15:00:00', $jadwalNormal->get('siang')?->jam_selesai);
    }
}
