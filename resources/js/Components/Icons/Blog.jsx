import React from "react";
import PropType from "prop-types";

const Blog = ({ className }) => {
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
                d="M5 7C4.725 7 4.5 7.225 4.5 7.5C4.5 7.775 4.725 8 5 8C6.65437 8 8 9.34563 8 11C8 12.6544 6.65437 14 5 14C3.34563 14 2 12.6544 2 11V3.5C2 3.225 1.77625 3 1.5 3C1.22375 3 1 3.225 1 3.5V11C1 13.2056 2.79406 15 5 15C7.20594 15 9 13.2056 9 11C9 8.79437 7.20625 7 5 7ZM6.5 1C6.225 1 6 1.22375 6 1.5C6 1.77625 6.225 2 6.5 2C10.6344 2 14 5.36562 14 9.5C14 9.77637 14.2236 10 14.5 10C14.7764 10 15 9.775 15 9.5C15 4.8125 11.1594 1 6.5 1ZM6.5 4C6.225 4 6 4.225 6 4.5C6 4.775 6.225 5 6.5 5C8.98125 5 11 7.01875 11 9.5C11 9.77637 11.2236 10 11.5 10C11.7764 10 12 9.775 12 9.5C12 6.44062 9.53125 4 6.5 4Z"
                fill="currentColor"
            />
        </svg>
    );
};

Blog.propTypes = {
    className: PropType.string,
};

export default Blog;
