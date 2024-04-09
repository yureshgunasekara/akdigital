import Input from "@/Components/Input";
import { useForm, usePage } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";

const ChangeEmail = () => {
   const { props } = usePage();
   const { email } = props.auth.user;

   const { data, setData, post, errors, clearErrors } = useForm({
      current_email: email,
      new_email: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("change.email"));
   };

   return (
      <Card className="shadow-card max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">Change Email</p>
         </div>
         <form onSubmit={submit} className="p-7">
            <div className="mb-7">
               <Input
                  fullWidth
                  type="email"
                  name="current_email"
                  value={data.current_email}
                  error={errors.current_email}
                  placeholder="Enter your current email"
                  onChange={onHandleChange}
                  label="Current Email"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  type="email"
                  name="new_email"
                  value={data.new_email}
                  error={errors.new_email}
                  placeholder="Enter your new email"
                  onChange={onHandleChange}
                  label="New Email"
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
                  Get Email Change Link
               </Button>
            </div>
         </form>
      </Card>
   );
};

export default ChangeEmail;
