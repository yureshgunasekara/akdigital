import React from "react";
import PropType from "prop-types";

const AlignCenter = (props) => {
    const { className } = props;
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
                d="M4.75 2C4.33437 2 4 2.29258 4 2.65625C4 3.01992 4.33437 3.3125 4.75 3.3125H11.25C11.6656 3.3125 12 3.01992 12 2.65625C12 2.29258 11.6656 2 11.25 2H4.75ZM1.75 5.5C1.33437 5.5 1 5.79258 1 6.15625C1 6.51992 1.33437 6.8125 1.75 6.8125H14.25C14.6656 6.8125 15 6.51992 15 6.15625C15 5.79258 14.6656 5.5 14.25 5.5H1.75ZM4 9.65625C4 10.0199 4.33437 10.3125 4.75 10.3125H11.25C11.6656 10.3125 12 10.0199 12 9.65625C12 9.29258 11.6656 9 11.25 9H4.75C4.33437 9 4 9.29258 4 9.65625ZM1.75 12.5C1.33437 12.5 1 12.7926 1 13.1562C1 13.5199 1.33437 13.8125 1.75 13.8125H14.25C14.6656 13.8125 15 13.5199 15 13.1562C15 12.7926 14.6656 12.5 14.25 12.5H1.75Z"
                fill="#374151"
            />
        </svg>
    );
};

AlignCenter.propTypes = {
    className: PropType.string,
};

export default AlignCenter;
