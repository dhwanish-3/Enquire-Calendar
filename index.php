<?php
require_once 'backup/google.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- the following stylesheet has the icons in the login signup form form_container -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- the following 3 lines are for getting Varela-Round font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <!-- this is for nunito font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&family=Varela+Round&display=swap" rel="stylesheet">
    <!-- the following bootstrap has conflicts with style.css I have added the css directly to the style.css file so no need -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <!-- this is for material-symbols-rounded curently not using these -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"> -->
    <link rel="stylesheet" href="style.css"/>
    <title>Enquire Quiz Calender</title>
</head>
<body>
  <!-- Header -->
  <section class="header">
    <div class="enquire">
      <img src="images/logo.png" alt="">
      <span>ENQUIRE QUIZ CLUB<span>
    </div>
    <div class="menu">
      <?php
        // Check if the user is logged in
      if (isset($_SESSION['email'])) {
        echo "<span>Hello, {$_SESSION['name']}</span>";
      ?>
        <button class="button" onclick="window.location.href = 'auth/logout.php'">LOGOUT</button>
      <?php
      }else{ ?>
        <button class="button" id="form-open">LOGIN</button>
      <?php
      }
      ?>
      <div>
        <button class="button apply-button">APPLY</button>
      </div>
    </div>
  </section>

    <!-- Home -->
    <section class="home">
      <div class="form_container">
        
        <!-- Login From -->
        <div class="form login_form">
          <form action="auth/login.php" method="POST">
            <div class="in_a_row">
              <h2>LOGIN</h2>
              <i class="uil uil-times form_close"></i>
            </div>
            <?php
              if(isset($_SESSION['login-msg'])){
                echo "<span class='session-msg'>{$_SESSION['login-msg']}</span>";
                unset($_SESSION['login-msg']);
              }
            ?>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required name="email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'];?>"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Enter your password" required name="password" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'];?>"/>
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" name="remember"/>
                <label for="check">Remember me</label>
              </span>
              <a href="forgot_password.php" class="forgot_pw">Forgot password?</a>
            </div>
            <button class="button">LOGIN NOW</button>
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>" class="no-line">
            <button id="google-button">
              <img src="images/google-logo.png">
              Sign in with Google
            </button>
          </a>
          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
        </div>

        <!-- Signup From -->
        <div class="form signup_form">
          <form action="auth/signup.php" method="POST">
            <div class="in_a_row">
              <h2>SIGNUP</h2>
              <i id="signup-form-close" class="uil uil-times form_close"></i>
            </div>
            <?php
              if(isset($_SESSION['signup-msg'])){
                echo "<span class='session-msg'>{$_SESSION['signup-msg']}</span>";
                unset($_SESSION['signup-msg']);
              }
            ?>
            <div class="input_box">
              <i class="uil uil-user-circle name"></i>
              <input type="text" placeholder="Enter your name" required name="name"/>           
            </div>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required name="email"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Create password" required id="password1" name="password"/>
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Confirm password" required id="password2" name="cpassword"/>
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <button class="button">SIGNUP NOW</button>
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>" class="no-line">
            <button id="google-button">
              <img src="images/google-logo.png">
              Sign in with Google
            </button>
          </a>
          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>       
        </div>
      </div>
    </section>

    <!-- Quiz Calendar -->
    <section class="main-body">
      <div class="calendars">
        <header>Quiz Calendar</header>
          <div class="two-calendars">
            <div class="wrapper">
              <header>
                <p class="current-date" id="current-date1"></p>
              </header>
              <div class="calendar">
                <ul class="weeks">
                  <li>Sun</li>
                  <li>Mon</li>
                  <li>Tue</li>
                  <li>Wed</li>
                  <li>Thu</li>
                  <li>Fri</li>
                  <li>Sat</li>
                </ul>
                <ul class="days" id="days1"></ul>
              </div>
            </div>
            <div class="wrapper">
              <header>
                <p class="current-date" id="current-date2"></p>
              </header>
              <div class="calendar">
                <ul class="weeks">
                  <li>Sun</li>
                  <li>Mon</li>
                  <li>Tue</li>
                  <li>Wed</li>
                  <li>Thu</li>
                  <li>Fri</li>
                  <li>Sat</li>
                </ul>
                <ul class="days" id="days2"></ul>
              </div>
            </div>
          </div>
        <section class="category-buttons">
          <div class="buttons-row">
            <button class="button open">OPEN</button>
            <button class="button school">SCHOOL</button>
            <button class="button college">COLLEGE</button>
          </div>
          <div class="buttons-row">
          <button class="button open-school">OPEN & SCHOOL</button>
            <button class="button open-college">OPEN & COLLEGE</button>
            <button class="button school-college">SCHOOL & COLLEGE</button>
          </div>
        </section>
      </div>
      <!-- Ads Section -->
      <section class="advertisement"></section>
    </section>
    <section class="fav-events">
      <div class="question">
        <span>HARD TIME SORTING YOUR FAVOURITE </span>
        <span>QUIZ EVENTS ?</span>
      </div>      
      <?php
      // getting the data if user has logged in
        $category=null;
        $open=0;
        $school=0;
        $college=0;
        $general=5;
        $scitech=5;
        $business=5;
        $scitechbiz=5;
        $sports=5;
        $mela=5;
        if(isset($_SESSION['general'])){
          $general=$_SESSION['general'];
          $scitech=$_SESSION['scitech'];
          $business=$_SESSION['business'];
          $scitechbiz=$_SESSION['scitechbiz'];
          $sports=$_SESSION['sports'];
          $mela=$_SESSION['mela'];
          $category=$_SESSION['category'];
          if(strpos($category,"open")!==false) $open=1;
          if(strpos($category,"school")!==false) $school=1;
          if(strpos($category,"college")!==false) $college=1;
        }
      ?>
      <div class="pop-up-form">
        <form id="submit-go">
          <div class="slider-container">
            <div class="range">
              <label for="general">General</label>
              <div class="slider">            
                <div class="range-thumb" id="range-thumb1">
                  <div class="range-value">
                    <div class="value-number" id="value-number1">
                      <span id="range-number1"></span>
                    </div>
                  </div>
                </div>
                <div class="range-slider">
                  <span>0</span>
                  <input type="range" class="range-input" id="range-input1" name="general" min="0" max="10" value="<?php echo $general; ?>" step="1">
                  <span>10</span>
                </div>
              </div>
            </div>
            <div class="range">
              <label for="sci-tech">Sci-Tech</label>
              <div class="slider">            
                <div class="range-thumb" id="range-thumb2">
                  <div class="range-value">
                    <div class="value-number" id="value-number2">
                      <span id="range-number2">5</span>
                    </div>
                  </div>
                </div>
                <div class="range-slider">
                  <span>0</span>
                  <input type="range" class="range-input" id="range-input2" name="scitech" min="0" max="10" value="<?php echo $scitech; ?>" step="1">
                  <span>10</span>
                </div>
              </div>
            </div>
            <div class="range">
              <label for="business">Business</label>
              <div class="slider">            
                <div class="range-thumb" id="range-thumb3">
                  <div class="range-value">
                    <div class="value-number" id="value-number3">
                      <span id="range-number3">5</span>
                    </div>
                  </div>
                </div>
                <div class="range-slider">
                  <span>0</span>
                  <input type="range" class="range-input" id="range-input3" name="business" min="0" max="10" value="<?php echo $business; ?>" step="1">
                  <span>10</span>
                </div>
              </div>
            </div>
            <div class="range">
              <label for="sci-tech-biz">Sci-Biz-Tech</label>
              <div class="slider">            
                <div class="range-thumb" id="range-thumb4">
                  <div class="range-value">
                    <div class="value-number" id="value-number4">
                      <span id="range-number4">5</span>
                    </div>
                  </div>
                </div>
                <div class="range-slider">
                  <span>0</span>
                  <input type="range" class="range-input" id="range-input4" name="scitechbiz" min="0" max="10" value="<?php echo $scitechbiz; ?>" step="1">
                  <span>10</span>
                </div>
              </div>
            </div>
            <div class="range">
              <label for="sports">Sports</label>
              <div class="slider">            
                <div class="range-thumb" id="range-thumb5">
                  <div class="range-value">
                    <div class="value-number" id="value-number5">
                      <span id="range-number5">5</span>
                    </div>
                  </div>
                </div>
                <div class="range-slider">
                  <span>0</span>
                  <input type="range" class="range-input" id="range-input5" name="sports" min="0" max="10" value="<?php echo $sports; ?>" step="1">
                  <span>10</span>
                </div>
              </div>
            </div>
            <div class="range">
              <label for="mela">Mela</label>
              <div class="slider">            
                <div class="range-thumb" id="range-thumb6">
                  <div class="range-value">
                    <div class="value-number" id="value-number6">
                      <span id="range-number6">5</span>
                    </div>
                  </div>
                </div>
                <div class="range-slider">
                  <span>0</span>
                  <input type="range" class="range-input" id="range-input6" name="mela" min="0" max="10" value="<?php echo $mela; ?>" step="1">
                  <span>10</span>
                </div>
              </div>
            </div>
          </div>
          <div class="radios">
            <span>Category :</span>
            <div class="radio">
              <input class="radio-input" type="checkbox" value="1" name="open" id="radio-open" <?php if($open) echo "checked"; ?>>
              <label class="radio-label" for="radio-open">Open</label>
              <input class="radio-input" type="checkbox" value="1" name="school" id="radio-school" <?php if($school) echo "checked"; ?>>
              <label class="radio-label" for="radio-school">School</label>
              <input class="radio-input" type="checkbox" value="1" name="college" id="radio-college" <?php if($college) echo "checked"; ?>>
              <label class="radio-label" for="radio-college">College</label>
            </div>
          </div>
          <button class="button go-button">GO !</button>
        </form>
      </div>
    </section>
    <section class="pop-up-section"></section>
    <section class="application-form">
      <div class="backdrop"></div>
      <div class="apply-container">
        <div class="apply-top">
          <div class="apply-header">
            <span class="heading">Application Form</span>
            <span class="instruction">Please fill the form below to apply to add an event in our website</span>
          </div>
          <button class="apply-close-button">&times;</button>
        </div>
        <form action="events/event_apply.php" method="POST" enctype="multipart/form-data">
          <div class="super-row">
            <div class="left-side">
              <div class="image-container">
                <input type="file" id="file-input" name="image">
                <label for="file-input" class="preview-label">
                  <img id="preview-image" src="images/preview.png" alt="Preview">
                  <span>Your selected image file will appear here</span>
                </label>
              </div>
              <label for="file-input" class="select-image">Please select an image</label>
              <label for="file-input" class="button select-file">Select Poster</label>
            </div>
            <div class="right-side">
              <div class="text-form-fields">
                <div class="form-field">
                  <input type="text" placeholder="Enter event name" required name="name">
                </div>
                <div class="form-field">
                  <input type="text" placeholder="Enter venue for the event" required name="venue">
                </div>
                <div class="form-field">
                  <input type="text" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" placeholder="Enter date of the event" required name="date">
                </div>
                <div class="form-field">
                  <input type="text" placeholder="Enter the quiz masters name" required name="quiz_masters">
                </div>
                <div class="form-field">
                  <input type="text" placeholder="Enter the contact info" required name="contact">
                </div>
                <div class="form-field">
                  <input type="text" placeholder="Enter the phone number of the applicant" required name="number">
                </div>
                <div class="form-field">
                  <input type="url" placeholder="Enter link for online registration if any" name="link">
                </div>
                <div class="form-field">
                  <input type="text" placeholder="Enter any extra details/rules for participation" name="rules">
                </div>
              </div>
              <div class="radios">
                <span>Category :</span>
                <div class="radio">
                  <input class="radio-input" type="checkbox" value="1" name="open" id="radio1">
                  <label class="radio-label" for="radio1">Open</label>
                  <input class="radio-input" type="checkbox" value="1" name="school" id="radio2">
                  <label class="radio-label" for="radio2">School</label>
                  <input class="radio-input" type="checkbox" value="1" name="college" id="radio3">
                  <label class="radio-label" for="radio3">College</label>
                </div>
              </div>
              <div class="drop-down">
                <span>Type :</span>
                <select class="select-drop" name="type" id="type">
                  <option selected value="general">General</option>
                  <option value="scitech">Sci-Tech</option>
                  <option value="business">Business</option>
                  <option value="scitechbiz">Sci-biz-tech</option>
                  <option value="sports">Sports</option>
                  <option value="mela">Mela</option>
                </select>
              </div>
              <div class="checkbox" id="apply-ad">
                <input type="checkbox" value="1" name="apply_ad" id="apply-ad-input" />
                <label for="apply-ad-input">Apply for ad</label>
              </div>
              <div class="apply-button">
                <button class="button apply-submit" onclick="return imageNotNull();">SUBMIT</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
    <section class="footer"></section>
    <!-- these are for carousel buttons and auto-carousel-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="script.js" defer></script>
</body>
</html>