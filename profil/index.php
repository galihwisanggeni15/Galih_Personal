<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profil.css">
  <title>Profil</title>
</head>

<body>
  <div class="container-profil">
    <div class="home">
      <a href="we"><svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M20 16.918C17.5535 13.9315 15.381 12.237 13.482 11.834C11.5835 11.4315 9.776 11.3705 8.059 11.6515V17L0 8.2725L8.059 0V5.0835C11.2335 5.1085 13.932 6.2475 16.155 8.5C18.3775 10.7525 19.6595 13.5585 20 16.918Z" fill="#005AC8" />
        </svg></a>
      <a href="#">
        <h5>Home</h5>
      </a>
      <a href="#">
        <h5>Cerita</h5>
      </a>
    </div>
    <div class="card">
      <div class="left-column">
        <div class="card">
          <div class="card-header">
            <h2>Menu</h2>
          </div>
          <div class="card-body">
            <a href="#">Profil</a>
            <a href="#">Ubah Password</a>
            <a href="#">Favorit</a>
            <a href="#">Log Out</a>
          </div>
        </div>
      </div>
      <div class="right-column">
        <div class="card">
          <div class="card-header">
            <h2>Profil Pengguna</h2>
          </div>
          <div class="card-body">
            <form action="" method="">
              <div class="container-form">
                <div class="left">
                  <label class="file-input">
                    <input type="file" name="file" class="file">
                    <img src="img/icon.png" alt="icon">
                  </label>
                </div>
                <div class="right">
                  <div class="form-group">
                    <input type="text" name="" class="input">
                    <i class="text"><i class="fa-solid fa-user"></i> Nama Lengkap</i>
                  </div>
                  <div class="form-group">
                    <input type="text" name="" class="input">
                    <i class="text"><i class="fa-solid fa-user"></i> Username</i>
                  </div>
                  <div class="form-group">
                    <input type="number" name="" class="input">
                    <i class="text"><i class="fa-solid fa-phone"></i> Nomor Telepone</i>
                  </div>
                  <div class="form-group">
                    <input type="email" name="" class="input">
                    <i class="text"><i class="fa-solid fa-envelope"></i> Email</i>
                  </div>
                </div>
              </div>
              <div class="container-button">
                <button></button>
                <button type="submit" class="btn">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="https://kit.fontawesome.com/36721e3235.js" crossorigin="anonymous"></script>
  <script src="profil.js"></script>
</body>

</html>