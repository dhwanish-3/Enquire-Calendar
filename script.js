const formOpenBtn = document.querySelector("#form-open"),
  home = document.querySelector(".home"),
  formContainer = document.querySelector(".form_container"),
  formCloseBtn = document.querySelector(".form_close"),
  signupBtn = document.querySelector("#signup"),
  loginBtn = document.querySelector("#login"),
  pwShowHide = document.querySelectorAll(".pw_hide");
  const daysTag = document.querySelector(".days"),
  currentDate = document.querySelector(".current-date"),
  prevNextIcon = document.querySelectorAll(".icons span");



formOpenBtn.addEventListener("click", () => home.classList.add("show"));
formCloseBtn.addEventListener("click", () => home.classList.remove("show"));

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

signupBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.add("active");
});
loginBtn.addEventListener("click", (e) => {
  e.preventDefault();
  formContainer.classList.remove("active");
});

function checkPasswords() {
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  if (password1 != password2) {
    alert("Passwords do not match!");
    return false;
  }
  return true;
}


// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

function showPopUp(day) {   
     const popUp = document.createElement("div");
    popUp.classList.add("pop-up");
    popUp.innerHTML = `<div>
                        <h2>${months[currMonth]} ${day}, ${currYear}</h2>
                       <p>Today is a special day!</p>
                       <img src="im.jpeg">
                       <p>Happy birthday!</p>
                       <button class="close-btn">Close</button>
                          <div/>`;
    // Close the pop-up window when the close button is clicked
    popUp.querySelector(".close-btn").addEventListener("click", () => {
        popUp.remove();
    });
    
    document.body.appendChild(popUp);
}
const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }
    for (let i = 1; i <= lastDateofMonth; i++) { // creating li of all days of current month
        // adding active class to li if the current day, month, and year matched
        let isToday = i === date.getDate() && currMonth === new Date().getMonth() 
                     && currYear === new Date().getFullYear() ? "active" : "";          
        liTag += `<li class="${isToday}">${i}</li>`;
    }
    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;
    const dayElements = daysTag.querySelectorAll('li');
    dayElements.forEach(dayElement => {
      dayElement.addEventListener('click', () => {
      const day = dayElement.innerText;
       showPopUp(day);
    });
}); 
}
renderCalendar();

prevNextIcon.forEach(icon => { 
                              // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            date = new Date(currYear, currMonth, new Date().getDate());
            currYear = date.getFullYear(); // updating current year with new date year
            currMonth = date.getMonth(); // updating current month with new date month
        } else {
            date = new Date(); // pass the current date as date value
        }
        renderCalendar(); // calling renderCalendar function
    });
});



for(let i=1;i<6;i++){
  const rangeThumb = document.getElementById(`range-thumb${i}`),
        rangeNumber = document.getElementById(`range-number${i}`),
        rangeLine = document.getElementById(`range-line${i}`),
        rangeInput = document.getElementById(`range-input${i}`)
  
  const rangeInputSlider = () =>{
  
     // Insert the value of the input range
     rangeNumber.textContent = rangeInput.value
  
     // Calculate the position of the input thumb
     // rangeInput.value = 50, rangeInput.max = 100, (50 / 100 = 0.5)
     // rangeInput.offsetWidth = 248, rangeThumb.offsetWidth = 32, (248 - 32 = 216)
     const thumbPosition = (rangeInput.value / rangeInput.max),
           space = rangeInput.offsetWidth - rangeThumb.offsetWidth
  
     // We insert the position of the input thumb
     // thumbPosition = 0.5, space = 216 (0.5 * 216 = 108)
     rangeThumb.style.left = (thumbPosition * space) + 'px'
  
     // We insert the width to the slider with the value of the input value
     // rangeInput.value = 50, ancho = 50%
     rangeLine.style.width = rangeInput.value + '%'
  
     // We call the range input
     rangeInput.addEventListener('input', rangeInputSlider)
  }
  
  rangeInputSlider()
  }
  
