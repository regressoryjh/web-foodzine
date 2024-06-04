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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>FoodZine</title>
	<meta name="description" content="FoodZine Rekomendasi Tempat Makan Terdekat" />

	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
	<link rel="manifest" href="site.webmanifest" />
	<link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#ffa500" />
	<meta name="theme-color" content="#ffa500" />

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
		rel="stylesheet" />
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	<!-- splide -->
	<script src=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js "></script>
	<link href=" https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css " rel="stylesheet" />

	<!-- custom css -->
	<link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/SearchPage.css" />

	<!-- custom javascript -->
	<script src="js/index.js" type="text/javascript" defer></script>
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

    <section>
      </header>
        <main class="result-page">
          <section class="result-content">
            <div class="result-header">
              <div class="result-toolbar">
                <div class="result-title-container">
                  <h2 class="menampilkan-hasil">MENAMPILKAN HASIL</h2>
                    <div class="toolbar-controls">
                      <a class="sort">Sort</a>
                        <div class="sort-dropdown">
                          <div class="text-input">
                            <input class="text" placeholder="Paling Populer" type="text"
                            />
                          </div>
                          <div class="sort-dropdown-inner">
                            <div class="jamarrow-up-parent">
                              <img
                                class="jamarrow-up-icon"
                                alt=""
                                src="img/searchpage/jamarrowup.svg"/>
                                <img class="jamarrow-up-icon1" src="img/searchpage/jamarrowup-1.svg"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="filter-container-parent">
          <div class="filter-container">
            <div class="filter">
              <img class="logo-placeholder-icon" src="img/searchpage/logo-placeholder.svg"/>
                <div class="rating">
                  <div class="rating-icons"></div>
                  <div class="feature">Feature</div>
                    <img class="features-list-icon" src="img/searchpage/features-list@2x.png"/>
                  </div>
                  <div class="jam">
                    <div class="time-range-label"></div>
                    <div class="time-range-label1"></div>
                    <div class="jam-buka">Jam Buka</div>
                    <a class="jam-tutup">Jam Tutup</a>
                  </div>
                  <div class="rating1">
                    <div class="rating-child" id="rectangle"></div>
                    <img class="chart-bar-icon" src="img/searchpage/chartbar.svg"/>
                    <div class="tampilkan-rating-wrapper">
                      <div class="tampilkan-rating">Tampilkan Rating</div>
                    </div>
                  </div>
                  <div class="harga">
                    <div class="range">
                      <div class="price-range-handles"></div>
                      <div class="price-range-handles1"></div>
                      <div class="harga-min">Harga Min</div>
                      <div class="price-range-divider">
                        <div class="price-range-divider-child"></div>
                      </div>
                      <div class="harga-max">Harga Max</div>
                    </div>
                    <div class="option">
                      <div class="price-buttons">
                        <div class="price-button-icons"></div>
                        <div class="ribu">0 - 75 ribu</div>
                      </div>
                      <div class="price-buttons1">
                        <div class="price-buttons-child"></div>
                        <div class="ribu1">75 - 150 ribu</div>
                      </div>
                      <div class="price-buttons2">
                        <div class="price-buttons-item"></div>
                        <div class="ribu2">150 - 500 ribu</div>
                      </div>
                    </div>
                  </div>
                  <img class="rating-icon" loading="lazy" src="img/searchpage/rating.svg"/>
                  <div class="jarak">
                    <div class="distance-options">
                      <div class="jarak-1">
                        <div class="distance-icons-top"></div>
                        <div class="km">0.2 km</div>
                      </div>
                        <div class="jarak-5">
                          <div class="distance-icons-bottom"></div>
                          <div class="km1">2 km</div>
                        </div>
                      </div>
                      <div class="distance-options1">
                        <div class="jarak-2">
                          <div class="jarak-2-child"></div>
                          <div class="km2">0.5 km</div>
                        </div>
                        <div class="jarak-6">
                          <div class="jarak-6-child"></div>
                          <div class="km3">5 km</div>
                        </div>
                      </div>
                      <div class="distance-options2">
                        <div class="jarak-3">
                          <div class="jarak-3-child"></div>
                          <div class="km4">0.7 km</div>
                        </div>
                        <div class="jarak-7">
                          <div class="jarak-7-child"></div>
                          <div class="km5">7 km</div>
                        </div>
                      </div>
                      <div class="distance-options3">
                        <div class="jarak-4">
                          <div class="jarak-4-child"></div>
                          <div class="km6">1 km</div>
                        </div>
                      <div class="jarak-8">
                        <div class="jarak-8-child"></div>
                        <div class="km7">10 km</div>
                      </div>
                    </div>
                  </div>
              
                  <div class="feature1">
                    <div class="feature2">
                      <div class="jarak-1-parent">
                        <div class="jarak-11">
                          <div class="feature-icon-backgrounds-top"></div>
                          <div class="feature-icons-top-container">
                            <img class="icround-near-me-icon" loading="lazy" src="img/searchpage/icroundnearme.svg"/>
                          </div>
                          <div class="near-me">Near me</div>
                        </div>
                        <div class="feature-icon-containers-bottom">
                          <div class="feature-icon-backgrounds-botto">
                            <img class="icround-thumb-up-icon" src="img/searchpage/icroundthumbup.svg"/>
                          </div>
                          <div class="best-meal">Best meal</div>
                        </div>
                        <div class="feature-icon-backgrounds-third"></div>
                        <div class="jarak-31">
                          <div class="feature-icons-fourth-row-one"></div>
                          <div class="feature-labels-fourth-row-one">
                            <img class="healthiconsmoney-bag" src="img/searchpage/healthiconsmoneybag.svg" />
                          </div>
                          <div class="on-budget">On budget</div>
                        </div>
                        <div class="jarak-41">
                          <div class="feature-icon-fifth-row"></div>
                          <div class="feature-labels-fifth-row">
                            <img class="material-symbolsemoji-food-be-icon" src="img/searchpage/materialsymbolsemojifoodbeverage.svg"/>
                          </div>
                          <div class="beverage">Beverage</div>
                        </div>
                      </div>
                      <div class="jarak-5-parent">
                        <div class="jarak-51">
                          <div class="jarak-5-child"></div>
                          <div class="mdibakery-wrapper">
                            <img
                              class="mdibakery-icon"
                              loading="lazy"
                              alt=""
                              src="img/searchpage/mdibakery.svg"
                            />
                          </div>
                          <div class="bakery">Bakery</div>
                        </div>
                        <div class="jarak-61">
                          <div class="jarak-6-item"></div>
                          <div class="bxsbowl-rice-wrapper">
                            <img
                              class="bxsbowl-rice-icon"
                              alt=""
                              src="img/searchpage/bxsbowlrice.svg"
                            />
                          </div>
                          <div class="rice">Rice</div>
                        </div>
                        <div class="jarak-71">
                          <div class="feature-icons-third-row-one"></div>
                          <div class="feature-labels-third-row-one">
                            <img
                              class="feature-labels-third-row-one-child"
                              alt=""
                              src="img/searchpage/group-2608565.svg"
                            />
                          </div>
                          <div class="noodle">Noodle</div>
                        </div>
                        <div class="jarak-81">
                          <div class="jarak-8-item"></div>
                          <div class="makirestaurant-seafood-wrapper">
                            <img
                              class="makirestaurant-seafood-icon"
                              alt=""
                              src="img/searchpage/makirestaurantseafood.svg"
                            />
                          </div>
                          <div class="seafood">Seafood</div>
                        </div>
                      </div>
                      <div class="jarak-9-parent">
                        <div class="jarak-9">
                          <div class="jarak-9-child"></div>
                          <div class="bxssushi-wrapper">
                            <img
                              class="bxssushi-icon"
                              loading="lazy"
                              alt=""
                              src="img/searchpage/bxssushi.svg"
                            />
                          </div>
                          <div class="japanese">Japanese</div>
                        </div>
                        <div class="jarak-10">
                          <div class="jarak-10-child"></div>
                          <div class="chinese">Chinese</div>
                          <img
                            class="game-iconsdumpling"
                            loading="lazy"
                            alt=""
                            src="img/searchpage/gameiconsdumpling.svg"
                          />
                        </div>
                        <div class="jarak-12">
                          <div class="jarak-12-child"></div>
                          <div class="korean">Korean</div>
                          <img
                            class="fluent-emoji-high-contrastode-icon"
                            alt=""
                            src="img/searchpage/fluentemojihighcontrastoden.svg"
                          />
                        </div>
                        <div class="jarak-111">
                          <div class="jarak-11-child"></div>
                          <div class="western">Western</div>
                          <img
                            class="mdiburger-icon"
                            alt=""
                            src="img/searchpage/mdiburger.svg"
                          />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="hasil-main-review">
              <div class="hasil-main-review1">
                <div class="restaurant-card">
                  <div class="restaurant-image-wrapper">
                    <img
                      class="photo-per-resto-icon"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/photo-per-resto@2x.png"
                    />
                  </div>
                  <div class="restaurant-info">
                    <div class="restaurant-title">
                      <b class="gokana">Gokana</b>
                      <div class="cepat-saji-nasi">
                        Cepat Saji, Nasi, Ayam
                      </div>
                    </div>
                    <div class="restaurant-status">
                      <b class="buka-1000">Buka • 10.00 - 24.00</b>
                      <div class="location-wrapper">
                        <textarea
                          class="box-per-resto"
                          rows="{8}"
                          cols="{31}"
                        >
                        </textarea>
                        <b class="alamat-lengkap"
                          >Jl. Bendungan Sutami No.6 , Kec. Lowokwaru, Kota
                          Malang,</b
                        >
                      </div>
                      <b class="rp-15000-">Rp 15.000 - 20.000 /orang</b>
                    </div>
                  </div>
                </div>
                <div class="photo-per-resto"></div>
                <div class="photo-per-resto1"></div>
                <div class="restaurant-list">
                  <div class="photo-per-resto-parent">
                    <img
                      class="photo-per-resto-icon1"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/photo-per-resto-1@2x.png"
                    />

                    <img
                      class="images-1-icon"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/images-1@2x.png"
                    />

                    <img
                      class="image-3-icon"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/image-3@2x.png"
                    />

                    <img
                      class="photo-per-resto-icon2"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/photo-per-resto-2@2x.png"
                    />

                    <div class="card-image-container">
                      <div class="photo-per-resto2"></div>
                      <img
                        class="img-20230416-145237-77d24b1c17-icon"
                        loading="lazy"
                        alt=""
                        src="img/searchpage/img2023041614523777d24b1c1738222cef285a61378ce093-1@2x.png"
                      />
                    </div>
                    <img
                      class="photo-per-resto-icon3"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/photo-per-resto-3@2x.png"
                    />

                    <img
                      class="photo-per-resto-icon4"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/photo-per-resto-4@2x.png"
                    />

                    <div class="card-image-container1">
                      <div class="photo-per-resto3"></div>
                      <img
                        class="image-2-icon"
                        loading="lazy"
                        alt=""
                        src="img/searchpage/image-2@2x.png"
                      />
                    </div>
                    <img
                      class="photo-per-resto-icon5"
                      loading="lazy"
                      alt=""
                      src="img/searchpage/photo-per-resto-5@2x.png"
                    />
                  </div>
                  <div class="restaurant-card-details">
                    <div class="card-info-container">
                      <div class="retawu-deli-parent">
                        <b class="retawu-deli">RETAWU DELI</b>
                        <div class="bakery-dessert-cafe">
                          Bakery, Dessert, Cafe, Chill
                        </div>
                      </div>
                      <div class="buka-0600-2000-parent">
                        <b class="buka-0600">Buka • 06.00 - 20.00</b>
                        <div class="box-per-resto-parent">
                          <textarea
                            class="box-per-resto1"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap1"
                            >Jl. Retawu No.4, Kec Klojen, Kota Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per"
                          >Rp 25.000-50.000 /orang</b
                        >
                      </div>
                      <div class="nakoa-kafe-suhat-parent">
                        <b class="nakoa-kafe-suhat">NAKOA KAFE SUHAT</b>
                        <div class="coffee-eatery">
                          Coffee & Eatery, Beverages
                        </div>
                      </div>
                      <div class="jam-buka-parent">
                        <b class="jam-buka1">Buka • 24 Jam</b>
                        <div class="box-per-resto-group">
                          <textarea
                            class="box-per-resto2"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="jl-puncak-borobudur"
                            >Jl. Puncak Borobudur G502, Griya Shanta Blk. J
                            No.216, Kota Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per1"
                          >Rp 25.000 - 50.000 /orang</b
                        >
                      </div>
                      <div class="takochan-parent">
                        <b class="takochan">TAKOCHAN</b>
                        <div class="kategori">Snack, Kaki Lima</div>
                      </div>
                      <div class="jam-buka-group">
                        <b class="jam-buka2">Buka • 14.00 - 22.00</b>
                        <div class="box-per-resto-container">
                          <textarea
                            class="box-per-resto3"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <p class="alamat-lengkap2">
                            Jl. Sigura - Gura No.7, Sumbersari, Kec.
                            Lowokwaru, Kota Malang
                          </p>
                        </div>
                        <b class="estimasi-harga-per2">Rp 25.000 /orang</b>
                      </div>
                      <div class="nasi-kapau-uda-falah-parent">
                        <p class="nasi-kapau-uda">NASI KAPAU UDA FALAH</p>
                        <div class="kategori1">Restoran Padang, Nas</div>
                      </div>
                      <div class="jam-buka-container">
                        <b class="jam-buka3">Buka • 09.00 - 22.00</b>
                        <div class="frame-div">
                          <textarea
                            class="box-per-resto4"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap3"
                            >Jl. Bunga coklat No.Kav.3 Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per3"
                          >Rp 12.000 - 17.000/Orang</b
                        >
                      </div>
                      <div class="guri-ramen-parent">
                        <b class="guri-ramen">GURI RAMEN</b>
                        <div class="kategori2">Ramen, Jepang</div>
                      </div>
                      <div class="jam-buka-parent1">
                        <b class="jam-buka4">Buka • 11.00 - 24.00</b>
                        <div class="box-per-resto-parent1">
                          <textarea
                            class="box-per-resto5"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap4"
                            >Jl. Buring No.1A, Oro-oro Dowo, Kec. Klojen,
                            Kota Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per4"
                          >RP 30.000 - 50.000 /orang</b
                        >
                      </div>
                      <div class="geprek-kak-rose-parent">
                        <b class="geprek-kak-rose">GEPREK KAK ROSE</b>
                        <div class="kategori3">Ayam, Nasi</div>
                      </div>
                      <div class="jam-buka-parent2">
                        <b class="jam-buka5">Buka • 24 Jam</b>
                        <div class="box-per-resto-parent2">
                          <textarea
                            class="box-per-resto6"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap5"
                            >Jl. Sigura-gura Barat No.22a, Karangbesuki Kec.
                            Sukun, Kota Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per5"
                          >RP 12.000 - 25.000 /orang</b
                        >
                      </div>
                      <div class="roketto-parent">
                        <b class="roketto">ROKETTO</b>
                        <div class="coffe-eatery">
                          Coffe & Eatery, Beverage
                        </div>
                      </div>
                      <div class="jam-buka-parent3">
                        <b class="jam-buka6">Buka • 24 Jam</b>
                        <div class="box-per-resto-parent3">
                          <textarea
                            class="box-per-resto7"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap6"
                            >Jl. Kendalsari No.06, Jatimulyo, Kec.
                            Lowokwaru, Kota Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per6"
                          >RP 25.000 - 50.000 /orang</b
                        >
                      </div>
                      <div class="warkop-satu-jiwa-parent">
                        <b class="warkop-satu-jiwa">WARKOP SATU JIWA</b>
                        <div class="kategori4">Coffee Beverages</div>
                      </div>
                      <div class="jam-buka-parent4">
                        <b class="jam-buka7">Buka • 24 Jam</b>
                        <div class="box-per-resto-parent4">
                          <textarea
                            class="box-per-resto8"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap7"
                            >Jl. Sunan Pandanaran No. 4</b
                          >
                        </div>
                        <b class="estimasi-harga-per7"
                          >Rp 9.000 - 20.000/orang</b
                        >
                      </div>
                      <div class="sugarlust-bistro-parent">
                        <b class="sugarlust-bistro">SUGARLUST BISTRO</b>
                        <div class="coffe-eatery1">
                          Coffe & Eatery, Beverage
                        </div>
                      </div>
                      <div class="jam-buka-parent5">
                        <b class="jam-buka8">Buka • 12.00 - 21.00</b>
                        <div class="box-per-resto-parent5">
                          <textarea
                            class="box-per-resto9"
                            rows="{8}"
                            cols="{31}"
                          >
                          </textarea>
                          <b class="alamat-lengkap8"
                            >Jl. Raya Tlogomas No.5, Tlogomas, Kec.
                            Lowokwaru, Kota Malang</b
                          >
                        </div>
                        <b class="estimasi-harga-per8"
                          >Rp 50.000 - 75.000/orang</b
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="resep-mudah-ayam-geprek-buat-s"></div>
                <div class="wp-1651239654687-1"></div>
                <div class="rating-per-resto">
                  <b class="rating-list">4.2/5</b>
                </div>
                <div class="rating-per-resto1">
                  <b class="b">4.2/5</b>
                </div>
                <div class="rating-per-resto2">
                  <b class="b1">4.2/5</b>
                </div>
                <div class="rating-per-resto3">
                  <b class="b2">4.2/5</b>
                </div>
                <div class="rating-per-resto4">
                  <b class="b3">4.2/5</b>
                </div>
                <img
                  class="hasil-main-review-child"
                  loading="lazy"
                  alt=""
                  src="img/searchpage/group-2608576.svg"
                />

                <div class="rating-per-resto5">
                  <b class="b4">4.2/5</b>
                </div>
                <div class="rating-per-resto6">
                  <b class="b5">4.2/5</b>
                </div>
                <div class="rating-per-resto7">
                  <b class="b6">4.2/5</b>
                </div>
                <div class="rating-per-resto8">
                  <b class="b7">4.2/5</b>
                </div>
                <div class="rating-per-resto9">
                    <b class="b8">4.2/5</b>
                </div>
                <img
                    class="hasil-main-review-item"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608567.svg"
                />

                <img
                    class="hasil-main-review-inner"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608568.svg"
                />

                <img
                    class="group-icon"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608569.svg"
                />

                <img
                    class="hasil-main-review-child1"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608570.svg"
                />

                <img
                    class="hasil-main-review-child2"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608571.svg"
                />

                <img
                    class="hasil-main-review-child3"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608572.svg"
                />

                <img
                    class="hasil-main-review-child4"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608573.svg"
                />

                <img
                    class="hasil-main-review-child5"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608574.svg"
                />

                <img
                    class="hasil-main-review-child6"
                    loading="lazy"
                    alt=""
                    src="img/searchpage/group-2608575.svg"
                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
    </section>
    
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