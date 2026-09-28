<?php

namespace App\Support;

class NamaWaliKelas
{
    /** @var array<int, array<string, list<string>>> */
    private const DAFTAR = [
        10 => [
            'TKI' => ['Muashofah, M.Pd', 'Sri Kusumastuti, S.Pd'],
            'RPL' => ['Indriati, S.Pd', 'Umi Kulsum, S.Pd'],
            'TKJ' => ['Listyana Hartati, S.Kom., M.Pd', 'Muhammad Fajar Assidiqi, S.Pd'],
            'BD' => ['Ratih Dian Irawati, S.E', 'Erna Qoriah, S.Pd', 'Retno Widyastuti, S.E'],
            'MP' => ['Tutut Sriatin, S.Pd', 'Peni Wulandari, S.Pd', 'Yustin Febrini, S.Pd', 'Rindang Rejeki, S.Pd'],
            'AK' => ['Atikh Wulipi, S.E., M.Pd', 'Yuli Ratnasari, S.Pd', 'Ista Nofasari, S.Pd', 'Astra Bela Flamboyan, S.Psi'],
            'ULW' => ['Dwi Nova Setyandari, S.Pd'],
            'DKV' => ['Rulik Indrayati, S.Pd', 'Khoyrotun Hisani, S.Sn'],
            'PSPT' => ['Benny Mora Kos, S.Kom', 'Muti’atul Khosiah, S.Pd'],
            'AN' => ['Dhlana Putri Puspitasary, S.Pd', 'Rika Okta Maulida, S.Ds'],
        ],
        11 => [
            'TKI' => ['Diana Hartanti, S.T', 'Yuni Jiastuti, S.Pd'],
            'RPL' => ['Sulistyowati, S.S', 'Winartin, S.Pd'],
            'TKJ' => ['Sri Rahayu, S.Pd', 'Fitri Amaliyah, S.Pd'],
            'BD' => ['Nur Eko Wahyuningsih, S.Pd', 'Erna Rinawati, S.Pd', 'Luluk Munfarida, S.Pd'],
            'MP' => ['Martin, S.Pd', 'Sunarti, S.Pd', 'Titik Samsistini, S.Pd', 'Mega Mahardika, S.Pd'],
            'AK' => ['Dra. Anik Indriani', 'Pipit Ambarwati, S.Pd', 'Arvia Renitasari, S.Pd', 'Ninik Sriwidayati, S.Pd'],
            'ULW' => ['Risqi Nur Imama, S.St.Par'],
            'DKV' => ['Sinta Lestari, S.Pd.I', 'Endik Kuswantoro, S.Kom'],
            'PSPT' => ['Winarsih, S.Pd., M.Pd', 'Tuhu Eries Kudori, S.Sn'],
            'AN' => ['Kuriyatul Kamila, S.Pd', 'Arif Setyobudi, S.Pd'],
        ],
        12 => [
            'TKI' => ["Rifkotin Na'imah, S.Pd", 'Basuki Sarjono, S.Pd'],
            'RPL' => ['Andri Retno Yuli Astuti, S.Pd', 'Badrus Sulaiman, S.Pd'],
            'TKJ' => ['Siswanti Purwaningsih, S.T', 'Nishfu Laili, S.Pd'],
            'BD' => ['Nurul Azizah, S.Pd', 'Anisa Kusumawati, S.Pd', 'Niken Dewi Hastika, S.Pd'],
            'MP' => ['Ajeng Oktavisari, S.Pd', 'Abdul Rohman, S.Pd', 'Fitria Dayah Ayu Hartati, S.Pd', 'Veronica Damay Rulitasari, S.Pd'],
            'AK' => ['Indayah, S.Pd', 'Siti Umiharsih, S.Pd', 'Kasmi, S.Pd', 'Septiani, S.Pd., M.Pd'],
            'ULW' => ['Fitria Renyatasari, S.Pd'],
            'DKV' => ['Fajar Wahyu Pratiwi, S.S', 'Elsa Yuli Nuraini, S.Si'],
            'PSPT' => ['Wiwik Winarsih, S.Pd', 'Mutiafor, S.Ag'],
            'AN' => ['Siti Maisaroh, S.Pd', 'Siti Khoiriyah, S.Pd'],
        ],
    ];

    public static function untukKelas(int|string $tingkat, string $jurusan, int|string $rombel): ?string
    {
        $names = self::DAFTAR[(int) $tingkat][strtoupper(trim($jurusan))] ?? [];

        return $names[(int) $rombel - 1] ?? null;
    }
}
