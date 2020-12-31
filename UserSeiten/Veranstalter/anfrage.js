
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

function setDays() {
    var maxDays = dayOfWeek(document.getElementById("min_date").value);
    var maxDaysHtml = document.getElementById("max_days").max = maxDays;
}

var currentDate = new Date();
var minDate = dateToHtml(addDays(currentDate, 28));
var initialDate = document.getElementById("min_date").value = minDate;
var minDateHtml = document.getElementById("min_date").min = minDate;
 