<?php
	include('session.php');
	if (isset($_SESSION["user_id"])) {
		header('Location: profil.php');
	}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once "config.php";
        $email = $_POST["email"];
        $password = $_POST["kata_sandi"];
        $sql = "SELECT * FROM user_form WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if (empty($email) || empty($password)){
			echo "<div class='alert alert-danger'>Email and password are required.</div>";
		} else {
			if ($user) {
				if (password_verify($password, $user["password"])) {
					$_SESSION["user_id"] = $user["id"];
					$_SESSION["user_email"] = $user["email"];

					// Set a cookie if "Remember Me" is checked
					if (isset($_POST["remember_me"])) {
						setcookie("user_id", $user["id"], time() + (86400 * 30), "/"); // 30 days
						setcookie("user_email", $user["email"], time() + (86400 * 30), "/"); // 30 days
					}

					header("Location: profil.php");
					exit();
				} else {
					echo "<div class='alert alert-danger'>Password does not match</div>";
				}
			} else {
				echo "<div class='alert alert-danger'>Email does not match</div>";
			}
        }
    }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
    <link rel="manifest" href="site.webmanifest" />
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#ffa500" />
    <meta name="theme-color" content="#ffa500" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login/login.css">
    <link rel="stylesheet" href="css/login/styles.css">

    <!-- google fonts -->
	<link
		rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	<!-- splide -->
	<script src=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js "></script>
	<link
		href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css "
		rel="stylesheet" />

    <!-- Fonts google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body class="antialiased font-inter bg-white text-zinc-950">
	<nav class="bg-zine">
		<div class="container flex items-center justify-between px-2 py-4 mx-auto">
			<a href="index.php" class="flex items-center space-x-2 font-bold text-white">
				<img src="img/logo.png" alt="logo" class="w-8 h-8" />
				<span class="text-lg">FoodZine</span>
			</a>

			<form action="SearchPage.php" method="get">
				<div class="items-center hidden xl:flex">
					<input type="text"
						class="w-40 rounded-l-full px-3 py-2 bg-white text-sm italic font-semibold mr-0.5"
						placeholder="Default" />
					<input type="text" class="w-40 px-3 py-2 mr-4 text-sm italic font-semibold bg-white rounded-r-full"
						placeholder="Default" />
					<button class="flex items-center justify-center text-white">
						<span class="material-symbols-outlined"> search </span>
					</button>
				</div>
			</form>
			<div class="items-center hidden text-sm font-semibold xl:flex">
				<a href="restaurant.php?terserah=true"
					class="rounded-l-full px-3 py-2 bg-white text-zine mr-0.5 flex items-center space-x-2">
					<span class="mr-2 material-symbols-outlined">
						celebration
					</span>
					Terserah aja deh
				</a>
				<a href="restaurant.php?surprise=true"
					class="flex items-center px-3 py-2 mr-4 space-x-2 bg-white rounded-r-full text-zine">
					<span class="mr-2 material-symbols-outlined">star</span>
					Surprise me!
				</a>
				<a href="login.php" class="relative flex items-center justify-center w-10 h-10 bg-white rounded-full">
					<span class="material-symbols-outlined text-zine">
						person
					</span>
				</a>
			</div>
		</div>
	</nav>


    <section class="login d-flex ">
        <div class="login-right w-2\/4 h-100">
            <div class="header">
                <h1>Selamat Datang!</h1>
                <p>Temukan rekomendasi tempat makanmu</p>
                <button type="submit" class="btn login-google">
                    <img src="img/login/flat-color-icons_google.png" alt="">
                    Masuk Dengan Google
                </button>
            </div>

            <div class="tulisan">
                <p>------------- masuk dengan surel ------------- </p>
            </div>

            <div class="container">
				<form action="login.php" class="form" method="post">

                    <label for="Surel" class="form-label">Surel</label>
                    <input type="email" class="form-control" name="email" id="Surel" placeholder="abc@mail.com">

                    <label for="Kata Sandi" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" name="kata_sandi" id="Kata Sandi" placeholder="kata sandi">

                    <div class="form-check d-flex justify-content-between">
                        <div>
                            <input name="remember_me" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Ingat saya</label>
                        </div>
                        <a href="forgot_password.php" class="d-inline text-decoration-none">Lupa kata sandi?</a>
                    </div>


                    <div class="tombol">
                        <button type="submit" class="btn masuk" name="submit">Masuk</button>
                    </div>
                </form>

                <div class="mt-8">
                    <span class="d-inline"">Belum punya akun? <a href="register.php" class="login d-inline text-decoration-none">Buat akun</a></span>
                </div>
            </div>

            <hr>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <footer class="w-full mt-20 bg-gradient-to-t from-zine-darker to-zine">
		<div class="container px-2 py-20 mx-auto">
			<div class="flex items-start justify-between gap-4">
				<div class="w-2/4">
					<div class="flex items-center space-x-4">
						<img src="img/logo.png" alt="logo" class="w-8 h-8" />
						<h3 class="font-bold text-white">FoodZine</h3>
					</div>

					<h5 class="mt-4 font-bold">
						Jelajahi Rasa, Penuhi Selera!
					</h5>
					<span class="font-bold">Tentang Kami</span>
					<p class="mt-4 text-sm text-zinc-900/60">
						Foodzine adalah tempat terbaik untuk mendapatkan
						rekomendasi kuliner di Kota Malang. Kami berkomitmen
						membagikan pengalaman dan tempat kuliner terbaik
						kepada Anda.
					</p>
				</div>
				<div class="w-1/4">
					<h5 class="font-bold">Kontak</h5>
					<div class="flex flex-col mt-2 space-y-4">
						<div class="flex items-center space-x-2">
							<span class="text-white material-symbols-outlined">
								email
							</span>
							<span class="text-sm">info@foodzine.com</span>
						</div>
						<div class="flex items-center space-x-2">
							<span class="text-white material-symbols-outlined">
								phone
							</span>
							<span class="text-sm">+62 812 3456 7890</span>
						</div>
						<div class="flex items-center space-x-2">
							<span class="text-white material-symbols-outlined">
								place
							</span>
							<span class="text-sm">Jl. Raya Tlogomas No. 246, Malang</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<section id="copyright" class="border-t bg-zine-darker border-zine">
		<div class="container px-2 py-3 mx-auto">
			<div class="flex items-center justify-between text-sm text-white">
				<p>© 2024 Pemrograman Web Kelompok 3 - FoodZine</p>
				<p>
					All Rights Reserved | Terms and Conditions | Privacy
					Policy
				</p>
			</div>
		</div>
	</section>

</body>

</html>
