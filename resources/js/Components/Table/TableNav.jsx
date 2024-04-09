import axios from "axios";
import Search from "@/Components/Icons/Search";
import TablePageSize from "@/Components/Table/TablePageSize";
import debounce from "@/utils/debounce";
import { usePage } from "@inertiajs/react";
import TableDataExport from "./TableDataExport";

const TableNav = (props) => {
   const {
      data,
      title,
      component,
      globalSearch,
      tablePageSizes,
      setSearchData,
      searchPath,
      exportPath,
   } = props;

   const page = usePage();

   const searchHandler = debounce(async (e) => {
      const query = e.target.value;
      const res = await axios.get(
         `${searchPath}?page=1&per_page=10&value=${query}`
      );
      setSearchData(res.data);
   }, 300);

   return (
      <div className="p-7 md:flex items-center justify-between">
         {title && (
            <p className="mb-4 md:mb-0 text18 font-bold text-gray-900">
               {title}
            </p>
         )}
         <div className="flex flex-col sm:flex-row justify-end items-center gap-3">
            {globalSearch && (
               <div className="w-full md:max-w-[260px] relative">
                  <input
                     type="text"
                     placeholder="Search"
                     onChange={searchHandler}
                     className="h-10 pl-12 pr-4 py-[15px] border border-gray-200 rounded-md w-full focus:ring-0 focus:outline-0 focus:border-primary-500 text-sm font-normal text-gray-500"
                  />
                  <Search className="absolute w-4 h-4 top-3 left-4 text-gray-700 z-10" />
               </div>
            )}

            <div className="w-full sm:w-auto flex items-center justify-between gap-3">
               <TablePageSize pageData={data} dropdownList={tablePageSizes} />

               {page.props.auth.user.role === "admin" && exportPath && (
                  <TableDataExport route={exportPath} />
               )}

               {component && component}
            </div>
         </div>
      </div>
   );
};

export default TableNav;
