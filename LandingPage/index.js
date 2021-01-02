// accordion start
var acc = document.getElementsByClassName("accordion");
var i;
  
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
// accordion end

// function to subtract years from current date -> used for age verification
function subtractYears(date, years) {
  var result = new Date(date);
  result.setFullYear(result.getFullYear() - years);
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

// age must be 18
var currentDate = new Date();
var maxDate = dateToHtml(subtractYears(currentDate, 18));
var maxT = document.getElementById("geb_t").max = maxDate;
var maxV = document.getElementById("geb_v").max = maxDate;
