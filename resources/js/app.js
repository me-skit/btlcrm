const { Alert } = require('bootstrap');

require('./bootstrap');

// hiding privileges
hidePrivilegesByGender = (sex, allchecks) => {
  Array.prototype.forEach.call(allchecks, item => {
    if (item.dataset.sex == sex) {
      item.classList.add('d-none');
      document.getElementById(item.dataset.id).checked = false;
    }
  });
}

hidePrivilegesByStatus = (status, allchecks) => {
  Array.prototype.forEach.call(allchecks, item => {
    if (item.dataset.status == status) {
      item.classList.add('d-none');
      document.getElementById(item.dataset.id).checked = false;
    }
  });
}

cleanPrivilegeChecked = (allchecks) => {
  Array.prototype.forEach.call(allchecks, item => {
    item.classList.remove('d-none');
    document.getElementById(item.dataset.id).checked = false;
  });
}

checkPrivilegesByGender = (gender, allchecks) => {
  if (gender == 1 || gender == 3) {
    hidePrivilegesByGender(2, allchecks);
  }
  else {
    hidePrivilegesByGender(1, allchecks);
  }
}

checkPrivilegesByStatus = (status, allchecks, role) => {
  if (status) {
    switch (status) {
      case '1'://married
        hidePrivilegesByStatus(2, allchecks);
        break;
      case '2'://single
        if (role == 1 || role == 2) {
          hidePrivilegesByStatus(2, allchecks);
        }

        hidePrivilegesByStatus(1, allchecks);
        break;
      default:
        hidePrivilegesByStatus(1, allchecks);
        hidePrivilegesByStatus(2, allchecks);
        break;
    }
  }
}

settingSurnames = (role) => {
  let family_names = document.getElementById('family_names');
  let first_surname = document.getElementById('first_surname');
  let second_surname = document.getElementById('second_surname');
  
  if (family_names) {
    if (role == 1) {
      first_surname.value = family_names.dataset.first;
      second_surname.value = '';
    }
    else if (role == 2){
      first_surname.value = family_names.dataset.second;
      second_surname.value = '';
    }
    else {
      first_surname.value = family_names.dataset.first;
      second_surname.value = family_names.dataset.second;
    }
  }
}

settingSex = (role) => {
  const sex_select = document.getElementById('sex');

  if (role == 1 || role == 3) {
    sex_select.value = 'M';
  }
  else {
    sex_select.value = 'F';
  }
}

// hiding privileges on change family role selector
let family_role = document.getElementById('family_role');
if (family_role) {
  const allchecks = document.getElementsByClassName('divcheckbox');
  settingSurnames(family_role.value);
  settingSex(family_role.value);
  hidePrivilegesByGender(2, allchecks);

  family_role.addEventListener('change', event => {
    const status = document.getElementById('status');

    settingSurnames(event.target.value);
    settingSex(event.target.value);
    cleanPrivilegeChecked(allchecks);
    checkPrivilegesByGender(event.target.value, allchecks);
    checkPrivilegesByStatus(status.value, allchecks, event.target.value);
  })
}

let edit_family_role = document.getElementById('edit_family_role');
if (edit_family_role) {
  const allchecks = document.getElementsByClassName('divcheckbox');

  edit_family_role.addEventListener('change', event => {
    const status = document.getElementById('status');

    cleanPrivilegeChecked(allchecks);
    checkPrivilegesByGender(event.target.value, allchecks);
    checkPrivilegesByStatus(status.value, allchecks, event.target.value);
  })  
}

// hiding privileges on change status selector
let status = document.getElementById('status');
if (status) {
  status.addEventListener('change', event => {
    let allchecks = document.getElementsByClassName('divcheckbox');
    let family_role = document.getElementById('family_role');
    if (!family_role) family_role = document.getElementById('edit_family_role');

    cleanPrivilegeChecked(allchecks);
    checkPrivilegesByGender(family_role.value, allchecks);
    checkPrivilegesByStatus(event.target.value, allchecks, family_role.value);
  });
}

