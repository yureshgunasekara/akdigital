import React from "react";
import PropType from "prop-types";

const Spinner = ({ className }) => {
   return (
      <div
         className={`inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-primary-500 motion-reduce:animate-[spin_1.5s_linear_infinite] ${className}`}
         role="status"
      >
         <span className="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">
            Loading...
         </span>
      </div>
   );
};

Spinner.propTypes = {
   className: PropType.string,
};

export default Spinner;
