import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import SaveDocument from "@/Components/Icons/SaveDocument";
import CodeViewer from "@/Components/CodeViewer";
import Dashboard from "@/Layouts/Dashboard";

const Update = (props) => {
   return (
      <>
         <Head title="Notifications" />
         <Breadcrumb Icon={SaveDocument} title="Update Document" />
         <div className="max-w-[920px] w-full mx-auto">
            <CodeViewer
               request="DELETE"
               codeInfo={props.code}
               parentClass="min-h-[calc(100vh-268px)]"
               childClass="min-h-[calc(100vh-438px)] !m-0"
            />
         </div>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
