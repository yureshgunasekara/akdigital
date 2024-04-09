import PropType from "prop-types";

const EditFill = ({ className }) => {
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
            d="M10.9274 1.51321L9.60264 2.83799L13.1609 6.39627L14.4857 5.07149C15.17 4.38721 15.17 3.27867 14.4857 2.59438L13.4073 1.51321C12.723 0.828929 11.6144 0.828929 10.9302 1.51321H10.9274ZM8.98405 3.45658L2.60377 9.83959C2.31911 10.1243 2.11109 10.4773 1.99613 10.8633L1.02718 14.1561C0.958753 14.3887 1.02171 14.6378 1.19141 14.8075C1.36111 14.9772 1.61019 15.0402 1.84011 14.9745L5.13289 14.0055C5.51883 13.8906 5.87192 13.6825 6.15658 13.3979L12.5423 7.01486L8.98405 3.45658Z"
            fill="currentColor"
         />
      </svg>
   );
};

EditFill.propType = {
   className: PropType.string,
};

export default EditFill;
