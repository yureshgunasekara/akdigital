import React from "react";
import PropType from "prop-types";

const Expand = ({ className }) => {
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
                d="M5 1H2C1.44719 1 1 1.44719 1 2V5C1 5.55281 1.44719 6 2 6C2.55281 6 3 5.55281 3 5V3H5C5.55281 3 6 2.55281 6 2C6 1.44719 5.55313 1 5 1ZM14 10C13.4472 10 13 10.4472 13 11V13H11C10.4472 13 10 13.4472 10 14C10 14.5528 10.4472 15 11 15H14C14.5528 15 15 14.5528 15 14V11C15 10.4469 14.5531 10 14 10Z"
                fill="#374151"
            />
            <path
                opacity="0.4"
                d="M14 1H11C10.4472 1 10 1.44719 10 2C10 2.55281 10.4472 3 11 3H13V5C13 5.55281 13.4472 6 14 6C14.5528 6 15 5.55281 15 5V2C15 1.44719 14.5531 1 14 1ZM5 13H3V11C3 10.4472 2.55281 10 2 10C1.44719 10 1 10.4472 1 11V14C1 14.5528 1.44719 15 2 15H5C5.55281 15 6 14.5528 6 14C6 13.4472 5.55313 13 5 13Z"
                fill="#374151"
            />
        </svg>
    );
};

Expand.propTypes = {
    className: PropType.string,
};

export default Expand;
