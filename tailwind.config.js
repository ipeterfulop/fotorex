module.exports = {
  theme: {
      // fontFamily: {
      //     display: ['Montserrat', 'sans-serif'],
      //     body: ['Montserrat', 'sans-serif'],
      // },
      letterSpacing: {
          'normal': '.36px',
          'wide': '.47px',
          'wider': '.8px',
      },
      extend: {
          colors: {
              fotored: '#eb5858',
              fotoverylightred: '#fef7f3',
              fotoblue: '#333745',
              fotogray: '#9e9fa3',
              fotomediumgray: '#d3dbdc',
              fotolightgray: '#ede9e9',
          },
          height: {
              '14': '3.5rem',
              '18': '4.5rem',
              '36': '9rem',
              '72': '18rem',
              '80': '20rem',
              '96': '24rem',
              '100': '25rem',
              '128': '32rem',
              '160': '40rem',
              '192': '48rem',
          }
      }
  },
  variants: {
      backgroundColor: ['responsive', 'hover', 'odd'],
      color: ['responsive', 'hover'],
  },
  plugins: []
}
