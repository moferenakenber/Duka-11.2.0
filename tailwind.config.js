import defaultTheme from 'tailwindcss/defaultTheme';

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



    // Set darkMode to 'media' so it uses system preferences for dark mode
    darkMode: 'media', // or 'media' (based on the user's system preference)


    safelist: [
        '[x-cloak]', // Ensures [x-cloak] is included even if not used directly in templates
      ],

    // daisyui: {
    //                themes: [
    //                "light", "dark", "retro",
    //              ],
    //         },

    // daisyui: {
    //     themes: [
    //       {
    //         mytheme: {
    //           "primary": "#a991f7",
    //           "secondary": "#f6d860",
    //           "accent": "#37cdbe",
    //           "neutral": "#3d4451",
    //           "base-100": "#ffffff",
    //         },
    //       },
    //       "dark",
    //       "retro",
    //     ],
    //   },


    daisyui: {
        themes: ["light", "dark", "cupcake"],
      },







    //plugins: [require('daisyui', 'flowbite/plugin'), forms],
    plugins: [
        require('daisyui'),
        require('flowbite/plugin'),
        require('@tailwindcss/forms'),
      ],
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


























// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';

// /** @type {import('tailwindcss').Config} */
// export default {
//   // Optional: Add !important to all Tailwind utilities
//   important: true,

//   // Specify where to look for classes
//   content: [
//     './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//     './storage/framework/views/*.php',
//     './resources/views/**/*.blade.php',
//   ],

//   theme: {
//     extend: {
//       fontFamily: {
//         sans: ['Figtree', 'Arial', 'sans-serif'],
//       },
//       colors: {
//         // Dark Mode Theme (Admin)
//         admintheme: {
//           primary: '#8a4f7d', // Purple
//           secondary: '#ff8f00', // Bright Orange
//           accent: '#ffd700', // Gold
//           neutral: '#1d1d1d', // Dark Gray
//           'base-100': '#2c2c2c', // Charcoal Gray
//         },
//         // Light Blue Theme (Seller)
//         sellerandstock_keepertheme: {
//           primary: '#8a4f7d', // Purple
//           secondary: '#f8b400', // Yellow
//           accent: '#00c7b7', // Cyan
//           neutral: '#f0f0f0', // Light Gray
//           'base-100': '#ffffff', // White
//         },
//         // Retro Theme (Visitor)
//         visitortheme: {
//           primary: '#8a4f7d', // Purple
//           secondary: '#f9cb9c', // Light Peach
//           accent: '#00bfae', // Turquoise
//           neutral: '#3b3b3b', // Dark Gray
//           'base-100': '#ffffff', // White
//         },
//       },
//     },
//   },

//   // Disable Preflight (Tailwind base styles)
// //   corePlugins: {
// //     preflight: false, // Disables base styles (CSS reset)
// //   },

//   // DaisyUI configuration for custom themes
//   daisyui: {
//     themes: [
//       {
//         mytheme: {
//           primary: "#a991f7",
//           secondary: "#f6d860",
//           accent: "#37cdbe",
//           neutral: "#3d4451",
//           'base-100': "#ffffff",
//         },
//       },
//       "dark",  // Default dark theme
//       "retro", // Retro theme
//     ],
//   },

//   plugins: [
//     require('daisyui'),
//     require('flowbite/plugin'),
//     forms
//   ],
// };









// This definetly changed it to light mode.

// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';

// /** @type {import('tailwindcss').Config} */
// export default {

//     //// Adds !important to all Tailwind utilities,
//     important: true,
//     // this makes tailwind class be dominant on the files but i should
//     // have done is use id's to identify the div's and buttons of bootstrap
//     // an apply the bootstrap there specifically.

//     content: [
//         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/views/**/*.blade.php',
//     ],

//     theme: {
//         extend: {
//             fontFamily: {
//                  sans: ['Figtree', ...defaultTheme.fontFamily.sans],
//                 //sans: ['Figtree', 'Arial', 'sans-serif'],
//             },
//             colors: {
//                 // Theme 1 - Dark Mode Theme
//                 admintheme: {
//                     //primary: '#ff6f61', // Soft Red: Primary color for admin elements like buttons, links
//                     primary: '#8a4f7d', // Purple: Primary color with a vintage vibe for main elements
//                     secondary: '#ff8f00', // Bright Orange: Secondary color for accents or highlights
//                     accent: '#ffd700', // Gold: Accent color for important elements or notifications
//                     neutral: '#1d1d1d', // Dark Gray: Neutral background color for deep contrast
//                     'base-100': '#2c2c2c', // Charcoal Gray: Base background color for dark theme
//                 },
//                 // Theme 2 - Light Blue Theme
//                 sellerandstock_keepertheme: {
//                     //primary: '#4f89dc',  // Light blue
//                     primary: '#8a4f7d', // Purple: Primary color with a vintage vibe for main elements
//                     secondary: '#f8b400',  // Yellow
//                     accent: '#00c7b7',  // Cyan
//                     neutral: '#f0f0f0',  // Light gray
//                     'base-100': '#ffffff',  // White background
//                 },
//                 // Theme 3 - Retro Theme
//                 visitortheme: {
//                     primary: '#8a4f7d', // Purple: Primary color with a vintage vibe for main elements
//                     secondary: '#f9cb9c', // Light Peach: Secondary color for softer accents or buttons
//                     accent: '#00bfae', // Turquoise: Bright accent color for highlighting important items
//                     neutral: '#3b3b3b', // Dark Gray: Neutral tone for deeper contrasts in the design
//                     'base-100': '#ffffff', // White: Base background for a clean and classic retro style
//                 },
//             },
//         },

//     },

//       // Disable Preflight (Tailwind base styles)
// //   corePlugins: {
// //     preflight: false, // Disables base styles (CSS reset)
// //   },

//     // daisyui: {
//     //                themes: [
//     //                "light", "dark", "retro",
//     //              ],
//     //         },

//     daisyui: {
//         themes: [
//           {
//             mytheme: {
//               "primary": "#a991f7",
//               "secondary": "#f6d860",
//               "accent": "#37cdbe",
//               "neutral": "#3d4451",
//               "base-100": "#ffffff",
//             },
//           },
//           "dark",
//           "retro",
//         ],
//       },

//     //plugins: [require('daisyui', 'flowbite/plugin'), forms],
//     plugins: [
//         require('daisyui'),  // Correct way to use DaisyUI
//         require('flowbite/plugin'),  // Correct way to use Flowbite plugin
//         forms
//       ],
// };

















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
