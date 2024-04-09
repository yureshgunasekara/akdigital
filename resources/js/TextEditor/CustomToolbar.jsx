import React from "react";
import formats from "./ToolbarOptions.js";

const renderOptions = (formatData, index) => {
   const { className, options } = formatData;

   return (
      <select key={index} className={className}>
         <option selected="selected"></option>
         {options.map((value, ind) => {
            return <option key={ind} value={value}></option>;
         })}
      </select>
   );
};

const renderSingle = (formatData, index) => {
   const { className, value } = formatData;
   return <button key={index} className={className} value={value}></button>;
};

const CustomToolbar = () => (
   <div id="toolbar">
      {formats.map((classes, index) => {
         return (
            <span key={index} className="ql-formats">
               {classes.map((formatData, index) => {
                  return formatData.options
                     ? renderOptions(formatData, index)
                     : renderSingle(formatData, index);
               })}
            </span>
         );
      })}
   </div>
);

export default CustomToolbar;
