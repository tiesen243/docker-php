import { fileURLToPath } from 'node:url'

/** @typedef {import("prettier").Config} PrettierConfig */
/** @typedef {import("prettier-plugin-tailwindcss").PluginOptions} TailwindConfig */

/** @type { PrettierConfig | TailwindConfig } */
const config = {
  /* General Prettier Config */
  semi: false,
  tabWidth: 2,
  printWidth: 80,
  singleQuote: true,
  trailingComma: 'all',
  jsxSingleQuote: true,

  plugins: ['@prettier/plugin-php', 'prettier-plugin-tailwindcss'],

  tailwindStylesheet: fileURLToPath(
    new URL('public/css/tailwind.css', import.meta.url),
  ),
}

export default config
