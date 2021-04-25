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
    
    throw new Error('No se pudo obtener la consulta, intente de nuevo');
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
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let privilege = document.getElementById('privilege_select');
    
    if (meta && privilege.value) {
      event.preventDefault();
      let start = document.getElementById('privilege_start');
      let end = document.getElementById('privilege_end');
      let person = document.getElementById('card-header');
      let privileges = document.getElementById('privileges');
      let privilege_role = document.getElementById('privilege_role_id')

      let _data = {
        person_id: person.dataset.id,
        privilege_id: privilege.value,
        privilege_role_id: privilege_role.value,
        start_date: start.value,
        end_date: end.value
      }

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
        $("#privilege_select").val('').selectpicker("refresh");
        $("#privilege_role_id").val('').selectpicker("refresh");
        start.value = '';
        end.value = '';
        setPrivilegeEditionAction();
        setPrivilegeDeleteAction();
      })
      .catch(err => console.log(err));
    }
  });
}

// calculating discipline duration according to start date when user change discipline type
onChangeDisciplineSelect = (discipline_select, discipline_start, discipline_end) => {
  if (discipline_start.value) {
    let the_date = new Date(discipline_start.value.replace(/-/g, '\/'));
    let new_date = new Date(discipline_start.value.replace(/-/g, '\/'));;

    switch (discipline_select.value) {
      case '3':
        new_date.setMonth(the_date.getMonth() + 3);
        new_date.setTime(new_date.getTime() - 86400000);
        discipline_end.value = new_date.getFullYear().toString() 
                               + '-' + (new_date.getMonth() + 1).toString().padStart(2, 0)
                               + '-' + new_date.getDate().toString().padStart(2, 0);
        break;
      case '6':
        new_date.setMonth(the_date.getMonth() + 6);
        new_date.setTime(new_date.getTime() - 86400000);
        discipline_end.value = new_date.getFullYear().toString() 
                               + '-' + (new_date.getMonth() + 1).toString().padStart(2, 0)
                               + '-' + new_date.getDate().toString().padStart(2, 0);
        break;
      default:
        discipline_end.value = '';
        break;
    }      
  }
}

const discipline_select = document.getElementById('discipline_select');
if (discipline_select) {
  const discipline_start = document.getElementById('discipline_start');
  const discipline_end = document.getElementById('discipline_end');
  discipline_select.addEventListener('change', () => onChangeDisciplineSelect(discipline_select, discipline_start, discipline_end));
}

// calculation discipline duration according to start date when user choose start date
onChangeDisciplineStart = (discipline_select, discipline_start, discipline_end) => {
  let the_date = new Date(discipline_start.value.replace(/-/g, '\/'));
  let new_date = new Date(discipline_start.value.replace(/-/g, '\/'));;

  switch (discipline_select.value) {
    case '3':
      new_date.setMonth(the_date.getMonth() + 3);
      new_date.setTime(new_date.getTime() - 86400000);
      discipline_end.value = new_date.getFullYear().toString() 
                             + '-' + (new_date.getMonth() + 1).toString().padStart(2, 0)
                             + '-' + new_date.getDate().toString().padStart(2, 0);
      break;
    case '6':
      new_date.setMonth(the_date.getMonth() + 6);
      new_date.setTime(new_date.getTime() - 86400000);
      discipline_end.value = new_date.getFullYear().toString() 
                             + '-' + (new_date.getMonth() + 1).toString().padStart(2, 0)
                             + '-' + new_date.getDate().toString().padStart(2, 0);
      break;
    default:
      discipline_end.value = '';
      break;
  }
}

const discipline_start = document.getElementById('discipline_start');
if (discipline_start) {
  const discipline_select = document.getElementById('discipline_select');
  const discipline_end = document.getElementById('discipline_end');
  discipline_start.addEventListener('change', () => onChangeDisciplineStart(discipline_select, discipline_start, discipline_end));
}