hideByAge = (value, allchecks, clean) => {
  let birthday = new Date(value.replace(/-/g, '\/'));
  let miliseconds_age = Date.now() - birthday.getTime();
  let age = Math.floor(miliseconds_age / 31536000000);

  let family_role = document.getElementById('family_role');
  if (!family_role) family_role = document.getElementById('edit_family_role');
  let status = document.getElementById('status');

  if (clean) cleanPrivilegeChecked(allchecks);

  checkPrivilegesByGender(family_role.value, allchecks);
  checkPrivilegesByStatus(status.value, allchecks, family_role.value);

  Array.prototype.forEach.call(allchecks, item => {
    if (item.dataset.min > 0 && item.dataset.max > 0) {
      if (age < item.dataset.min || age > item.dataset.max) {
        item.classList.add('d-none');
        document.getElementById(item.dataset.id).checked = false;
      }
    }
  });
}

const birthday = document.getElementById('birthday');
if (birthday) {
  let allchecks = document.getElementsByClassName('divcheckbox');
  if (birthday.value) {
    hideByAge(birthday.value, allchecks);
  }

  birthday.addEventListener('change', () => hideByAge(birthday.value, allchecks, 1));
}

// attend church selector change
hidePrivilegeSection = (allchecks) => {
  let p_section = document.getElementById('privilege-section');

  cleanPrivilegeChecked(allchecks);
  p_section.classList.add('d-none');
}

showPrivilegeSection = (allchecks) => {
  let family_role = document.getElementById('family_role');
  if (!family_role) family_role = document.getElementById('edit_family_role');
  let status = document.getElementById('status');
  let p_section = document.getElementById('privilege-section');

  p_section.classList.remove('d-none');
  checkPrivilegesByGender(family_role.value, allchecks);
  checkPrivilegesByStatus(status.value, allchecks, family_role.value);
}

toggleReasonField = (attend) => {
  const reason = document.getElementById('reason');

  if (attend == 0 || attend == 2) {
    reason.disabled = false;
  }
  else {
    reason.value = '';
    reason.disabled = true;
  }
}

toggleCampusField = (attend) => {
  const campus = document.getElementById('campus_id');

  if (attend == -1 || attend == 0) {
    campus.value = '';
    campus.required = false;
    campus.disabled = true;
  }
  else if (attend == 1) {
    campus.required = true;
    campus.disabled = false;
  }
  else {
    campus.required = false;
    campus.disabled = false;
  }
}

togglePrivilegesSection = (attend) => {
  let allchecks = document.getElementsByClassName('divcheckbox');
  if (attend == 1 || attend == 2) {
    showPrivilegeSection(allchecks);
  }
  else {
    hidePrivilegeSection(allchecks);
  }
}

const attend = document.getElementById('attend_church');
if (attend) {
  toggleReasonField(attend.value);
  toggleCampusField(attend.value);
  togglePrivilegesSection(attend.value);

  attend.addEventListener('change', event => {
    toggleReasonField(event.target.value);
    toggleCampusField(event.target.value);
    togglePrivilegesSection(event.target.value);
  });
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
addPrivilege = (event) => {
  const id = event.target.dataset.id;
  let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
  let privilege = document.getElementById('privilege-select-' + id);
  
  if (meta && privilege.value) {
    event.preventDefault();
    let formData = new FormData(document.getElementById('form-priv-' + id));

    let _data = {
      person_id: id,
      privilege_id: formData.get('privilege_id'),
      privilege_role_id: formData.get('privilege_role_id'),
      start_date: formData.get('start_date'),
      end_date: formData.get('end_date')
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
      let privileges = document.getElementById('privileges-' + id);
      privileges.innerHTML = text;

      $("#privilege-select-" + id).val('').selectpicker("refresh");
      $("#privilege-role-" + id).val('').selectpicker("refresh");
      document.getElementById('privilege-start-' + id).value = '';
      document.getElementById('privilege-end-' + id).value = '';

      setPrivilegeEditionAction();
      setPrivilegeDeleteAction();
    })
    .catch(err => console.log(err));
  }
}

let btns_addprivilege = document.getElementsByName('btn-addprivilege');
Array.prototype.forEach.call(btns_addprivilege, btn => btn.addEventListener('click', (event) => addPrivilege(event)));

// calculating discipline duration according to start date when user change discipline type
setDisciplineEnd = (discipline_select, discipline_start, discipline_end) => {
  const value = parseInt(discipline_select.value);

  if (discipline_select.value && discipline_select.value != '0' && discipline_start.value) {
    let the_date = new Date(discipline_start.value.replace(/-/g, '\/'));
    let new_date = new Date(discipline_start.value.replace(/-/g, '\/'));

    new_date.setMonth(the_date.getMonth() + value);
    new_date.setTime(new_date.getTime() - 86400000);
    discipline_end.value = new_date.getFullYear().toString() 
                           + '-' + (new_date.getMonth() + 1).toString().padStart(2, 0)
                           + '-' + new_date.getDate().toString().padStart(2, 0);
  }
  else {
    discipline_end.value = '';
  }
}

