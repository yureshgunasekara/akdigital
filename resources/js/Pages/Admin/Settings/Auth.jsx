import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Setting from "@/Components/Icons/Setting";
import GoogleAuthSettings from "@/Components/Forms/GoogleAuthSettings";
import Dashboard from "@/Layouts/Dashboard";

const Auth = (props) => {
   return (
      <>
         <Head title="Auth Settings" />
         <Breadcrumb Icon={Setting} title="Auth Settings" />

         <GoogleAuthSettings google={props.google} />

         {/* <FacebookAuthSettings
        facebookLoginAllow={facebookLoginAllow}
        facebookClientId={facebookClientId}
        facebookClientSecret={facebookClientSecret}
        facebookRedirect={facebookRedirect}
        /> */}
      </>
   );
};

Auth.layout = (page) => <Dashboard children={page} />;

export default Auth;
