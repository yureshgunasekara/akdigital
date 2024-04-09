import axios from "axios";
import Dashboard from "@/Layouts/Dashboard";
import { Head, router } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Control from "@/Components/Icons/Control";
import { Button } from "@material-tailwind/react";
import { useEffect, useState } from "react";
import { Dialog } from "@material-tailwind/react";

const AppControl = ({ version }) => {
   const [appUpdate, setAppUpdate] = useState(false);
   const [appUpdating, setAppUpdating] = useState(false);
   const [appVersion, setAppVersion] = useState();

   useEffect(() => {
      axios.get("/version/check").then(({ data }) => setAppVersion(data));
   }, []);

   const appUpdateHandler = () => {
      if (appVersion?.update_available) {
         setAppUpdate(false);
         setAppUpdating(true);
         router.get("/version/update");
      }
   };

   return (
      <>
         <Head title="App Control" />
         <Breadcrumb Icon={Control} title="App Control" />

         <div className="">
            <p className="font-medium">
               {"Current installed version: "}
               <span className="font-normal">{version}</span>
            </p>
            <p className="font-medium mt-4 mb-8">
               {"Available latest version: "}
               <span className="font-normal">
                  {appVersion?.version ?? "..."}
               </span>
            </p>

            <Button
               type="submit"
               color="white"
               onClick={() => setAppUpdate(true)}
               disabled={appVersion?.update_available ? false : true}
               className="capitalize bg-primary-500 text-white text-sm !rounded-lg px-5"
            >
               Update App Version
            </Button>
         </div>

         <Dialog
            size="xs"
            open={appUpdate}
            handler={() => setAppUpdate(false)}
            className="px-6 py-10 max-h-[calc(100vh-80px)] overflow-y-auto text-gray-800"
         >
            <h6 className="text-red-500 text-center text-xl mb-10">
               Are you sure to update the current version?
            </h6>
            <div className="flex items-center justify-center">
               <Button
                  color="red"
                  className="py-2 font-medium capitalize text-base mr-6"
                  onClick={() => setAppUpdate(false)}
               >
                  <span>Cancel</span>
               </Button>
               <Button
                  type="submit"
                  color="white"
                  onClick={appUpdateHandler}
                  className="capitalize bg-primary-500 text-white text-sm !rounded-lg px-5 py-2.5"
               >
                  Update
               </Button>
            </div>
         </Dialog>

         <Dialog
            size="sm"
            open={appUpdating}
            handler={() => null}
            className="bg-transparent border-none outline-none shadow-none"
         >
            <div className="bg-warning-100 text-gray-900 p-4 rounded-md">
               <p className="text-justify font-medium mb-6">
                  Your app is currently undergoing an automatic update. This
                  process will take a few minutes. Please don't refresh your
                  page or don't turn off your device. Just stay with this
                  process.
               </p>
               <div className="relative w-full bg-gray-200 rounded-full">
                  <div className="shim-blue top-0 h-4 w-full relative overflow-hidden bg-primary-500 rounded-full"></div>
               </div>
            </div>
         </Dialog>
      </>
   );
};

AppControl.layout = (page) => <Dashboard children={page} />;

export default AppControl;
