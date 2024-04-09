import axios from "axios";
import Card from "@/Components/Card";
import GuestLayout from "@/Layouts/GuestLayout";
import { Button } from "@material-tailwind/react";
import { Head, useForm } from "@inertiajs/react";

export default function VerifyEmail({ status }) {
   const { post } = useForm({});

   const submit = (e) => {
      e.preventDefault();
      post(route("verification.send"));
   };

   const logout = async () => {
      const res = await axios.post("/logout");
      if (res.status === 200) window.location = "/";
   };

   return (
      <>
         <Head title="Email Verification" />

         <Card className="max-w-[600px] w-full mx-auto p-7">
            <div className="mb-7 text-sm text-gray-600">
               Thanks for signing up! Before getting started, could you verify
               your email address by clicking on the link we just emailed to
               you? If you didn't receive the email, we will gladly send you
               another.
            </div>

            {status === "verification-link-sent" && (
               <div className="mb-7 font-medium text-sm text-success-600">
                  A new verification link has been sent to the email address you
                  provided during registration.
               </div>
            )}

            <form onSubmit={submit}>
               <div className="flex items-center justify-between">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
                  >
                     Resend Verification Email
                  </Button>

                  <Button
                     variant="text"
                     color="white"
                     onClick={logout}
                     className="border border-gray-900 text-gray-900 font-medium capitalize rounded-md text14"
                  >
                     Log Out
                  </Button>
               </div>
            </form>
         </Card>
      </>
   );
}

VerifyEmail.layout = (page) => <GuestLayout children={page} />;
