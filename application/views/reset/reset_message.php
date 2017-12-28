<html>
    <head>
    </head>
    <style>
    </style>
    <body style="background-color:lightgray;">
        <div id="container" >
            <center>
                <h1 style="font-size:80px; color:green;">PetEx</h1>
                <hr>
                <h2>Hello <?= $name ?>,</h2>
                <div id="body" >
                    <p>We have received a request to reset your password for your PetEx Account. If you made this request, click the button below.</p>
                    <a href = "<?= base_url() ?>reset/enterNewPass/<?= $user ?>" class="waves-effect waves-light btn button green">Click to Verify</a>
                    <br>
                </div>
            </center>
        </div>
    </body>
</html>