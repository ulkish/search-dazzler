let isActive = false
let groupCode = false
let corpCode = false

function toggleActive () {
  const dropdown = document.getElementById('habDropdown')
  if (!isActive) {
    dropdown.classList.add("is-active")
    isActive = true
  } else {
    dropdown.classList.remove("is-active")
    isActive = false
  }
}

function toggleGroupCode () {
    const dropdown = document.getElementById('groupCode')
    if (!groupCode) {
      dropdown.classList.remove("showEspecials")
      groupCode = true
    } else {
      dropdown.classList.add("showEspecials")
      groupCode = false
    }
  }

function toggleCorpCode () {
    const dropdown = document.getElementById('corpCode')
    if (!corpCode) {
        dropdown.classList.remove("showEspecials")
        corpCode = true
    } else {
        dropdown.classList.add("showEspecials")
        corpCode = false
    }
}

const createState = (state) => {
    return new Proxy(state, {
      set(target, property, value) {
        target[property] = value;
        render();
        return true;
      }
    });
  };
  
  const state = createState({
    rooms: 1,
    adults: 1,
    childs: 1
  });
  
  const rooms = document.querySelectorAll('[data-model="rooms"]');
  
  rooms.forEach((room) => {
    const name = room.dataset.model;
    room.addEventListener('click', (event) => {
      if (room.name === 'add') state[name] += 1;
      if (room.name === 'remove') state[name] -= 1;
    });
  });
  
  const adults = document.querySelectorAll('[data-model="adults"]');
  
  adults.forEach((adult) => {
    const name = adult.dataset.model;
    adult.addEventListener('click', (event) => {
      if (adult.name === 'add') state[name] += 1;
      if (adult.name === 'remove') state[name] -= 1;
    });
  });
  
  const childs = document.querySelectorAll('[data-model="childs"]');
  
  childs.forEach((child) => {
    const name = child.dataset.model;
    child.addEventListener('click', (event) => {
      if (child.name === 'add') state[name] += 1;
      if (child.name === 'remove') state[name] -= 1;
    });
  });
  
  const render = () => {
      document.querySelector('[data-binding="rooms"]').innerHTML = state['rooms'];
      document.querySelector('[data-binding="rooms"]').value = state['rooms'];
      document.querySelector('[data-binding="adults"]').innerHTML = state['adults'];
      document.querySelector('[data-binding="adults"]').value = state['adults'];
      document.querySelector('[data-binding="childs"]').innerHTML = state['childs'];
      document.querySelector('[data-binding="childs"]').value = state['childs'];
  };