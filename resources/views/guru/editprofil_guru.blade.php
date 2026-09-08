<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Profil Guru</title>

    <!-- Tailwind tanpa Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full min-h-screen bg-[#F5EFE8] text-[#3E3028]">

    <div class="w-full min-h-screen bg-[#F5EFE8] flex flex-col">

        <!-- =========================
             HEADER
        ========================== -->

        <header
            class="w-full h-12 px-4 bg-white border-b border-[#E5D8CC]
                   flex items-center justify-center shrink-0"
        >
            <h1 class="text-[16px] leading-6 font-bold text-center">
                Edit Profil
            </h1>
        </header>


        <!-- =========================
             CONTENT
        ========================== -->

        <main
            class="w-full flex-1 px-4 py-6 flex flex-col items-center gap-5
                   max-[600px]:px-4 max-[600px]:py-5 max-[600px]:gap-[18px]
                   min-[800px]:px-[8%] min-[800px]:py-10 min-[800px]:gap-[25px]"
        >

            <!-- =========================
                 DATA PROFIL
            ========================== -->

            <div
                class="w-full max-w-[600px] p-5 bg-white
                       border border-[#E5D8CC] rounded-[10px]
                       max-[600px]:p-4
                       max-[350px]:p-3
                       min-[800px]:max-w-[700px] min-[800px]:p-7"
            >

                <!-- Nama Lengkap -->

                <div class="w-full mb-4 max-[350px]:mb-[13px]">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        value="Budi Santoso, S.Pd."
                        class="w-full h-[42px] px-3
                               border border-[#D9C9BA] rounded-[7px]
                               bg-white text-[#3E3028] text-[13px]
                               outline-none focus:border-[#5C4033]
                               max-[350px]:h-10 max-[350px]:text-[12px]
                               min-[800px]:h-12 min-[800px]:text-[15px]"
                    >

                </div>


                <!-- Email -->

                <div class="w-full mb-4 max-[350px]:mb-[13px]">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        value="budi.santoso@email.com"
                        class="w-full h-[42px] px-3
                               border border-[#D9C9BA] rounded-[7px]
                               bg-white text-[#3E3028] text-[13px]
                               outline-none focus:border-[#5C4033]
                               max-[350px]:h-10 max-[350px]:text-[12px]
                               min-[800px]:h-12 min-[800px]:text-[15px]"
                    >

                </div>


                <!-- Unit Kerja -->

                <div class="w-full mb-4 max-[350px]:mb-[13px]">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Unit Kerja
                    </label>

                    <input
                        type="text"
                        value="SMK Negeri 1 Jakarta"
                        class="w-full h-[42px] px-3
                               border border-[#D9C9BA] rounded-[7px]
                               bg-white text-[#3E3028] text-[13px]
                               outline-none focus:border-[#5C4033]
                               max-[350px]:h-10 max-[350px]:text-[12px]
                               min-[800px]:h-12 min-[800px]:text-[15px]"
                    >

                </div>


                <!-- Mata Pelajaran -->

                <div class="w-full">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        value="Matematika"
                        class="w-full h-[42px] px-3
                               border border-[#D9C9BA] rounded-[7px]
                               bg-white text-[#3E3028] text-[13px]
                               outline-none focus:border-[#5C4033]
                               max-[350px]:h-10 max-[350px]:text-[12px]
                               min-[800px]:h-12 min-[800px]:text-[15px]"
                    >

                </div>

            </div>


            <!-- =========================
                 UBAH PASSWORD
            ========================== -->

            <div
                class="w-full max-w-[600px] p-5 bg-white
                       border border-[#E5D8CC] rounded-[10px]
                       max-[600px]:p-4
                       max-[350px]:p-3
                       min-[800px]:max-w-[700px] min-[800px]:p-7"
            >

                <h2
                    class="mb-4 text-[15px] font-bold text-[#3E3028]
                           max-[350px]:text-[14px]
                           min-[800px]:text-[18px]"
                >
                    Ubah Password
                </h2>


                <!-- Password Lama -->

                <div class="w-full mb-4 max-[350px]:mb-[13px]">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Password Lama
                    </label>

                    <div class="relative w-full">

                        <input
                            type="password"
                            id="passwordLama"
                            placeholder="Masukkan password lama"
                            class="w-full h-[42px] pl-3 pr-[45px]
                                   border border-[#D9C9BA] rounded-[7px]
                                   bg-white text-[#3E3028] text-[13px]
                                   outline-none focus:border-[#5C4033]
                                   max-[350px]:h-10 max-[350px]:text-[12px]
                                   min-[800px]:h-12 min-[800px]:text-[15px]"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('passwordLama', this)"
                            class="absolute right-[10px] top-1/2 -translate-y-1/2
                                   w-6 h-6 border-0 bg-transparent p-0
                                   flex items-center justify-center cursor-pointer"
                        >
                            <span
                                class="eye-icon relative block w-5 h-[13px]
                                       border-2 border-[#3E3028]
                                       rounded-[50%]"
                            ></span>
                        </button>

                    </div>

                </div>


                <!-- Password Baru -->

                <div class="w-full mb-4 max-[350px]:mb-[13px]">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Password Baru
                    </label>

                    <div class="relative w-full">

                        <input
                            type="password"
                            id="passwordBaru"
                            placeholder="Masukkan password baru"
                            class="w-full h-[42px] pl-3 pr-[45px]
                                   border border-[#D9C9BA] rounded-[7px]
                                   bg-white text-[#3E3028] text-[13px]
                                   outline-none focus:border-[#5C4033]
                                   max-[350px]:h-10 max-[350px]:text-[12px]
                                   min-[800px]:h-12 min-[800px]:text-[15px]"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('passwordBaru', this)"
                            class="absolute right-[10px] top-1/2 -translate-y-1/2
                                   w-6 h-6 border-0 bg-transparent p-0
                                   flex items-center justify-center cursor-pointer"
                        >
                            <span
                                class="eye-icon relative block w-5 h-[13px]
                                       border-2 border-[#3E3028]
                                       rounded-[50%]"
                            ></span>
                        </button>

                    </div>

                </div>


                <!-- Konfirmasi Password -->

                <div class="w-full">

                    <label
                        class="block mb-[7px] text-[12px] font-semibold text-[#7A6A60]
                               min-[800px]:text-[14px]"
                    >
                        Konfirmasi Password Baru
                    </label>

                    <div class="relative w-full">

                        <input
                            type="password"
                            id="konfirmasiPassword"
                            placeholder="Ulangi password baru"
                            class="w-full h-[42px] pl-3 pr-[45px]
                                   border border-[#D9C9BA] rounded-[7px]
                                   bg-white text-[#3E3028] text-[13px]
                                   outline-none focus:border-[#5C4033]
                                   max-[350px]:h-10 max-[350px]:text-[12px]
                                   min-[800px]:h-12 min-[800px]:text-[15px]"
                        >

                        <button
                            type="button"
                            onclick="togglePassword('konfirmasiPassword', this)"
                            class="absolute right-[10px] top-1/2 -translate-y-1/2
                                   w-6 h-6 border-0 bg-transparent p-0
                                   flex items-center justify-center cursor-pointer"
                        >
                            <span
                                class="eye-icon relative block w-5 h-[13px]
                                       border-2 border-[#3E3028]
                                       rounded-[50%]"
                            ></span>
                        </button>

                    </div>

                </div>

            </div>


            <!-- =========================
                 BUTTON
            ========================== -->

            <div
                class="w-full max-w-[600px] flex gap-[10px]
                       min-[800px]:max-w-[700px]"
            >

                <!-- Simpan -->

                <button
                    type="button"
                    class="w-full h-[45px]
                           rounded-lg
                           flex items-center justify-center
                           text-[14px] font-semibold
                           cursor-pointer
                           bg-[#5C4033] text-white
                           max-[350px]:h-[42px] max-[350px]:text-[13px]
                           min-[800px]:h-[52px] min-[800px]:text-[16px]"
                >
                    Simpan Perubahan
                </button>


                <!-- Batal -->

                <a
                    href="/profil-guru"
                    class="w-full h-[45px]
                           rounded-lg
                           flex items-center justify-center
                           text-[14px] font-semibold
                           cursor-pointer no-underline
                           bg-white text-[#5C4033]
                           border border-[#5C4033]
                           max-[350px]:h-[42px] max-[350px]:text-[13px]
                           min-[800px]:h-[52px] min-[800px]:text-[16px]"
                >
                    Batal
                </a>

            </div>

        </main>


        <!-- =========================
             NAVIGASI BAWAH
        ========================== -->

        <nav
            class="w-full h-16 py-2 bg-white
                   border-t border-[#E5D8CC]
                   flex justify-around items-center shrink-0
                   min-[800px]:h-[75px]"
        >

            <!-- Dashboard -->

            <a
                href="/dashboard-guru"
                class="flex-1 flex flex-col items-center gap-1
                       text-[11px] text-[#7A6A60] no-underline
                       min-[800px]:text-[13px]"
            >
                <div class="text-[18px] h-5">
                    ⌂
                </div>

                <span>
                    Dashboard
                </span>
            </a>


            <!-- Jurnal -->

            <a
                href="/mulai-sesi"
                class="flex-1 h-full flex flex-col items-center justify-center
                       gap-1 no-underline
                       text-[#9A8A80]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect
                            x="5"
                            y="3"
                            width="14"
                            height="18"
                            rx="2"
                        ></rect>

                        <path d="M9 3v18"></path>
                    </svg>

                </div>

                <span class="text-[13px]">
                    Jurnalis
                </span>

            </a>


            <!-- Rekap -->

            <a
                href="/rekap-jurnal"
                class="flex-1 h-full flex flex-col items-center justify-center
                       gap-1 no-underline
                       text-[#7A6A60]
                       min-[800px]:text-[13px]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect
                            x="4"
                            y="5"
                            width="16"
                            height="15"
                            rx="2"
                        ></rect>

                        <path d="M4 9h16"></path>

                        <path d="M8 3v4"></path>
                        <path d="M16 3v4"></path>

                    </svg>

                </div>

                <span class="text-[13px]">
                    Rekap
                </span>

            </a>


            <!-- Profil -->

            <a
                href="/profil-guru"
                class="flex-1 h-full flex flex-col items-center justify-center
                       gap-1 no-underline
                       text-[#9A8A80]"
            >

                <div class="w-6 h-6 flex items-center justify-center">

                    <svg
                        width="22"
                        height="22"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <circle
                            cx="12"
                            cy="8"
                            r="3"
                        ></circle>

                        <path
                            d="M5 21c0-3.5 3-6 7-6s7 2.5 7 6"
                        ></path>
                    </svg>

                </div>

                <span class="text-[13px]">
                    Profil
                </span>

            </a>

        </nav>

    </div>


    <!-- =========================
         JAVASCRIPT
    ========================== -->

    <script>

        function togglePassword(inputId, button) {

            const input = document.getElementById(inputId);
            const icon = button.querySelector(".eye-icon");

            if (input.type === "password") {

                input.type = "text";

                icon.classList.add("hidden");

            } else {

                input.type = "password";

                icon.classList.remove("hidden");

            }

        }

    </script>

</body>
</html>
