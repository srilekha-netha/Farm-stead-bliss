<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs (example validation, adjust as needed)
    $name = htmlspecialchars(trim($_POST['Name']));
    $email = filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL);
    $country = htmlspecialchars($_POST['Country']);
    $phone = htmlspecialchars($_POST['Phone']);
    $roomType = htmlspecialchars($_POST['RoomType']);
    $bed = htmlspecialchars($_POST['Bed']);
    $noOfRooms = htmlspecialchars($_POST['NoofRoom']);
    $mealOption = htmlspecialchars($_POST['Meal']);
    $checkInDate = htmlspecialchars($_POST['CheckIn']);
    $checkOutDate = htmlspecialchars($_POST['CheckOut']);

    // Example validation: Check if required fields are filled
    if (empty($name) || empty($email) || empty($country) || empty($phone) || empty($roomType) || empty($bed) || empty($noOfRooms) || empty($mealOption) || empty($checkInDate) || empty($checkOutDate)) {
        // Handle validation failure (redirect or error message)
        echo "Please fill all required fields.";
        exit;
    }

    // Example: Save booking information to database or file
    // Replace with your actual database connection and query logic
    // Example assumes MySQL database, adjust for your database type

    // Database connection parameters
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into database (example)
    $sql = "INSERT INTO bookings (name, email, country, phone, room_type, bedding_type, number_of_rooms, meal_option, check_in_date, check_out_date)
            VALUES ('$name', '$email', '$country', '$phone', '$roomType', '$bed', '$noOfRooms', '$mealOption', '$checkInDate', '$checkOutDate')";

    if ($conn->query($sql) === TRUE) {
        // Display booking completed alert using JavaScript
        echo "<script>
                alert('Booking Completed');
                window.location.href = 'booking.html'; // Redirect to booking form after alert
              </script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    // Redirect back to booking form if accessed directly without POST method
    header("Location: booking.html");
    exit;
}
?>