// set discipline end when discipline type changes
onDisciplineSelectChange = (event) => {
  const discipline_start = document.getElementById('discipline-start-' + event.target.dataset.id);
  const discipline_end = document.getElementById('discipline-end-' + event.target.dataset.id);
  setDisciplineEnd(event.target, discipline_start, discipline_end);
}

let discipline_selects = document.getElementsByName('discipline_type');
Array.prototype.forEach.call(discipline_selects, select => select.addEventListener('change', (event) => onDisciplineSelectChange(event)));

// set discipline end when start changes
onDisciplineStartChange = (event) => {
  const discipline_select = document.getElementById('discipline-select-' + event.target.dataset.id);
  const discipline_end = document.getElementById('discipline-end-' + event.target.dataset.id);
  setDisciplineEnd(discipline_select, event.target, discipline_end);
}

let start_fields = document.getElementsByClassName('start_date');
Array.prototype.forEach.call(start_fields, field => field.addEventListener('change', (event) => onDisciplineStartChange(event)));

// adding discipline
addDiscipline = (event) => {
  const id = event.target.dataset.id;
  let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
  let discipline_select = document.getElementById('discipline-select-' + id);
  let start_input = document.getElementById('discipline-start-' + id);
  let end_input = document.getElementById('discipline-end-' + id);
  let act_input = document.getElementById('act-number-' + id);

  if (meta && discipline_select.value && start_input.value && act_input.value) {
    event.preventDefault();

    let _data = {
      person_id: id,
      discipline_type: discipline_select.value,
      start_date: start_input.value,
      end_date: end_input.value,
      act_number: act_input.value
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
      let disciplines = document.getElementById('disciplines-' + id);
      disciplines.innerHTML = text;

      $("#discipline-select-" + id).val('').selectpicker("refresh");
      start_input.value = '';
      end_input.value = '';
      act_input.value = '';

      setDisciplineEditionAction();
      setDisciplineDeleteAction();
      updatePrivilegesView(id);
    })
    .catch(err => console.log(err));
  }
}

let btns_adddiscipine = document.getElementsByName('btn-adddiscipline');
Array.prototype.forEach.call(btns_adddiscipine, btn => btn.addEventListener('click', (event) => addDiscipline(event)));

// editing privileges
setPrivilegeEditionAction = () => {
  let btns_editprivilege = document.getElementsByName('btn-editprivilege');
  let edit_div = document.getElementById('editPrivilegeBody');
  let button = document.getElementById('btn-modify-privilege');
  Array.prototype.forEach.call(btns_editprivilege, btn => btn.addEventListener('click', (event) => {
    fetch('/assignments/' + event.target.dataset.id + '/edit')
    .then(response => response.text())
    .then(text => { 
      edit_div.innerHTML = text;
      $("#privilege_select_edit").selectpicker("refresh");
      $("#privilege_role_id_edit").selectpicker("refresh");
      button.dataset.id = event.target.dataset.id;
      button.dataset.user = event.target.dataset.user;
    })
    .catch(err => console.log(err));
  }));
}

setPrivilegeEditionAction();

