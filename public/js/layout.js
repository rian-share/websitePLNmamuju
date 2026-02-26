// document.addEventListener("DOMContentLoaded", function () {
    let isSecurity = document.getElementById('isSecurity') ?? ''
    let isCustomer = document.getElementById('isCustomer') ?? ''
    let loading = document.getElementById('Loadingg')
    if(isSecurity) {
        isSecurity.addEventListener('click', function () {
            let animateD = document.getElementById('modal-alert');
            document.getElementById('modal-delete').classList.add('scale-90', 'opacity-0');
            animateD.classList.add('opacity-0');
            setTimeout(() => {
                animateD.classList.add('hidden');
            }, 300)
        })
    }

    if(isCustomer){
      isCustomer.addEventListener('click',()=>{
        loading.classList.remove('hidden')
        window.location.href = 'http://127.0.0.1:8000/alertCustomer'
      })
    }

const fab = document.getElementById('fab-wa');

// ----- Animasi Fade-in -----
window.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        fab.classList.remove('scale-0', 'opacity-0');
        fab.classList.add('scale-100', 'opacity-100');
    }, 300); // delay 0.3s agar terlihat smooth
});

// ----- Dragable -----
let isDragging = false;
let offset = { x: 0, y: 0 };

fab.addEventListener('mousedown', startDrag);
fab.addEventListener('touchstart', startDrag);

function startDrag(e) {
  isDragging = true;
  const rect = fab.getBoundingClientRect();

  if(e.type === 'mousedown'){
    offset.x = e.clientX - rect.left;
    offset.y = e.clientY - rect.top;
  } else { // touch
    offset.x = e.touches[0].clientX - rect.left;
    offset.y = e.touches[0].clientY - rect.top;
  }

  document.addEventListener('mousemove', drag);
  document.addEventListener('mouseup', stopDrag);
  document.addEventListener('touchmove', drag);
  document.addEventListener('touchend', stopDrag);
}

function drag(e){
  if(!isDragging) return;

  let x, y;
  if(e.type === 'mousemove'){
    x = e.clientX - offset.x;
    y = e.clientY - offset.y;
  } else { // touchmove
    x = e.touches[0].clientX - offset.x;
    y = e.touches[0].clientY - offset.y;
  }

  // batasi agar tidak keluar layar
  const maxX = window.innerWidth - fab.offsetWidth;
  const maxY = window.innerHeight - fab.offsetHeight;

  x = Math.max(0, Math.min(x, maxX));
  y = Math.max(0, Math.min(y, maxY));

  fab.style.left = x + 'px';
  fab.style.top = y + 'px';
  fab.style.bottom = 'auto';
  fab.style.right = 'auto';
}

function stopDrag(){
  isDragging = false;
  document.removeEventListener('mousemove', drag);
  document.removeEventListener('mouseup', stopDrag);
  document.removeEventListener('touchmove', drag);
  document.removeEventListener('touchend', stopDrag);
}