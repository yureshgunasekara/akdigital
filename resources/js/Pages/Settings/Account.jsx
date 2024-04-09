import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import ChangePassword from "@/Components/Forms/ChangePassword";
import ForgetPassword from "@/Components/Forms/ForgetPassword";
import ProfileIcon from "@/Components/Icons/ProfileIcon";
import Dashboard from "@/Layouts/Dashboard";
import ChangeEmail from "@/Components/Forms/ChangeEmail";

const Account = (props) => {
   const { email } = props.auth.user;

   return (
      <>
         <Head title="Account settings" />
         <Breadcrumb Icon={ProfileIcon} title="Account Settings" />

         <ForgetPassword errors={props.errors} email={email} />
         <ChangePassword errors={props.errors} />
         <ChangeEmail />
      </>
   );
};

Account.layout = (page) => <Dashboard children={page} />;

export default Account;
