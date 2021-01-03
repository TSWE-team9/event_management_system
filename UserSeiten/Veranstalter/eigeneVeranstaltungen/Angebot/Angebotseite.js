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
    
// Veranstaltung muss mindestens 4 Wochen in der zukunft liegen
var currentDate = new Date();
var minDate = dateToHtml(addDays(currentDate, 28));
document.getElementById("new_date").value = minDate;
document.getElementById("new_date").min = minDate;

// letzer möglicher Tag
function latestDay(duration) {
    var result;

    switch(duration) {
        case "1":
            day = "Sonntag";
            break;

        case "2":
            day = "Samstag";
            break;

        case "3":
            day = "Freitag";
            break;

        case "4":
            day = "Donnerstag";
            break;
        
        case "5": 
            day = "Mittwoch";
            break;

        case "6":
            day = "Dienstag";
            break;

        case "7":
            day = "Montag";
            break;
    }

    result = ["Die Veranstaltung muss spätestens an einem", day, "beginnen."].join(" ");
    return result;
}

// Anzeige des spätesten Tages
var tag = latestDay(document.getElementById("dauer").value);
document.getElementById("ltag").innerHTML = tag;


// gets current day of the week and returns number of possible event days -> events duration is limited to one week (monday to sunday)
function dayOfWeek(date) {
    var day = new Date(date).getDay();
    var result;

    switch(day) {
        // sunday
        case 0:
            result = 1;
            break;

        // monday    
        case 1:
            result = 7;
            break;

        // tuesday
        case 2:
            result = 6;
            break;

        // wednesday
        case 3:
            result = 5;
            break;

        // thursday
        case 4:
            result = 4;
            break;

        // friday
        case 5:
            result = 3;
            break;

        // saturday
        case 6:
            result = 2;
            break;
    }
    return result;
}

// enable and disbale Button
function enableBtn() {
    var maxDays = dayOfWeek(new Date(document.getElementById("new_date").value));
    var days = parseInt(document.getElementById("dauer").value);

    if(days <= maxDays) {
        document.getElementById("btn_new_date").disabled = false;
    } else if(days > maxDays) {
        document.getElementById("btn_new_date").disabled = true;
    }  
}  
