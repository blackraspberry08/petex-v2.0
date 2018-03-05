
<!--==========================
  Hero Section
============================-->

<section id="hero">

    <div class="hero-container ">
        <div class="row container-fluid align-items-center mt-5">
            <div class="col-lg-7 col-md-12 py-5 wow fadeInLeft">
                <h1>Welcome to PetEx</h1>
                <h2><strong>Pet Express</strong>, an Adoption System<br> for <strong>PAWS</strong></h2>
            </div>

            <div class="col-lg-5 col-md-12 py-5">
                <div class="card wow fadeInRight ">
                    <?php if ($this->session->has_userdata("userid") && $this->session->has_userdata("isloggedin")): ?>
                        <div class="card-header">
                            You are currently logged in as
                        </div>    
                        <div class="card-body text-center">
                            <?php
                            $current_user = $this->session->userdata("current_user");
                            if ($this->session->userdata("user_access") == "user"):
                                ?>
                                <img src = "<?= base_url() . $current_user->user_picture ?>" class="img-fluid img-thumbnail rounded mb-3" width = 75/><br>
                                <strong><?= $current_user->user_firstname . " " . $current_user->user_lastname ?></strong><br>
                                <span>Pet Adopter</span>
                            <?php elseif ($this->session->userdata("user_access") == "subadmin" || $this->session->userdata("user_access") == "admin"): ?>
                                <img src = "<?= base_url() . $current_user->admin_picture ?>" class="img-fluid img-thumbnail rounded mb-3" width = 75/><br>
                                <strong><?= $current_user->admin_firstname . " " . $current_user->admin_lastname ?></strong><br>
                                <span><?= $current_user->admin_access == "Subadmin" ? "PAWS Officer" : "Administrator"; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <?php if ($this->session->userdata("user_access") == "user"): ?>
                                <a class="btn btn-primary" href="<?= base_url() . "UserDashboard" ?>"><i class="fa fa-sign-in fa-lg"></i> Proceed to account</a>
                            <?php elseif ($this->session->userdata("user_access") == "subadmin"): ?>
                                <a class="btn btn-primary" href="<?= base_url() . "SubadminDashboard" ?>"><i class="fa fa-sign-in fa-lg"></i> Proceed to account</a>
                            <?php elseif ($this->session->userdata("user_access") == "admin"): ?>
                                <a class="btn btn-primary" href="<?= base_url() . "AdminDashboard" ?>"><i class="fa fa-sign-in fa-lg"></i> Proceed to account</a>  
                            <?php endif; ?>
                            <?php if ($this->session->userdata("user_access") == "Admin"): ?>
                                <a class="btn btn-secondary" href="<?= base_url() . "AdminLogout" ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                            <?php else: ?>
                                <a class="btn btn-secondary " href="<?= base_url() . "UserLogout" ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="card-header">
                            <img src="<?= $this->config->base_url() ?>images/logo/icon.png" style="height:50px;" alt="" />
                            <br><br>
                            <h4> <i class="fa fa-sign-in fa-lg"></i> Sign in to PetEx</h4>
                        </div>
                        <form method="POST" action="<?= $this->config->base_url() ?>login/login_exec">
                            <div class="card-body">
                                <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" type="text" name="username" placeholder="Username" autofocus>
                                        <br>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" type="password" name="password" placeholder="Password">
                                        <br>
                                    </div>
                                </div>
                                <p>New to PetEx? <a href="<?= $this->config->base_url() ?>register">Create an Account</a></p>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-primary" href="<?= $this->config->base_url() ?>reset">
                                    <i class="fa fa-refresh fa-lg"></i> Reset Password</a>
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <a href="#about" class="btn-get-started wow fadeInUp mt-5">Get Started</a>
    </div>
</section><!-- #hero -->

