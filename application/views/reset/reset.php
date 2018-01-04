
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6" style="margin-top:100px;">
            <form method="POST" action="<?= $this->config->base_url() ?>reset/resetPass_exec">
                <div class="card wow fadeInRight">
                    <div class="card-header">
                        <br>
                        <h4> <i class="fa fa-refresh fa-lg"></i> Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <p>Enter your email address and username and we will send you instructions on how to reset your password.</p>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="text" name="username" placeholder="Username" autofocus> 
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                                <br>
                            </div>
                        </div> 
                    </div> 
                    <div class="card-footer ">
                        <button class="btn btn-success pull-right">
                            <i class="fa fa-send fa-lg"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-3">
        </div>
    </div>
</div>