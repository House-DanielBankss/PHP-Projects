<?php
    ini_set('display_errors', 0);

    $error = "";
    $successMessage = "";

    if ($_POST) {
        if (!$_POST["email"]) {
            $error .= "An <strong>email address</strong> is required<br>";
        }

        if (!$_POST["content"]) {
            $error .= "The <strong>content</strong> field is required<br>";
        }

        if (!$_POST["subject"]) {
            $error .= "The <strong>subject</strong> is required<br>";
        }

        if ((!$_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL == false)) {
            $error .= "The <strong>email address</strong> is invalid<br>";
        }

        if ($error != "") {
            $error = '<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';
        } else {
            $emailTo = "supportemail@support.com";
            $subject = $_POST['subject'];
            $content = $_POST['content'];
            $headers = "From: " . $_POST['email'];

            if (mail($emailTo, $subject, $content, $headers)) {
                $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, We\'ll respond ASAP!</div>';
            } else {
                $error = '<div class="alert alert-danger w-100" role="alert">Your message couldn\'t be sent - try again later</div>';
            }
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Form</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="d-flex flex-column justify-content-center align-items-center mt-5">
            <h1>Get in touch!</h1>

            <div id="error"><?php echo $error . $successMessage; ?></div>

            <form method="post" class="d-flex flex-column gap-2 w-25">
                <fieldset class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <small class="text-muted">We'll never share your e-mail with anyone else.</small>
                </fieldset>

                <fieldset class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                </fieldset>

                <fieldset class="form-group">
                    <label for="content">What would you like to ask us?</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </fieldset>

                <button type="submit" id="submit" class="btn btn-primary w-25">Submit</button>
            </form>
        </div>
    </body>
</html>