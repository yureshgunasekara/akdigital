import DoubleArrow from "@/Components/Icons/DoubleArrow";
import PropType from "prop-types";

const TableHead = ({ className, headerGroups }) => {
   return (
      <>
         {headerGroups.map((headerGroup) => (
            <tr {...headerGroup.getHeaderGroupProps()}>
               {headerGroup.headers.map((column) => (
                  <th
                     {...column.getHeaderProps(column.getSortByToggleProps())}
                     className={`px-7 py-4 bg-gray-50 text-start last:text-end text-sm text-gray-500 font-bold ${className}`}
                  >
                     <span className="whitespace-nowrap relative pr-4">
                        {column.render("Header")}
                        <DoubleArrow className="w-3 h-3 ml-1 absolute right-0 top-1/2 transform -translate-y-1/2" />
                     </span>
                  </th>
               ))}
            </tr>
         ))}
      </>
   );
};

TableHead.propType = {
   className: PropType.string,
   headerGroups: PropType.array,
};

export default TableHead;
