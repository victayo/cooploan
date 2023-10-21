let birthdayArray = "0";
let selectedYear = birthdayArray["year"];
let selectedMonth = Math.floor(birthdayArray["month"]);
let selectedDay = birthdayArray["day"];
const choiceOptions = {
    allowHTML: false,
    itemSelectText: ""
}

if (document.getElementById('choices-gender')) {
    var gender = document.getElementById('choices-gender');
    const example = new Choices(gender, {...choiceOptions});
}

if (document.getElementById('choices-role')) {
    var role = document.getElementById('choices-role');
    const example = new Choices(role, {...choiceOptions});
}

if (document.getElementById('choices-language')) {
    var language = document.getElementById('choices-language');
    const example = new Choices(language, {...choiceOptions});
}

if (document.getElementById('choices-skills')) {
    var skills = document.getElementById('choices-skills');
    const example = new Choices(skills, Object.assign({
        removeItemButton: true,
    }, choiceOptions));
}

if (document.getElementById('choices-year')) {
    var year = document.getElementById('choices-year');
    setTimeout(function () {
        const example = new Choices(year, {...choiceOptions});
    }, 1);

    for (let y = 1900; y <= 2020; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;
        if (selectedYear > 0) {
            if (y == selectedYear) {
                optn.selected = true;
            }
        }

        year.options.add(optn);
    }
}

if (document.getElementById('choices-day')) {
    var day = document.getElementById('choices-day');
    setTimeout(function () {
        const example = new Choices(day, {...choiceOptions});
    }, 1);


    for (let y = 1; y <= 31; y++) {
        var optn = document.createElement("OPTION");
        optn.text = y;
        optn.value = y;

        if (selectedDay > 0) {
            if (y == selectedDay) {
                optn.selected = true;
            }
        }

        day.options.add(optn);
    }

}

if (document.getElementById('choices-month')) {
    var month = document.getElementById('choices-month');
    setTimeout(function () {
        const example = new Choices(month, {...choiceOptions});
    }, 1);

    var d = new Date();
    var monthArray = new Array();
    monthArray[0] = "January";
    monthArray[1] = "February";
    monthArray[2] = "March";
    monthArray[3] = "April";
    monthArray[4] = "May";
    monthArray[5] = "June";
    monthArray[6] = "July";
    monthArray[7] = "August";
    monthArray[8] = "September";
    monthArray[9] = "October";
    monthArray[10] = "November";
    monthArray[11] = "December";
    for (let m = 0; m <= 11; m++) {
        var optn = document.createElement("OPTION");
        optn.text = monthArray[m];
        // server side month start from one
        optn.value = (m + 1);
        // if june selected
        if (selectedMonth > 0) {
            if (optn.value == selectedMonth) {
                optn.selected = true;
            }
        }
        month.options.add(optn);
    }
}

function visible() {
    var elem = document.getElementById('profileVisibility');
    if (elem) {
        if (elem.innerHTML == "Switch to visible") {
            elem.innerHTML = "Switch to invisible"
        } else {
            elem.innerHTML = "Switch to visible"
        }
    }
}

var openFile = function (event) {
    var input = event.target;

    // Instantiate FileReader
    var reader = new FileReader();
    reader.onload = function () {
        imageFile = reader.result;

        document.getElementById("imageChange").innerHTML = '<img width="200" src="' + imageFile +
            '" class="rounded-circle w-100 shadow" />';
    };
    reader.readAsDataURL(input.files[0]);
};
