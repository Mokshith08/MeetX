<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// DB CONNECT 
$conn = new mysqli("localhost", "root", "", "meetingroomsys");
if ($conn->connect_error) {
    die("DB connection failed");
}

$booking_id = intval($_GET['booking_id']);

// FETCH BOOKING + USER + ROOM DATA
$query = "
SELECT 
    b.id AS BookingID,
    b.booking_date AS BookingDate,
    b.start_time AS StartTime,
    b.end_time AS EndTime,
    b.purpose AS Purpose,
    b.fare AS Fare,
    
    u.name AS Name,
    u.email AS Email,
    u.phone AS Phone,
    u.org AS Organisation,

    b.room AS RoomName,
    r.rate_per_hour AS RatePerHour

FROM bookings b
JOIN users u 
    ON b.user_id = u.id
JOIN rooms r 
    ON r.room_name = b.room
WHERE b.id = $booking_id
";

$result = $conn->query($query);
$data = $result->fetch_assoc();

if (!$data) {
    die("Invoice data not found.");
}

// LOAD TEMPLATE
$template = file_get_contents("pdf.html");

// PLACEHOLDERS
$search = [
    "{{BOOKING_ID}}","{{DATE}}","{{START}}","{{END}}","{{PURPOSE}}",
    "{{ROOM}}","{{RATE}}","{{NAME}}","{{EMAIL}}","{{PHONE}}",
    "{{ORG}}","{{FARE}}"
];

// VALUES
$replace = [
    $data['BookingID'],
    $data['BookingDate'],
    $data['StartTime'],
    $data['EndTime'],
    $data['Purpose'],
    $data['RoomName'],
    $data['RatePerHour'],
    $data['Name'],
    $data['Email'],
    $data['Phone'],
    $data['Organisation'],
    $data['Fare']
];

// FINAL HTML
$html = str_replace($search, $replace, $template);

// GENERATE PDF
$dompdf = new Dompdf([
    "isRemoteEnabled" => true,
    "defaultFont" => "DejaVu"
]);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// DOWNLOAD PDF
$dompdf->stream("invoice_$booking_id.pdf", ["Attachment" => true]);
?>
