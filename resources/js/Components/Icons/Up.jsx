import React from "react";
import PropType from "prop-types";
const Up = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M2.25566 9.72498L7.43754 5.23232C7.59436 5.06907 7.7989 5 8.00004 5C8.20118 5 8.40505 5.06869 8.56255 5.20602L13.7444 9.69867C14.0726 9.98515 14.0864 10.4619 13.7764 10.7639C13.4653 11.0681 12.9452 11.0788 12.6193 10.7933L7.99996 6.7622L3.38059 10.7933C3.05461 11.0788 2.53683 11.068 2.22353 10.7639C1.91373 10.491 1.92736 10.0138 2.25566 9.72498Z"
                fill="#374151"
            />
        </svg>
    );
};
Up.propTypes = {
    className: PropType.string,
};
export default Up;
