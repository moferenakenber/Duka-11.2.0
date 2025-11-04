module.exports = {
    semi: true,
    singleQuote: true,
    tabWidth: 4,
    printWidth: 400, // increase to avoid wrapping
    plugins: [require("@prettier/plugin-php"), require("prettier-plugin-blade")],
};
