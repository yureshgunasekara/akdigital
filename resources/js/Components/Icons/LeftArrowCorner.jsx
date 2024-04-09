import React from "react";
import PropType from "prop-types";

const LeftArrowCorner = ({ className }) => {
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
                d="M14.7938 2.19526L3.38122 13.5773L11.4996 13.6034C11.8889 13.6034 12.1996 13.9177 12.1996 14.3017C12.1602 14.6901 11.8846 15 11.4996 15L1.69997 14.9714C1.31241 14.9695 1 14.6596 1 14.2712V4.52578C1 4.14172 1.31306 3.82749 1.69997 3.82749C2.08688 3.82749 2.39995 4.14172 2.39995 4.52578V12.5822L13.8051 1.20457C14.0786 0.931808 14.5217 0.931808 14.7947 1.20457C15.0677 1.47734 15.0694 1.92031 14.7938 2.19526Z"
                fill="currentColor"
            />
        </svg>
    );
};

LeftArrowCorner.propTypes = {
    className: PropType.string,
};
export default LeftArrowCorner;
