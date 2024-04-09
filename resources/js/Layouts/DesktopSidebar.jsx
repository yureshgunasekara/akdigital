import routes from "@/routes";
import SimpleBar from "simplebar-react";
import { useEffect, useState } from "react";
import { usePage } from "@inertiajs/react";
import { useAppContext } from "@/hooks/useAppContext";
import SidebarItem from "@/Components/Layout/SidebarItem";
import { Avatar } from "@material-tailwind/react";

const DesktopSidebar = () => {
   const { url, props } = usePage();
   const { user } = props.auth;
   const { name, logo, openai_key, aws_key, aws_secret } = props.app;

   const [open, setOpen] = useState(null);
   const [compact, setCompact] = useState(false);
   const [state] = useAppContext();
   const { openSidenav } = state;

   const handleOpen = (value) => {
      if (value === open) {
         setOpen(null);
      } else {
         setOpen(value);
      }
   };

   useEffect(() => {
      if (openSidenav) setCompact(false);
      else setCompact(true);
   }, [openSidenav]);

   const sideNavWidth = openSidenav ? "max-w-[260px]" : "max-w-[100px]";
   const scrollbarWidth = openSidenav ? "w-[260px]" : "w-[100px]";
   const compactHide = !openSidenav && compact ? "hidden" : "block";
   const compactSpace = !openSidenav && compact ? "px-6" : "px-4";
   const dropDown = (name) => {
      if (!openSidenav && compact) {
         return false;
      } else if (open === name) {
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

   // Activate or deactivate of AI features based on key
   routes.map((route) => {
      route.pages.map((page) => {
         if (
            (page.path === "/templates") |
            (page.path === "/ai-images") |
            (page.path === "/ai-chats") |
            (page.path === "/ai-code") |
            (page.path === "/speech-to-text") |
            (page.path === "/text-to-speech")
         ) {
            if (!openai_key) {
               page.active = false;
            } else {
               page.active = true;
            }
            return page;
         }

         return page;
      });

      return route;
   });

   return (
      <section
         className={`hidden md:block ${sideNavWidth} inset-0 z-50 h-full w-full transition-all duration-300 relative`}
      >
         <SimpleBar
            className={`${scrollbarWidth} hover:w-[260px] overflow-x-hidden transition-all duration-300 absolute top-0 left-0 h-full bg-gray-25`}
            onMouseEnter={() => setCompact(false)}
            onMouseLeave={() => setCompact(true)}
         >
            <a href="/" className="flex items-center gap-4 py-6 px-8">
               <Avatar src={`/${logo}`} size="sm" />
               <p
                  className={`${compactHide} text22 font-bold whitespace-nowrap`}
               >
                  {name}
               </p>
            </a>

            <div className="m-4">
               {routes.map(({ role, title, pages }, key) => {
                  if (user.role === "user" && role === "admin") return;
                  return (
                     <ul key={key} className="mb-4 flex flex-col gap-1">
                        <li className={`${compactHide} mx-3.5 mt-2 mb-5`}>
                           <small className=" font-medium">{title}</small>
                        </li>
                        {pages.map(
                           ({ icon, name, path, active, children = [] }) => (
                              <li key={name}>
                                 <SidebarItem
                                    path={path}
                                    icon={icon}
                                    name={name}
                                    active={active}
                                    children={children}
                                    compactSpace={compactSpace}
                                    compactHide={compactHide}
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
      </section>
   );
};

export default DesktopSidebar;
