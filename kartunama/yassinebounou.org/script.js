const burgerButton = document.getElementById("burgerButton");
const navContent = document.querySelector(".nav-content"); // Perbarui pemilihan ini
const overlay = document.getElementById("overlay");

burgerButton.addEventListener("click", function () {
  if (navContent.style.left === "-400px") {
    navContent.style.left = "0";
    overlay.style.display = "block";
  } else {
    navContent.style.left = "-400px";
    overlay.style.display = "none";
  }
});

overlay.addEventListener("click", function () {
  navContent.style.left = "-400px";
  overlay.style.display = "none";
});

navContent.addEventListener("click", function (event) {
  event.stopPropagation();
});

// dark mode
function toggleMode() {
  const body = document.body;
  body.classList.toggle("dark-mode");

  // Simpan preferensi mode pengguna
  if (body.classList.contains("dark-mode")) {
    localStorage.setItem("mode", "dark");
  } else {
    localStorage.setItem("mode", "light");
  }
}

// Memeriksa preferensi mode pengguna saat halaman dimuat
const savedMode = localStorage.getItem("mode");
if (savedMode === "dark") {
  document.body.classList.add("dark-mode");
}

// Tambahkan event listener untuk tombol mode
document.getElementById("mode-toggle").addEventListener("click", toggleMode);

// foto
// JavaScript functions for image enlargement and close
function enlargeImage(imageSrc) {
  var enlargedImage = document.getElementById("enlargedImg");
  var enlargedImageContainer = document.getElementById(
    "enlargedImageContainer"
  );

  enlargedImage.src = imageSrc; // Set the source of the enlarged image

  enlargedImageContainer.style.display = "flex"; // Display the enlarged image container
  document.body.style.overflow = "hidden"; // Disable scrolling when the image is enlarged
}

function closeEnlargedImage() {
  var enlargedImageContainer = document.getElementById(
    "enlargedImageContainer"
  );

  enlargedImageContainer.style.display = "none"; // Hide the enlarged image container
  document.body.style.overflow = "auto"; // Enable scrolling again
}



document.addEventListener("DOMContentLoaded", function () {
  const searchIcon = document.getElementById("searchIcon");
  const pencarian = document.querySelector(".pencarian");

  searchIcon.addEventListener("click", function () {
    if (pencarian.style.display === "block") {
      pencarian.style.display = "none"; // Menyembunyikan elemen pencarian saat ikon pencarian diklik kembali
    } else {
      pencarian.style.display = "block"; // Menampilkan elemen pencarian saat ikon pencarian diklik
    }
  });
});




