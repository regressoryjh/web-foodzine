<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login/signup.css">
    <link rel="stylesheet" href="css/login/styles.css">

    <!-- Fonts google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,400;6..12,600;6..12,700&display=swap" rel="stylesheet">

    <link
		rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    
    <title>Edit User</title>
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
    
    <section class="login d-flex">
        <div class="login-right w-2\/4 h-100">
            <div class="header">
                <h1>Edit Your Information</h1>
                <div class="login-form">
                <?php
                
                    require_once "config.php";

                    // Assume id is passed as a GET parameter
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Fetch current user data
                        $sql = "SELECT * FROM user_form WHERE id = ?";
                        $stmt = mysqli_stmt_init($conn);

                        if ($stmt) {
                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                mysqli_stmt_bind_param($stmt, "i", $id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $user = mysqli_fetch_assoc($result);

                                    // Close the statement
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "<div class='alert alert-danger'>User not found</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'>Error in preparing statement</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Error in initializing statement</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>No user ID provided</div>";
                    }

                if (isset($_POST["submit"])) {
                    $name = $_POST["fullname"];
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $birth = $_POST["tanggal_lahir"];
                    $password = $_POST["kata_sandi"];

                    $errors = array();

                    if (empty($name) || empty($username) || empty($email) || empty($birth)) {
                        array_push($errors, "All fields are required");
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Email is not valid");
                    } else if (!empty($password) && strlen($password) < 8) {
                        array_push($errors, "Password must be at least 8 characters long");
                    }

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {
                        $sql = "UPDATE user_form SET name = ?, username = ?, email = ?, birth = ?" . (!empty($password) ? ", password = ?" : "") . " WHERE id = ?";
                        $stmt = mysqli_stmt_init($conn);

                        if ($stmt) {
                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                if (!empty($password)) {
                                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                                    mysqli_stmt_bind_param($stmt, "sssssi", $name, $username, $email, $birth, $passwordHash, $id);
                                } else {
                                    mysqli_stmt_bind_param($stmt, "ssssi", $name, $username, $email, $birth, $id);
                                }
                                mysqli_stmt_execute($stmt);
                                echo "<div class='alert alert-success'>Your information has been updated successfully.</div>";
								mysqli_stmt_close($stmt);
                            } else {
                                echo "<div class='alert alert-danger'>Error in preparing statement</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Error in initializing statement</div>";
                        }
                    }
                }
                
                ?>

                <form action="edit_user.php?id=<?php echo $id; ?>" class="form" method="post">
                    <label for="Nama Lengkap" class="form-label1">Nama Lengkap</label>
                    <input type="Nama Lengkap" class="form-control" name="fullname" id="Nama Lengkap" placeholder="nama lengkap " value="<?php echo htmlspecialchars($user['name']); ?>">

                    <label for="Nama Pengguna" class="form-label1">Nama Pengguna</label>
                    <input type="Nama Pengguna" class="form-control" name="username" id="Nama Pengguna" placeholder="@Suzie123" value="<?php echo htmlspecialchars($user['username']); ?>">

                    <label for="Surel" class="form-label1">Surel</label>
                    <input type="Surel" class="form-control" name="email" id="Surel" placeholder="abc@mail.com" value="<?php echo htmlspecialchars($user['email']); ?>">

                    <label>Tanggal Lahir</label>
                    <input class="form-control" type="date" value="<?php echo htmlspecialchars($user['birth']); ?>" name="tanggal_lahir">

                    <label for="Kata Sandi" class="form-label">Kata Sandi (leave blank to keep current password)</label>
                    <input type="password" class="form-control" name="kata_sandi" id="Kata Sandi" placeholder="kata sandi">

                    <hr>
                </div>                
                <div class="tombol">
                    <a href="profil.php" name="cancel" onclick="return confirm('You have unsaved changes. Are you sure you want to leave?');">
                    <button type="button" class="btn masuk">Batal</button>
                    </a>
                    <button type="submit" class="btn masuk" name="submit">Perbarui</button>
                </div>
                </form>
            </div>
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
