<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FFF7F0] min-h-screen flex flex-col items-center relative">

<style>
@font-face {
  font-family: 'Maragsa';
  src: url('{{ asset('fonts/Maragsa.ttf') }}') format('truetype');
}
.font-maragsa { font-family: 'Maragsa', serif; }
</style>

{{-- NAVBAR --}}
<nav class="flex justify-between items-center px-12 py-6 bg-[#FFF7F0] w-full">
  <div class="text-3xl font-maragsa text-[#9A3B1B]">JAWARA</div>

  <ul class="hidden md:flex gap-10 text-[#171717] font-medium">
    <li><a href="/dashboard-user" class="hover:text-[#4C9894] {{ request()->is('dashboard-user') ? 'text-[#4C9894]' : '' }}">Home</a></li>
    <li><a href="/materi" class="hover:text-[#4C9894] {{ request()->is('materi') ? 'text-[#4C9894]' : '' }}">Modul</a></li>
    <li><a href="#" class="hover:text-[#4C9894]">Progress Tracker</a></li>
    <li><a href="#" class="hover:text-[#4C9894]">Narahubung</a></li>
  </ul>

  <div class="flex items-center space-x-4 relative">
    <img src="{{ asset('images/profil user.png') }}" alt="User Avatar" class="w-10 h-10 rounded-full border border-gray-300">

    <button id="menuToggle" class="flex flex-col justify-between w-6 h-4">
      <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
      <span class="block w-full h-[3px] bg-[#171717] rounded"></span>
    </button>

    <div id="dropdownMenu" class="hidden absolute top-14 right-[-1rem] bg-white rounded-xl shadow-lg py-4 w-48 border border-gray-100 z-50">
      <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
        <img src="{{ asset('images/Vector profil.png') }}" alt="Profil Icon" class="w-5 h-5 mr-3"> Profil
      </a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left flex items-center px-5 py-2 hover:bg-gray-100 text-[#171717]">
          <img src="{{ asset('images/Vector logout.png') }}" alt="Logout Icon" class="w-5 h-5 mr-3"> Logout
        </button>
      </form>
    </div>
  </div>
</nav>

<script>
const toggleBtn = document.getElementById('menuToggle');
const dropdownMenu = document.getElementById('dropdownMenu');
toggleBtn.addEventListener('click', () => dropdownMenu.classList.toggle('hidden'));
document.addEventListener('click', (e) => {
  if (!toggleBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.classList.add('hidden');
  }
});
</script>

<img src="{{ asset('images/rumah adat.png') }}" alt="Rumah Adat"
     class="absolute bottom-0 left-0 w-full object-cover pointer-events-none z-0">

<!-- === Kontainer Putih Profil === -->
<div class="relative z-10 bg-white shadow-lg rounded-2xl w-full max-w-md mx-auto mt-10 px-8 py-8">
  <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Foto Profil + Tombol Kamera -->
    <div class="flex flex-col items-center mb-6 relative">
      <div class="relative">
        <img id="profileImage" 
          src="{{ $user && $user->foto ? asset('storage/' . $user->foto) : asset('images/profil user.png') }}"
          alt="User Avatar"
          class="w-28 h-28 rounded-full object-cover border border-gray-300 shadow-sm">
        <label for="foto"
          class="absolute bottom-0 right-0 bg-white border border-gray-300 p-2 rounded-full shadow cursor-pointer hover:bg-gray-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 4v8" />
          </svg>
          <input type="file" id="foto" name="foto" accept="image/*" class="hidden">
        </label>
      </div>
      <p class="text-lg font-semibold text-[#171717] mt-3">{{ $user->nama ?? 'Nama Pengguna' }}</p>
    </div>

    <!-- Input Nama -->
    <div class="mb-4">
      <label class="block text-sm text-gray-600 mb-1">Nama</label>
      <input type="text" name="nama"
        value="{{ old('nama', $user->nama ?? '') }}"
        class="profile-input w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#4C9894]"
        readonly>
    </div>

    <!-- Input Email -->
    <div class="mb-4">
      <label class="block text-sm text-gray-600 mb-1">Email</label>
      <input type="email" name="email"
        value="{{ old('email', $user->email ?? '') }}"
        class="profile-input w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#4C9894]"
        readonly>
    </div>

    <!-- Input Password -->
    <div class="mb-6">
      <label class="block text-sm text-gray-600 mb-1">Password Baru (opsional)</label>
      <input type="password" name="password" placeholder="********"
        class="profile-input w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#4C9894]"
        readonly>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end space-x-3" id="viewButtons">
      <button type="button" id="editButton"
        class="bg-[#4C9894] text-white px-6 py-2 rounded-lg hover:bg-[#3E7E7B] transition">
        Edit
      </button>
    </div>

    <div class="hidden flex justify-end space-x-3" id="editButtons">
      <button type="button" id="cancelButton"
        class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition">
        Batal
      </button>
      <button type="submit"
        class="bg-[#4C9894] text-white px-6 py-2 rounded-lg hover:bg-[#3E7E7B] transition">
        Simpan
      </button>
    </div>
  </form>
</div>


<!-- Tambahkan CSS khusus untuk readonly input -->
<style>
  /* Saat input readonly, tampilannya netral (tidak berubah saat hover/fokus) */
  .profile-input[readonly] {
    background-color: #f9fafb; /* warna sedikit berbeda dari putih */
    cursor: default;
  }
  .profile-input[readonly]:hover,
  .profile-input[readonly]:focus {
    border-color: #d1d5db; /* tetap abu-abu */
    box-shadow: none;
    outline: none;
  }
</style>

<script>
  // === Preview foto sebelum upload ===
  const fotoInput = document.getElementById('foto');
  const profileImage = document.getElementById('profileImage');
  const navbarImage = document.querySelector('nav img[alt="User Avatar"]'); // foto di navbar

  fotoInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        profileImage.src = e.target.result; // tampil di halaman profil
        if (navbarImage) navbarImage.src = e.target.result; // update juga di navbar
      };
      reader.readAsDataURL(file);
    }
  });
