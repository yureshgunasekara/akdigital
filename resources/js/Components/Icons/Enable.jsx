import PropType from "prop-types";

const Enable = ({ className }) => {
   return (
      <svg
         xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 512 512"
         className={className}
         fill="currentColor"
      >
         <path
            className="fa-primary"
            d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 448C362 448 448 362 448 256C448 149.1 362 64 256 64C149.1 64 64 149.1 64 256C64 362 149.1 448 256 448z"
         />
      </svg>
   );
};

Enable.propTypes = {
   className: PropType.string,
};

export default Enable;
