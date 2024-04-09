import React from "react";
import PropType from "prop-types";
const Calender = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M5.75 1.65625C5.75 1.29258 5.41563 1 5 1C4.58437 1 4.25 1.29258 4.25 1.65625V2.75H3C1.89688 2.75 1 3.53477 1 4.5V4.9375V6.25V13.25C1 14.2152 1.89688 15 3 15H13C14.1031 15 15 14.2152 15 13.25V6.25V4.9375V4.5C15 3.53477 14.1031 2.75 13 2.75H11.75V1.65625C11.75 1.29258 11.4156 1 11 1C10.5844 1 10.25 1.29258 10.25 1.65625V2.75H5.75V1.65625ZM2.5 6.25H13.5V13.25C13.5 13.4906 13.275 13.6875 13 13.6875H3C2.725 13.6875 2.5 13.4906 2.5 13.25V6.25Z"
                fill="#374151"
            />
        </svg>
    );
};
Calender.propTypes = {
    className: PropType.string,
};
export default Calender;
