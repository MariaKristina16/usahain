/**
 * Tailwind CSS Configuration
 * Usahain Landing Page Design System
 * 
 * Maps CSS variables from design spec to Tailwind utilities.
 * Color palette: blue-900, blue-700, blue-500, cta, sky-200, etc.
 */

module.exports = {
  content: [
    './application/views/**/*.php',
    './application/controllers/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        // Primary brand colors
        'brand-dark': '#0f3246',    // --blue-900
        'brand-mid': '#1b5676',     // --blue-700
        'brand': '#2b8bb0',         // --blue-500
        
        // CTA / Accent
        'cta': '#4ec1f2',           // --cta
        'cta-dark': '#2aa1d6',      // --cta-dark
        
        // Backgrounds & Neutrals
        'sky': '#bfe9fb',           // --sky-200
        'card': '#ffffff',          // --card-bg
        'muted': '#f5f8fa',         // --muted
        
        // Text colors
        'text-900': '#052631',      // --text-900
        'text-700': '#23546a',      // --text-700
        'text-500': '#5d7f8c',      // --text-500
        
        // Accents
        'accent-warm': '#ffb74d',   // --accent-warm
      },
      
      borderRadius: {
        'card': '16px',             // --radius-card
        'stat': '12px',             // --radius-stat
      },
      
      spacing: {
        'xs': '4px',
        'sm': '8px',
        'md': '16px',
        'lg': '24px',
        'xl': '32px',
        'xxl': '48px',
      },
      
      fontSize: {
        // Typography scale
        'h1-mobile': '28px',
        'h1-desktop': '48px',
        'h2-mobile': '20px',
        'h2-desktop': '28px',
        'body-mobile': '16px',
        'body-desktop': '18px',
        'small': '14px',
      },
      
      fontFamily: {
        // Primary font with fallbacks
        'poppins': '"Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial',
      },
      
      boxShadow: {
        'card': '0 4px 16px rgba(11,35,49,0.06)',
        'card-hover': '0 10px 30px rgba(11,35,49,0.08)',
      },
      
      animation: {
        'fade-in': 'fadeIn 0.4s ease-in-out',
      },
      
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', transform: 'translateY(8px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },
  plugins: [],
}
