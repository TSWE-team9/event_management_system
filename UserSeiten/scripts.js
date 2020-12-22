// fucntion to add days to current date -> used to set min date
export function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

// function to subtract years from current date -> used for age verification
export function subtractYears(date, years) {
    var result = new Date(date);
    result.setFullYear(result.getFullYear() - years);
    return result;
}

// formats date to html format
export function dateToHtml(date) {
    var result = [date.getFullYear(), date.getMonth()+1, date.getDate()].join("-");
    return result;
}

// gets current day of the week and returns number of possible event days -> events duration is limited to one week (monday to sunday)
export function dayOfWeek(date) {
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