<main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
        <div class="container">
            <div class="row about-container">

                <div class="col-lg-6 content order-lg-1 order-2">
                    <h2 class="title">Few Words About Us</h2>
                    <p>
                        PetEx, short for Pet Express, is a pet adoption system where animals that are ready for adoption are being promoted online. The project will help animal shelters to effectively promote their animal that are ready for adoption and is intended to speed up the pet adoption processes. The project is a web based application and will display the animals that are ready for adoption in their animal shelter online. The project is also available on mobile application where a user, who recently adopted a pet from PAWS, can send notifications among different app user when their pet is missing so other users will be aware of the missing pet.
                    </p>

                </div>

                <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div>
            </div>

        </div>
    </section><!-- #about -->

    <!--==========================
      Facts Section
    ============================-->
    <section id="facts">
        <div class="container wow fadeIn">
            <div class="section-header">
                <h3 class="section-title">Facts</h3>
                <p class="section-description">These are the gathered FACTS in the system.</p>
            </div>
            <div class="row counters">
                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= $allAdopters ?></span>
                    <p>Customers</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= $allPets ?></span>
                    <p>Pets</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= $allDiscovered ?></span>
                    <p>Discovered Animal/s</p>
                </div>
                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up"><?= $allTransactions ?></span>
                    <p>Transactions</p>
                </div>

            </div>

        </div>
    </section><!-- #facts -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
        <div class="container wow fadeIn">
            <div class="section-header">
                <h3 class="section-title">Services</h3>
                <p class="section-description">This is our offered Services.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="box">
                        <div class="icon"><a href="#services"><i class="fa fa-paw"></i></a></div>
                        <h4 class="title">Pet Adoption</h4>
                        <p class="description">Pet Adopter's  can now adopt pets online using PetEx.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="box">
                        <div class="icon"><a href="#services"><i class="fa fa-line-chart"></i></a></div>
                        <h4 class="title">My Progress</h4>
                        <p class="description">He/she can track and monitor is own progress before, during and after adoption.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="box">
                        <div class="icon"><a href="#services"><i class="fa fa-cog"></i></a></div>
                        <h4 class="title">Manage your Pet</h4>
                        <p class="description">The Pet Adopter can manage his/her own pet infomation using PetEx's web and mobile application.</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- #services -->

    <!--==========================
    Call To Action Section
    ============================-->
    <section id="call-to-action">
        <div class="container wow fadeIn">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center wow fadeInLeft ">
                    <h3 class="cta-title">PetEx Pet Manager</h3>
                    <p class="cta-text"> Using our mobile application, you can access PetEx any hour any day. It will be easy for you to see your ow pet, change its information, find your lost pet and contact the finder of your pet.</p>
                </div>
                <div class="col-lg-6 wow fadeInRight my-5">
                    <center>
                        <img src="<?= $this->config->base_url() ?>images/logo/mobilePrev2.png" class= "img-fluid" alt="" />
                    </center>
                </div>
            </div>

        </div>
    </section><!-- #call-to-action -->

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="adoptables">
        <div class="container wow fadeInUp">
            <div class="section-header">
                <h3 class="section-title">Adoptables</h3>
                <p class="section-description">These are the current adoptables in PAWS.</p>
            </div>
            <div class="card">

                <h3 class="card-header">Newly Registered Pet</h3>
                <?php if (empty($pets)): ?>
                    <div class = "col-lg-12">
                        <center>
                            <h4>No animals yet</h4>
                            <i class = "fa fa-exclamation-circle fa-5x" style = "color:#bbb;"></i>
                        </center>
                    </div>
                <?php else: ?>
                    <div class="card-body container-fluid">
                        <div class="row">
                            <?php $counter = 0; ?>
                            <?php foreach ($pets as $pet): ?>
                                <?php if ($pet->pet_status == 'Adoptable' && $pet->pet_access == 1): ?>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <a href = "<?= $this->config->base_url() . $pet->pet_picture ?>" data-toggle="lightbox" data-gallery="hidden-images" data-footer ="<b><?= $pet->pet_name ?></b>">
                                                <img class="card-img-top" style="height:150px;" src = "<?= $this->config->base_url() . $pet->pet_picture ?>" alt="picture">
                                            </a>
                                            <div class="card-body">
                                                <h4 class="card-title"><?= $pet->pet_name ?></h4>
                                                <i class="fa fa-calendar"></i> <?= date('M. j, Y', $pet->pet_bday) ?><br>
                                                <?php if ($pet->pet_sex == "Male" || $pet->pet_sex == "male"): ?>
                                                    <i class="fa fa-mars" style="color:blue"></i> <?= $pet->pet_sex ?><br>
                                                <?php else: ?>
                                                    <i class="fa fa-venus" style="color:red"></i> <?= $pet->pet_sex ?><br>
                                                <?php endif; ?>
                                                <i class="fa fa-paw"></i> <?= $pet->pet_breed ?><br>
                                                <i class="fa fa-check-square" style="color:green"></i> <?= $pet->pet_status ?>
                                            </div>

                                            <div class="card-footer text-center">
                                                <div class = "btn-group" role="group" aria-label="Button Group">
                                                    <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>detail"  data-placement="bottom" title="View Full Details"><i class = "fa fa-eye fa-2x"></i></a>
                                                    <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>video" data-placement="bottom" title="Play Video"><i class = "fa fa-video-camera fa-2x"></i></a>
                                                    <a href = "#" class = "btn btn-outline-secondary btn-sm" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>adopters" data-placement="bottom" title="Interested Adopters"><i class = "fa fa-users fa-2x"></i></a>
                                                    <a href = "#" class = "btn btn-outline-secondary btn-md" data-toggle="modal" data-target=".<?= $pet->pet_id; ?>adopt" data-placement="bottom" title="Adopt a Pet"><i class = "fa fa-star fa-2x"></i></a>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Detail -->
                                        <div class="modal fade <?= $pet->pet_id; ?>detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class = "fa fa-info"></i> Pet Info</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class ="col-md-5">
                                                                <img src = "<?= $this->config->base_url() . $pet->pet_picture ?>" class = "img-fluid" style = "border-radius:50px;  margin-top:20px;"/>
                                                            </div>
                                                            <div class ="col-md-7">
                                                                <table class = "table table-responsive table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>Name: </th>
                                                                            <td><?= $pet->pet_name; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Status: </th>
                                                                            <td><?= $pet->pet_status; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Size: </th>
                                                                            <td><?= $pet->pet_size; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Birthday: </th>
                                                                            <td><?= date("F d, Y", $pet->pet_bday); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Age:</th>
                                                                            <td><?= get_age($pet->pet_bday); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Specie: </th>
                                                                            <td><?= $pet->pet_specie; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Sex: </th>
                                                                            <td><?= $pet->pet_sex; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Breed: </th>
                                                                            <td><?= $pet->pet_breed; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Sterilized: </th>
                                                                            <td><?= $pet->pet_neutered_spayed == 1 ? "Yes" : "No"; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Admission: </th>
                                                                            <td><?= $pet->pet_admission; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Description: </th>
                                                                            <td><?= $pet->pet_description; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Findings: </th>
                                                                            <td><?= $pet->pet_history; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Video -->
                                        <div class="modal fade <?= $pet->pet_id; ?>video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class = "fa fa-video-camera"></i> Pet Video</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row container">
                                                            <?php if ($adopted->pet_video == NULL): ?>
                                                                <h2>This pet has no Video</h2>
                                                            <?php else: ?>
                                                                <div class="embed-responsive embed-responsive-16by9">
                                                                    <iframe class="embed-responsive-item" src="..."></iframe>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Interested Adopters -->
                                        <div class="modal fade <?= $pet->pet_id; ?>adopters" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class = "fa fa-users"></i> Interested Adopters</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row container">
                                                            <?php if (!$adopters): ?>
                                                                <h2><i class="fa fa-warning"></i> This pet has no Adopters</h2>
                                                            <?php else: ?>
                                                                <?php foreach ($adopters as $adopter): ?>
                                                                    <?php if ($adopter->pet_id == $pet->pet_id && $adopter->transaction_isFinished == 0): ?>
                                                                        <br>
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-6 pull-left">
                                                                                <h6><strong>Name: </strong><?= $adopter->user_firstname ?></h6>
                                                                            </div>
                                                                            <div class="col-md-6 pull-right">
                                                                                <h6><strong>Pet Name: </strong><?= $adopter->pet_name ?></h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="progress" style="width:100%; ">
                                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $adopter->transaction_progress ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $adopter->transaction_progress . '%' ?>;"><?= $adopter->transaction_progress ?></div>
                                                                            </div>
                                                                        </div>
                                                                    <?php elseif ($adopter->pet_id != $pet->pet_id): ?>
                                                                        <h2><i class="fa fa-warning"></i> This pet has no Adopter/s</h2>
                                                                        <?php break; ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Adopt -->
                                        <div class="modal fade <?= $pet->pet_id; ?>adopt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><i class = "fa fa-star"></i> Adopt a Pet</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row container">
                                                            <p><strong>There are two options for you to decide, its either download the form or fill up the form and send to our email online.</strong></p>
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-3"> 
                                                                <a href="<?= base_url() ?>download/adoption_application_form.pdf" onclick="window.open('<?= base_url() ?>PetAdoption/download_exec/<?= $pet->pet_id ?>');
                                                                                    return true;" class = 'btn btn-outline-primary' download> Download <i class = "fa fa-download"></i></a >
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="<?= base_url() ?>PetAdoption/petAdoptionOnlineForm_exec/<?= $pet->pet_id ?>" class="btn btn-outline-primary">Fill up the Form Online</a>
                                                            </div>
                                                            <div class="col-md-3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if ($counter == 3): {
                                        break;
                                    }
                                    ?>
                                <?php endif; ?>
                                <?php $counter++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url() ?>PetAdoption" class="pull-right">See more</a>
                    </div>
                <?php endif; ?>
            </div><br>

        </div>
    </section><!-- #portfolio -->

    <!--==========================
      Team Section
    ============================-->
    <section id="team">
        <div class="container wow fadeInUp">
            <div class="section-header">
                <h3 class="section-title">Developers</h3>
                <p class="section-description">This is the team who developed and documented the system.</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <div class="pic img-fluid"><img src="<?= base_url() ?>images/team/jcMatFinal.png" alt=""></div>
                        <h4>Juan Carlo Valencia</h4>
                        <span>Project Manager</span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <div class="pic img-fluid"><img src="<?= base_url() ?>images/team/markusMatFinal.png" alt=""></div>
                        <h4>Angelo Markus Zaguirre</h4>
                        <span>Webmaster</span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <div class="pic img-fluid"><img src="<?= base_url() ?>images/team/allenMatFinal.png" alt=""></div>
                        <h4>Allen Torres</h4>
                        <span>Quality Assurance</span>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <div class="pic img-fluid"><img src="<?= base_url() ?>images/team/joshMatFinal.png" alt=""></div>
                        <h4>Joshua Vitug</h4>
                        <span>Writer And Editor</span>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- #team -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
        <div class="container wow fadeInUp">
            <div class="section-header">
                <h3 class="section-title">Contact</h3>
                <p class="section-description">Send some feedbacks or concerns about the system.</p>
            </div>
        </div>

        <div id="google-map" data-latitude="14.6326954" data-longitude="121.0770871"></div>

        <div class="container wow fadeInUp">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-4">

                    <div class="info">
                        <div>
                            <i class="fa fa-map-marker"></i>
                            <p>Aurora Blvd, Quezon City,<br>1800 Metro Manila</p>
                        </div>

                        <div>
                            <i class="fa fa-envelope"></i>
                            <p>philpaws@paws.org.ph /<br>codebusters.solutions@gmail.com</p>
                        </div>

                        <div>
                            <i class="fa fa-phone"></i>
                            <p>475-1688</p>
                        </div>
                    </div>
                    <!--
                                        <div class="social-links">
                                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                        </div>-->

                </div>

                <div class="col-lg-5 col-md-8">
                    <div class="form">
                        <div id="sendmessage">Your message has been sent. Thank you!</div>
                        <div id="errormessage"></div>
                        <form action="<?= base_url() ?>main/contact" method="post" role="form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control <?= !empty(form_error("name")) ? "is-invalid" : ""; ?>" id="name" placeholder="Your Name" value = "<?= set_value("name") ?>"/>
                                <div class="invalid-feedback"><?= form_error('name') ?></div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control <?= !empty(form_error("email")) ? "is-invalid" : ""; ?>" name="email" id="email" placeholder="Your Email" value = "<?= set_value("email") ?>"/>
                                <div class="invalid-feedback"><?= form_error('email') ?></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= !empty(form_error("subject")) ? "is-invalid" : ""; ?>" name="subject" id="subject" placeholder="Subject" value = "<?= set_value("subject") ?>" />
                                <div class="invalid-feedback"><?= form_error('subject') ?></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control <?= !empty(form_error("message")) ? "is-invalid" : ""; ?>" name="message" rows="5" placeholder="Message" value = "<?= set_value("message") ?>"></textarea>
                                <div class="invalid-feedback"><?= form_error('message') ?></div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- #contact -->

</main>
