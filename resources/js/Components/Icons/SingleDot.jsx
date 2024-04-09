import React from "react";
import PropType from "prop-types";

const SingleDot = ({ className }) => {
    return (
        <svg
            width="4"
            height="4"
            viewBox="0 0 4 4"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            className={className}
        >
            <circle cx="2" cy="2" r="2" fill="currentColor" />
        </svg>
    );
};

SingleDot.propTypes = {
    className: PropType.string,
};

export default SingleDot;
