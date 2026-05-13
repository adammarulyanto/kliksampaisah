function openDrawer() {
  document.getElementById('drawer').classList.add('open');
  document.getElementById('overlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeDrawer() {
  document.getElementById('drawer').classList.remove('open');
  document.getElementById('overlay').classList.remove('open');
  document.body.style.overflow = '';
}
document.querySelectorAll('.bnav-item').forEach(el => {
  el.addEventListener('click', function() {
    document.querySelectorAll('.bnav-item').forEach(x => x.classList.remove('active'));
    this.classList.add('active');
  });
});
document.querySelectorAll('.pill-tabs').forEach(tabs => {
  tabs.querySelectorAll('.pill-tab').forEach(tab => {
    tab.addEventListener('click', function() {
      tabs.querySelectorAll('.pill-tab').forEach(x => x.classList.remove('active'));
      this.classList.add('active');
    });
  });
});