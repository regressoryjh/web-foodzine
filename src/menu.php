<?php
include('session.php');

if (!isset($_SESSION["user_id"])) {
    // Check for cookies if session is not set
        if (isset($_COOKIE["user_id"]) && isset($_COOKIE["user_email"])) {
            $_SESSION["user_id"] = $_COOKIE["user_id"];
            $_SESSION["user_email"] = $_COOKIE["user_email"];
        } else {
            header("Location: login.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>FoodZine</title>
		<meta
			name="description"
			content="FoodZine Rekomendasi Tempat Makan Terdekat" />

		<!-- favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="img/apple-touch-icon.png" />
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="img/favicon-32x32.png" />
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="img/favicon-16x16.png" />
		<link rel="manifest" href="site.webmanifest" />
		<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#ffa500" />
		<meta name="theme-color" content="#ffa500" />

		<!-- google fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
			rel="stylesheet" />
		<link
			rel="stylesheet"
			href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

		<!-- splide -->
		<script src=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js "></script>
		<link
			href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css "
			rel="stylesheet" />

		<!-- custom css -->
		<link rel="stylesheet" href="css/styles.css" />

		<!-- custom javascript -->
		<script src="js/menu.js" type="text/javascript" defer></script>
	</head>

	<body class="antialiased font-inter bg-zine-lighter text-zinc-950">
		<nav class="bg-zine">
			<div
				class="container flex items-center justify-between px-2 py-4 mx-auto">
				<a
					href="index.php"
					class="flex items-center space-x-2 font-bold text-white">
					<img src="img/logo.png" alt="logo" class="w-8 h-8" />
					<span class="text-lg">FoodZine</span>
				</a>

				<div class="items-center hidden xl:flex">
					<input
						type="text"
						class="w-40 rounded-l-full px-3 py-2 bg-white text-sm italic font-semibold mr-0.5"
						placeholder="Default" />
					<input
						type="text"
						class="w-40 px-3 py-2 mr-4 text-sm italic font-semibold bg-white rounded-r-full"
						placeholder="Default" />
					<button class="flex items-center justify-center text-white">
						<span class="material-symbols-outlined"> search </span>
					</button>
				</div>

				<div class="items-center hidden text-sm font-semibold xl:flex">
					<a
						href="restaurant.php?terserah=true"
						class="rounded-l-full px-3 py-2 bg-white text-zine mr-0.5 flex items-center space-x-2">
						<span class="mr-2 material-symbols-outlined">
							celebration
						</span>
						Terserah aja deh
					</a>
					<a
						href="restaurant.php?surprise=true"
						class="flex items-center px-3 py-2 mr-4 space-x-2 bg-white rounded-r-full text-zine">
						<span class="mr-2 material-symbols-outlined">star</span>
						Surprise me!
					</a>
					<div
						class="relative flex items-center justify-center w-10 h-10 bg-white rounded-full">
						<span class="material-symbols-outlined text-zine">
							person
						</span>
					</div>
				</div>
			</div>
		</nav>

		<section id="main" class="w-full py-20">
			<div class="container px-2 mx-auto">
				<h3 class="text-2xl font-bold" id="name">All You Can Eat</h3>
				<p class="mt-2 text-sm" id="detail">All You Can Eat | Jl. Raya</p>

				<div class="w-full mt-6 overflow-hidden bg-zine rounded-xl">
					<h6 class="p-6 font-bold text-white">Menus</h6>
					<div class="flex flex-wrap gap-4 p-6 bg-white" id="menus">
						<div
							class="w-20 rounded-lg cursor-pointer aspect-square bg-zine bg-opacity-20 animate-pulse"></div>
						<div
							class="w-20 rounded-lg cursor-pointer aspect-square bg-zine bg-opacity-20 animate-pulse"></div>
						<div
							class="w-20 rounded-lg cursor-pointer aspect-square bg-zine bg-opacity-20 animate-pulse"></div>
					</div>
				</div>

				<div class="w-full mt-6 rounded-xl" id="preview">
					<div
						class="aspect-square bg-zine bg-opacity-20 animate-pulse"></div>
				</div>

				<div class="p-6 mt-6 rounded-b-xl bg-zine">
					<h4 class="font-bold text-white">
						Harga dapat berubah sewaktu-waktu tanpa pemberitahuan
						terlebih dahulu.
					</h4>
				</div>
			</div>
		</section>

		<footer class="w-full mt-20 bg-gradient-to-t from-zine-darker to-zine">
			<div class="container px-2 py-20 mx-auto">
				<div class="flex items-start justify-between gap-4">
					<div class="w-2/4">
						<div class="flex items-center space-x-4">
							<img
								src="img/logo.png"
								alt="logo"
								class="w-8 h-8" />
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
								<span
									class="text-white material-symbols-outlined">
									email
								</span>
								<span class="text-sm">info@foodzine.com</span>
							</div>
							<div class="flex items-center space-x-2">
								<span
									class="text-white material-symbols-outlined">
									phone
								</span>
								<span class="text-sm">+62 812 3456 7890</span>
							</div>
							<div class="flex items-center space-x-2">
								<span
									class="text-white material-symbols-outlined">
									place
								</span>
								<span class="text-sm"
									>Jl. Raya Tlogomas No. 246, Malang</span
								>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<section id="copyright" class="border-t bg-zine-darker border-zine">
			<div class="container px-2 py-3 mx-auto">
				<div
					class="flex items-center justify-between text-sm text-white">
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
