import { useEffect } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import GuestLayout from "@/Layouts/GuestLayout";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";

export default function ResetPassword(props) {
   const { token, email } = props;
   const { data, setData, post, errors, reset, wasSuccessful } = useForm({
      token: token,
      email: email,
      password: "",
      password_confirmation: "",
   });

   useEffect(() => {
      return () => {
         reset("password", "password_confirmation");
      };
   }, []);

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      post(route("password.store"));
   };

   return (
      <>
         <Head title="Reset Password" />

         <Card className="shadow-card max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Reset Your Password
               </p>
            </div>
            <form onSubmit={submit} className="grid grid-cols-1 gap-7 p-7">
               <Input
                  type="email"
                  name="email"
                  label="Account Email"
                  value={data.email}
                  onChange={onHandleChange}
                  placeholder="Your account email"
                  error={errors["email"]}
                  flexLabel
                  fullWidth
                  required
                  disabled
               />
               <Input
                  type="password"
                  name="password"
                  label="Password"
                  value={data.password}
                  onChange={onHandleChange}
                  placeholder="Enter your new password"
                  error={errors["password"]}
                  flexLabel
                  fullWidth
                  required
               />
               <Input
                  type="password"
                  name="password_confirmation"
                  label="Confirm Password"
                  value={data.password_confirmation}
                  onChange={onHandleChange}
                  placeholder="Enter your confirm password"
                  flexLabel
                  fullWidth
                  required
               />

               <div className="flex items-center mt-4 md:pl-[164px]">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
                  >
                     Save Changes
                  </Button>
               </div>
            </form>
         </Card>
      </>
   );
}

ResetPassword.layout = (page) => <GuestLayout children={page} />;
