import { Head } from "@inertiajs/react";
import Dashboard from "@/Layouts/Dashboard";
import Setting from "@/Components/Icons/Setting";
import Breadcrumb from "@/Components/Breadcrumb";
import AddSocialLinks from "@/Components/AddSocialLinks";
import GlobalSettings from "@/Components/Forms/GlobalSettings";

const Global = (props) => {
   return (
      <>
         <Head title="Global Settings" />
         <Breadcrumb Icon={Setting} title="Global Settings" />

         <GlobalSettings app={props.app} />
         <AddSocialLinks socials={props.socials} />
      </>
   );
};

Global.layout = (page) => <Dashboard children={page} />;

export default Global;
