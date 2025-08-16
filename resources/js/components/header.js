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

const disableAnimation = (nonce) => {
  const css = document.createElement('style')
  if (nonce) css.setAttribute('nonce', nonce)
  css.appendChild(
    document.createTextNode(
      `*,*::before,*::after{-webkit-transition:none!important;-moz-transition:none!important;-o-transition:none!important;-ms-transition:none!important;transition:none!important}`,
    ),
  )
  document.head.appendChild(css)

  return () => {
    ;(() => window.getComputedStyle(document.body))()
    setTimeout(() => {
      document.head.removeChild(css)
    }, 1)
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
  const restoreAnimation = disableAnimation(themeToggle.getAttribute('nonce'))

  document.documentElement.classList.toggle('dark')
  localStorage.setItem(
    'theme',
    document.documentElement.classList.contains('dark') ? 'dark' : 'light',
  )
  updateThemeIcon()

  restoreAnimation()
})
