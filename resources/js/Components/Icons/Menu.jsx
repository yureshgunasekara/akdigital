import React from "react";
import PropType from "prop-types";

const Menu = ({ className }) => {
   return (
      <svg
         width="16"
         height="16"
         viewBox="0 0 16 16"
         fill="none"
         xmlns="http://www.w3.org/2000/svg"
         className={className}
      >
         <path
            d="M1 8H9.33333"
            stroke="#374151"
            strokeWidth="2"
            strokeLinecap="round"
         />
         <path
            d="M1 3L15 3M1 13H12.5"
            stroke="#374151"
            strokeWidth="2"
            strokeLinecap="round"
         />
      </svg>
   );
};

Menu.propTypes = {
   className: PropType.string,
};

export default Menu;
