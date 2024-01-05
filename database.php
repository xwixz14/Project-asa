<?php
// Fungsi untuk menampilkan rating dengan gambar bintang
function tampilkanRating($rating) {
    $output = '';
    $maxStars = 5; // Jumlah maksimal bintang

    // Menambahkan bintang sesuai dengan nilai desimal
    for ($i = 1; $i <= $maxStars; $i++) {
        if ($rating >= $i - 0.5 && $rating < $i) {
            // Menambahkan bintang setengah
            $output .= '<i class="fas fa-star-half-alt"></i>';
        } elseif ($rating >= $i) {
            // Menambahkan bintang penuh
            $output .= '<i class="fas fa-star"></i>';
        } else {
            // Menambahkan bintang kosong
            $output .= '<i class="far fa-star"></i>';
        }
    }

    return $output;
}
   
// Inisialisasi nama file untuk menyimpan review
$fileName = 'reviews.json';

// Inisialisasi array untuk menyimpan kritik, saran, dan rating
$reviews = [];



function tambahReview($namaPengguna, $kritik, $saran, $rating) {
    
    
global $reviews;
    $reviews[] = [
        'namaPengguna' => $namaPengguna,
        'kritik' => $kritik,
        'saran' => $saran,
        'rating' => $rating
    ];
}


  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaPengguna = $_POST["username"];
    $kritik = $_POST["comment"];
    $saran = $_POST["suggestion"];
    $rating = $_POST["rate"];

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
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Input tidak valid. Harap lengkapi semua field dan beri rating antara 1 dan 5.";
    }
}

// Baca review dari file jika ada
if (file_exists($fileName)) {
    $reviews = json_decode(file_get_contents($fileName), true);
}

// Inisialisasi waktu awal pencarian
$startTime = microtime(true);

// Check if a specific rating is selected
$searchRating = isset($_GET['search-rating']) ? $_GET['search-rating'] : null;

// Function to perform bubble sort on reviews based on rating
function bubbleSort(&$array) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j]['rating'] < $array[$j + 1]['rating']) {
                // Swap positions if the rating is greater
                $temp = $array[$j];
                
        
$array[$j] = $array[$j + 1];
                
  
$array[$j + 1] = $temp;
            }
        }
    }
}

        $totalRating = 0;
        $jumlahReview = count($reviews);

        if ($jumlahReview > 0) {
            foreach ($reviews as $review) {
                $totalRating += $review['rating'];
            }

            $rataRata = $totalRating / $jumlahReview;
        }
?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Rating</title>
    <link rel="stylesheet" href="database.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fa167abe8.js" crossorigin="anonymous"></script>
    
</head>
<body>
 <div class="rating">
 <form method="GET">
    <label for="search-rating">
        <h3>Penilaian Kritik Dan Saran</h3>
        <h4>Rumah makan pecel lele mas bagus wae</h4>
    </label>
    <select name="search-rating" id="search-rating">

        <option value="Semua">Semua</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
        
    </select>
    <button type="submit">Cari</button>
</form>
<?php
echo '<div class="rating-container">';
echo ' ' . round($rataRata, 2) . ' ' . tampilkanRating(round($rataRata, 2));
echo '<span class="ulasan">' . $jumlahReview . ' Ulasan</span>';
echo '</div>';
        
?>
</div>



<?php
bubbleSort($reviews);

// Display sorted reviews
foreach ($reviews as $review) {
    
  
    // Filter review based on rating if selected
    if ($searchRating === null || $searchRating === "Semua" || $review['rating'] == $searchRating) {
               
    echo "<p><strong>{$review['namaPengguna']}</strong><br>";
    echo "Kritik: {$review['kritik']}<br>";
    echo "Saran: {$review['saran']}<br>";
    echo "Rating: " . tampilkanRating($review['rating']) . "</p>";
        }
    }
    


// Waktu akhir pencarian
// $endTime = microtime(true);

// // Menghitung waktu pencarian
// $searchTime = $endTime - $startTime;
// echo "Waktu pencarian: $searchTime detik";
?>
    
</body>
</html>
