/** @typedef {import("prettier").Config} PrettierConfig */
/** @typedef {import("@prettier/plugin-php").Plugin} PHPConfig */

/** @type { PrettierConfig | SortImportsConfig | TailwindConfig } */
const config = {
  /* General Prettier Config */
  semi: false,
  tabWidth: 2,
  printWidth: 80,
  singleQuote: true,
  trailingComma: 'all',
  jsxSingleQuote: true,

  plugins: ['@prettier/plugin-php'],
}

export default config
