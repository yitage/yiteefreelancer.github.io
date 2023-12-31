
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
    
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'contact_form_db');
        if ($conn->connect_error) {
            echo "$conn->connect_error";
            die("Connection Failed: " . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            $execval = $stmt->execute();
    
            if ($execval) {
                echo '<div style="width: 300px; margin: 0 auto; color: white; text-align: center; padding: 20px; background-color: black; border: 1px solid white;">Success: Your message has been sent!</div>';
                header("refresh:3; url=index.html"); // Redirect to 'home.php' after 3 seconds
            } else {
                echo '<div style="width: 300px; margin: 0 auto; text-align: center; padding: 20px; background-color: lightcoral; border: 1px solid red;">Error: Message sending failed. Please try again.</div>';
                header("refresh:3; url=index.html"); // Redirect to 'home.php' after 3 seconds
            }
            
            
    
            $stmt->close();
            $conn->close();
        }
    }
    ?>
    