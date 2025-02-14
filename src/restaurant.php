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
		<script src="js/restaurant.js" type="text/javascript" defer></script>
	</head>

	<body class="antialiased font-inter bg-zine-lighter text-zinc-950">
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

		<section id="terserah" class="hidden w-full mt-20">
			<div class="container px-2 mx-auto">
				<div class="p-6 font-bold text-white bg-zine-red rounded-t-xl">
					Terserah aja deh
				</div>
				<p class="p-6 text-sm bg-white rounded-b-xl">
					<strong
						>Kamu melihat halaman ini karena kamu mengeklik halaman
						“Terserah aja deh!”
					</strong>
					<br />Selamat datang di Halaman Terserah aja deh! Di sini,
					kami memberikan rekomendasi kuliner berdasarkan preferensi
					Kamu, untuk Kamu yang kebingungan mencari tempat makan di
					sekitar Kota Malang.
				</p>
			</div>
		</section>

		<section id="surprise" class="hidden w-full mt-20">
			<div class="container px-2 mx-auto">
				<div class="p-6 font-bold text-white bg-zine-red rounded-t-xl">
					Surprise Me
				</div>
				<p class="p-6 text-sm bg-white rounded-b-xl">
					<strong
						>Kamu melihat halaman ini karena kamu mengeklik halaman
						“Surprise Me!”
					</strong>
					<br />Selamat datang di Halaman Terserah aja deh! Di sini,
					kami memberikan rekomendasi kuliner berdasarkan preferensi
					Kamu, untuk Kamu yang kebingungan mencari tempat makan di
					sekitar Kota Malang.
				</p>
			</div>
		</section>

		<div
			class="fixed inset-0 z-10 hidden overflow-y-auto transition-all duration-100"
			id="modal">
			<div
				class="absolute inset-0 z-0 w-full h-full bg-black bg-opacity-50"
				id="overlay"></div>
			<div
				class="relative z-10 flex items-center justify-center w-full h-full">
				<div
					class="relative z-10 w-full max-w-lg p-6 mx-auto bg-white shadow-sm rounded-xl">
					<div class="flex items-center justify-between">
						<h3 class="font-bold">Link Berhasil Disalin!</h3>
						<button
							class="text-2xl material-symbols-outlined text-zine"
							id="closeModal">
							close
						</button>
					</div>
				</div>
			</div>
		</div>

		<section id="info-resto" class="w-full py-20">
			<div
				class="container grid items-start grid-cols-1 gap-8 px-2 mx-auto xl:grid-cols-2">
				<div
					class="w-full h-[500px] rounded-xl overflow-hidden"
					id="imageContainer">
					<div
						class="w-full h-full bg-zine bg-opacity-20"></div>
				</div>
				<div class="w-full">
					<div
						class="flex items-center justify-between text-2xl font-bold">
						<h3 id="name">All You Can Eat</h3>
						<span
							id="rating"
							class="px-3 py-2 bg-white border-2 rounded-lg border-zine"
							>4.2</span
						>
					</div>

					<div class="flex items-center justify-center mt-8">
						<div class="w-full border-t-2 border-zine"></div>
					</div>

					<div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-5">
						<div
							class="flex overflow-hidden bg-white rounded-lg md:flex-col">
							<h5
								class="flex items-center justify-start w-4/5 px-3 py-2 font-bold text-center text-white md:w-full bg-zine md:justify-center">
								Rasa
							</h5>
							<span
								class="flex items-center justify-center w-1/5 h-16 text-xl font-bold text-center bg-white md:w-full xl:text-2xl"
								id="taste">
								4.5
							</span>
						</div>
						<div
							class="flex overflow-hidden bg-white rounded-lg md:flex-col">
							<h5
								class="flex items-center justify-start w-4/5 px-3 py-2 font-bold text-center text-white md:w-full bg-zine md:justify-center">
								Suasana
							</h5>
							<span
								class="flex items-center justify-center w-1/5 h-16 text-xl font-bold text-center bg-white md:w-full xl:text-2xl"
								id="ambiance">
								4.4
							</span>
						</div>
						<div
							class="flex overflow-hidden bg-white rounded-lg md:flex-col">
							<h5
								class="flex items-center justify-start w-4/5 px-3 py-2 font-bold text-center text-white md:w-full bg-zine md:justify-center">
								Harga: rasa
							</h5>
							<span
								class="flex items-center justify-center w-1/5 h-16 text-xl font-bold text-center bg-white md:w-full xl:text-2xl"
								id="price">
								4.1
							</span>
						</div>
						<div
							class="flex overflow-hidden bg-white rounded-lg md:flex-col">
							<h5
								class="flex items-center justify-start w-4/5 px-3 py-2 font-bold text-center text-white md:w-full bg-zine md:justify-center">
								Pelayanan
							</h5>
							<span
								class="flex items-center justify-center w-1/5 h-16 text-xl font-bold text-center bg-white md:w-full xl:text-2xl"
								id="service">
								4.2
							</span>
						</div>
						<div
							class="flex overflow-hidden bg-white rounded-lg md:flex-col">
							<h5
								class="flex items-center justify-start w-4/5 px-3 py-2 font-bold text-center text-white md:w-full bg-zine md:justify-center">
								Kebersihan
							</h5>
							<span
								class="flex items-center justify-center w-1/5 h-16 text-xl font-bold text-center bg-white md:w-full xl:text-2xl"
								id="cleanliness">
								4.3
							</span>
						</div>
					</div>

					<div
						class="flex flex-col items-center mt-8 space-y-2 lg:items-start">
						<div class="flex items-center space-x-4">
							<span class="material-symbols-outlined text-zine">
								place
							</span>
							<span class="ml-2 text-sm" id="address"
								>Jl. Raya</span
							>
						</div>
						<div class="flex items-center mt-2 space-x-4">
							<span class="material-symbols-outlined text-zine">
								phone
							</span>
							<span class="ml-2 text-sm" id="phone"
								>0808-1234-5678</span
							>
						</div>
						<div class="flex items-center mt-2 space-x-4">
							<span class="material-symbols-outlined text-zine">
								paid
							</span>
							<span class="ml-2 text-sm" id="open"
								>Rp99.000 - Rp200.000 / orang</span
							>
						</div>
					</div>

					<div class="flex items-center justify-center mt-8 space-x-4 lg:justify-start">
						<a href="menu.php"
							class="px-3 py-2 font-bold text-white transition duration-300 border-2 rounded-lg bg-zine border-zine hover:bg-zine-darker hover:border-zine-darker">
							Lihat Menu
						</a>
						<a
							href="review.php"
							class="px-3 py-2 ml-4 font-bold transition duration-300 bg-white border-2 rounded-lg text-zine border-zine hover:bg-zinc-100 hover:border-zine-darker">
							Tulis Review
						</a>
						<button id="copy">
							<span
								class="text-2xl material-symbols-outlined text-zine">
								share
							</span>
						</button>
					</div>
				</div>
			</div>
		</section>

		<div class="container px-2 mx-auto">
			<div class="w-full border-t-2 border-zine"></div>
		</div>

		<section id="detail-resto" class="w-full py-20">
			<div
				class="container flex flex-wrap items-start gap-8 px-2 mx-auto lg:justify-between">
				<div class="w-full lg:w-1/4">
					<h3 class="text-xl font-bold">Informasi Resto</h3>
					<div class="grid items-start w-full grid-cols-2 gap-4 mt-4">
						<div class="flex flex-col w-full space-y-2">
							<div>
								<h5 class="font-bold">Tipe Kuliner</h5>
								<p class="text-sm" id="type">Buffet</p>
							</div>
							<div>
								<h5 class="font-bold">Jam Buka</h5>
								<p class="text-sm" id="capacity">10.00 - 22.00</p>
							</div>
							<div>
								<h5 class="font-bold">Cabang</h5>
								<p class="text-sm" id="branch">Ya</p>
							</div>
						</div>
						<div class="flex flex-col w-full">
							<h5 class="font-bold">Fasilitas</h5>
							<div
								class="flex flex-col mt-2 space-y-1"
								id="facilities">
								<div
									class="flex items-center space-x-2 text-sm">
									<span
										class="material-symbols-outlined text-zinc-500">
										check
									</span>
									<span>Halal</span>
								</div>
								<div
									class="flex items-center space-x-2 text-sm">
									<span
										class="material-symbols-outlined text-zinc-500">
										close
									</span>
									<span>Wi-Fi</span>
								</div>
								<div
									class="flex items-center space-x-2 text-sm">
									<span
										class="material-symbols-outlined text-zinc-500">
										check
									</span>
									<span>Mushola</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="w-full lg:w-1/2">
					<iframe
						class="w-full h-[400px] rounded-xl"
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31610.770314138645!2d112.60567115670551!3d-7.9631192919338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629782be47b99%3A0x6fb76b332d7f07fe!2sHodai%20All%20You%20Can%20Eat%20Jl.%20Ciliwung!5e0!3m2!1sen!2sid!4v1700043545468!5m2!1sen!2sid"
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</section>

		<div class="container px-2 mx-auto">
			<div class="w-full border-t-2 border-zine"></div>
		</div>

		<section class="w-full py-20">
			<div class="container px-2 mx-auto">
				<h3 class="text-xl font-bold">Review</h3>

				<div id="reviews" class="mt-4">
					<div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-6">
						<div class="col-span-1 px-10 mx-auto">
							<div
								class="w-[100px] overflow-hidden rounded-full aspect-square bg-zine bg-opacity-20">
								<img id="profilImage" src="img/login/gamabarprofil.svg" alt="">
							</div>
							<div class="text-center">
								<h5 class="mt-4 font-bold">Nafa</h5>
								<span class="text-sm text-gray-600"
									>3 Ulasan</span
								>
							</div>
						</div>
						<div class="col-span-1 xl:col-span-3">
							<div
								class="relative w-full p-4 bg-white border-2 border-zine rounded-xl after:content-[''] after:absolute after:border-[20px] after:border-transparent after:border-b-zine xl:after:border-b-transparent xl:after:border-r-zine xl:after:top-[20px] xl:after:-left-[40px] after:-z-10 after:-top-[40px] after:left-1/2 after:transform after:-translate-x-1/2 xl:after:transform-none">
								<div class="flex items-start justify-between">
									<div class="flex flex-col">
										<h4 class="font-bold">Best All You Can In Townnn</h4>
										<span class="text-sm text-gray-600"
											>0 orang terbantu</span
										>
									</div>
									<span class="text-sm text-gray-600">5 menit yang lalu</span
									>
								</div>
								<p class="mt-6 text-sm text-gray-600">
									Saya sangat merekomendasikan restoran all you can eat ini! Harga terjangkau, rasa enak, ambience yang nyaman, dan kebersihan terjaga dengan baik
								</p>
							</div>
						</div>
						<div class="order-first xl:order-last xl:col-span-2">
							<div
								class="w-full h-[250px] rounded-xl overflow-hidden">
								<div
									class="w-full h-full bg-zine bg-opacity-20"></div>
							</div>
						</div>
					</div>
				</div>

				<!-- pagination -->
<!--				<div
					class="flex items-center justify-center mt-8 space-x-2"
					id="pagination">
					<script>
						const pagination = document.getElementById('pagination');

						for (let i = 1; i <= 5; i++) {
							const button = document.createElement('button');
							button.classList.add(
								'h-8',
								'w-8',
								'relative',
								'flex',
								'items-center',
								'justify-center',
								'rounded-lg',
								'bg-white',
								'text-zine',
								'border-2',
								'border-zine',
								'hover:bg-zinc-100'
							);
							button.innerText = i;
							pagination.appendChild(button);
						}
					</script>
				</div>
-->
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
