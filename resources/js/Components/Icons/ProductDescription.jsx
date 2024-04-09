import React from "react";
import PropType from "prop-types";

const ProductDescription = ({ className }) => {
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
                d="M8 5.75C8.41406 5.75 8.75 5.41438 8.75 5C8.75 4.58594 8.41406 4.25 8 4.25C7.58594 4.25 7.25 4.58437 7.25 5C7.25 5.41563 7.58437 5.75 8 5.75ZM13 1H3C1.89531 1 1 1.89531 1 3V13C1 14.1047 1.89531 15 3 15H13C14.1047 15 15 14.1047 15 13V3C15 1.89531 14.1031 1 13 1ZM14 13C14 13.5512 13.5512 14 13 14H3C2.44875 14 2 13.5512 2 13V3C2 2.44875 2.44875 2 3 2H13C13.5512 2 14 2.44875 14 3V13ZM9.5 11H8.5V7.5C8.5 7.225 8.275 7 8 7H7C6.725 7 6.5 7.225 6.5 7.5C6.5 7.775 6.725 8 7 8H7.5V11H6.5C6.225 11 6 11.225 6 11.5C6 11.775 6.225 12 6.5 12H9.5C9.77613 12 10 11.7761 10 11.5C10 11.225 9.775 11 9.5 11Z"
                fill="currentColor"
            />
        </svg>
    );
};

ProductDescription.propTypes = {
    className: PropType.string,
};

export default ProductDescription;
