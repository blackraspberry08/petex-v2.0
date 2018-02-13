
<!--===========================
Pet Adoption
============================-->
<div class="content-wrapper">
    <div class="container-fluid">
        <?php include_once (APPPATH . "views/show_error/show_error.php"); ?>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>UserDashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>PetAdoption">Pet Adoption</a>
            </li>
            <li class="breadcrumb-item active">Online Adoption Application Form</li>
        </ol>
        <!-- Registered -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-file-text-o"></i> Online Adoption Application Form
            </div>
            <div class="card-body container-fluid">
                <div class="row">
                    <form method="POST" enctype="multipart/form-data" action ="petAdoptionOnlineForm_send/<?= $pet->pet_id ?>">
                        <div class="row">
                            <div class ="col-sm-3 center"><br><br>
                                <img src ="<?= base_url(); ?>images/logo/paws.png" class ="img-fluid">
                            </div>
                            <div class ="col-sm-6">
                                <center>
                                    <h6>The Philippine Animal Rehabilitation Center</h6>
                                    <h2 style = "font-weight: bold; font-family:Roboto;">ADOPTION APPLICATION</h2>
                                    <span style = "font-size: 11px;">PAWS Animal Rehabilitation Center (PARC), Aurora Boulevard,
                                        <br>Katipunan Valley, Loyola Heights, Quezon City</span>
                                </center>
                            </div>
                            <div class ="col-sm-3 center"><br><br>
                                <img src ="<?= base_url(); ?>images/logo/parc.png" class ="img-fluid">
                            </div>
                        </div>
                        <div class ="row container">
                            <div class = "col-sm-12">
                                <center>
                                    <p style = "font-weight: bold;">You will still need to have an interview with an adoption counsellor, prior to approval of your application.<br>
                                        Filling out this form will save time at the shelter, but not substitute for an in-person interview.<br><Br></p>
                                </center>
                            </div>
                            <div class="col-sm-8"></div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" name = "date" value="<?= date("F d, Y") ?>" readonly="">
                                <label>&emsp;&emsp;Date of Application</label>
                            </div>
                            <div class="form-group col-sm-5">
                                <input type="text"  class="form-control" name = "name" readonly="" value="<?= $userInfo->user_firstname ?> <?= $userInfo->user_lastname ?>" >
                                <label>&nbsp;Name</label>
                            </div>
                            <div class="form-group col-sm-3">
                                <input type="text" class="form-control" name = "userage" readonly="" value="<?= get_age($userInfo->user_bday); ?>" >
                                <label>&nbsp;Age</label>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" name = "email" readonly="" value="<?= $userInfo->user_email ?>" >
                                <label>&nbsp;Email</label>
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="text" class="form-control" name = "address" readonly="" value="<?= $userInfo->user_address ?>, <?= $userInfo->user_brgy ?>, <?= $userInfo->user_city ?>" >
                                <label>&nbsp;Address</label>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" name = "numhome" >
                                <label>&nbsp;Tel Nos. (Home)</label>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" name = "numwork" >
                                <label>&nbsp;Tel Nos. (Work)</label>
                            </div>
                            <div class="form-group col-sm-4 <?php if (!empty($form_error['nummobile'])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <input type="text" class="form-control <?php if (!empty($form_error['nummobile'])): ?>is-invalid<?php else: ?><?php endif; ?>" name = "nummobile" value = "<?= set_value("nummobile", $userInfo->user_contact_no); ?> "> 
                                <label>&nbsp;Mobile No.</label>
                                <div class="invalid-feedback"><?= $form_error['nummobile'] ?></div>
                            </div>
                        </div>
                        <style>
                            input[type="text"]:disabled{
                                color:black !important;
                            }
                        </style>
                        <div class = "row container">
                            <div class="col-sm-12">
                                <h4>Chosen Adoptee</h4>
                            </div>
                            <br>
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <img src = "<?= base_url() . $pet->pet_picture; ?>" class ="img-thumbnail center-cropped img-fluid mx-auto d-block">
                            </div>
                            <div class = "col-sm-12">
                                <div class = "row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" class="form-control" name = "adoptee_name" readonly="" value = "<?= $pet->pet_name ?>">
                                        <label>&nbsp;Pet Name</label>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="text" class="form-control" name = "adoptee_age" readonly="" value = "<?= get_age($pet->pet_bday); ?>">
                                        <label>&nbsp;Age</label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control" name = "adoptee_specie" readonly="" value = "<?= $pet->pet_specie == "Canine" ? "Dog" : "Cat"; ?>">
                                        <label>&nbsp;Specie</label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control" name = "adoptee_sex" readonly="" value = "<?= $pet->pet_sex == "male" ? "Male" : "Female"; ?>">
                                        <label>&nbsp;Sex</label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control" name = "adoptee_sterilized" readonly="" value = "<?= $pet->pet_neutered_spayed == 1 ? "Yes" : "No"; ?>">
                                        <label for = "adoptee_sterilized">&nbsp;<?= $pet->pet_sex == "Male" ? "Neutered?" : "Spayed?"; ?></label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control" name = "adoptee_admission" readonly="" value = "<?= $pet->pet_admission; ?>">
                                        <label for = "adoptee_admission">&nbsp;Admission</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class = "row container">
                            <div class="col-sm-12">
                                <h4>Personal Reference</h4>
                            </div>
                            <div class="form-group col-sm-5 <?php if (!empty($form_error['nameref'])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <input type="text"  name = "nameref" class="form-control <?php if (!empty($form_error['nameref'])): ?>is-invalid<?php else: ?><?php endif; ?>" value = "<?= set_value("nameref") ?>">
                                <label>&nbsp;
                                    Name</label>
                                <div class="invalid-feedback"><?= $form_error['nameref'] ?></div>
                            </div>
                            <div class = "form-group col-sm-3 <?php if (!empty($form_error["relref"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <input type = "text" class = "form-control <?php if (!empty($form_error["relref"])): ?>is-invalid<?php else: ?><?php endif; ?>" name = "relref" value = "<?= set_value("relref") ?>">
                                <label>&nbsp;
                                    Relationship</label>
                                <div class="invalid-feedback"><?= $form_error['relref'] ?></div>
                            </div>
                            <div class = "form-group col-sm-4 <?php if (!empty($form_error["numref"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <input type = "text" class = "form-control <?php if (!empty($form_error["nameref"])): ?>is-invalid<?php else: ?><?php endif; ?>" name = "numref" value = "<?= set_value("numref") ?>">
                                <label>&nbsp;
                                    Mobile No.</label>
                                <div class="invalid-feedback"><?= $form_error['numref'] ?></div>
                            </div>
                            <div class = "form-group col-sm-4 <?php if (!empty($form_error["prompt"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <input type = "text" class = "form-control <?php if (!empty($form_error["prompt"])): ?>is-invalid<?php else: ?><?php endif; ?>" name = "prompt" value = "<?= set_value("prompt") ?>">
                                <label>&nbsp;
                                    What prompted you to come to PARC?</label>
                                <div class="invalid-feedback"><?= $form_error['prompt'] ?></div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class = "col-sm-3">
                                <span>Are you interested in: </span>

                                <div class = "form-check">
                                    <label class = "form-check-label">
                                        <input name = "interested" type = "radio" id = "interested_cat" class = "form-check-label" value = "Cat" <?= $pet->pet_specie == "Feline" ? "checked = \"\"" : "disabled = \"\"" ?>/>
                                        Cat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="interested" type="radio" id="interested_dog" class = "with-gap" value ="Dog" <?= $pet->pet_specie == "Canine" ? "checked = \"\"" : "disabled = \"\"" ?>/>
                                        Dog
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span>Size: </span>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="size" type="radio" id="small" value ="S" class = "with-gap" <?= $pet->pet_size == "S" ? "checked = \"\"" : "disabled = \"\"" ?> />
                                        S
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="size" type="radio" id="medium" value ="M" class = "with-gap" <?= $pet->pet_size == "M" ? "checked = \"\"" : "disabled = \"\"" ?>  />
                                        M
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="size" type="radio" id="large" value ="L" class = "with-gap" <?= $pet->pet_size == "L" ? "checked = \"\"" : "disabled = \"\"" ?>  />
                                        L
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input name="size" type="radio" id="xlarge" value ="XL" class = "with-gap" <?= $pet->pet_size == "XL" ? "checked = \"\"" : "disabled = \"\"" ?>  />
                                        XL
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control" name = "breed" readonly="" value="<?= $pet->pet_breed ?>" >
                                <label>&nbsp;Breed/Mix</label>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="description" style = "padding-top:40px !important;">Name/description of animal(if animal is available at PARC)</label>
                                <textarea id="description" name="description" class="form-control" placeholder = " "><?= $pet->pet_description ?></textarea>
                            </div>
                        </div>
                        <div class ="row container">
                            <div class="col-sm-12">
                                <h4>Questionnaire</h4>
                            </div>
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num1"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <span>1.) Why did you decide to adopt an animal from PAWS?</span>
                                <textarea id="num1" name="num1" class="form-control <?php if (!empty($form_error["num1"])): ?>is-invalid<?php else: ?><?php endif; ?>"  placeholder = "<?= set_value("num1") ?>"></textarea>
                                <div class="invalid-feedback"><?= $form_error['num1'] ?></div>
                            </div>
                            <div class="col-sm-6">
                                <span>2.) Have you adopted from PAWS/PARC atleast once before?</span>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num2yes" name = "num2" value ="Yes" class = "with-gap num2" checked="" />
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num2no" name = "num2" value ="No"  class = "with-gap num2" checked="" />
                                        No
                                    </label>
                                </div>
                                <div id = "num2Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class="form-group col-sm-12">
                                        <input id = "num2When" type="text" class = "form_datetime form-control" name = "num2ifyes" >
                                        <label for = "num2When">When is the latest?</label>
                                    </div>

                                    <div class="form-check col-sm-12">
                                        <span>What animal?</span><br>
                                        <label class="form-check-label">
                                            <input type="radio" id="num2HiddenDog" value ="Dog" name = "num2ifYesSpecie" class = "with-gap rdbutton" checked=""/>
                                            Cat
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" id="num2HiddenCat" value ="Cat"  name = "num2ifYesSpecie" class = "with-gap rdbutton"/>
                                            Dog
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>3.) What type of building do you live in?</span><br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="radio" id="house" value ="House" name = "num3" class="with-gap num3" checked="" />
                                                House
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="townhouse" value ="Townhouse" name = "num3" class="with-gap num3"/>
                                                Townhouse
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="other" value = "Other" name = "num3" class="with-gap num3"/>
                                                Other
                                            </label>
                                        </div><br>
                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="radio" id="apartment" value ="Apartment" name = "num3" class="with-gap num3"/>
                                                Apartment
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="condo" value ="Condo" name = "num3" class="with-gap num3"/>
                                                Condo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id = "num3Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class="form-group col-sm-12">
                                            <input id = "num3Other" type="text" class="form-control" name = "num3Other" >
                                            <label for = "num3Other">&nbsp;Please Specify</label>
                                        </div>
                                        <div class = "col-sm-12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>4.) Do you Rent?</span>

                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <input type="radio" id="num4yes" value ="Yes" name = "num4" class = "with-gap num4"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num4no" value ="No" name = "num4" class = "with-gap num4" checked=""/>
                                        No
                                    </label>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div id="num4Hidden"  class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <span>Please attach a letter from your landlord granting you permission to keep pets.</span>
                                        <div class="custom-file-container" data-upload-id="num4file">
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" name = "num4file" id = "num21file_edit" class="custom-file-container__custom-file__custom-file-input" accept="application/*">
                                                <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                                <button class="custom-file-container__image-clear">x</button>
                                            </label>
                                            <small id="videoHelp" class="form-text text-muted">
                                                Max size is 5MB. Allowed types is .docx, .pdf
                                            </small>
                                            <div class="custom-file-container__image-preview" style= "height:0px !important;" id = "num4fileedit_preview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br><br>
                        <div class = "row container">
                            <div class = "col s6">
                                <span>5.) Who do you live with?</span>
                                <div class = "row">
                                    <div class="col-sm-4">
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="radio" id="parents" value ="Parents" name = "num5" class="with-gap num5" checked=""/>
                                                Parents
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="children" value ="Children" name = "num5" class="with-gap num5"/>
                                                Children
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="roomates" value ="Roomate(s)" name = "num5" class="with-gap num5"/>
                                                Roomate(s)
                                            </label>
                                        </div><br>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="radio" id="spouse" value ="Spouse" name = "num5" class="with-gap num5"/>
                                                Spouse
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="alone" value ="Alone" name = "num5" class="with-gap num5"/>
                                                Alone
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="num5other" value = "Other" name = "num5" class="with-gap num5"/>
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <label for = "yearslived">How long have you lived in this address?</label>
                                <div class="col-sm-12">
                                    <div class="form-group col-sm-6 <?php if (!empty($form_error["yearslived"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                        <input id = "yearslived" type="text" class= "form-control <?php if (!empty($form_error["yearslived"])): ?>is-invalid<?php else: ?><?php endif; ?>" name = "yearslived"  value = "<?= set_value("yearslived"); ?>"/>
                                        <div class="invalid-feedback"><?= $form_error['yearslived'] ?></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" id="exampleSelect1" name="period">
                                            <option>Days</option>
                                            <option>Weeks</option>
                                            <option>Months</option>
                                            <option>Years</option>
                                        </select>
                                    </div>
                                </div>
                                <div id = "num5Hidden" class = "animated fadeOutUp col-sm-s6" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num5Other" type="text" class="form-control" name = "num5Other" >
                                            <label for = "num5Other">&nbsp;Please Specify</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>6.) Are you planning to move in the next 6 months?</span>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num6yes" value ="Yes" name = "num6" class = "with-gap num6"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num6no" value ="No" name = "num6"  class = "with-gap num6" checked=""/>
                                        No
                                    </label>
                                </div>
                                <div id = "num6Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <textarea id="num6explain" name="num6explain" class="form-control"></textarea>
                                            <label for = "num6explain">Where?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>7.) For whom are you adopting animal?</span>
                                <div class = "row">
                                    <div class="col-sm-5">
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="radio" id="myself" value ="for myself" name = "num7" class = "with-gap num7" checked=""/>
                                                for myself
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="forchildren" value ="for my children" name = "num7" class = "with-gap num7"/>
                                                for my children
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="radio" id="gift" value ="as a gift" name = "num7" class = "with-gap num7"/>
                                                as a gift
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="num7others" value = "Other" name = "num7" class = "with-gap num7"/>
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id = "num7Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num7specify" class="form-control" type="text" name = "num7specify" >
                                            <label for = "num7specify">Please Specify</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>8.) Will the whole family share in the care in the care of animal?</span>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num8yes" value ="Yes" name = "num8" class = "with-gap num8" checked=""/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num8no" value ="No" name = "num8"  class = "with-gap num8"/>
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>9.) Is there anyone in your household who has objection(s) to the arrangement?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num9yes" value ="Yes" name = "num9" class = "with-gap num9"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num9no" value ="No" name = "num9" class = "with-gap num9" checked=""/>
                                        No
                                    </label>
                                </div>
                                <div id = "num9Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "col-sm-12 form-group">
                                            <textarea id="num9explain" name="num9explain" class="form-control"></textarea>
                                            <label for = "num9explain">Explain</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>10.) Are there any children that visit your home frequently?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num10yes" value ="Yes" name = "num10" class = "with-gap num10"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num10no" value ="No" name = "num10" class = "with-gap num10" checked=""/>
                                        No
                                    </label>
                                </div>
                                <div id = "num10Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num10age" type="text" class="form-control" name = "num10age" >
                                            <label for = "num10age">&nbsp;Age Range</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>11.) Are there any other regular visitors to your home, human or animal, with which your new companion must get along?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num11yes" value ="Yes" name = "num11" class = "with-gap num11"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num11no" value ="No" name = "num11" class = "with-gap num11" checked=""/>
                                        No
                                    </label>
                                </div>
                                <div id = "num11Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <textarea id="num11explain" name="num11explain" class="form-control"></textarea>
                                            <label for = "num11explain">Explain</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span>12.) Are any members of your household allergic to cats/dogs?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num12yes" value ="Yes" name = "num12" class = "with-gap num12"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num12no" value ="No"  name = "num12" class = "with-gap num12" checked=""/>
                                        No
                                    </label>
                                </div> 
                                <div id = "num12Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num12age" type="text" class="form-control" name = "num12age" >
                                            <label for = "num12age">Who?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num13"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <span>13.) What will happen to this animal if you have to move unexpectedly?</span>
                                <textarea id="num13" name="num13" class="form-control <?php if (!empty($form_error["num13"])): ?>is-invalid<?php else: ?><?php endif; ?>"></textarea>
                                <div class="invalid-feedback"><?= $form_error['num13'] ?></div>
                            </div>
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num14"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <span>14.) What kind of behavior(s) do you feel unable to accept?</span>
                                <textarea id="num14" name="num14" rows="3" class="form-control <?php if (!empty($form_error["num13"])): ?>is-invalid<?php else: ?><?php endif; ?>"></textarea>
                                <div class="invalid-feedback"><?= $form_error['num14'] ?></div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num15"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <span>15.) How many hours in an average workday will your companion animal spend without a human?</span>
                                <input type="text" class="form-control <?php if (!empty($form_error["num15"])): ?>is-invalid<?php else: ?><?php endif; ?>" value = "<?= set_value("num15"); ?>" name="num15">
                                <div class="invalid-feedback"><?= $form_error['num15'] ?></div>
                            </div>
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num16"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <span>16.) What will happen to your companion animal, when you go on a vacation or in case of emergency?</span>
                                <textarea id="num16" name="num16" class="form-control <?php if (!empty($form_error["num16"])): ?>is-invalid<?php else: ?><?php endif; ?>"></textarea>
                                <div class="invalid-feedback"><?= $form_error['num16'] ?></div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="form-group col-sm-6">
                                <span>17.) Do you have regular veterinarian?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num17yes" value ="Yes" name = "num17" class = "with-gap num17" />
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num17no" value ="No" name = "num17" checked=""  class = "with-gap num17"/>
                                        No
                                    </label>
                                </div> 
                                <div id = "num17Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num17name" type="text" class="form-control" name = "num17name" >
                                            <label for = "num17name">&nbsp;Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6 green-theme">
                                <span>18.) Do you have other companion animal(s) in the past?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num18yes" value ="Yes" name = "num18" class = "with-gap num18"/>
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num18no" value ="No" name = "num18" class = "with-gap num18" checked=""/>
                                        No
                                    </label>
                                </div> 
                                <div id = "num18Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "col s12 green-theme">
                                            <br><span>What animal?</span>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" value ="Dog" id="num18HiddenDog" name = "num18animal" class = "with-gap " checked=""/>
                                                    Dog
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" value ="Cat" id="num18HiddenCat" name = "num18animal" class = "with-gap "/>
                                                    Cat
                                                </label>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>19.) What part of your house do you want this animal to stay?</span><br> 
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="inside" value ="Inside only" name = "num19" class = "with-gap" checked=""/>
                                        Inside only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="insideoutside" value ="Inside/outside" name = "num19" class = "with-gap"/>
                                        Inside/outside
                                    </label>
                                </div> 
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="outside" value ="Outside only" name = "num19" class = "with-gap"/>
                                        Outside only
                                    </label>
                                </div> 
                            </div>
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num20"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>" >
                                <span>20.) Where will this animal be kept during the Day? Night?</span>
                                <textarea id="num20" name="num20" class="form-control <?php if (!empty($form_error["num20"])): ?>is-invalid<?php else: ?><?php endif; ?>"></textarea>
                                <div class="invalid-feedback"><?= $form_error['num20'] ?></div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>21.) Do you have a fenced yard?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num21yes" value ="Yes" name = "num21" class = "with-gap num21"/>
                                        Yes
                                    </label>
                                </div> 
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio"id="num21no" value ="No" name = "num21" class = "with-gap num21"checked=""/>
                                        No
                                    </label>
                                </div> 
                                <div id = "num21Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num21fence" type="text" class="form-control" name = "num21fence" >
                                            <label for = "num21fence">Fence height and type</label>
                                        </div>
                                    </div>
                                    <div class="custom-file-container" data-upload-id="num21file">
                                        <label class="custom-file-container__custom-file" >
                                            <input type="file" name = "num21file" id = "num21file_edit" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                                            <input type="hidden" name="MAX_FILE_SIZE" value = "10485760"/>
                                            <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            <button class="custom-file-container__image-clear">x</button>
                                        </label>
                                        <small id="videoHelp" class="form-text text-muted">
                                            Max size is 5MB. Allowed types is .jpg, .jpeg, .gif, .png
                                        </small>
                                        <div class="custom-file-container__image-preview" id = "num21fileedit_preview"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col s6 green-theme">
                                <span>22.) If adopting a dog, does fencing completely enclose the yard?</span><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num22yes" value ="Yes" name = "num22" class = "with-gap num22" checked=""/>
                                        Yes
                                    </label>
                                </div> 
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" id="num22no" value ="No" name = "num22" class = "with-gap num22"/>
                                        No
                                    </label>
                                </div> 
                                <div id = "num22Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class="form-group col-sm-12">
                                            <textarea id="num22how" name="num22how" class="form-control"></textarea>
                                            <label for = "num22how">&nbsp;How will you handle the dog's exercise and toilet duties?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="col-sm-6">
                                <span>23.) If adopting a cat, where will the litterbox be kept?</span>
                                <div class = "row">
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" value ="Inside house" id="insidehouse" name = "num23" class = "with-gap num23" checked=""/>
                                                Inside house
                                            </label>
                                        </div> 
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" value ="Garage" id="garage" name = "num23" class = "with-gap num23"/>
                                                Garage
                                            </label>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" value ="No need" id="noneed" name = "num23" class = "with-gap num23"/>
                                                No need
                                            </label>
                                        </div> 
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" id="other23" value = "Other" name = "num23" class = "with-gap num23"/>
                                                Other Location
                                            </label>
                                        </div> 
                                    </div>
                                </div>
                                <div id = "num23Hidden" class = "animated fadeOutUp" style = "visibility: hidden;">
                                    <div class = "row">
                                        <div class = "form-group col-sm-12">
                                            <input id = "num23specify" type="text" class="form-control" name = "num23specify" >
                                            <label for = "num23specify">Please Specify</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 <?php if (!empty($form_error["num24"])): ?>has-danger<?php else: ?>has-success<?php endif; ?>">
                                <span>24.) As a matter of policy, PARC will neuter all animals prior to releasing
                                    for adoption. What is your opinion about spaying and neutering (kapon) of companion animals?</span>
                                <textarea id="num24" name="num24" class="form-control <?php if (!empty($form_error["num24"])): ?>is-invalid<?php else: ?><?php endif; ?>"></textarea>
                                <div class="invalid-feedback"><?= $form_error['num24'] ?></div>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class="form-group col-sm-12">
                                <span>25.) Do you have questions and comments? (Optional)</span>
                                <textarea id="num25" name="num25" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class = "row container">
                            <div class = "col-sm-2"></div>
                            <div class = "col-sm-8">
                                <p><center><strong>I certify that the above information are true and understand that false information may result in the automative nullification of my proposed adoption. PARC reserves the right to refuse and adoption.</strong></center></p>
                                <center>
                                    <br>
                                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                                </center>
                            </div>
                            <div class = "col-sm-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
    </div>
</div>
</div>

<script>
    $(".num2").click(function () {
        var isChecked = $("#num2yes").prop("checked");
        if (isChecked) {
            $("#num2Hidden").addClass("fadeInDown");
            $("#num2Hidden").css("visibility", "visible");
            $("#num2Hidden").removeClass("fadeOutUp");
        } else {
            $("#num2Hidden").addClass("fadeOutUp");
            $("#num2Hidden").css("visibility", "hidden");
            $("#num2Hidden").removeClass("fadeInDown");
        }
    });
    $(".num3").click(function () {
        var isChecked = $("#other").prop("checked");
        if (isChecked) {
            $("#num3Hidden").addClass("fadeInDown");
            $("#num3Hidden").css("visibility", "visible");
            $("#num3Hidden").removeClass("fadeOutUp");
        } else {
            $("#num3Hidden").addClass("fadeOutUp");
            $("#num3Hidden").css("visibility", "hidden");
            $("#num3Hidden").removeClass("fadeInDown");
        }
    });
    $(".num4").click(function () {
        var isChecked = $("#num4yes").prop("checked");
        if (isChecked) {
            $("#num4Hidden").addClass("fadeInDown");
            $("#num4Hidden").css("visibility", "visible");
            $("#num4Hidden").removeClass("fadeOutUp");
        } else {
            $("#num4Hidden").addClass("fadeOutUp");
            $("#num4Hidden").css("visibility", "hidden");
            $("#num4Hidden").removeClass("fadeInDown");
        }
    });
    $(".num5").click(function () {
        var isChecked = $("#num5other").prop("checked");
        if (isChecked) {
            $("#num5Hidden").addClass("fadeInDown");
            $("#num5Hidden").css("visibility", "visible");
            $("#num5Hidden").removeClass("fadeOutUp");
        } else {
            $("#num5Hidden").addClass("fadeOutUp");
            $("#num5Hidden").css("visibility", "hidden");
            $("#num5Hidden").removeClass("fadeInDown");
        }
    });
    $(".num6").click(function () {
        var isChecked = $("#num6yes").prop("checked");
        if (isChecked) {
            $("#num6Hidden").addClass("fadeInDown");
            $("#num6Hidden").css("visibility", "visible");
            $("#num6Hidden").removeClass("fadeOutUp");
        } else {
            $("#num6Hidden").addClass("fadeOutUp");
            $("#num6Hidden").css("visibility", "hidden");
            $("#num6Hidden").removeClass("fadeInDown");
        }
    });
    $(".num7").click(function () {
        var isChecked = $("#num7others").prop("checked");
        if (isChecked) {
            $("#num7Hidden").addClass("fadeInDown");
            $("#num7Hidden").css("visibility", "visible");
            $("#num7Hidden").removeClass("fadeOutUp");
        } else {
            $("#num7Hidden").addClass("fadeOutUp");
            $("#num7Hidden").css("visibility", "hidden");
            $("#num7Hidden").removeClass("fadeInDown");
        }
    });
    $(".num9").click(function () {
        var isChecked = $("#num9yes").prop("checked");
        if (isChecked) {
            $("#num9Hidden").addClass("fadeInDown");
            $("#num9Hidden").css("visibility", "visible");
            $("#num9Hidden").removeClass("fadeOutUp");
        } else {
            $("#num9Hidden").addClass("fadeOutUp");
            $("#num9Hidden").css("visibility", "hidden");
            $("#num9Hiddens").removeClass("fadeInDown");
        }
    });
    $(".num10").click(function () {
        var isChecked = $("#num10yes").prop("checked");
        if (isChecked) {
            $("#num10Hidden").addClass("fadeInDown");
            $("#num10Hidden").css("visibility", "visible");
            $("#num10Hidden").removeClass("fadeOutUp");
        } else {
            $("#num10Hidden").addClass("fadeOutUp");
            $("#num10Hidden").css("visibility", "hidden");
            $("#num10Hidden").removeClass("fadeInDown");
        }
    });
    $(".num11").click(function () {
        var isChecked = $("#num11yes").prop("checked");
        if (isChecked) {
            $("#num11Hidden").addClass("fadeInDown");
            $("#num11Hidden").css("visibility", "visible");
            $("#num11Hidden").removeClass("fadeOutUp");
        } else {
            $("#num11Hidden").addClass("fadeOutUp");
            $("#num11Hidden").css("visibility", "hidden");
            $("#num11Hidden").removeClass("fadeInDown");
        }
    });
    $(".num12").click(function () {
        var isChecked = $("#num12yes").prop("checked");
        if (isChecked) {
            $("#num12Hidden").addClass("fadeInDown");
            $("#num12Hidden").css("visibility", "visible");
            $("#num12Hidden").removeClass("fadeOutUp");
        } else {
            $("#num12Hidden").addClass("fadeOutUp");
            $("#num12Hidden").css("visibility", "hidden");
            $("#num12Hidden").removeClass("fadeInDown");
        }
    });
    $(".num17").click(function () {
        var isChecked = $("#num17yes").prop("checked");
        if (isChecked) {
            $("#num17Hidden").addClass("fadeInDown");
            $("#num17Hidden").css("visibility", "visible");
            $("#num17Hidden").removeClass("fadeOutUp");
        } else {
            $("#num17Hidden").addClass("fadeOutUp");
            $("#num17Hidden").css("visibility", "hidden");
            $("#num17Hidden").removeClass("fadeInDown");
        }
    });
    $(".num18").click(function () {
        var isChecked = $("#num18yes").prop("checked");
        if (isChecked) {
            $("#num18Hidden").addClass("fadeInDown");
            $("#num18Hidden").css("visibility", "visible");
            $("#num18Hidden").removeClass("fadeOutUp");
        } else {
            $("#num18Hidden").addClass("fadeOutUp");
            $("#num18Hidden").css("visibility", "hidden");
            $("#num18Hidden").removeClass("fadeInDown");
        }
    });
    $(".num21").click(function () {
        var isChecked = $("#num21yes").prop("checked");
        if (isChecked) {
            $("#num21Hidden").addClass("fadeInDown");
            $("#num21Hidden").css("visibility", "visible");
            $("#num21Hidden").removeClass("fadeOutUp");
        } else {
            $("#num21Hidden").addClass("fadeOutUp");
            $("#num21Hidden").css("visibility", "hidden");
            $("#num21Hidden").removeClass("fadeInDown");
        }
    });
    $(".num22").click(function () {
        var isChecked = $("#num22no").prop("checked");
        if (isChecked) {
            $("#num22Hidden").addClass("fadeInDown");
            $("#num22Hidden").css("visibility", "visible");
            $("#num22Hidden").removeClass("fadeOutUp");
        } else {
            $("#num22Hidden").addClass("fadeOutUp");
            $("#num22Hidden").css("visibility", "hidden");
            $("#num22Hidden").removeClass("fadeInDown");
        }
    });
    $(".num23").click(function () {
        var isChecked = $("#other23").prop("checked");
        if (isChecked) {
            $("#num23Hidden").addClass("fadeInDown");
            $("#num23Hidden").css("visibility", "visible");
            $("#num23Hidden").removeClass("fadeOutUp");
        } else {
            $("#num23Hidden").addClass("fadeOutUp");
            $("#num23Hidden").css("visibility", "hidden");
            $("#num23Hidden").removeClass("fadeInDown");
        }
    });

</script>

<!-- Bootstrap File Upload with preview -->
<script src = "<?= base_url() ?>assets/bootstrap-fileupload/js/file-upload-with-preview.js"></script>
<script>
    var upload = new FileUploadWithPreview('num21file')
    var upload = new FileUploadWithPreview('num4file')
</script>