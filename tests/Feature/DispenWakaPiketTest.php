<?php

namespace Tests\Feature;

use App\Models\JadwalPiketBulanan;
use App\Models\Waka;
use App\Support\WakaPiket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Alur persetujuan dispensasi: guru mengajukan surat, sistem menentukan Waka
 * piket dari jadwal buatan admin, lalu mengirim tautan persetujuan WhatsApp
 * yang dapat dipakai Waka tanpa login.
 */
class DispenWakaPiketTest extends TestCase
{
    use RefreshDatabase;

    /** Senin, dipakai sebagai "hari ini" agar jadwal piket mudah diuji. */
    private const HARI_INI = '2026-09-28';

    protected function setUp(): void
    {
        parent::setUp();

        config(['jurnal.waktu_uji' => self::HARI_INI.' 08:00:00']);
    }

    public function test_nomor_waka_distandardkan_untuk_tautan_whatsapp(): void
    {
        $waka = $this->buatWaka('Waka Nomor', '0812-3456-7890');

        $this->assertSame('6281234567890', $waka->nomorWa());
        $this->assertSame('0812-3456-7890', $waka->nomorTampilan());
        $this->assertTrue($waka->nomorValid());

        $luarNegeri = $this->buatWaka('Waka Luar Negeri', '+62 812-3456-7890');
        $this->assertSame('6281234567890', $luarNegeri->nomorWa());

        $tanpaNomor = $this->buatWaka('Waka Tanpa Nomor', null);
        $this->assertNull($tanpaNomor->nomorWa());
        $this->assertFalse($tanpaNomor->nomorValid());

        $tidakJelas = $this->buatWaka('Waka Salah Ketik', 'bukan nomor');
        $this->assertFalse($tidakJelas->nomorValid());
    }

    public function test_waka_ditentukan_berdasarkan_tanggal_dispensasi(): void
    {
        $wakaHariIni = $this->buatWaka('Waka Senin', '081200000001');
        $wakaBesok = $this->buatWaka('Waka Selasa', '081200000002');

        $this->jadwalkanWaka(self::HARI_INI, $wakaHariIni);
        $this->jadwalkanWaka('2026-09-29', $wakaBesok);

        $this->assertSame($wakaBesok->id, WakaPiket::bertugas('2026-09-29')?->id);
        $this->assertSame($wakaHariIni->id, WakaPiket::bertugas(self::HARI_INI)?->id);
    }

    public function test_waka_bernomor_lengkap_diprioritaskan_dan_ada_pencadangan(): void
    {
        $tanpaNomor = $this->buatWaka('Waka Tanpa Nomor', null);
        $lengkap = $this->buatWaka('Waka Siap WA', '081200000009');

        $this->jadwalkanWaka(self::HARI_INI, $tanpaNomor);
        $this->jadwalkanWaka('2026-09-30', $lengkap);

        // Jadwal hari ini belum punya nomor, jadi dipakai jadwal Waka berikutnya.
        $this->assertSame($lengkap->id, WakaPiket::bertugas(self::HARI_INI)?->id);

        // Tanpa satu pun jadwal Waka, sistem tidak mengarang penerima.
        JadwalPiketBulanan::query()->delete();
        $this->assertNull(WakaPiket::bertugas(self::HARI_INI));
    }
}
