<?php
  //session_start();
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
  // Fetch user data from database
  include('config.php');
  $user_id = $_SESSION["user_id"];
  $sql = "SELECT * FROM user_form WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  $stmt->close();
  $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
    <link rel="manifest" href="site.webmanifest" />
    <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#ffa500" />
    <meta name="theme-color" content="#ffa500" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/login/style5.css">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,400;6..12,600;6..12,700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- splide -->
		<script src=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js "></script>
		<link
			href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css "
			rel="stylesheet" />

    <script src="js/index.js" type="text/javascript" defer></script>
</head>

<body>
  <nav class="bg-zine">
		<div class="container d-flex items-center justify-between px-2 py-4 mx-auto">
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

  <div class="container">
    <div class="row">
      <section class="fotoprof">
        <img id="profilImage" src="img/login/gamabarprofil.svg" alt="">
      </section>

      <section class="profil col-md-6 d-flex flex-column">
          <div class="mb-3 d-flex align-items-center text-4x1">
              <strong>PROFIL PENGGUNA</strong>
          </div>
          <div class="mb-3 d-flex align-items-center">
              <img class="d-inline" src="img/login/Vector1.svg" alt="" style="margin-right: 10px; width: 20px; height: 20px;">
              <strong>Username: </strong>
              <span id="namaLengkap" class="ms-2"><?php echo $user['username']; ?></span>
          </div>

          <div class="mb-3 d-flex align-items-center">
              <img class="d-inline" src="img/login/Vector.svg" alt="" style="margin-right: 10px; width: 20px; height: 20px;">
              <strong>Nama Lengkap: </strong>
              <span id="namaLengkap" class="ms-2"><?php echo $user['name']; ?></span>
          </div>  

          <div class="mb-3 d-flex align-items-center">
              <img src="img/login/EnvelopeSimple.svg" alt="" style="margin-right: 10px; width: 20px; height: 20px;">
              <strong>Surel: </strong>
              <span id="email" class="ms-2"><?php echo $user['email']; ?></span>
          </div>

          <div class="mb-3 d-flex align-items-center">
              <img src="img/login/Eye.svg" alt="" style="margin-right: 10px; width: 20px; height: 20px;">
              <strong>Tanggal Lahir: </strong>
              <span id="kataSandi" class="ms-2"><?php echo $user['birth']; ?></span>
          </div>

          <div class="d-flex align-items-center">
            <a href="edit_profile.php?id=<?php echo $user['id']; ?>" class="btn btn-danger me-2">Edit Profil</a>
            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger ms-2" onclick="return confirm('Are you sure you want to delete your account?');">Hapus Akun</a>
            <?php if (isset($_SESSION["user_id"])) : ?>
                <a href="logout.php" class="btn btn-secondary ms-2">Logout</a>
            <?php endif; ?>
          </div>
      </section>
    </div>

    <div class="ulasan">
        <h1>History Ulasan</h1>
          <div class="komen">
          <div class="gambar"><img src="img/login/Group 2608596.svg" alt=""></div>
          <div class="hapus">
            <a href="#" class="delete-trigger"
              data-image="carbontrash-can-31-Group2608536-31-HalamanProfil-31-ProfilUlasanblmEdit.png">
              <img class="imgabv"
                src="img/login/carbontrash-can-31-Group2608536-31-HalamanProfil-31-ProfilUlasanblmEdit.png" alt="Hapus">
            </a>
          </div>
          <div class="edit">
            <a href="#" class="edit-trigger" data-image="Group 2608597.png">
              <img class="imgabv" src="img/login/Group 2608597.png" alt="Edit">
            </a>
          </div>
          </div>

    <script>
      // Mendapatkan elemen delete
      var deleteTrigger = document.querySelector('.komen .delete-trigger');
      if (deleteTrigger) {
        deleteTrigger.addEventListener('click', function (event) {
          // Menghentikan tindakan default agar tautan tidak diikuti
          event.preventDefault();

          // Mengambil data-image dari elemen
          var popupImageSrc = deleteTrigger.getAttribute('data-image');

          // Menggunakan confirm untuk memunculkan dialog konfirmasi
          var userConfirmation = confirm('Apakah Anda yakin ingin menghapus ulasan?');

          // Jika pengguna mengonfirmasi, hapus ulasan dan seluruh elemen di dalam elemen dengan kelas "komen"
          if (userConfirmation) {
            // Tambahkan logika penghapusan ulasan di sini
            alert('Ulasan dihapus!');
            // Hapus seluruh elemen di dalam elemen dengan kelas "komen"
            document.querySelector('.komen').remove();
          }
        });
      }

      // Mendapatkan elemen edit
      var editTrigger = document.querySelector('.komen .edit-trigger');
      if (editTrigger) {
        editTrigger.addEventListener('click', function (event) {
          // Menghentikan tindakan default agar tautan tidak diikuti
          event.preventDefault();

          // Mendapatkan URL atau path file HTML yang ingin Anda arahkan
          var targetURL = 'reviewEdit.php';

          // Menggunakan confirm untuk memunculkan dialog konfirmasi
          var userConfirmation = confirm('Apakah Anda yakin ingin mengedit ulasan?');

          // Jika pengguna mengonfirmasi, arahkan ke file HTML lain
          if (userConfirmation) {
            // Tambahkan logika pengeditan ulasan di sini (jika diperlukan)
            alert('Anda akan diarahkan ke halaman ulasan!');
            // Arahkan ke file HTML lain
            window.location.href = targetURL;
          }
        });
      }
    </script>



    <div class="komen1">
      <div class="gambar1"><img src="img/login/Group 2608598.svg" alt=""></div>
      <div class="hapus1"><a href="#" class="delete-trigger1"
          data-image="carbontrash-can-31-Group2608536-31-HalamanProfil-31-ProfilUlasanblmEdit.png"><img class="imgabv"
            src="img/login/carbontrash-can-31-Group2608536-31-HalamanProfil-31-ProfilUlasanblmEdit.png" alt="Hapus"></a>
      </div>
      <div class="edit1"><a href="#" class="edit-trigger1" data-image="Group 2608597.png"><img class="imgabv"
            src="img/login/Group 2608597.png" alt="Edit"></a></div>
    </div>
    <script>
      // Mendapatkan elemen delete
      var deleteTrigger1 = document.querySelector('.komen1 .delete-trigger1');
      if (deleteTrigger1) {
        deleteTrigger1.addEventListener('click', function (event1) {
          // Menghentikan tindakan default agar tautan tidak diikuti
          event1.preventDefault();

          // Mengambil data-image dari elemen
          var popupImageSrc1 = deleteTrigger1.getAttribute('data-image');

          // Menggunakan confirm untuk memunculkan dialog konfirmasi
          var userConfirmation1 = confirm('Apakah Anda yakin ingin menghapus ulasan?');

          // Jika pengguna mengonfirmasi, hapus ulasan dan seluruh elemen di dalam elemen dengan kelas "komen1"
          if (userConfirmation1) {
            // Tambahkan logika penghapusan ulasan di sini
            alert('Ulasan dihapus!');
            // Hapus seluruh elemen di dalam elemen dengan kelas "komen1"
            deleteTrigger1.closest('.komen1').remove();
          }
        });
      }


      // Mendapatkan elemen edit
      var editTrigger1 = document.querySelector('.komen1 .edit-trigger1');
      if (editTrigger1) {
        editTrigger1.addEventListener('click', function (event) {
          // Menghentikan tindakan default agar tautan tidak diikuti
          event.preventDefault();

          // Mendapatkan URL atau path file HTML yang ingin Anda arahkan
          var targetURL = 'reviewEdit.php';

          // Menggunakan confirm untuk memunculkan dialog konfirmasi
          var userConfirmation = confirm('Apakah Anda yakin ingin mengedit ulasan?');

          // Jika pengguna mengonfirmasi, arahkan ke file HTML lain
          if (userConfirmation) {
            // Tambahkan logika pengeditan ulasan di sini (jika diperlukan)
            alert('Anda akan diarahkan ke halaman ulasan!');
            // Arahkan ke file HTML lain
            window.location.href = targetURL;
          }
        });
      }
    </script>

    <div class="komen2">
      <div class="gambar2"></div><img src="img/login/Group 2608599.svg" alt="">
      <div class="hapus2">
        <a href="#" class="delete-trigger2"
          data-image="carbontrash-can-31-Group2608536-31-HalamanProfil-31-ProfilUlasanblmEdit.png"><img class="imgabv"
            src="img/login/carbontrash-can-31-Group2608536-31-HalamanProfil-31-ProfilUlasanblmEdit.png" alt="Hapus"></a>
      </div>
      <div class="edit2">
        <a href="#" class="edit-trigger2" data-image="Group 2608597.png"><img class="imgabv"
            src="img/login/Group 2608597.png" alt="Edit"></a>
      </div>
    </div>

    <script>
      // Mendapatkan elemen delete
      var deleteTrigger2 = document.querySelector('.komen2 .delete-trigger2');
      if (deleteTrigger2) {
        deleteTrigger2.addEventListener('click', function (event2) {
          // Menghentikan tindakan default agar tautan tidak diikuti
          event2.preventDefault();

          // Mengambil data-image dari elemen
          var popupImageSrc2 = deleteTrigger2.getAttribute('data-image');

          // Menggunakan confirm untuk memunculkan dialog konfirmasi
          var userConfirmation2 = confirm('Apakah Anda yakin ingin menghapus ulasan?');

          // Jika pengguna mengonfirmasi, hapus ulasan dan seluruh elemen di dalam elemen dengan kelas "komen2"
          if (userConfirmation2) {
            // Tambahkan logika penghapusan ulasan di sini
            alert('Ulasan dihapus!');
            // Hapus seluruh elemen di dalam elemen dengan kelas "komen2"
            deleteTrigger2.closest('.komen2').remove();
          }
        });
      }

      // Mendapatkan elemen edit
      var editTrigger2 = document.querySelector('.komen2 .edit-trigger2');
      if (editTrigger2) {
        editTrigger2.addEventListener('click', function (event) {
          // Menghentikan tindakan default agar tautan tidak diikuti
          event.preventDefault();

          // Mendapatkan URL atau path file HTML yang ingin Anda arahkan
          var targetURL = 'reviewEdit.php';

          // Menggunakan confirm untuk memunculkan dialog konfirmasi
          var userConfirmation = confirm('Apakah Anda yakin ingin mengedit ulasan?');

          // Jika pengguna mengonfirmasi, arahkan ke file HTML lain
          if (userConfirmation) {
            // Tambahkan logika pengeditan ulasan di sini (jika diperlukan)
            alert('Anda akan diarahkan ke halaman ulasan!');
            // Arahkan ke file HTML lain
            window.location.href = targetURL;
          }
        });
      }
    </script>
      </div>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  --
    </script>

    <!-- Tambahkan atribut data-image pada elemen delete-trigger dan edit-trigger -->


    <style>
      .komen,
      .komen1,
      .komen2 {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        align-items: flex-end;
        gap: 8px;
        /* Jarak antar ikon */
        margin-top: 20px;
        /* Sesuaikan margin sesuai kebutuhan */
      }

      .komen imgabv {
        position: absolute;
        margin-left: 100px;
      }
    </style>
    <!-- <script>
    // Mendapatkan semua elemen <a> yang berisi gambar
    var imageLinks = document.querySelectorAll('.komen a');
  
    // Menambahkan event listener pada setiap elemen <a>
    imageLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        alert('Edit Ulasan?');
      });
    });
  </script> -->

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