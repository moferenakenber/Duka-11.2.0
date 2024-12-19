import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {

    //// Adds !important to all Tailwind utilities,
    important: true,
    // this makes tailwind class be dominant on the files but i should
    // have done is use id's to identify the div's and buttons of bootstrap
    // an apply the bootstrap there specifically.

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    // daisyui: {
    //                themes: [
    //                "light", "dark", "retro",
    //              ],
    //         },

    daisyui: {
        themes: [
          {
            mytheme: {
              "primary": "#a991f7",
              "secondary": "#f6d860",
              "accent": "#37cdbe",
              "neutral": "#3d4451",
              "base-100": "#ffffff",
            },
          },
          "dark",
          "retro",
        ],
      },

    plugins: [require('daisyui', 'flowbite/plugin'), forms],
};


// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';

// /** @type {import('tailwindcss').Config} */
// export default {
//     important: true,
//     content: [
//         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/views/**/*.blade.php',
//     ],

//     theme: {
//         extend: {
//             // Custom font family
//             fontFamily: {
//                 sans: ['Figtree', ...defaultTheme.fontFamily.sans],
//             },
//             // Custom colors
//             colors: {
//                 primary: '#1DA1F2', // Tailwind's default blue color as an example
//                 secondary: '#FF5733', // A custom secondary color
//                 dark: '#121212', // Custom dark background color
//                 light: '#F5F5F5', // Custom light background color
//             },
//             // Custom spacing
//             spacing: {
//                 128: '32rem', // Custom spacing value
//                 144: '36rem', // Another custom spacing value
//             },
//             // Custom breakpoints
//             screens: {
//                 'xs': '480px',
//                 ...defaultTheme.screens,
//             },
//             // Extend default border radius
//             borderRadius: {
//                 xl: '1rem',
//                 '2xl': '1.5rem',
//             },
//             // Custom shadows
//             boxShadow: {
//                 'primary': '0 2px 10px rgba(0, 0, 0, 0.1)',
//                 'secondary': '0 4px 20px rgba(0, 0, 0, 0.2)',
//             },
//         },
//     },

//     daisyui: {
//         themes: [
//           "retro",
//         ],
//       },


//     plugins: [require('daisyui'), forms],
// };
