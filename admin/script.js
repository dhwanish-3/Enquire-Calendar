
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

    globalListofRequests=listofRequests; // assigning to global variable

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
    }
}

// calling the function to get listofRequests
getRequests(showRequests);