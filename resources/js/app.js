const { Alert } = require('bootstrap');

require('./bootstrap');

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

const attend = document.getElementById('attend_church');

if (attend) {
  const campus = document.getElementById('campus_id');

  changeCampusValue(attend.value, campus);
  attend.addEventListener('change', () => changeCampusValue(attend.value, campus));
}


toggleHidePrivilege = (value, allchecks, males, females, singles, married, sex_select, status_select) => {
  Array.prototype.forEach.call(allchecks, item => item.classList.remove('d-none'));

  if (value == 1) {
    Array.prototype.forEach.call(females, item => item.classList.add('d-none'))
    Array.prototype.forEach.call(singles, item => item.classList.add('d-none'));
    sex_select.value = 'M';
    status_select.value = 1;
  }
  else if (value == 2){
    Array.prototype.forEach.call(males, item => item.classList.add('d-none'))
    Array.prototype.forEach.call(singles, item => item.classList.add('d-none'));
    sex_select.value = 'F';
    status_select.value = 1;
  }
  else if (value == 3) {
    Array.prototype.forEach.call(females, item => item.classList.add('d-none'))
    Array.prototype.forEach.call(married, item => item.classList.add('d-none'));
    sex_select.value = 'M';
    status_select.value = 2;
  }
  else {
    Array.prototype.forEach.call(males, item => item.classList.add('d-none'))    
    Array.prototype.forEach.call(married, item => item.classList.add('d-none'));
    sex_select.value = 'F';
    status_select.value = 2;
  }
}

const frole = document.querySelector('#family_role');
const allchecks = document.getElementsByClassName('divcheckbox');
const males = document.getElementsByClassName('male');
const females = document.getElementsByClassName('female');
const singles = document.getElementsByClassName('single');
const married = document.getElementsByClassName('married');
const sex_select = document.getElementById('sex');
const status_select = document.getElementById('status');

if (frole) {
  toggleHidePrivilege(frole.value, allchecks, males, females, singles, married, sex_select, status_select);

  frole.addEventListener('change', () => toggleHidePrivilege(frole.value, allchecks, males, females, singles, married, sex_select, status_select));
}

hideByAge = (value, allchecks) => {
  let birthday = new Date(value.replace(/-/g, '\/'));
  let miliseconds_age = Date.now() - birthday.getTime();
  let age = Math.floor(miliseconds_age / 31536000000);

  toggleHidePrivilege(frole.value, allchecks, males, females, singles, married, sex_select, status_select);

  Array.prototype.forEach.call(allchecks, item => {
    if (item.dataset.min > 0 && item.dataset.max > 0) {
      if (age < item.dataset.min || age > item.dataset.max) {
        item.classList.add('d-none');
        document.getElementById(item.dataset.id).checked = false;
      }
    }
  });
}

const birthday = document.querySelector('#birthday');

if (birthday) {

  if (birthday.value) {
    hideByAge(birthday.value, allchecks);
  }

  birthday.addEventListener('change', () => hideByAge(birthday.value, allchecks));
}

// the search in family table thing
searchByFamilyName = (query, page = 1) => {
  const pagination = document.getElementById('pagination');
  const title = document.getElementById('title');

  fetch('/' + title.dataset.name + '?page=' + page + '&query=' + query)
  .then(response => {
    if (response.ok) return  response.text();
    
    throw new Error('Something went wrong');
  })
  .then(data => {
    pagination.innerHTML = data;
    paginate();
  })
  .catch(error => {
    pagination.innerHTML = '';
  });
}

const search = document.getElementById('search');

if (search) {
  search.addEventListener('keyup', () => searchByFamilyName(search.value));
}

pagination = (event, item) => {
  event.preventDefault();
  let page = String(item);
  page = page.split('page=')[1];
  let value = search ? search.value : '';
  searchByFamilyName(value, page);
}

paginate = () => {
  const paginations = document.getElementsByClassName('page-link');
  if (paginations)
  {
    Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item)));
  }
}

paginate();