// adding discipline
const addd_button = document.getElementById('btn-add-discipline');
if (addd_button) {
  addd_button.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let discipline = document.getElementById('discipline_select');
    let start = document.getElementById('discipline_start');
    let act = document.getElementById('act_number');

    if (meta && discipline.value && start.value && act.value) {
      event.preventDefault();
      let end = document.getElementById('discipline_end');
      let person = document.getElementById('card-header');
      let disciplines = document.getElementById('disciplines');

      let _data = {
        person_id: person.dataset.id,
        discipline_type: discipline.value,
        act_number: act.value,
        start_date: start.value,
        end_date: end.value
      }

      fetch('/disciplines', {
        method: "POST",
        body: JSON.stringify(_data),
        headers: { 
          "X-CSRF-TOKEN": meta.getAttribute('content'),
          "Content-type": "application/json; charset=UTF-8"
        }
      })
      .then(response => response.text())
      .then(text => { 
        disciplines.innerHTML = text;
        $("#discipline_select").val('').selectpicker("refresh");
        start.value = '';
        end.value = '';
        act.value = '';
        setDisciplineEditionAction();
        setDisciplineDeleteAction();
        updatePrivilegesView();
      })
      .catch(err => console.log(err));
    }
  });
}

// editing privileges
setPrivilegeEditionAction = () => {
  let edit_priv_btns = document.getElementsByName('btn-edit-privilege');
  if (edit_priv_btns) {
    let edit_priv_body = document.getElementById('editPrivilegeBody');
    Array.prototype.forEach.call(edit_priv_btns, item => item.addEventListener('click', (event) => {
      fetch('/assignments/' + event.target.dataset.id + '/edit')
      .then(response => response.text())
      .then(text => { 
        edit_priv_body.innerHTML = text;
        $("#privilege_select_edit").selectpicker("refresh");
        $("#privilege_role_id_edit").selectpicker("refresh");
      })
      .catch(err => console.log(err));
    }));
  }
}

setPrivilegeEditionAction();

// update privilege
let btn_modify_privilege = document.getElementById('btn-modify-privilege');
if (btn_modify_privilege) {
  btn_modify_privilege.addEventListener('click', (event) => {
    let privilege = document.getElementById('privilege_select_edit');
    let start = document.getElementById('privilege_start_edit');
    let end = document.getElementById('privilege_end_edit');
    let privilege_role = document.getElementById('privilege_role_id_edit')

    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let privileges = document.getElementById('privileges');
    let the_privilege = document.getElementById('edit-privilege');

    let _data = {
      privilege_id: privilege.value,
      privilege_role_id: privilege_role.value,
      start_date: start.value,
      end_date: end.value
    }

    if (meta) {
      fetch('/assignments/' + the_privilege.dataset.id, {
        method: "PUT",
        body: JSON.stringify(_data),
        headers: { 
          "X-CSRF-TOKEN": meta.getAttribute('content'),
          "Content-type": "application/json; charset=UTF-8"
        }
      })
      .then(response => response.text())
      .then(text => {
        $('#editPrivilegeModal').modal('toggle');
        privileges.innerHTML = text;
        setPrivilegeEditionAction();
        setPrivilegeDeleteAction();
      })
      .catch(err => console.log(err));
    }
  });
}

// editing disciplines
setDisciplineEditionAction = () => {
  let edit_discip_btns = document.getElementsByName('btn-edit-discipline');
  if (edit_discip_btns) {
    let edit_discip_body = document.getElementById('editDisciplineBody');
    Array.prototype.forEach.call(edit_discip_btns, item => item.addEventListener('click', (event) => {
      fetch('/disciplines/' + event.target.dataset.id + '/edit')
      .then(response => response.text())
      .then(text => { 
        edit_discip_body.innerHTML = text;
        $("#discipline_select_edit").selectpicker("refresh");
        const discipline_select = document.getElementById('discipline_select_edit');
        const discipline_start = document.getElementById('discipline_start_edit');
        const discipline_end = document.getElementById('discipline_end_edit');

        discipline_select.addEventListener('change', () => onChangeDisciplineSelect(discipline_select, discipline_start, discipline_end));
        discipline_start.addEventListener('change', () => onChangeDisciplineStart(discipline_select, discipline_start, discipline_end));
      })
      .catch(err => console.log(err));
    }));
  }
}

setDisciplineEditionAction();

