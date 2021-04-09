const { Alert } = require('bootstrap');

require('./bootstrap');

// attend church selector change

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

// hiding privileges

toggleHidePrivilege = (value, allchecks, males, females, singles, married, sex_select, status_select, role) => {
  Array.prototype.forEach.call(allchecks, item => item.classList.remove('d-none'));
  let family_names = document.getElementById('family_names');
  let first_surname = document.getElementById('first_surname');
  let second_surname = document.getElementById('second_surname');

  
  if (value == 1) {
    Array.prototype.forEach.call(females, item => item.classList.add('d-none'))
    Array.prototype.forEach.call(singles, item => item.classList.add('d-none'));
    sex_select.value = 'M';
    status_select.value = 1;
    if (family_names && role)
    {
      first_surname.value = family_names ? family_names.dataset.first : '';
      second_surname.value = '';
    }
  }
  else if (value == 2){
    Array.prototype.forEach.call(males, item => item.classList.add('d-none'))
    Array.prototype.forEach.call(singles, item => item.classList.add('d-none'));
    sex_select.value = 'F';
    status_select.value = 1;
    if (family_names && role)
    {
      first_surname.value = family_names ? family_names.dataset.second : '';
      second_surname.value = '';
    }
  }
  else if (value == 3) {
    Array.prototype.forEach.call(females, item => item.classList.add('d-none'))
    Array.prototype.forEach.call(married, item => item.classList.add('d-none'));
    sex_select.value = 'M';
    status_select.value = 2;
    if (family_names && role)
    {
      first_surname.value = family_names ? family_names.dataset.first : '';
      second_surname.value = family_names ? family_names.dataset.second : '';
    }
  }
  else {
    Array.prototype.forEach.call(males, item => item.classList.add('d-none'))    
    Array.prototype.forEach.call(married, item => item.classList.add('d-none'));
    sex_select.value = 'F';
    status_select.value = 2;
    if (family_names && role)
    {
      first_surname.value = family_names ? family_names.dataset.first : '';
      second_surname.value = family_names ? family_names.dataset.second : '';
    }
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
  toggleHidePrivilege(frole.value, allchecks, males, females, singles, married, sex_select, status_select, 1);

  frole.addEventListener('change', () => toggleHidePrivilege(frole.value, allchecks, males, females, singles, married, sex_select, status_select, 1));
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

// the search thing
searchQuery = (query, page = 1, type, id) => {
  const pagination = document.getElementById('pagination');
  const title = document.getElementById('title');

  fetch('/' + title.dataset.name + '?page=' + page + '&query=' + query + (type ? '&type=' + type : '') + (id ? '&id=' + id : ''))
  .then(response => {
    if (response.ok) return  response.text();
    
    throw new Error('Algo salio mal, intente de nuevo');
  })
  .then(data => {
    pagination.innerHTML = data;
    paginate();
    addShowFunction();
  })
  .catch(error => {
    pagination.innerHTML = error;
  });
}

const search = document.getElementById('search');

if (search) {
  search.addEventListener('keyup', () => searchQuery(search.value));
}

pagination = (event, item, querytype, id) => {
  event.preventDefault();
  let page = String(item);
  page = page.split('page=')[1];
  let value = search ? search.value : '';
  searchQuery(value, page, querytype, id);
}

paginate = () => {
  const paginations = document.getElementsByClassName('page-link');

  if (paginations)
  {
    const query_type = document.getElementById('query_type');

    if (query_type)
    {
      const query_value = query_type.value;
      if (query_value === '2')
      {
        let campus = document.getElementById('campus_query').value;
        Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item, query_value, campus)));
      } else if (query_value === '3')
      {
        let privilege = document.getElementById('privilege_query').value;
        Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item, query_value, privilege)));
      }
      else
      {
        Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item, query_value)));
      }
    }
    else
    {
      Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item)));
    }
  }
}

paginate();

// hiding options and inputs when the type of query changes making a query at once
const query_type = document.getElementById('query_type');

if (query_type)
{
  const for_queries = document.getElementsByClassName('for-query');

  query_type.addEventListener('change', (event) => {
    Array.prototype.forEach.call(for_queries, item => item.classList.add('d-none'));
    let query_type = event.target.value;

    switch(query_type) {
      case '1':
        let search = document.getElementById('search');
        search.value = '';
        document.getElementById('by-name').classList.remove('d-none');
        searchQuery('', 1, query_type);
        break;
      case '2':
        let campus = document.getElementById('campus_query').value;
        document.getElementById('by-campus').classList.remove('d-none');
        searchQuery('', 1, query_type, campus);
        break;
      case '3':
        let privilege = document.getElementById('privilege_query').value;
        document.getElementById('by-privilege').classList.remove('d-none');
        searchQuery('', 1, query_type, privilege);
        break;
      default:
        searchQuery('', 1, query_type);
        break;
      }
  });
}

// when the second query option changes
const campus_query = document.getElementById('campus_query');
if (campus_query) {
  campus_query.addEventListener('change', (event) => searchQuery('', 1, 2, event.target.value));
}

const privilege_query = document.getElementById('privilege_query');
if (privilege_query) {
  privilege_query.addEventListener('change', (event) => searchQuery('', 1, 3, event.target.value));
}

// person details

showPersonDetails = (event, button) => {
  event.preventDefault();
  let modal_content = document.getElementById('modal-content');
  fetch('/nomember/' + button.dataset.id)
  .then(response => {
    if (response.ok) return  response.text();
    
    throw new Error('Error al cargar los datos, intente de nuevo');
  })
  .then(data => {
    modal_content.innerHTML = data;
  })
  .catch(error => {
    modal_content.innerHTML = error;
  });  
}

addShowFunction = () => {
  let d_buttons = document.getElementsByClassName('btn-f-details');
  if (d_buttons)
  {
    Array.prototype.forEach.call(d_buttons, item => item.addEventListener('click', () => showPersonDetails(event, item)));
  }
}

addShowFunction();

// adding privileges
const addp_button = document.getElementById('btn-add-privilege');
if (addp_button) {
  addp_button.addEventListener('click', (event) => {
    let privilege = document.getElementById('privilege_select');
    let start = document.getElementById('privilege_start');
    let end = document.getElementById('privilege_end');
    let person = document.getElementById('card-header');
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let privileges = document.getElementById('privileges');
    let privilege_role = document.getElementById('privilege_role_id')

    let _data = {
      person_id: person.dataset.id,
      privilege_id: privilege.value,
      privilege_role_id: privilege_role.value,
      start_date: start.value,
      end_date: end.value
    }

    if (meta) {
      fetch('/assignments', {
        method: "POST",
        body: JSON.stringify(_data),
        headers: { 
          "X-CSRF-TOKEN": meta.getAttribute('content'),
          "Content-type": "application/json; charset=UTF-8"
        }
      })
      .then(response => response.text())
      .then(text => { 
        privileges.innerHTML = text;
        start.value = '';
        end.value = '';
        privilege_role.value = '';
      })
      .catch(err => console.log(err));
    }
  });
}
