<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ 'login/login.css' }}">

    <title>Login & Registration Form</title>
</head>

<body>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="/sesi/login" method="POST">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Masukkan  username" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Masukkan  password"
                            required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login" value="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Belum punya akun?
                        <a href="#" class="text signup-link">Signup</a>
                    </span>
                </div>
            </div>
            @if (session('loginAlert'))
                <script>
                    alert("Registrasi Berhasil! Silahkan Login");
                </script>
            @endif
            @if (session('loginsalah'))
                <script>
                    alert("Login gagal silahkan coba lagi, Cek Username atau Password");
                </script>
            @endif
            @if (session('sudahada'))
                <script>
                    alert("Username, email, dan telephone telah digunakan");
                </script>
            @endif
            @if (session('showp'))
                <script>
                    alert("Password minimal 6 karakter");
                </script>
            @endif

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration</span>

                <form action="/registrasi" method="POST">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="nama" placeholder="Masukkan  name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Masukkan  Username" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="number" name="telephone" placeholder="Masukkan  Telephone" required>
                        <i class="uil uil-phone"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="email" placeholder="Masukkan  email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Create a password"
                            required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Signup">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Punya akun?
                        <a href="#" class="text login-link">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.querySelector(".container"),
            pwShowHide = document.querySelectorAll(".showHidePw"),
            pwFields = document.querySelectorAll(".password"),
            signUp = document.querySelector(".signup-link"),
            login = document.querySelector(".login-link");

        //   js code to show/hide password and change icon
        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
                pwFields.forEach(pwField => {
                    if (pwField.type === "password") {
                        pwField.type = "text";

                        pwShowHide.forEach(icon => {
                            icon.classList.replace("uil-eye-slash", "uil-eye");
                        })
                    } else {
                        pwField.type = "password";

                        pwShowHide.forEach(icon => {
                            icon.classList.replace("uil-eye", "uil-eye-slash");
                        })
                    }
                })
            })
        })

        // js code to appear signup and login form
        signUp.addEventListener("click", () => {
            container.classList.add("active");
        });
        login.addEventListener("click", () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>
