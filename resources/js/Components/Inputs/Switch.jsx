import PropType from "prop-types";

const Switch = (props) => {
   const {
      switchId,
      name,
      label,
      labelClass,
      onChange,
      defaultChecked,
      checked,
      required,
   } = props;

   return (
      <label
         htmlFor={switchId}
         className="group flex items-center cursor-pointer"
      >
         <div className="relative">
            <input
               name={name}
               id={switchId}
               role="switch"
               type="checkbox"
               className="sr-only"
               onChange={onChange}
               required={required}
               checked={checked}
               defaultChecked={defaultChecked}
            />
            <div className="container block bg-gray-300 w-11 h-6 rounded-full"></div>
            <div className="dot absolute left-[0.11rem] top-[0.1rem] bg-white w-5 h-5 rounded-full transition"></div>
         </div>
         {label && (
            <small
               className={`whitespace-nowrap text-gray-500 font-medium pl-4 ${labelClass}`}
            >
               {label}
            </small>
         )}
      </label>
   );
};

Switch.propTypes = {
   name: PropType.string,
   label: PropType.string,
   labelClass: PropType.string,
   switchId: PropType.string,
   onChange: PropType.func,
   checked: PropType.bool,
   defaultChecked: PropType.bool,
   required: PropType.bool,
};

export default Switch;
