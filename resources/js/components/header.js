const themeToggle = document.querySelector('.header__theme-toggle')
const themeIcon = themeToggle.querySelector('i')

function updateThemeIcon() {
  if (document.documentElement.classList.contains('dark')) {
    themeIcon.classList.remove('fa-sun')
    themeIcon.classList.add('fa-moon')
  } else {
    themeIcon.classList.remove('fa-moon')
    themeIcon.classList.add('fa-sun')
  }
}

const savedTheme = localStorage.getItem('theme')
if (savedTheme) {
  document.documentElement.classList.toggle('dark', savedTheme === 'dark')
} else {
  if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
    document.documentElement.classList.add('dark')
  }
}

updateThemeIcon()

themeToggle.addEventListener('click', () => {
  document.documentElement.classList.toggle('dark')
  localStorage.setItem(
    'theme',
    document.documentElement.classList.contains('dark') ? 'dark' : 'light',
  )
  updateThemeIcon()
})
