import React from "react";
import PropType from "prop-types";

const ProductName = ({ className }) => {
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
                d="M11.7 1C12.4906 1 13.2062 1.46563 13.5281 2.18781L14.8281 5.1125C14.9406 5.36875 15 5.64375 15 5.925V13C15 14.1031 14.1031 15 13 15H3C1.89531 15 1 14.1031 1 13V5.925C1 5.64375 1.05872 5.36875 1.17237 5.1125L2.47219 2.18781C2.79313 1.46531 3.50937 1 4.3 1H11.7ZM11.7 2H8.5V5H13.6844L12.6156 2.59375C12.4531 2.23281 12.0969 2 11.7 2ZM14 6H2V13C2 13.5531 2.44781 14 3 14H13C13.5531 14 14 13.5531 14 13V6ZM2.31656 5H7.5V2H4.3C3.90469 2 3.54656 2.23281 3.38594 2.59375L2.31656 5Z"
                fill="currentColor"
            />
        </svg>
    );
};

ProductName.propTypes = {
    className: PropType.string,
};

export default ProductName;
