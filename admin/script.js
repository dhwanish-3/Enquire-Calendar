
// sign-up and login form
const home=document.querySelector(".home");
const formOpenBtn = document.querySelector("#form-open");
const formCloseBtn = document.querySelector(".form_close");
const pwShowHide = document.querySelectorAll(".pw_hide");
const nonhomeElements = document.querySelectorAll("body > *:not(.home)");

const outsideClickHandlerforAuth = (event) => {
  if (!home.contains(event.target) && event.target !== home) {
    nonhomeElements.forEach((element) => {
      element.classList.remove("blur-effect");
      home.classList.remove("show");
    });
    document.removeEventListener("click", outsideClickHandlerforAuth);
  }
};

if(formOpenBtn!==null){
  formOpenBtn.addEventListener("click", () => {
    nonhomeElements.forEach((element) => {
      element.classList.add("blur-effect");
    });

    setTimeout(() => {
      document.addEventListener("click", outsideClickHandlerforAuth);
    }, 100);
    home.classList.add("show");
  });
}

formCloseBtn.addEventListener("click", () => {
  home.classList.remove("show");
  document.removeEventListener("click", outsideClickHandlerforAuth);
  nonhomeElements.forEach((element) => {
    element.classList.remove("blur-effect");
  });
});

// password show and hide
pwShowHide.forEach((icon) => {
    icon.addEventListener("click", () => {
        let getPwInput = icon.parentElement.querySelector("input");
        if (getPwInput.type === "password") {
            getPwInput.type = "text";
            icon.classList.replace("uil-eye-slash", "uil-eye");
        } else {
            getPwInput.type = "password";
            icon.classList.replace("uil-eye", "uil-eye-slash");
        }
    });
});


// defining a global list of requests in case needed
let globalListofRequests=new Array();

// function to get data from request_event table
const getRequests=(callback)=>{
    var xhr = new XMLHttpRequest();
    // Set up the request
    xhr.open('GET', 'requests.php',true);
    // Set up the callback function
    xhr.onload = function() {
        // Check if the request was successful
        if (xhr.status === 200) {
            // Parse the response as JSON
            var data = JSON.parse(xhr.responseText);
            console.log(data);
            globalListofRequests=data; // assigning to global variable

            callback(data);
        } else {
            // Handle errors here
            console.error(xhr.statusText);
        }
    };
    // Send the request
    xhr.send();
}

// function to render the list of requested events
const showRequests=(listofRequests)=>{

    if(listofRequests.length==0) return;

    const requestSection=document.querySelector(".requests-table");
    // for the header row of table
    // refer other script.js line no. 552
    let tableHtmlHeader=``;
    // for table contents
    let tableContentHtml=``;
    let i=0;
    while(i<listofRequests.length){
        tableContentHtml=tableContentHtml.concat(``);
        i++;
    }
}

// we always want to show the login form if the user has not logged in
// then only we fetch the data
// for showing msg in signup - login container
const urlParams = new URLSearchParams(window.location.search);
const login = urlParams.get('login');
console.log(login);
console.log(formOpenBtn);
if(login==null){
    if(formOpenBtn==null){
        getRequests(showRequests);
    }else{
        formOpenBtn.click();
    }
}
else if(login!=null){
    if(formOpenBtn==null){
        // calling the function to get listofRequests
        getRequests(showRequests);

    }else if(formOpenBtn!=null){
        formOpenBtn.click();
    }
}

