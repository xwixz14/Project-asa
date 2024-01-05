<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Pecel Lele Mas Bagus Wae</title>
    <link rel="stylesheet" href="tampilan.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/1fa167abe8.js" crossorigin="anonymous"></script>

    
</head>

<body>
<!-- Membuat Navigation bar -->
    <section class="Navbar-Menu" id="Navbar-Menu-Id">
        <div class="menu">
           
            <div class="rightside" id="rightside">
                <nav class="Icons" >

                    <a href="#Navbar-Menu-Id" class="navicon">Home</a>
                    <a href="#Gallery" class="navicon">Gallery</a>
                    <a href="#Feedback" class="navicon">Feedback</a>
                    <a href="#footerid" class="navicon">Contact</a>
                    <a href="database.php" class="navicon">Semua ulasan</a>
                    <i class="fas fa-times-circle" id="cross" onclick="Hidemenu()"></i>

                    <div class="social">
                        <li id="Border"></li>
                        <a href="index.html" id="Roti-Bakar"> Pecel Lele Mas Bagus Wae</a>
                    </div>
                </nav>
            </div>
            <div class="menubar" >
                <div class="line" onclick="Togglebar()"></div>
                <div class="line" onclick="Togglebar()"></div>
                <div class="line" onclick="Togglebar()"></div>
            </div>

            <!-- Membuat header -->
        </div>
        <div class="heading" >
        
            <h2>Pecel Lele Mas Bagus Wae</h2><br>
        </div>
        <div class="Scroll-Arrow" id="topbutton">
            <a href="#"><i class="fal fa-arrow-up"></i></a>
         </div>
    </section>

<!-- gallery-->
<section id="Gallery">
    <h4 class="G">Gallery</h4>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu1.jpeg">
      <img src="asset/menu1.jpeg" alt="Northern Lights" width="30%" height="900">
    </a>
    <div class="desc">Pecel Lele</div>
  </div>
</div>

<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu2.jpg">
      <img src="asset/menu2.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Lele Bakar</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu7.jpeg">
      <img src="asset/menu7.jpeg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Ikan Gurame Bakar</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu3.jpg">
      <img src="asset/menu3.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Tongseng Sapi</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu5.jpg">
      <img src="asset/menu5.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Ikan Nila Bakar</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu6.jpg">
      <img src="asset/menu6.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Bebek Bakar</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu4.jpe">
      <img src="asset/menu4.jpe" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Cah kangkung</div>
  </div>
</div>
<div class="responsive">
  <div class="gallery">
    <a target="_blank" href="asset/menu8.jpg">
      <img src="asset/menu8.jpg" alt="Mountains" width="600" height="400">
    </a>
    <div class="desc">Ikan Gurame Pedas Manis</div>
  </div>
</div>
<div class="clearfix"></div>
</section>


<!-- Membuat Tampilan Fedback -->
<section class="Feedback" id="Feedback">
    <h1>Feedback</h1>
    <p>Tidak Ada Yang Bisa Kami Ungkapan Selain Kepuasan Pelangggan</p>
            
        <?php
        // Menampilkan rata-rata rating
        // Fungsi untuk menampilkan rating dengan gambar bintang
        function tampilkanRating($rating) {
          $output = '';
          $ratingFloor = floor($rating);
          $fraction = $rating - $ratingFloor;
      
          for ($i = 1; $i <= $ratingFloor; $i++) {
              $output .= '<i class="fas fa-star"></i>';
          }
      
          if ($fraction > 0) {
              // Jika terdapat fraksi, tambahkan bintang sebagian
              $output .= '<i class="fas fa-star-half-alt"></i>';
          }
      
          // Mengisi sisa bintang dengan bintang kosong
          for ($i = $ratingFloor + 2; $i <= 5; $i++) {
              $output .= '<i class="far fa-star"></i>';
          }
      
          return $output;
      }
      
        // Membaca data reviews dari file JSON
        $fileName = 'reviews.json';
        $reviews = [];

        if (file_exists($fileName)) {
            $reviews = json_decode(file_get_contents($fileName), true);
        }

        // Menghitung rata-rata rating
        $totalRating = 0;
        $jumlahReview = count($reviews);

        if ($jumlahReview > 0) {
            foreach ($reviews as $review) {
                $totalRating += $review['rating'];
            }

            $rataRata = $totalRating / $jumlahReview;

            // Menampilkan rata-rata rating dengan gambar bintang yang dinamis
echo '<div class="rating-container">';
echo ' ' . round($rataRata, 2) . ' ' . tampilkanRating(round($rataRata, 2));
echo '<span class="ulasan">' . $jumlahReview . ' Ulasan</span>';
echo '</div>';
          }
        ?>
    <div class="feedback-background">
            <div class="center-heading">
            <p>Beri kami penilaian  <br>Pecel Lele Mas Bagus Wae</p>
            <a href="javascript:void(0);" onclick="checkLoginStatus()">Send Feedback Now</a>   
            </div> 
    </div>
</section>

<!-- Mmmbuat Tampilan footer -->
<section class="footer" id="footerid">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-4 col-md-4 col-12 mx-auto">
                <h3>Kontak Kami</h3>
                <p>Jalan ZA. Pagar Alam No.1 A
                    Labuhan Ratu
                    Kecamatan Kedaton
                    Kota Bandar Lampung
                    Lampung 35142
                    Indonesia</p>
                <hr class="w-25 mx-auto text-dark">
                <p>Hours: Opens 11:00AM To 23:00PM <br>
                    Monday to Monday <br>
                Phone: 0852-6723-5528</p>      
            </div>
            <div class="col-lg-4 col-md-4 col-12 mx-auto">
                <h3>Location</h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.2303693278473!2d105.2570581!3d-5.38181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db0b31cd66d1%3A0x441dc49ff7887e3f!2sPecel%20Lele%20Mas%20Bagus%20Wae!5e0!3m2!1sid!2sid!4v1704377205630!5m2!1sid!2sid"  height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <hr class="w-50 mt-5 mx-auto text-dark">
    <div class="container last-footer" >
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12 mx-auto Copyright">
                <h4 id="last-logo">Pecel Lele Mas Bagus Wae</h4>
            </div>
        </div>
    </div>
</section>

    
<!-- Script Section -->
<script>
    function checkLoginStatus() {
        // Ganti kondisi ini dengan metode login sesuai dengan kebutuhan Anda
        var isLoggedIn = sessionStorage.getItem('username') !== null;

        if (isLoggedIn) {
            // Jika sudah login, arahkan ke halaman feedback
            window.location.href = 'kiritik.php';
        } else {
            // Jika belum login, beri peringatan atau arahkan ke halaman login
            alert('Anda harus login terlebih dahulu.');
            // Misalnya, bisa diarahkan ke halaman login
             window.location.href = 'login.html';
        }
    }
</script>
    
</body>
</html>
