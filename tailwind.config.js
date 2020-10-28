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
              fotolightgray: '#ede9e9',
          },
          height: {
              '96': '24rem',
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
