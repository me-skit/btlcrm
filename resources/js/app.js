const { Alert } = require('bootstrap');

require('./bootstrap');

const attend = document.getElementById("attend_church");

changeCampusValue = (value, campus) => {
  if (value == 0) {
    campus.value = '';
    campus.required = false;
    campus.disabled = true;
  }

  if (value == 1) {
    campus.required = true;
    campus.disabled = false;
  }

  if (value == 2) {
    campus.required = false;
    campus.disabled = false;
  }
}

if (attend) {
  const campus = document.getElementById("campus_id");
  attend.addEventListener('change', () => changeCampusValue(attend.value, campus));
}
