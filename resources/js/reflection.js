document.addEventListener("DOMContentLoaded", () => {
  const simpanBtn = document.getElementById("simpanBtn");
  const batalBtn = document.getElementById("batalBtn");
  const modalKonfirmasi = document.getElementById("modalKonfirmasi");
  const yakinBtn = document.getElementById("yakinBtn");
  const tidakBtn = document.getElementById("tidakBtn");

  if (simpanBtn && modalKonfirmasi) {
    simpanBtn.addEventListener("click", (e) => {
      e.preventDefault();
      modalKonfirmasi.classList.remove("hidden");
    });
  }

  if (tidakBtn) {
    tidakBtn.addEventListener("click", () => {
      modalKonfirmasi.classList.add("hidden");
    });
  }

  if (yakinBtn) {
    yakinBtn.addEventListener("click", () => {
      modalKonfirmasi.classList.add("hidden");
      // Redirect ke halaman daftar refleksi
      window.location.href = "/reflection-list";
    });
  }

  if (batalBtn) {
    batalBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.location.href = "/dashboard-user";
    });
  }
});
