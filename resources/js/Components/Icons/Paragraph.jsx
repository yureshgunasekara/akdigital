import React from "react";
import PropType from "prop-types";
const Paragraph = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M1 6C1 3.2375 3.40962 1 6.38462 1H8.53846H14.1923C14.6399 1 15 1.33437 15 1.75C15 2.16563 14.6399 2.5 14.1923 2.5H12.8462V14.25C12.8462 14.6656 12.4861 15 12.0385 15C11.5909 15 11.2308 14.6656 11.2308 14.25V2.5H9.61539V14.25C9.61539 14.6656 9.25529 15 8.80769 15C8.3601 15 8 14.6656 8 14.25V11H6.38462C3.40962 11 1 8.7625 1 6ZM8 9.5V2.5H6.38462C4.30144 2.5 2.61538 4.06562 2.61538 6C2.61538 7.93438 4.30144 9.5 6.38462 9.5H8Z"
                fill="#374151"
            />
        </svg>
    );
};
Paragraph.propTypes = {
    className: PropType.string,
};
export default Paragraph;
