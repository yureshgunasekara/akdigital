import { useEffect, useRef, useState } from "react";

const TextArea = (props) => {
   const {
      rows,
      cols,
      name,
      value,
      label,
      error,
      maxLength,
      onChange,
      className,
      fullWidth,
      placeholder,
      flexLabel,
      required,
   } = props;

   const [lengthOver, setLengthOver] = useState(false);
   useEffect(() => {
      maxLength && value && value.length >= maxLength
         ? setLengthOver(true)
         : setLengthOver(false);
   }, [value]);

   const textAreaRef = useRef();
   useEffect(() => {
      if (maxLength) {
         textAreaRef.current.maxLength = parseInt(maxLength);
      }
   }, []);

   return (
      <div
         className={`relative flex flex-col items-start ${
            flexLabel && "md:flex-row md:items-center"
         } ${fullWidth && "w-full"}`}
      >
         {label && (
            <>
               {flexLabel ? (
                  <small className="max-w-[164px] w-full mb-1 whitespace-nowrap flex items-center font-medium text-gray-500">
                     <span className="mr-1">{label}</span>
                     {required && <span className="block text-red-500">*</span>}
                  </small>
               ) : (
                  <small className="w-full mb-1 whitespace-nowrap flex items-center font-medium text-gray-500">
                     <span className="mr-1">{label}</span>
                     {required && <span className="block text-red-500">*</span>}
                  </small>
               )}
            </>
         )}
         {maxLength && (
            <small className="absolute top-0 right-0 w-full text-end">
               {value ? value.length : 0}/{maxLength}
            </small>
         )}

         <div className="w-full">
            <textarea
               name={name}
               value={value}
               rows={rows || 3}
               cols={cols || 10}
               className={`rounded-md w-full text-sm px-2.5 py-2 focus:ring-0 border-none outline outline-1 ${
                  lengthOver
                     ? "outline-red-500 focus:outline-red-500"
                     : "outline-gray-200 focus:outline-primary-500"
               } ${fullWidth && "w-full"}`}
               placeholder={placeholder}
               onChange={onChange}
               required={required}
               ref={textAreaRef}
            ></textarea>

            {lengthOver && (
               <p className="text-sm text-red-500 mt-1">
                  Max length should be less or equal {maxLength}
               </p>
            )}
            {error && <p className="text-sm text-red-500 mt-1">{error}</p>}
         </div>
      </div>
   );
};

export default TextArea;
