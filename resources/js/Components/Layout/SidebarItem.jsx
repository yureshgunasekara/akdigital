import {
   Button,
   Accordion,
   Typography,
   AccordionBody,
   AccordionHeader,
} from "@material-tailwind/react";
import { Link, usePage } from "@inertiajs/react";
import SingleDot from "@/Components/Icons/SingleDot";

function Icon({ open }) {
   return (
      <svg
         xmlns="http://www.w3.org/2000/svg"
         className={`${
            open ? "rotate-0" : "-rotate-90"
         } h-3 w-3 transition-transform hover:text-white`}
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         strokeWidth={2}
      >
         <path
            strokeLinecap="round"
            strokeLinejoin="round"
            d="M19 9l-7 7-7-7"
         />
      </svg>
   );
}

const SidebarItem = (props) => {
   const {
      path,
      icon,
      name,
      active,
      children,
      compactSpace,
      compactHide,
      dropDown,
      handleOpen,
   } = props;

   const { url, app } = usePage();
   const activePath = (currentPath) => {
      return currentPath === url
         ? "bg-white text-primary-500"
         : "text-gray-700";
   };

   const itemButton = `${compactSpace} flex items-center hover:text-primary-500 hover:bg-white py-[14px] rounded-full`;

   return (
      <>
         {!children.length > 0 ? (
            <>
               {active ? (
                  <Link href={`${path}`}>
                     <Button
                        variant="text"
                        color="white"
                        className={`${itemButton} ${activePath(path)}`}
                        fullWidth
                     >
                        {icon}
                        <span
                           className={`${compactHide} font-normal capitalize text-sm ml-4 whitespace-nowrap`}
                        >
                           {name}
                        </span>
                     </Button>
                  </Link>
               ) : (
                  <Button
                     disabled
                     variant="text"
                     color="white"
                     className={`${itemButton} ${activePath(path)}`}
                     fullWidth
                  >
                     {icon}
                     <span
                        className={`${compactHide} font-normal capitalize text-sm ml-4 whitespace-nowrap`}
                     >
                        {name}
                     </span>
                  </Button>
               )}
            </>
         ) : (
            <Accordion open={dropDown(path)}>
               <AccordionHeader
                  className="border-0 nav-accordion group p-0"
                  onClick={() => handleOpen(path)}
               >
                  <div
                     className={`${itemButton} w-full justify-between  ${
                        dropDown(path) && "text-primary-500"
                     }`}
                  >
                     <div className="flex items-center capitalize">
                        {icon}
                        <Typography
                           color="inherit"
                           className={`${compactHide} font-normal text-sm ml-4 whitespace-nowrap`}
                        >
                           {name}
                        </Typography>
                     </div>
                     <Icon
                        id={1}
                        open={dropDown(path)}
                        className={compactHide}
                     />
                  </div>
               </AccordionHeader>
               <AccordionBody className="pt-0 pb-2">
                  {children.map((item, ind) => (
                     <Link key={ind} href={`${path}${item.path}`}>
                        <Button
                           variant="text"
                           color="white"
                           className={`${itemButton} ${activePath(
                              `${path}${item.path}`
                           )} px-[22px]`}
                           fullWidth
                        >
                           <SingleDot className="mr-[22px]" />
                           <Typography
                              color="inherit"
                              className="font-normal capitalize text-sm"
                           >
                              {item.name}
                           </Typography>
                        </Button>
                     </Link>
                  ))}
               </AccordionBody>
            </Accordion>
         )}
      </>
   );
};

export default SidebarItem;
