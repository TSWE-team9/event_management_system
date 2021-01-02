 // Get the modal
var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.target == "none";
    }
}

// neues Datum muss auch in mindestens vier Wochen liegen
function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

// formats date to html format
function dateToHtml(date) {
    var year = date.getFullYear();
    var month = date.getMonth()+1;
    var day = date.getDate();

    if (month < 10) {
        month = [0, month].join("");
    }

    if (day < 10) {
        day = [0, day].join("");
    }

    var result = [year, month, day].join("-");
    return result;
}
    
var currentDate = new Date();
var minDate = dateToHtml(addDays(currentDate, 28));
var initialDate = document.getElementById("new_date").value = minDate;
var minDateHtml = document.getElementById("new_date").min = minDate;
