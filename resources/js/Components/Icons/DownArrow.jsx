import React from "react";
import PropType from "prop-types";
const DownArrow = () => {
    return (
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M4.19225 10.1594C4.32045 10.0309 4.48778 9.96803 4.6562 9.96803C4.82462 9.96803 4.99195 10.0321 5.12018 10.1603L7.71842 12.7596V1.6562C7.71842 1.29392 8.01371 1 8.37461 1C8.73551 1 9.0308 1.29392 9.0308 1.6562V12.7596L11.629 10.1613C11.8854 9.90501 12.3005 9.90501 12.557 10.1613C12.8135 10.4177 12.8133 10.8328 12.557 11.0893L8.83859 14.8078C8.58227 15.0641 8.16709 15.0641 7.91063 14.8078L4.19222 11.0893C3.93592 10.832 3.93592 10.4164 4.19225 10.1594Z"
                fill="#374151"
            />
        </svg>
    );
};
DownArrow.propTypes = {
    className: PropType.string,
};
export default DownArrow;
