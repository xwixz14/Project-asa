<?php


// Inisialisasi nama file untuk menyimpan review
$fileName = 'reviews.json';

// Inisialisasi array untuk menyimpan kritik, saran, dan rating
$reviews = [];

// Fungsi untuk menambahkan review
function tambahReview($namaPengguna, $kritik, $saran, $rating) {
    global $reviews;
    $reviews[] = [
        'namaPengguna' => $namaPengguna,
        'kritik' => $kritik,
        'saran' => $saran,
        'rating' => $rating
    ];
}

// Proses form jika data review dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPengguna = $_POST["username"];
    $kritik = $_POST["comment"];
    $saran = $_POST["suggestion"];
    $rating = $_POST["rate"];

   // Validasi input
   if (!empty($namaPengguna) && !empty($kritik) && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
    // Baca review dari file jika ada
    if (file_exists($fileName)) {
        $reviews = json_decode(file_get_contents($fileName), true);
    }

    // Tambahkan review
    tambahReview($namaPengguna, $kritik, $saran, $rating);

    // Simpan review ke file dalam format JSON
    file_put_contents($fileName, json_encode($reviews));

    // Redirect agar tidak terjadi pengiriman ulang pada refresh
    header("Location:  profil.html");
    exit();
} else {
    echo "Input tidak valid. Harap lengkapi semua field dan beri rating antara 1 dan 5.";
}
}

// Baca review dari file jika ada
if (file_exists($fileName)) {
    $reviews = json_decode(file_get_contents($fileName), true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rating</title>
    <link rel="stylesheet" href="kritik.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fa167abe8.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="kotak">
        <div class="c_silahkan-masuk-text">
            <p class="c_silahkan-masuk-text1">Kritik Dan Saran</p>
        </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="text">
                <label for="username">Nama Anda </label>
                <input type="text" placeholder="Masukan Nama Anda" name="username">
                <label for="comment">Kritik </label>
                <textarea name="comment" required></textarea>
                <label for="suggestion">Saran </label>
                <textarea name="suggestion"></textarea>
            </div>
            <div class="bintang">
                <input type="radio" name="rate" id="rate-5" value="5">
                <label for="rate-5" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-4" value="4">
                <label for="rate-4" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-3" value="3">
                <label for="rate-3" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-2" value="2">
                <label for="rate-2" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-1" value="1">
                <label for="rate-1" class="fas fa-star"></label>
            </div>
            <div class="tombol">
                <button type="submit">Submit Review</button>
            </div>
        </form>

       
    <script>
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault();
            // Submit form
            this.submit();
        });
    </script>
    </div>
    
  
</body>
</html>
