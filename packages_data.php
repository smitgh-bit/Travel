<?php
// packages_data.php
// Yahaan hum saare travel packages ki details ek array mein store karenge.

$packages = [
    'uk' => [
        'name' => 'United Kingdom',
        'description' => 'Walk through royal history, iconic landmarks, and charming countryside!',
        'image' => 'images/uk.png', // Aapke image ka path
        'price' => '800',
        'stars' => 3
    ],
    'france' => [
        'name' => 'France',
        'description' => 'Romance in Paris, vineyards in Bordeaux, and timeless beauty everywhere!',
        'image' => 'images/france.png',
        'price' => '700',
        'stars' => 3
    ],
    'monaco' => [
        'name' => 'Monaco',
        'description' => 'Luxury, glamour, and breathtaking views by the Mediterranean Sea!',
        'image' => 'images/Monaco.jpg',
        'price' => '900',
        'stars' => 4
    ],
    'italy' => [
        'name' => 'Italy',
        'description' => 'Fall in love with art, history, and the taste of authentic pasta & pizza!',
        'image' => 'images/italy.png',
        'price' => '800',
        'stars' => 4
    ],
    'india' => [
        'name' => 'India',
        'description' => 'Dive into colors, culture, spirituality, and timeless heritage!',
        'image' => 'images/india.png',
        'price' => '1000',
        'stars' => 5
    ],
    'usa' => [
        'name' => 'United States',
        'description' => 'Experience the land of dreams — from New York’s skyline to California’s sunsets!',
        'image' => 'images/us.png',
        'price' => '900',
        'stars' => 4
    ]
];

// Ek helper function stars generate karne ke liye
function generate_stars($count) {
    $output = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $count) {
            $output .= '<i class="fa-solid fa-star checked"></i>';
        } else {
            $output .= '<i class="fa-solid fa-star"></i>';
        }
    }
    return $output;
}
?>
