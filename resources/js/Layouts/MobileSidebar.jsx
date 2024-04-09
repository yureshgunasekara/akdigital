import routes from "@/routes";
import SimpleBar from "simplebar-react";
import { useEffect, useState } from "react";
import { usePage } from "@inertiajs/react";
import SidebarItem from "@/Components/Layout/SidebarItem";
import { Avatar, IconButton } from "@material-tailwind/react";
import { useAppContext } from "@/hooks/useAppContext";
import LeftArrow from "@/Components/Icons/LeftArrow";
import { setMobileSidenav } from "@/context/AppContext";
import SidebarItemMobile from "@/Components/Layout/SidebarItemMobile";

const MobileSidebar = () => {
   const { url, props } = usePage();
   const { user } = props.auth;
   const { name, logo } = props.app;
   const [open, setOpen] = useState(null);
   const [state, dispatch] = useAppContext();
   const { mobileSidenav } = state;

   const handleOpen = (value) => {
      if (value === open) {
         setOpen(null);
      } else {
         setOpen(value);
      }
   };

   const dropDown = (name) => {
      if (open === name) {
         return true;
      } else {
         return false;
      }
   };

   useEffect(() => {
      const path = url.split("/");
      if (path.length > 2) {
         if (path[1] === "admin") {
            const activePath = `/${path[1]}/${path[2]}`;
            setOpen(activePath);
            dropDown(activePath);
         } else {
            const activePath = `/${path[1]}`;
            setOpen(activePath);
            dropDown(activePath);
         }
      }
   }, [url]);

   const sidebarWidth = mobileSidenav ? "w-[260px]" : "w-0";

   return (
      <section className="block md:hidden max-w-[0px] inset-0 z-50 h-full w-full transition-all duration-300 relative">
         <div
            className={`${sidebarWidth} overflow-x-hidden transition-all duration-300 absolute top-0 left-0 h-full bg-gray-25`}
         >
            <div className="py-6 flex items-center justify-between">
               <a href="/" className="flex items-center gap-4 pl-6">
                  <Avatar src={`/${logo}`} size="sm" />
                  <p className="block text22 font-bold whitespace-nowrap">
                     {name}
                  </p>
               </a>
               <IconButton
                  variant="text"
                  color="white"
                  className="bg-gray-200 hover:bg-gray-200 active:bg-gray-200 w-6 h-9 text-gray-500 rounded-r-none"
                  onClick={() => setMobileSidenav(dispatch, !mobileSidenav)}
               >
                  <LeftArrow />
               </IconButton>
            </div>

            <SimpleBar style={{ height: "calc(100vh - 86px)" }}>
               <div className="m-4">
                  {routes.map(({ role, title, pages }, key) => {
                     if (user.role === "user" && role === "admin") return;
                     return (
                        <ul key={key} className="mb-4 flex flex-col gap-1">
                           <li className="block mx-3.5 mt-2 mb-5">
                              <small className=" font-medium">{title}</small>
                           </li>
                           {pages.map(
                              ({ icon, name, path, active, children = [] }) => (
                                 <li key={name}>
                                    <SidebarItemMobile
                                       path={path}
                                       icon={icon}
                                       name={name}
                                       active={active}
                                       children={children}
                                       compactSpace="px-6"
                                       compactHide="block"
                                       dropDown={dropDown}
                                       handleOpen={handleOpen}
                                    />
                                 </li>
                              )
                           )}
                        </ul>
                     );
                  })}
               </div>
            </SimpleBar>
         </div>
      </section>
   );
};

export default MobileSidebar;
