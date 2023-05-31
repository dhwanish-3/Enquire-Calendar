<?php
require 'backup/google.php';
// Check if the user is logged in
if (isset($_SESSION['name'])) {
  // Display the welcome message
  echo "Hello, " . $_SESSION['name'] . "!";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enquire Calendar</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="script.js" defer></script>
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <nav class="nav">
        <a href="#" class="nav_logo">ENQUIRE QUIZ CLUB</a>
        <?php
          // Check if the user is logged in
          if (isset($_SESSION['email'])) { ?>
           <button class="button" id="form-open" onclick="window.location.href = 'logout.php'">Logout</button>
         <?php
        }else{ ?>
          <button class="button" id="form-open">Login</button>
          <?php
        }
         ?>
      </nav>
    </header>
    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
          <form action="login.php" method="POST">
            <h2>Login</h2>

            <div class="input_box">
              <input type="email" placeholder="Enter your email" required name="email"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Enter your password" required name="password"/>
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="#" class="forgot_pw">Forgot password?</a>
            </div>
            <button class="button">Login Now</button>      
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>"><button id="google-button"><img src="images/google-logo.png">Sign in with Google</button></a>
          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
        </div>

        <!-- Signup From -->
        <div class="form signup_form">
          <form action="signup.php" method="POST">
            <h2>Signup</h2>

            <div class="input_box">
              <i class="uil uil-user-circle name"></i>
              <input type="text" placeholder="Enter your name" required name="name"/>
           
            </div>
            <div class="input_box">
              <input type="email" placeholder="Enter your email" required name="email"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>


            <div class="input_box">
              <input type="password" placeholder="Create password" required id="password1" name="password" />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Confirm password" required id="password2" />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <button class="button" onclick="return checkPasswords()">SignUp now</button>
          </form>
          <a href="<?php echo $client->createAuthUrl(); ?>"><button id="google-button"><img src="images/google-logo.png">Sign in with Google</button></a>

          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>       
        </div>
        <script>
          const urlParams = new URLSearchParams(window.location.search);
          const signup = urlParams.get('signup');
          if (signup === 'success') {
            const message = document.createElement('p');
            message.innerText = 'You have successfully signed up!';
            document.body.appendChild(message);
          }
        </script>
      </div>
    </section>
   <!-- Calendar --> 
   <div class="row">  
  <div class="bod col-md-8">
    <div class="wrapper">
      <header>
        <p class="current-date"></p>
        <div class="icons">
          <!-- {{!-- <span id="prev" class="material-symbols-rounded">chevron_left</span>
          <span id="next" class="material-symbols-rounded">chevron_right</span> --}} -->
        </div>
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
        <ul class="days"></ul>
      </div>
      <div class="pop"></div>
    </div> 
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;

    <div class="wrapper2">
      <header>
        <p class="current-date2"></p>
        <div class="icons">
          <!-- {{!-- <span id="prev" class="material-symbols-rounded">chevron_left</span>
          <span id="next" class="material-symbols-rounded">chevron_right</span> --}} -->
        </div>
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
        <ul class="days2"></ul>
      </div>
      <div class="pop"></div>
    </div>
    
  </div>
  <div id="carouselExampleControls" class="carousel slide bg-dark col-md-4" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://th.bing.com/th?id=OIP.LM6UsZ8chpv8A06YegHmIgHaE0&w=309&h=201&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" class="d-block w-100" alt="..." >
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://th.bing.com/th?id=OIP.C9U-IioM247k-QKQ-1stoAHaEK&w=333&h=187&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" class="d-block w-100" alt="..." >
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://th.bing.com/th?id=OIP.XoJuP62VMIIqNhTBrZU9ywHaFj&w=288&h=216&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" class="d-block w-100" alt="..." >
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>   
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div> 
    </div>
   </div>
        <div class="form application">
          <form action="event_apply.php" method="POST">
            <h2>Apply for Event</h2>
            <label for="image">Image : </label>
            <!-- <img id="previewImage" src="#" alt="Preview Image" style="display:none;"> -->
            <!-- <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> -->
            <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
            <div class="input_box">
              <i class="uil uil-user-circle name"></i>
              <input type="text" placeholder="Enter event name" required name="name"/>
            </div>
            <div class="input_box">
              <i class="uil uil-user-circle name"></i>
              <input type="date" placeholder="Enter event date" required name="date"/>
            </div>
            <div class="input_box">
              <input type="text" placeholder="Enter venue" required name="venue"/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="text" placeholder="Quiz masters"  id="masters" name="quiz_masters" />
            </div>
            <div class="input_box">
              <input type="text" placeholder="Contacts"  required id="contacts" name="contact"/>
            </div>
            <div class="input_box">
              <input type="number" placeholder="Applicants phone" required id="number" name="number"/>
            </div>
            <div class="input_box">
              <input type="link" placeholder="Link" id="link" name="link"/>
            </div><br>
            <span class="checkbox">
                <input type="checkbox" id="ads" name="apply_ad" value="1"/>
                <label for="check">Apply for Advertisement</label>
              </span>
            <div class="type-details-box">
          <span class="type-title">Category</span>
            <div class="what">
              <input type="radio" name="category" value="school">
              <label for="school">School</label>
              <input type="radio" name="category" value="college">
              <label for="college">College</label>
              <input type="radio" name="category" value="open">
              <label for="open">Open</label>
            </div>
          <span class="type-title">Type</span>
            <div class="type">
              <input type="radio" name="type" value="general" >
              <label for="general">General</label>
              <input type="radio" name="type" value="scitech">
              <label for="scitech">Sci-Tech</label>
              <input type="radio" name="type" value="business">
              <label for="business">Business</label>
              <input type="radio" name="type" value="scitechbiz">
              <label for="scitechbiz">Sci-Tech-Biz</label>
              <input type="radio" name="type"value="sports" >
              <label for="sports">Sports</label>
              <input type="radio" name="type" value="mela">
              <label for="mela">Mela</label>
            </div>
        </div>
            <button class="classs">Apply</button>
          </form>     
        </div>
    <div class="container">
      <h1 class="form-title">Registration</h1>
      <form action="#">
        <div class="main-user-info">
          <div class="user-input-box">
            <label for="general">General</label>
            <div class="range">
            <div class="sliderValue">
              <span>100</span>
            </div>
            <div class="field">
              <div class="value left">
              0</div>
              <input type="range" id="general" name="general"min="0" max="200" value="0" steps="1">
              <div class="value right">
                200</div>
              </div>
           </div>
            </label>
          </div>
          <div class="user-input-box">
            <label for="scitech">Sci-Tech</label>
                 
            <div class="range">
              <div class="sliderValue">
                <span>100</span>
              </div>
              <div class="field">
                <div class="value left">
                0</div>
                <input type="range" id="scitech" name="scitech"min="0" max="200" value="100" steps="1">
                <div class="value right">
                  200</div>
                </div>
             </div>
  
          </div>

          <div class="user-input-box">
            <label for="sports">Sports</label>
                 
            <div class="range">
              <div class="sliderValue">
                <span>100</span>
              </div>
              <div class="field">
                <div class="value left">
                0</div>
                <input type="range" id="sports" name="sports"min="0" max="200" value="100" steps="1">
                <div class="value right">
                  200</div>
                </div>
             </div>
  
          </div>
          
          <div class="user-input-box">
            <label for="business">Business</label>
                 
            <div class="range">
              <div class="sliderValue">
                <span>100</span>
              </div>
              <div class="field">
                <div class="value left">
                0</div>
                <input type="range" id="business" name="business"min="0" max="200" value="100" steps="1">
                <div class="value right">
                  200</div>
                </div>
             </div>
  
          </div>
           
          <div class="user-input-box">
            <label for="mela">Mela</label>      
          <div class="range">
            <div class="sliderValue">
              <span>100</span>
            </div>
            <div class="field">
              <div class="value left">
              0</div>
              <input type="range" id="mela" name="mela" min="0" max="200" value="100" steps="1">
              <div class="value right">
                200</div>
              </div>
           </div>

          </div>

        </div>
        <div class="type-details-box">
          <span class="type-title">Category</span>
          <div class="category">
            <input type="radio" name="type" id="male">
            <label for="school">School</label>
            <input type="radio" name="type" id="female">
            <label for="college">College</label>
            <input type="radio" name="type" id="other">
            <label for="open">Open</label>
          </div>
        </div>
        <div class="form-submit-btn">
          <input type="submit" value="Go!">
        </div>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="script.js"> 
      const slideValue = document.querySelector("span");
      const inputSlider = document.querySelector("input");
      inputSlider.oninput = (()=>{
        let value = inputSlider.value;
        slideValue.textContent = value;
        slideValue.style.left = (value/2) + "%";
        slideValue.classList.add("show");
      });
      inputSlider.onblur = (()=>{
        slideValue.classList.remove("show");
      });   </script>
      
  </body>
</html>