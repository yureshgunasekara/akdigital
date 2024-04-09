import SimpleBar from "simplebar-react";
import { usePage } from "@inertiajs/react";
import MobileSidebar from "./MobileSidebar";
import DesktopSidebar from "./DesktopSidebar";
import DashboardNavbar from "./DashboardNavbar";
import { error, warning, success } from "@/utils/toast";

const Dashboard = ({ children }) => {
   const { props } = usePage();

   if (props.flash.error) error(props.flash.error);
   if (props.flash.warning) warning(props.flash.warning);
   if (props.flash.success) success(props.flash.success);

   return (
      <main className="h-screen bg-[#F5F5F5] flex">
         <DesktopSidebar />
         <MobileSidebar />

         <SimpleBar
            style={{ height: "100vh" }}
            className="px-6 py-0 md:py-6 overflow-x-auto w-full"
         >
            <DashboardNavbar />

            <div className="pt-6 pb-12 md:pb-6">{children}</div>
         </SimpleBar>
      </main>
   );
};

export default Dashboard;
