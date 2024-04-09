import React from "react";
import PropType from "prop-types";

const ParagraphGenerator = ({ className }) => {
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
                d="M13.5 1H5.97182C4.61556 1 3.29367 1.57438 2.34741 2.58594C1.40209 3.59375 0.917715 4.95313 1.01147 6.33125C1.18334 8.9875 3.50617 11 6.17182 11H7.99996V14.5C7.99996 14.775 8.22493 15 8.49996 15C8.77499 15 8.99996 14.775 8.99996 14.5V2H11V14.5C11 14.775 11.2249 15 11.5 15C11.775 15 12 14.775 12 14.5V2H13.5C13.775 2 14 1.775 14 1.5C14 1.225 13.775 1 13.5 1ZM7.97183 10H5.97182C3.76086 10 1.97179 8.21094 1.97179 6C1.97179 3.78906 3.76086 2 5.97182 2H7.97183V10Z"
                fill="currentColor"
            />
        </svg>
    );
};

ParagraphGenerator.propTypes = {
    className: PropType.string,
};

export default ParagraphGenerator;
