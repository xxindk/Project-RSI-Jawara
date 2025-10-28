document.addEventListener("DOMContentLoaded", () => {
  const simpanBtn = document.getElementById("simpanBtn");
  const batalBtn = document.getElementById("batalBtn");
  const modalKonfirmasi = document.getElementById("modalKonfirmasi");
  const yakinBtn = document.getElementById("yakinBtn");
  const tidakBtn = document.getElementById("tidakBtn");
  const form = document.getElementById("reflectionForm");


  simpanBtn.addEventListener("click", () => {
    modalKonfirmasi.classList.remove("hidden");
  });


  tidakBtn.addEventListener("click", () => {
    modalKonfirmasi.classList.add("hidden");
  });


  yakinBtn.addEventListener("click", () => {
    form.submit();
  });


  batalBtn.addEventListener("click", () => {
    window.location.href = "/reflection-list";
  });
});
