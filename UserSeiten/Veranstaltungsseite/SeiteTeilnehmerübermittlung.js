// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


// holen der Excel Datei
var input = document.getElementById("input");
var arr = [];

// auslesen der Excel Datei und speichern im Array arr
input.addEventListener('change', function() {
    readXlsxFile(input.files[0]).then((data) => {
        arr = data;
    });
});

// holen der maximalen Teilnehmeranzahl
var max = document.getElementById("t_max").value;

// füllen der Inputfelder mit den Daten aus der Excel Datei
function fill() {
    for(var i = 1; i <= max; i++) {
        var n = ["n", i].join("");
        var v = ["v", i].join("");

        document.getElementById(n).value = arr[i-1][0];
        document.getElementById(v).value = arr[i-1][1];
    }
}