// update discipline
let btn_modify_discipline = document.getElementById('btn-modify-discipline');
if (btn_modify_discipline) {
  btn_modify_discipline.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let start = document.getElementById('discipline_start_edit');
    let act = document.getElementById('act_number_edit');

    if (meta && start.value && act.value) {
      event.preventDefault();
      let discipline = document.getElementById('discipline_select_edit');
      let end = document.getElementById('discipline_end_edit');

      let disciplines = document.getElementById('disciplines');
      let the_discipline = document.getElementById('edit-discipline');

      let _data = {
        discipline_type: discipline.value,
        act_number: act.value,
        start_date: start.value,
        end_date: end.value
      }

      fetch('/disciplines/' + the_discipline.dataset.id, {
        method: "PUT",
        body: JSON.stringify(_data),
        headers: { 
          "X-CSRF-TOKEN": meta.getAttribute('content'),
          "Content-type": "application/json; charset=UTF-8"
        }
      })
      .then(response => response.text())
      .then(text => {
        $('#editDisciplineModal').modal('toggle');
        disciplines.innerHTML = text;
        setDisciplineEditionAction();
        setDisciplineDeleteAction();
        updatePrivilegesView();
      })
      .catch(err => console.log(err));
    }
  });
}

// delete privilege
setPrivilegeDeleteAction = () => {
  let del_priv_buttons = document.getElementsByName('btn-del-privilege');
  if (del_priv_buttons) {
    let button = document.getElementById('btn-del-privilege');
    Array.prototype.forEach.call(del_priv_buttons, item => item.addEventListener('click', (event) => {
      button.dataset.id = event.target.dataset.id;
    }));
  }  
}

setPrivilegeDeleteAction();

let btn_del_privilege = document.getElementById('btn-del-privilege');
if (btn_del_privilege) {
  btn_del_privilege.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let privileges = document.getElementById('privileges');

    fetch('/assignments/' + event.target.dataset.id, {
      method: "DELETE",
      headers: { 
        "X-CSRF-TOKEN": meta.getAttribute('content'),
        "Content-type": "application/json; charset=UTF-8"
      }
    })
    .then(response => response.text())
    .then(text => { 
      $('#delPrivilegeModal').modal('toggle');
      privileges.innerHTML = text;
      setPrivilegeEditionAction();
      setPrivilegeDeleteAction();
    })
    .catch(err => console.log(err));
  });
}

// delete discipline
setDisciplineDeleteAction = () => {
  let del_disp_buttons = document.getElementsByName('btn-del-discipline');
  if (del_disp_buttons) {
    let button = document.getElementById('btn-del-discipline');
    Array.prototype.forEach.call(del_disp_buttons, item => item.addEventListener('click', (event) => {
      button.dataset.id = event.target.dataset.id;
    }));
  }  
}

setDisciplineDeleteAction();

let btn_del_discipline = document.getElementById('btn-del-discipline');
if (btn_del_discipline) {
  btn_del_discipline.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let disciplines = document.getElementById('disciplines');

    fetch('/disciplines/' + event.target.dataset.id, {
      method: "DELETE",
      headers: { 
        "X-CSRF-TOKEN": meta.getAttribute('content'),
        "Content-type": "application/json; charset=UTF-8"
      }
    })
    .then(response => response.text())
    .then(text => { 
      $('#delDisciplineModal').modal('toggle');
      disciplines.innerHTML = text;
      setDisciplineEditionAction();
      setDisciplineDeleteAction();
      updatePrivilegesView();
    })
    .catch(err => console.log(err));
  });
}

// make a get request for privileges associated with a person
updatePrivilegesView = () => {
  let card_header = document.getElementById('card-header');
  fetch('/assignments?userid=' + card_header.dataset.id)
  .then(response => {
    if (response.ok) return  response.text();
    
    throw new Error('No se pudo actualizar los datos de privilegios');
  })
  .then(text => {
    privileges.innerHTML = text;
    setPrivilegeEditionAction();
    setPrivilegeDeleteAction();
  })
  .catch(error => {
    privileges.innerHTML = error;
  });  
}

// change select when shows privilege directory
let privilege_list = document.getElementById('privilege_list');
if (privilege_list) {
  privilege_list.addEventListener('change', (event) => {
    let t_body = document.getElementById('priv-t-body');

    fetch('/directory?priv_id=' + event.target.value)
    .then(response => {
      if (response.ok) return  response.text();
      
      throw new Error('No se pudo obtener la consulta');
    })
    .then(data => {
      t_body.innerHTML = data;
    })
    .catch(error => {
      t_body.innerHTML = error;
    });
  });
}

// $(document).ready(function(){
//   $("p").click(function(){
//     alert("The paragraph was clicked.");
//     $("#privilege_role_id").val('');
//     $("#privilege_role_id").selectpicker("refresh");
//   });
// });