// update privilege
let btn_modify_privilege = document.getElementById('btn-modify-privilege');
if (btn_modify_privilege) {
  btn_modify_privilege.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let formData = new FormData(document.getElementById('form-editprivilege'));

    let _data = {
      privilege_id: formData.get('privilege_id'),
      privilege_role_id: formData.get('privilege_role_id'),
      start_date: formData.get('start_date'),
      end_date: formData.get('end_date')
    }

    if (meta) {
      fetch('/assignments/' + event.target.dataset.id, {
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

        let privileges = document.getElementById('privileges-' + event.target.dataset.user);
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
  let btns_editdiscipline = document.getElementsByName('btn-editdiscipline');
  let edit_div = document.getElementById('editDisciplineBody');
  let button = document.getElementById('btn-modify-discipline');
  Array.prototype.forEach.call(btns_editdiscipline, btn => btn.addEventListener('click', (event) => {
    fetch('/disciplines/' + event.target.dataset.id + '/edit')
    .then(response => response.text())
    .then(text => { 
      edit_div.innerHTML = text;
      $("#discipline_select_edit").selectpicker("refresh");
      button.dataset.id = event.target.dataset.id;
      button.dataset.user = event.target.dataset.user;

      const discipline_select = document.getElementById('discipline_select_edit');
      const start_field = document.getElementById('discipline_start_edit');
      const end_field = document.getElementById('discipline_end_edit');
      discipline_select.addEventListener('change', () => setDisciplineEnd(discipline_select, start_field, end_field));
      start_field.addEventListener('change', () => setDisciplineEnd(discipline_select, start_field, end_field));
    })
    .catch(err => console.log(err));
  }));
}

setDisciplineEditionAction();

// update discipline
let btn_modify_discipline = document.getElementById('btn-modify-discipline');
if (btn_modify_discipline) {
  btn_modify_discipline.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let start_input = document.getElementById('discipline_start_edit');
    let act_input = document.getElementById('act_number_edit');

    if (meta && start_input.value && act_input.value) {
      event.preventDefault();
      let discipline_select = document.getElementById('discipline_select_edit');
      let end_input = document.getElementById('discipline_end_edit');
      
      let _data = {
        discipline_type: discipline_select.value,
        start_date: start_input.value,
        end_date: end_input.value,
        act_number: act_input.value
      }

      fetch('/disciplines/' + event.target.dataset.id, {
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
        let disciplines = document.getElementById('disciplines-' + event.target.dataset.user);
        disciplines.innerHTML = text;

        setDisciplineEditionAction();
        setDisciplineDeleteAction();
        updatePrivilegesView(event.target.dataset.user);
      })
      .catch(err => console.log(err));
    }
  });
}

// setting the delete privilege action
setPrivilegeDeleteAction = () => {
  let btns_delprivilege = document.getElementsByName('btn-delprivilege');
  let button = document.getElementById('btn-del-privilege');
  Array.prototype.forEach.call(btns_delprivilege, btn => btn.addEventListener('click', (event) => {
    button.dataset.id = event.target.dataset.id;
    button.dataset.user = event.target.dataset.user;
  }));
}

setPrivilegeDeleteAction();

// delete privilege
let btn_del_privilege = document.getElementById('btn-del-privilege');
if (btn_del_privilege) {
  btn_del_privilege.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let privileges = document.getElementById('privileges-' + event.target.dataset.user);

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

// setting the delete discipline action
setDisciplineDeleteAction = () => {
  let btns_deldiscipline = document.getElementsByName('btn-deldiscipline');
  let button = document.getElementById('btn-del-discipline');
  Array.prototype.forEach.call(btns_deldiscipline, btn => btn.addEventListener('click', (event) => {
    button.dataset.id = event.target.dataset.id;
    button.dataset.user = event.target.dataset.user;
  }));
}

setDisciplineDeleteAction();

// delete discipline
let btn_del_discipline = document.getElementById('btn-del-discipline');
if (btn_del_discipline) {
  btn_del_discipline.addEventListener('click', (event) => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let disciplines = document.getElementById('disciplines-' + event.target.dataset.user);

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
      updatePrivilegesView(event.target.dataset.user);
    })
    .catch(err => console.log(err));
  });
}

// make a get request for privileges associated with a person
updatePrivilegesView = (id) => {
  let privileges = document.getElementById('privileges-' + id);

  fetch('/assignments?userid=' + id)
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
    let accordion = document.getElementById('accordion');

    fetch('/directory?priv_id=' + event.target.value)
    .then(response => {
      if (response.ok) return  response.text();
      
      throw new Error('No se pudo obtener la lista de personas en ese privilegio');
    })
    .then(data => {
      accordion.innerHTML = data;
    })
    .catch(error => {
      accordion.innerHTML = error;
    });
  });
}

// end/achive discipline action for modal
endDisciplineFunction = () => {
  let end_btns = document.getElementsByName('end-discipline');
  Array.prototype.forEach.call(end_btns, item => item.addEventListener('click', event => {
    let the_end_btn = document.getElementById('end-discipline');
    let end_date = document.getElementById('new-end-date');
    the_end_btn.dataset.id = event.target.dataset.id;
    end_date.value = '';
  }));
}

endDisciplineFunction();

