import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";

const ChangePassword = () => {
   const { data, setData, post, processing, errors, clearErrors } = useForm({
      current_password: "",
      password: "",
      password_confirmation: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("password.change"));
   };

   return (
      <Card className="shadow-card max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">Change Password</p>
         </div>
         <form onSubmit={submit} className="p-7">
            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="current_password"
                  label="Current Password"
                  value={data.current_password}
                  error={errors.current_password}
                  placeholder="Enter your current password"
                  onChange={onHandleChange}
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="password"
                  label="New Password"
                  value={data.password}
                  error={errors.password}
                  placeholder="Enter your new password"
                  onChange={onHandleChange}
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  type="password"
                  name="password_confirmation"
                  value={data.password_confirmation}
                  placeholder="Retype your new password"
                  onChange={onHandleChange}
                  label="Re-type Password"
                  flexLabel
                  required
               />
            </div>

            <div className="flex items-center mt-6 md:pl-[164px]">
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
   );
};

export default ChangePassword;
