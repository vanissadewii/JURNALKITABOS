<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f7f3ee">
    <title>Persetujuan Dispensasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#f7f3ee] px-4 py-8 text-[#382c27] sm:px-6 sm:py-12">
    <main class="mx-auto flex min-h-[calc(100svh-4rem)] w-full max-w-2xl items-center">
        <section class="w-full rounded-2xl border border-[#eee7e0] bg-white p-5 shadow-sm sm:p-8">
            <div class="mb-6">
                <p class="text-xs font-semibold uppercase tracking-[.16em] text-[#8c7568]">Jurnal Guru · Piket</p>
                <h1 class="mt-2 text-xl font-bold sm:text-2xl">Persetujuan Surat Dispen</h1>
                <p class="mt-1 text-sm text-[#806e64]">No. Surat: {{ $dispen->nomor_surat }}</p>
            </div>

            @if(session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
            @endif

            <dl class="space-y-4 rounded-xl bg-[#f8f6f3] p-4 text-sm sm:p-6">
                <div class="grid grid-cols-[6.5rem_1fr] gap-2"><dt class="font-semibold">Nama</dt><dd>{{ $dispen->siswa->nama }}</dd></div>
                <div class="grid grid-cols-[6.5rem_1fr] gap-2"><dt class="font-semibold">Kelas</dt><dd>{{ $dispen->kelas->tingkat }} {{ $dispen->kelas->jurusan }} {{ $dispen->kelas->rombel }}</dd></div>
                <div class="grid grid-cols-[6.5rem_1fr] gap-2"><dt class="font-semibold">Tanggal</dt><dd>{{ $dispen->tanggal->format('d/m/Y') }}</dd></div>
                <div class="grid grid-cols-[6.5rem_1fr] gap-2"><dt class="font-semibold">Jam</dt><dd>{{ $dispen->labelJam() }}</dd></div>
                <div class="grid grid-cols-[6.5rem_1fr] gap-2"><dt class="font-semibold">Alasan</dt><dd class="break-words">{{ $dispen->alasan }}</dd></div>
                <div class="grid grid-cols-[6.5rem_1fr] gap-2"><dt class="font-semibold">Diajukan oleh</dt><dd>{{ $dispen->guruPiket->name ?? 'Guru Piket' }}</dd></div>
            </dl>

            @if($bisaApprove)
                <p class="mt-5 text-sm text-[#806e64]">Tautan ini dikirim langsung kepada Waka dan hanya dapat digunakan sekali. Setelah disetujui, status dispensasi langsung tercatat pada jurnal di kelas dan jam terkait.</p>
                <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <form method="POST" action="{{ route('dispen.approval.setuju', $dispen->token_approval) }}">@csrf<button class="min-h-12 w-full rounded-xl bg-green-700 px-4 py-3 font-semibold text-white hover:bg-green-800">Setujui Dispensasi</button></form>
                    <form method="POST" action="{{ route('dispen.approval.tolak', $dispen->token_approval) }}">@csrf<button class="min-h-12 w-full rounded-xl bg-red-600 px-4 py-3 font-semibold text-white hover:bg-red-700">Tolak</button></form>
                </div>
            @elseif($alasanTidakBisa === 'sudah_diproses')
                <div class="mt-5 rounded-xl {{ $dispen->status === 'disetujui' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800' }} px-4 py-4 text-center font-semibold">
                    {{ $dispen->status === 'disetujui' ? 'Surat ini sudah disetujui.' : 'Surat ini sudah ditolak.' }}
                </div>
            @else
                <div class="mt-5 rounded-xl bg-amber-50 px-4 py-4 text-sm text-amber-900">
                    {{ $alasanTidakBisa === 'pengaju_sendiri' ? 'Pengaju tidak dapat memproses permohonannya sendiri. Minta guru piket lain.' : 'Hanya guru yang sedang bertugas piket yang dapat memproses permohonan ini.' }}
                </div>
            @endif
        </section>
    </main>
</body>
</html>
