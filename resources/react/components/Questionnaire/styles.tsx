import { StylesConfig } from "react-select";

export const customStyles: StylesConfig = {
  control: (defaultStyles) => ({
    ...defaultStyles,
    width: '120px',
    borderRadius: '25px',
    padding: '5px',
    fontFamily: "var(--font-family)",
    fontWeight: "400",
    fontSize: "16px",
    borderColor: 'none',
    boxShadow: 'none',
    outline: 'none',
    border: '2px solid var(--3)',
    ':active': {
      // ...defaultStyles[':active'],
      borderColor: 'none',
      boxShadow: 'none',
      outline: 'none',
      border: '2px solid var(--3)',
    },
    ':hover': {
      // ...defaultStyles[':hover'],
      borderColor: 'none',
      boxShadow: 'none',
      outline: 'none',
      border: '2px solid var(--3)',
    }
  }),
  option: (defaultStyles) => ({
    ...defaultStyles,
    width: '100%',
    borderRadius: '25px',
    padding: '5px',
    fontFamily: "var(--font-family)",
    fontWeight: "400",
    fontSize: "16px",
    textAlign: 'center',
  }),
  menu: (defaultStyles) => ({
    ...defaultStyles,

    maxHeight: '150px', 
    overflowY: 'auto', 
    // borderRadius: '25px',
    padding: '5px',
  }),
}