</script>

<script>
  const editBtn = document.getElementById('editButton');
  const cancelBtn = document.getElementById('cancelButton');
  const inputs = document.querySelectorAll('#profileForm input');
  const viewBtns = document.getElementById('viewButtons');
  const editBtns = document.getElementById('editButtons');
  const form = document.getElementById('profileForm');

  // --- logika edit & batal ---
  editBtn.addEventListener('click', () => {
    inputs.forEach(i => i.removeAttribute('readonly'));
    viewBtns.classList.add('hidden');
    editBtns.classList.remove('hidden');
  });

  cancelBtn.addEventListener('click', () => {
    inputs.forEach(i => i.setAttribute('readonly', true));
    editBtns.classList.add('hidden');
    viewBtns.classList.remove('hidden');
  });

  // --- popup konfirmasi sebelum submit ---
  form.addEventListener('submit', function (event) {
    const passwordInput = form.querySelector('input[name="password"]');
    const emailInput = form.querySelector('input[name="email"]');
    const newPassword = passwordInput.value.trim();
    const newEmail = emailInput.value.trim();
    const originalEmail = "{{ $user->email ?? '' }}"; // ambil email lama dari server

    let message = null;

    if (newPassword !== "") {
      message = "Apakah Anda yakin mengubah password?";
    } else if (newEmail !== originalEmail) {
      message = "Apakah Anda yakin mengubah email?";
    }

    if (message) {
      event.preventDefault(); // hentikan submit dulu

      // Buat popup konfirmasi
      const confirmBox = document.createElement('div');
      confirmBox.className = "fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50";
      confirmBox.innerHTML = `
        <div class="bg-white rounded-xl shadow-lg p-6 w-[360px] text-center animate-fadeIn">
          <h2 class="text-base text-[#171717] mb-6 font-normal">${message}</h2>
          <div class="flex justify-center gap-4">
            <button id="noBtn"
              class="bg-gray-300 text-[#171717] text-sm px-6 py-2 rounded-md hover:bg-gray-400 transition font-normal w-24">
              Tidak
            </button>
            <button id="yesBtn"
              class="bg-[#4C9894] text-white text-sm px-6 py-2 rounded-md hover:bg-[#3E7E7B] transition font-normal w-24">
              Ya
            </button>
          </div>
        </div>
      `;
      document.body.appendChild(confirmBox);

      // Tombol YA → tampilkan popup sukses
      confirmBox.querySelector('#yesBtn').addEventListener('click', () => {
        document.body.removeChild(confirmBox);
        showSuccessPopup("Perubahan berhasil disimpan");
      });

      // Tombol TIDAK → tutup popup
      confirmBox.querySelector('#noBtn').addEventListener('click', () => {
        document.body.removeChild(confirmBox);
      });
    }
  });

  // --- popup sukses ---
  function showSuccessPopup(text) {
    const successBox = document.createElement('div');
    successBox.className = "fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 animate-fadeIn";
    successBox.innerHTML = `
      <div class="bg-white rounded-xl shadow-lg p-6 w-[360px] text-center animate-fadeIn">
        <div class="flex justify-center mb-4">
          <div class="bg-[#4C9894] rounded-full w-14 h-14 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
          </div>
        </div>
        <p class="text-base text-[#171717] font-normal">${text}</p>
      </div>
    `;
    document.body.appendChild(successBox);

    // Tutup otomatis setelah 1.5 detik, lalu submit form
    setTimeout(() => {
      document.body.removeChild(successBox);
      form.submit();
    }, 1500);
  }
</script>

<style>
  @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
  }
  .animate-fadeIn {
    animation: fadeIn 0.25s ease-out;
  }
</style>