// end/achive discipline
let end_discipline = document.getElementById('end-discipline');
if (end_discipline) {
  end_discipline.addEventListener('click', event => {
    let meta = document.querySelectorAll('meta[name="csrf-token"]')[0];
    let end = document.getElementById('new-end-date');

    if (meta && end.value) {
      event.preventDefault();
      let container = document.getElementById('disciplines-list');

      let _data = {
        end_date: end.value
      }

      fetch('/end/' + event.target.dataset.id, {
        method: "PATCH",
        body: JSON.stringify(_data),
        headers: {
          "X-CSRF-TOKEN": meta.getAttribute('content'),
          "Content-type": "application/json; charset=UTF-8"
        }
      })
      .then(response => {
        if (response.ok) return  response.text();
        
        throw new Error('No se pudo obtener la lista de disciplinas');
      })
      .then(data => {
        $('#confirmModal').modal('toggle');
        container.innerHTML = data;
        endDisciplineFunction();
      })
      .catch(error => {
        container.innerHTML = error;
      });
    }
  });
}

// map and markers
objectPosition = (strLatitude, strLongitude) => {
  let lat = parseFloat(strLatitude);
  let lng = parseFloat(strLongitude);
  return {lat, lng};
}

setLocationInForm = position => {
  let location = document.getElementById('location');
  location.value = position.lat + ', ' + position.lng;
}

addMarker = (position, map) => {
  let icon = {
    url: '../../images/red-with-house.png',
    scaledSize: new google.maps.Size(23, 40),
  };

  let marker = new google.maps.Marker({
    position,
    map,
    icon
  });

  return marker;
}

initMap = () => {
  let marker;
  const bethel = {lat: 14.632584549506703, lng: -90.92646535338397};
  const div_map = document.getElementById("map");
  const map = new google.maps.Map(div_map, {
    zoom: 16,
    center: bethel
  });

  if (div_map.dataset.map == 0) {
    div_map.style.height = "700px";
    //map.setZoom(15);
    let page = 1;
    getABunch(page, map, 'campus', 'black-with-church.png');
    getABunch(page, map, 'families', 'red-with-house.png');  
  }
  else if (div_map.dataset.map == 1) {
    map.addListener("click", (event) => {
      if (marker) marker.setMap(null);

      let pos = event.latLng.toJSON();
      let position = objectPosition(pos.lat, pos.lng);

      marker = addMarker(position, map);
      map.panTo(position);
      setLocationInForm(position);
    });
  }
  else if (div_map.dataset.map == 2) {
    if (div_map.dataset.lat && div_map.dataset.lng) {
      let position = objectPosition(div_map.dataset.lat, div_map.dataset.lng);
      map.setCenter(position);
      marker = addMarker(position, map);
    }

    map.addListener("click", (event) => {
      if (marker) marker.setMap(null);

      let pos = event.latLng.toJSON();
      let position = objectPosition(pos.lat, pos.lng);

      marker = addMarker(position, map);
      map.panTo(position);
      setLocationInForm(position);
    });
  }
  else {
    if (div_map.dataset.lat && div_map.dataset.lng) {
      let position = objectPosition(div_map.dataset.lat, div_map.dataset.lng);
      map.setCenter(position);
      addMarker(position, map);
    }
  }
}

getABunch = (page, map, model, image) => {

  fetch('/' + model + '/bunch?page=' + page)
  .then(response => {
    if (response.ok) return  response.json();
    
    // throw new Error('No se pudieron obtener datos de familias');
  })
  .then(json => {
    let list = json.data;
    list.forEach(item => {
      let icon = {
        url: '../images/' + image,
        scaledSize: new google.maps.Size(23, 40),
      };

      let position = objectPosition(item.latitude, item.longitude);
      let marker = new google.maps.Marker({
        position,
        map,
        icon
      });

      let info = new google.maps.InfoWindow({
        content: '<b>' + item.name + '</b><br />' + item.address
      });

      marker.addListener('click', () => {
        info.open(map, marker);
      });
    });

    page++;
    if (page <= json.last_page) {
      getABunch(page, map, model, image);
    }
  })
  .catch(error => {
    console.log(error);
  });
}

// const div_map = document.getElementById("map");
// if (div_map) {
//   initMap;
// }

// $(document).ready(function(){
//   $("p").click(function(){
//     alert("The paragraph was clicked.");
//     $("#privilege_role_id").val('');
//     $("#privilege_role_id").selectpicker("refresh");
//   });
// });
