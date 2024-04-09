import React from "react";
import PropType from "prop-types";
const RightCornerArrow = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M15 1.72756V11.4735C15 11.8595 14.6869 12.1718 14.3 12.1718C13.9131 12.1718 13.6 11.8595 13.6 11.4735V3.41662L2.19427 14.7949C2.05821 14.9302 1.87883 15 1.6999 15C1.52096 15 1.34167 14.9318 1.20508 14.7954C0.93164 14.5226 0.93164 14.0805 1.20508 13.8081L12.6195 2.42117L4.49948 2.39696C4.11098 2.39533 3.7986 2.08109 3.79991 1.69701C3.80128 1.31101 4.11439 1 4.49992 1L14.3 1.02864C14.6894 1.03099 15 1.34349 15 1.72756Z"
                fill="#374151"
            />
        </svg>
    );
};
RightCornerArrow.propTypes = {
    className: PropType.string,
};
export default RightCornerArrow;
