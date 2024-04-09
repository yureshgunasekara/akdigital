import PropTypes from "prop-types";
import { Fragment, useEffect, useState } from "react";
import { Listbox, Transition } from "@headlessui/react";
import ArrowDown from "@/Components/Icons/ArrowDown";

const InputDropdown = (props) => {
   const {
      name,
      label,
      error,
      onChange,
      onBlur,
      required,
      className,
      flexLabel,
      fullWidth,
      defaultValue,
      itemList = [],
      dropdownListClass,
   } = props;

   const defaultSelect = itemList.find((item) => item.value === defaultValue);
   const [selected, setSelected] = useState(
      defaultSelect || { key: "", value: "" }
   );

   useEffect(() => {
      onChange(selected);
   }, [selected]);

   useEffect(() => {
      const select = itemList.find((item) => item.value === defaultValue);
      setSelected(select);
   }, [defaultValue]);

   const dropdownActive = (item) => {
      const active =
         item.value === selected.value
            ? "bg-gray-100 text-primary-500"
            : "text-gray-900";

      return `relative cursor-pointer select-none py-2 px-4 hover:bg-gray-25 hover:text-primary-500 ${active} ${dropdownListClass}`;
   };

   return (
      <div
         className={`flex flex-col items-start ${
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

         <div className="w-full">
            <Listbox name={name} value={selected.key} onChange={setSelected}>
               <div className={`relative ${fullWidth && "w-full"}`}>
                  <Listbox.Button
                     className={`text-left !border !border-gray-200 focus:!border-primary-500 h-10 px-2.5 rounded-md focus:outline-none w-full text-sm ${className}`}
                  >
                     <span className="block truncate">{selected.key}</span>
                     <span className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                        <ArrowDown className="w-3 h-3 text-gray-700" />
                     </span>
                  </Listbox.Button>

                  <Transition
                     as={Fragment}
                     enter="transition ease-out duration-200"
                     enterFrom="transform opacity-0 scale-95"
                     enterTo="transform opacity-100 scale-100"
                     leave="transition ease-in duration-75"
                     leaveFrom="transform opacity-100 scale-100"
                     leaveTo="transform opacity-0 scale-95"
                     className="z-20"
                  >
                     <Listbox.Options className="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                        {itemList.map((item, index) => {
                           return (
                              <Listbox.Option
                                 key={index}
                                 value={item}
                                 className={dropdownActive(item)}
                              >
                                 {item.key}
                              </Listbox.Option>
                           );
                        })}
                     </Listbox.Options>
                  </Transition>
               </div>
            </Listbox>
            {error && <p className="text-sm text-red-500 mt-1">{error}</p>}
         </div>
      </div>
   );
};

InputDropdown.propTypes = {
   name: PropTypes.string,
   label: PropTypes.string,
   onChange: PropTypes.func,
   onBlur: PropTypes.func,
   required: PropTypes.bool,
   flexLabel: PropTypes.bool,
   fullWidth: PropTypes.bool,
   itemList: PropTypes.array,
   className: PropTypes.string,
   defaultValue: PropTypes.string,
   dropdownListClass: PropTypes.string,
};

export default InputDropdown;
