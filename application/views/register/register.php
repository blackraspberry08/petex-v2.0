
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6" style="margin-top:50px; margin-bottom: 50px;">
            <form method="POST" action="<?= $this->config->base_url() ?>register/register_exec">
                <div class="card wow fadeInRight">
                    <div class="card-header">
                        <br>
                        <h4> <i class="fa fa-user-plus fa-lg"></i> Register</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="text" name="username" placeholder="Username" autofocus>
                                <br>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="password" name="password" placeholder="Password">
                            </div>
                            <div class="col">
                                <input class="form-control" type="password" name="conpassword" placeholder="Confirm Password">
                                <br>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                                <br>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="text" name="phone" placeholder="Mobile Phone">
                                <br>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="text" name="lname" placeholder="Lastname">
                                <br>
                            </div>
                            <div class="col">
                                <input class="form-control" type="text" name="fname" placeholder="Firstname">
                            </div>
                        </div>
                        <div class="form-row"> 
                            <div class="col">
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                                <label class="form-check-label">
                                    Male
                                </label>
                                <br>
                            </div>
                            <div class="col">
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gender" value="Female" >
                                <label class="form-check-label">
                                    Female
                                </label>
                                <br>
                            </div>
                            <div class="col">
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="bday" class="form_datetime form-control" placeholder="Birthday">
                            </div>
                        </div>

                    </div> 

                    <div class="card-footer ">
                        <button class="btn btn-success pull-right">
                            <i class="fa fa-send fa-lg"></i> Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-3">
        </div>
    </div>
</div>