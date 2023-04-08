<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// get refferer server
if($_SERVER['HTTP_REFERER'] === "http://unn-w20015975.newnumyspace.co.uk/"){
    // extract the data from $_POST
    $name = isset($_GET['name']) ? $_GET['name'] : null;
    $message = isset($_GET['message']) ? $_GET['message'] : null;
    $phone_number = isset($_GET['phone_number']) ? $_GET['phone_number'] : null;
    $interests = isset($_GET['interests']) ? $_GET['interests'] : null;
    $preference = isset($_GET['preference']) ? $_GET['preference'] : null;
    $organisation = isset($_GET['organisation']) ? $_GET['organisation'] : null;
    $job_title = isset($_GET['job_title']) ? $_GET['job_title'] : null;
    $email = isset($_GET['sendto']) ? $_GET['sendto'] : null;

    if($name && $message && $phone_number && $interests && $preference && $organisation && $job_title && $email){
    
        //Load composer's autoloader
        include 'group/vendor/autoload.php';

      

        $mail = new PHPMailer(true);
        try{
            // SMTP server configuration
            $mail->isSMTP();                                      // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                             // Enable SMTP authentication
            $mail->Username   = 'kv6002group@gmail.com';           // SMTP username
            $mail->Password   = 'zpqrlbmurwfzkluf';                        // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('kv6002group@gmail.com', 'React Contact form');
            $mail->addAddress('kv6002group@gmail.com');     // Add a recipient
            $mail->addReplyTo('kv6002group@gmail.com', 'Information');

            // Content
            $mail->isHTML(true);      // Set email format to HTML
            $mail->Subject = 'React Contact form';
            $mail->Body    = 'Name: ' . $name . '<br />Phone: ' . $phone_number . '<br />Organisation: ' . $organisation . '<br />JobTitle: ' . $job_title . '<br />Interests: ' . $interests . '<br />Preference: ' . $preference . '<br />Email: ' . $email . '<br /><br /><b>Message:</b> '
            . $message;

            if($mail->send()){

          
                try {
                    // Open a connection to the SQLite database
                    $db = new PDO('sqlite:ic3/db/tpp.db');
                
                    // Prepare the INSERT statement
                    $stmt = $db->prepare('INSERT INTO submissions (name, email, phone_number, interests, preference, organisation, job_title, message) VALUES (:name, :email, :phone_number, :interests, :preference, :organisation, :job_title, :message)');
                
                    if ($stmt !== false) {
                        // Bind the email data to the parameters in the INSERT statement
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':phone_number', $phone_number);
                        $stmt->bindParam(':interests', $interests);
                        $stmt->bindParam(':preference', $preference);
                        $stmt->bindParam(':organisation', $organisation);
                        $stmt->bindParam(':job_title', $job_title);
                        $stmt->bindParam(':message', $message);
                
                        // Execute the INSERT statement
                        if ($stmt->execute()) {
                            
                            echo "Email data inserted successfully";
                        } else {
                            echo "Error inserting email data: " . $stmt->errorInfo()[2];
                        }
                    } else {
                        echo "Error preparing SQL statement: " . $db->errorInfo()[2];
                    }
                
                    // Close the database connection
                    $db = null;
                } catch (PDOException $e) {
                    echo "Error connecting to database: " . $e->getMessage();
                }
               

                 echo "Message has been sent!";
            }
        }catch (Exception $e){
            echo "Message couldn't be sent. Error: ", $mail->ErrorInfo;
        }
    }else{
        echo "All the fileds are required!";
    }
}else{
    echo "You can't use this server!";
}
?>