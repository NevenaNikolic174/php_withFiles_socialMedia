
<?php
 
  include "models/users.php";


  
?>

  <section class="vh-100 gradient-custom" style="height: 200% !important;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
      
                  <div class="mb-md-5 mt-md-4 pb-5">
      
                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                    <p class="text-white-50 mb-5">Please enter your username and password!</p>
                    
                    <div class="error-message" style="<?php echo (count($errors) > 0) ? 'display:block' : 'display:none'; ?>">
                      <?php echo implode('<br>', $errors); ?>
                    </div>                    
                    
                    <form role="form" action="index.php?page=register" method="post" onsubmit="return validateRegistration()" name="regForm" novalidate>
                    
                        <div class="form-outline mb-4">
                          <input type="text" id="reg-username" class="form-control form-control-lg" value="<?php echo $username;?>" name="username" />
                          <label class="form-label" >Your Name</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="email" id="reg-email" class="form-control form-control-lg" 
                              value="<?php echo $email;?>" name="email" onblur="checkEmailAvailability()" />
                          <label class="form-label">Your Email</label>
                          <span id="email-availability-status" style="display:none;"></span>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password"  id="reg-password" class="form-control form-control-lg" value="<?php echo $password;?>" name="password" />
                            <label class="form-label">Password</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="reg-password-confirmation" class="form-control form-control-lg" value="<?php echo $passConfim;?>" name="password_confirmation" />
                            <label class="form-label">Repeat your password</label>
                        </div>

                        
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" id="submit-reg" name="register-btn">Register</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> 