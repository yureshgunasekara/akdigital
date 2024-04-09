import React from "react";
import PropType from "prop-types";
const Italic = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M6 1.75C6 1.33437 6.33437 1 6.75 1H13.25C13.6656 1 14 1.33437 14 1.75C14 2.16563 13.6656 2.5 13.25 2.5H11.1031L6.52187 13.5H9.25C9.66563 13.5 10 13.8344 10 14.25C10 14.6656 9.66563 15 9.25 15H2.75C2.33437 15 2 14.6656 2 14.25C2 13.8344 2.33437 13.5 2.75 13.5H4.89687L9.47813 2.5H6.75C6.33437 2.5 6 2.16563 6 1.75Z"
                fill="#374151"
            />
        </svg>
    );
};
Italic.propTypes = {
    className: PropType.string,
};
export default Italic;
