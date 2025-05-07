<?php
// php/book_form.php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ! isset($_POST['send'])) {
    die('Invalid request method.');
}

// 1) Required-fields check
$required = ['name','email','phone','address','location','guests','arrivals','leaving'];
foreach ($required as $f) {
    if (empty($_POST[$f])) {
        die("Please fill in all required fields.");
    }
}

// 2) Sanitize inputs
$name     = trim($_POST['name']);
$email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$phone    = trim($_POST['phone']);
$address  = trim($_POST['address']);
$location = trim($_POST['location']);
$guests   = intval($_POST['guests']);
$arr_raw  = trim($_POST['arrivals']);
$lev_raw  = trim($_POST['leaving']);

// 3) Validate email
if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// 4) Parse & validate dates
$dateArr = DateTime::createFromFormat('Y-m-d', $arr_raw);
$dateLev = DateTime::createFromFormat('Y-m-d', $lev_raw);
if (! $dateArr || ! $dateLev) {
    die("Invalid date(s) provided.");
}
$arrivals = $dateArr->format('Y-m-d');
$leaving  = $dateLev->format('Y-m-d');

if ($dateLev < $dateArr) {
    die("‘Leaving’ date must come after ‘Arrivals’ date.");
}

// 5) Prepare & bind (5 strings, 1 integer, 2 dates as strings)
$stmt = $conn->prepare("
    INSERT INTO book_form
      (name, email, phone, address, location, guests, arrivals, leaving)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
if (! $stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param(
    "sssssiss",
    $name,
    $email,
    $phone,
    $address,
    $location,
    $guests,
    $arrivals,
    $leaving
);

// 6) Execute & redirect
if (! $stmt->execute()) {
    die("Error inserting booking: " . $stmt->error);
}

$stmt->close();
$conn->close();

// 7) On success, send back to the form with a success flag
header('Location: /tour_travel/html/book.html?success=1');
exit();
