import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";

const ForgetPassword = ({ email }) => {
   const { data, setData, post, processing, errors, clearErrors } = useForm({
      email: email,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("password.email"));
   };

   return (
      <Card className="shadow-card max-w-[1000px] w-full mx-auto">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">Forget Password</p>
         </div>
         <form onSubmit={submit} className="p-7">
            <div className="mb-7">
               <Input
                  fullWidth
                  type="email"
                  name="email"
                  value={data.email}
                  errors={errors.email}
                  placeholder="Enter your email"
                  onChange={onHandleChange}
                  label="Email Address"
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
                  Get Password Reset Link
               </Button>
            </div>
         </form>
      </Card>
   );
};

export default ForgetPassword;
