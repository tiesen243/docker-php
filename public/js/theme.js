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

;(function (nonce) {
  const removeAnimation = disableAnimation(nonce)
  window.addEventListener('DOMContentLoaded', () => {
    requestAnimationFrame(() => {
      removeAnimation()
    })
  })
})(Math.random().toString(36).substring(2, 15))

const toggleTheme = document.querySelector('.toggle-theme')

const savedTheme = localStorage.getItem('theme') ?? 'light'
document.documentElement.classList.add(savedTheme)

toggleTheme.addEventListener('click', () => {
  const restoreAnimation = disableAnimation()
  const currentTheme = document.documentElement.classList.contains('light')
    ? 'light'
    : 'dark'
  const newTheme = currentTheme === 'light' ? 'dark' : 'light'

  document.documentElement.classList.remove(currentTheme)
  document.documentElement.classList.add(newTheme)

  localStorage.setItem('theme', newTheme)
  restoreAnimation()
})
