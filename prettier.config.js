/** @typedef {import("prettier").Config} PrettierConfig */

/** @type { PrettierConfig } */
const config = {
  /* General Prettier Config */
  semi: false,
  tabWidth: 2,
  printWidth: 80,
  singleQuote: true,
  trailingComma: 'all',
  jsxSingleQuote: true,

  plugins: ['@prettier/plugin-php'],

  overrides: [{ files: 'app/Views/**/*.php', options: { parser: 'html' } }],
}

export default config
