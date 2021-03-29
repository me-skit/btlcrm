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

// the search thing
searchQuery = (query, page = 1, type, id) => {
  const pagination = document.getElementById('pagination');
  const title = document.getElementById('title');

  fetch('/' + title.dataset.name + '?page=' + page + '&query=' + query + (type ? '&type=' + type : '') + (id ? '&id=' + id : ''))
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
  search.addEventListener('keyup', () => searchQuery(search.value));
}

pagination = (event, item, querytype) => {
  event.preventDefault();
  let page = String(item);
  page = page.split('page=')[1];
  let value = search ? search.value : '';
  searchQuery(value, page, querytype);
}

paginate = () => {
  const paginations = document.getElementsByClassName('page-link');

  if (paginations)
  {
    const query_type = document.getElementById('query_type');

    if (query_type)
    {
      if (query_type.value == '2')
      {
        let campus = document.getElementById('campus');
        Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item, query_type.value, campus.value)));
      } else if (query_type == '3')
      {
        let privilege = document.getElementById('privilege');
        Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item, query_type.value, privilege.value)));
      }
      else
      {
        Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item, query_type.value)));
      }
    }
    else
    {
      Array.prototype.forEach.call(paginations, item => item.addEventListener('click', () => pagination(event, item)));
    }
  }
}

paginate();

// the consult list on change
const query_type = document.getElementById('query_type');

if (query_type)
{
  const for_queries = document.getElementsByClassName('for-query');

  query_type.addEventListener('change', (event) => {
    Array.prototype.forEach.call(for_queries, item => item.classList.add('d-none'));
    document.getElementById('btn-search').classList.remove('d-none');

    switch(event.target.value) {
      case '1':
        document.getElementById('by-name').classList.remove('d-none');
        document.getElementById('btn-search').classList.add('d-none');
        break;
      case '2':
        document.getElementById('by-campus').classList.remove('d-none');
        break;
      case '3':
        document.getElementById('by-privilege').classList.remove('d-none');
        break;
    }
  });
}

const btn_search = document.getElementById('btn-search');

if (btn_search)
{
  btn_search.addEventListener('click', () => {
    switch(query_type.value) {
      case '2':
        let campus = document.getElementById('campus');
        searchQuery('', 1, query_type.value, campus.value);
        break;
      case '3':
        let privilege = document.getElementById('privilege');
        searchQuery('', 1, query_type.value, privilege.value);
        break;
      default:
        searchQuery('', 1, query_type.value);
    }
  });
}
