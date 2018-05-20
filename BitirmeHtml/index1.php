<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login/Sign-In</title>
  
<link rel="stylesheet" type="text/css" href="top.css">
</head>

<body>
<div class="top"><img src="Film-icon.png" width="40" height="40" class="logo">
    <p class="logotext">Movie Recommendation System</p></div>

  <div class="logmod">
  <div class="logmod__wrapper">
    <span class="logmod__close">Close</span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href="#">Login</a></li>
        <li data-tabtar="lgm-1"><a href="#">Sign Up</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an acount</strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8" action="register.php" class="simform" method="POST">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">First Name*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Name" type="text" size="50" name="user_name" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Last Name*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Last Name" type="text" size="50" name="user_surname" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="user-email" placeholder="Email" type="email" size="50" name="user_mail" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input string optional">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" type="text" size="50" name="user_pass" />
              </div>
              <div class="input string optional">
                <label class="string optional" for="user-pw-repeat">Repeat password *</label>
                <input class="string optional" maxlength="255" id="user-pw-repeat" placeholder="Repeat password" type="text" size="50" name="user_repass" />
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="commit" type="submit" value="Create Account" />
              <span class="simform__actions-sidetext">By creating an account you agree to our <a class="special" target="_blank" role="link">Terms & Privacy</a></span>
            </div> 
          </form>
        </div> 
            <div class="logmod__alter">
          <div class="logmod__alter-container">

                <span>Sign in with <strong>Facebook</strong></span>

              
           <fb:login-button scope="public_profile,email,user_likes" onlogin="checkLoginState();">Login with Facebook
          </fb:login-button>
          </div>
        </div>
      </div>
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your email and password <strong>to sign in</strong></span>
        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8" action="login.php" class="simform" method="POST" >
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" name="user_mail" id="user_mail" placeholder="Email" type="email" size="50"  />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" type="password" size="50" name="user_pass" />
                            <span class="hide-password">Show</span>
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="commit" type="submit" value="Log In" />
              <span class="simform__actions-sidetext"><a class="special" role="link"  >Forgot your password?<br>Click here</a></span>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">

                <span>Sign in with <strong>Facebook</strong></span>

              
           <fb:login-button scope="public_profile,email,user_likes" onlogin="checkLoginState();">Login with Facebook
          </fb:login-button>
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>