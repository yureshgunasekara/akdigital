import React from "react";
import PropType from "prop-types";
const Quotetion = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M15 9.25C15 11.3219 13.3219 13 11.25 13H11C10.4469 13 10 12.5531 10 12C10 11.4469 10.4469 11 11 11H11.25C12.2156 11 13 10.2156 13 9.25V9H11C9.89688 9 9 8.10312 9 7V5C9 3.89688 9.89688 3 11 3H13C14.1031 3 15 3.89688 15 5V6V7V9.25ZM7 9.25C7 11.3219 5.32188 13 3.25 13H3C2.44687 13 2 12.5531 2 12C2 11.4469 2.44687 11 3 11H3.25C4.21562 11 5 10.2156 5 9.25V9H3C1.89688 9 1 8.10312 1 7V5C1 3.89688 1.89688 3 3 3H5C6.10312 3 7 3.89688 7 5V6V7V9.25Z"
                fill="#374151"
            />
        </svg>
    );
};
Quotetion.propTypes = {
    className: PropType.string,
};
export default Quotetion;
