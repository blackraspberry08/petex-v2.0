<html>
    <head>
        <title>Account Verification</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        
    </head>
    <style>
    </style>
    <body style="background-color:lightgray;">
        <div id="container" >
            <center>
                <h1 style="font-size:80px; color:green;">PetEx</h1>
                <hr>
                <h2>Hello <?= $name ?>,</h2>
                <h3>Thank you for registering to PetEx</h3>
                <div id="body" >
                    <p>You've received this message because your email address <br>has been registered with PetEx. Verify your account<br>
                        and confirm your email by clicking the link below.</p>
                    <a href = "<?= base_url() ?>register/verifyCode/<?= $code ?>" class="btn btn-primary">Click to Verify</a>
                    <br>
                </div>
            </center>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.bundle.min.js" integrity="sha384-VspmFJ2uqRrKr3en+IG0cIq1Cl/v/PHneDw6SQZYgrcr8ZZmZoQ3zhuGfMnSR/F2" crossorigin="anonymous"></script>
    </body>
</html>