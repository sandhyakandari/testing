<!-- Login/Registration popup -->
    <div id="donate-popup" class="donate-popup">
        <div class="close-donate"><span class="fa fa-close"></span></div>
        <div class="popup-inner">
            <div class="container">
                <div id="login-form" class="donate-form-area reg-display">
                    <h2>Login</h2>
                    <h4>How would you like to login:</h4>
                    <form id="loginForm" action="{{ route('login')}}" class="donate-form default-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <ul class="chicklet-list clearfix" id="loginTab" role="tablist">
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="academy-tab" data-bs-toggle="tab" href="#academy" role="tab" aria-controls="academy" aria-selected="true">Academy</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="player-tab" data-bs-toggle="tab" href="#player" role="tab" aria-controls="player" aria-selected="false">Player</a>
                            </li> --}}
                            <li>
                                <input type="radio" id="donate-amount-1" name="user-type" value="Acadmey"/>
                                <label for="donate-amount-1" data-amount="Acadmey" >Academy</label>
                            </li>
                            <li>
                                <input type="radio" id="donate-amount-2" name="user-type" value="Player" checked="checked" />
                                <label for="donate-amount-2" data-amount="Player">Player</label>
                            </li>
                        </ul>

                        <h3>Login Information :</h3>
                        <div class="form-bg">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Email*</p>
                                        <input type="email" name="email" placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Password*</p>
                                        <input type="password" name="password" placeholder="Your Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="center"><button class="theme-btn mt-3 w-25" type="submit">Login</button></div>          
                    </form>
                    <div class="mt-3">
                        <h6>New registration? <a href="#register-form" class="reg-btn" data-target="register-form"><strong>Click here</strong> </a> to get register yourself!</h6>
                        {{-- <button class="theme-btn mt-3 w-25">Register</button>  --}}
                    </div>
                </div>
                <div id="register-form" class="donate-form-area reg-display">
                    <h2>Registration</h2>
                    <h4>How would you like to register:</h4>
                    <form id="registrationForm" action="{{ route('register')}}" class="donate-form default-form" method="post" enctype="multipart/form-data">
                        @csrf
                        <ul class="chicklet-list clearfix" id="registrationTab" role="tablist">
                            <li>
                                <input type="radio" id="donate-amount1" name="user-type" value="Academy"/>
                                <label for="donate-amount1" data-amount="Acadmey" >Academy</label>
                            </li>
                            <li>
                                <input type="radio" id="donate-amount2" name="user-type" value="Player" checked="checked" />
                                <label for="donate-amount2" data-amount="Player">Player</label>
                            </li>
                        </ul>

                        <h3>Registration Details :</h3>
                        {{-- <div class="form-bg">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Name*</p>
                                        <input type="text" id="name" name="name" placeholder="Your Name">
                                        <p id="nameError" class="error nameError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Email*</p>
                                        <input type="text" id="email" name="email" placeholder="Your Email">
                                        <p id="emailError" class="error emailError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Phone*</p>
                                        <input type="text" maxlength="10" id="phone" name="phone" placeholder="Your Phone Number">
                                        <p id="phoneError" class="error phoneError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Password*</p>
                                        <input type="password" id="password" name="password" placeholder="Your Password">
                                        <p id="passwordError" class="error passwordError"></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <p>Confirm Password*</p>
                                        <input type="password" id="cPassword" name="cPassword" placeholder="Confirm Password">
                                        <p id="cPasswordError" class="error cPasswordError"></p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="center"><button id="signupbtn" class="theme-btn mt-3 w-25" type="submit">Register</button></div>          
                    </form>
                    <div>
                        <h6>Already registered? <a href="#login-form" class="reg-btn" data-target="login-form"><strong>Click here</strong> </a> to get Login yourself!</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

