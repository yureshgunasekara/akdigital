import {
   Menu,
   Navbar,
   Avatar,
   MenuList,
   MenuItem,
   IconButton,
   MenuHandler,
} from "@material-tailwind/react";
import MenuIcon from "@/Components/Icons/Menu";
import Expand from "@/Components/Icons/Expand";
import UserCircle from "@/Components/Icons/UserCircle";
import { Link, usePage } from "@inertiajs/react";
import { setOpenSidenav, setMobileSidenav } from "@/context/AppContext";
import { useAppContext } from "@/hooks/useAppContext";
import { useState } from "react";

const DashboardNavbar = () => {
   const { props } = usePage();
   const { user } = props.auth;
   const [state, dispatch] = useAppContext();
   const { fixedNavbar, openSidenav, mobileSidenav } = state;
   const [isFullscreen, setIsFullscreen] = useState(false);

   const logout = async () => {
      const res = await axios.post("/logout");
      if (res.status === 200) window.location = "/";
   };

   const handleFullscreenToggle = () => {
      if (!isFullscreen) {
         document.documentElement.requestFullscreen();
      } else {
         document.exitFullscreen();
      }
      setIsFullscreen(!isFullscreen);
   };

   const navStyle = fixedNavbar
      ? "sticky top-0 md:top-6 z-40 shadow-card"
      : "px-0 py-1";

   return (
      <Navbar
         fullWidth
         blurred={fixedNavbar}
         color={fixedNavbar ? "white" : "transparent"}
         className={`rounded-b-xl md:rounded-xl transition-all ${navStyle}`}
      >
         <div className="flex justify-between gap-6 md:flex-row md:items-center">
            <div className="capitalize">
               <IconButton
                  variant="text"
                  color="blue-gray"
                  className="hidden md:block"
                  onClick={() => setOpenSidenav(dispatch, !openSidenav)}
               >
                  <MenuIcon />
               </IconButton>
               <IconButton
                  variant="text"
                  color="blue-gray"
                  className="block md:hidden"
                  onClick={() => setMobileSidenav(dispatch, !mobileSidenav)}
               >
                  <MenuIcon />
               </IconButton>
            </div>

            <div className="flex items-center">
               <IconButton
                  onClick={handleFullscreenToggle}
                  variant="text"
                  color="blue-gray"
                  className="mr-2 rounded-full"
               >
                  <Expand className="h-[18px] w-[18px]" />
               </IconButton>

               <Menu placement="bottom-end">
                  <MenuHandler>
                     <div>
                        {user && user.image ? (
                           <Avatar
                              src={`/${user.image}`}
                              alt="item-1"
                              size="xs"
                              variant="circular"
                              className="h-9 w-9 lg:mr-1 cursor-pointer"
                           />
                        ) : (
                           <UserCircle className="h-10 w-10 text-blue-gray-500 lg:m-1 cursor-pointer" />
                        )}
                     </div>
                  </MenuHandler>

                  <MenuList className="min-w-[140px]">
                     <MenuItem>
                        <a href="/">Home</a>
                     </MenuItem>
                     <MenuItem>
                        <Link href="/profile">Profile</Link>
                     </MenuItem>
                     <MenuItem onClick={logout}>Log Out</MenuItem>
                  </MenuList>
               </Menu>
            </div>
         </div>
      </Navbar>
   );
};

export default DashboardNavbar;
