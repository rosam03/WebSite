
<?php

// Retreive visitor name, email, and message from form
$visitor_name =  $_POST["name"];
$visitor_email = $_POST["email"];
$visitor_message = $_POST["message"];

// The following regular expressions are invalid for form fields
$invalid_name = "/[^A-Za-z+.]/"; // Name can only contain letters and periods
$invalid_email = "/[^A-Za-z0-9++@._-]/"; // Email can only contain valid email address characters 
$invalid_message ="/[<>\_{}]/" ; // Message body cannot contain symbols that might represent external code

    // If any invalid characters are detected, exit
    if(preg_match($invalid_name, $visitor_name) || preg_match($invalid_message, $visitor_message) || preg_match($invalid_email, $visitor_email) ) {

    echo "One or more of the characters you entered in the fields is not allowed. Please try again."."<br><br>"."Names can only contain letters and periods.<br>"."Emails can only contain letters, numbers, and the following symbols: @ . + _ - <br>"."Messages must not contain the following: < > \ { }<br>";

    exit;

    }

    else if( strlen($visitor_message) > 9 ) { // Mail if the message is more than 9 characters long 

	if(strlen($visitor_name) == 0){ // Warn visitor if name field left blank

	    echo "Warning: Name field was left blank."."<br>";
	    $visitor_name = "";

	}

	if(strlen($visitor_email) == 0) { // Warn visitor if there is no reply-to email address
	    echo "Warning: Email field was left blank."."<br>";
	    $visitor_email = "";

	}

    $email_from = "rosamohammadi@hotmail.com"; //email_from is set as owner instead of visitor_email so system doesnt assume trying to impersonate others

    $email_subject = "IMP: WEBSITE EMAIL!"; // Email subject
    // Form a message with the available information

    $email_body = "You have received a message on your Weebly website, rosamohammadi.weebly.com, from $visitor_name: \n\n"."$visitor_message"."\n\n\n"."Reply to $visitor_email \n";

    $to = $email_from; // Send email to server owner
    $headers = "Reply-to: $visitor_email \r\n"; // Include in email the visitors email


    if(mail($to, $email_subject, $email_body, $headers)) { // Let visitor know if mail was accepted for delivery

	echo "Mail was successfully accepted for delivery. Thank you!"."<br>";

    }
    else{ // Let visitor know if mail failed to send

	echo "ERROR: Mail was not successfully delivered. Please try again."."<br>";

    }

    }

    else{ // If message body was 9 characters or less, it probably does not contain useful information

	echo "Email cannot be sent when message field is blank. Please try again."."<br>";

    }

?>