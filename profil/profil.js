const fileInput = document.querySelector('.file-input input[type="file"]');
const imgPreview = document.querySelector(".file-input img");

fileInput.addEventListener("change", function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function () {
      imgPreview.src = reader.result;
    };
    reader.readAsDataURL(file);
  }
});
