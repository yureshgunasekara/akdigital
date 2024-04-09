import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import SaveDocument from "@/Components/Icons/SaveDocument";
import DocumentUpdateEditor from "@/TextEditor/DocumentUpdateEditor";
import Dashboard from "@/Layouts/Dashboard";

const Update = (props) => {
   return (
      <>
         <Head title="Notifications" />
         <Breadcrumb Icon={SaveDocument} title="Update Document" />
         <div className="max-w-[920px] w-full mx-auto">
            <DocumentUpdateEditor document={props.document} />
         </div>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
