<!DOCTYPE html>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <!-- PICTURE LINKS
            Codebusters logo 	- https://image.ibb.co/icbWHc/logo_cropped.png
            PetEx "P" 		- https://image.ibb.co/gopkcc/PetEx.png
            PetEx Word		- https://image.ibb.co/fte1Hc/Pet_Ex_word.png
            Background Image	- https://image.ibb.co/ecWgHc/big_bg.jpg
        -->
        <style>
            body{
                background:#eee;
                background:url('https://image.ibb.co/ecWgHc/big_bg.jpg');
                background-size:cover;
            }
        </style>
        <div class = "container">
            <div class = "row">
                <div class = "col-md-2"></div>
                <div class = "col-md-8">

                    <div class = "card border-0 mt-3">
                        <div class="card-header text-white" style = "background:#ededed;">
                            <div class = "text-center"><img src="https://image.ibb.co/fte1Hc/Pet_Ex_word.png" alt="Card image cap" height = "50"></div>
                        </div>
                        <div class="card-body text-center">
                            <div class = "mx-auto my-2 text-center mb-3">
                                <h1 class = "display-4">Hello, <strong><?= $name ?></strong></h1>
                                <span class = "lead">Thank you for registering to PetEx</span>
                            </div>
                            <img class = "img-fluid" src = "https://cdn.pixabay.com/photo/2016/07/21/14/18/dog-1532627__340.png" width = "200"/>
                            <div class = "lead text-center mx-5 mt-3 mb-3" style = "font-size:15px;">
                                You've received this message because you forgot your password in PetEx. Enter your new password by clicking the link below.
                            </div><br>
                            <a href = "<?= base_url() ?>reset/enter_newPass_exec/<?= $name ?>" class="btn btn-outline-success">Enter New Password</a>
                        </div>
                    </div>
                </div>
                <div class = "col-md-2"></div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
