import React from "react";
import PropType from "prop-types";

const Delete = ({ className }) => {
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
            d="M5.69687 1.48398L5.5 1.875H2.875C2.39102 1.875 2 2.26602 2 2.75C2 3.23398 2.39102 3.625 2.875 3.625H13.375C13.859 3.625 14.25 3.23398 14.25 2.75C14.25 2.26602 13.859 1.875 13.375 1.875H10.75L10.5531 1.48398C10.4055 1.18594 10.102 1 9.77109 1H6.47891C6.14805 1 5.84453 1.18594 5.69687 1.48398ZM13.375 4.5H2.875L3.45469 13.7695C3.49844 14.4613 4.07266 15 4.76445 15H11.4855C12.1773 15 12.7516 14.4613 12.7953 13.7695L13.375 4.5Z"
            fill="currentColor"
         />
      </svg>
   );
};

Delete.propTypes = {
   className: PropType.string,
};

export default Delete;
