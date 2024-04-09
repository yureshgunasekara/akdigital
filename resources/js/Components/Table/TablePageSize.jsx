import {
   Button,
   Menu,
   MenuHandler,
   MenuItem,
   MenuList,
} from "@material-tailwind/react";
import SimpleBar from "simplebar-react";
import ArrowDown from "../Icons/ArrowDown";
import { router } from "@inertiajs/react";

const TablePageSize = (props) => {
   const { pageData, dropdownList, className } = props;
   const { path, per_page, current_page } = pageData;

   const gotoPage = (current, size) => {
      router.get(`${path}?page=${current}&per_page=${size}`);
   };
   const menuItem = (e) => {
      return `text-center ${per_page === e && "bg-primary-50"}`;
   };

   return (
      <div className={`relative ${className}`}>
         <span className="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
            <ArrowDown className="w-3 h-3 text-gray-700" />
         </span>
         <Menu placement="bottom-end">
            <MenuHandler>
               <Button
                  ripple={false}
                  variant="text"
                  color="white"
                  className="text-start py-0 px-4 w-[72px] h-10 rounded-md text-gray-700 border border-gray-200 hover:border-primary-500"
               >
                  {per_page}
               </Button>
            </MenuHandler>
            <MenuList className="max-h-[200px] min-w-[72px] p-0 overflow-hidden">
               <SimpleBar style={{ maxHeight: "198px" }}>
                  {dropdownList.map((item) => (
                     <MenuItem
                        key={item}
                        value={item}
                        onClick={() => gotoPage(current_page, item)}
                        className={menuItem(item)}
                     >
                        {item}
                     </MenuItem>
                  ))}
               </SimpleBar>
            </MenuList>
         </Menu>
      </div>
   );
};

export default TablePageSize;
