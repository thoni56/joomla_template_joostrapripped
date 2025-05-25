document.addEventListener('DOMContentLoaded', function () {
  const goTop = document.querySelector('.go-top');
  if (!goTop) return;

  goTop.addEventListener('click', function (e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  window.addEventListener('scroll', function () {
    if (window.scrollY > 200) {
      goTop.style.display = 'block';
    } else {
      goTop.style.display = 'none';
    }
  });
});
