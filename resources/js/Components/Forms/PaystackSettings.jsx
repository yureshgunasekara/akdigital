import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";
import Switch from "@/Components/Inputs/Switch";

const PaystackSettings = (props) => {
   const { active, key, secret } = props.paystack;
   const { data, setData, patch, errors, clearErrors } = useForm({
      allow_paystack: active,
      paystack_key: key,
      paystack_secret: secret,
   });

   const onHandleChange = (event) => {
      setData(
         event.target.name,
         event.target.type === "checkbox"
            ? event.target.checked
            : event.target.value
      );
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      patch(route("settings.paystack"));
   };

   return (
      <Card className="shadow-card max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Paystack Payment Gateway
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="paystack"
                  name="allow_paystack"
                  label="Allow Paystack Payment Gateway"
                  onChange={onHandleChange}
                  defaultChecked={JSON.parse(data.allow_paystack)}
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="paystack_key"
                  value={data.paystack_key}
                  error={errors.paystack_key}
                  placeholder="Enter paystack key"
                  onChange={onHandleChange}
                  label="Paystack Key"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="paystack_secret"
                  value={data.paystack_secret}
                  error={errors.paystack_secret}
                  placeholder="Enter your paystack secret"
                  onChange={onHandleChange}
                  label="Paystack Secret"
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

export default PaystackSettings;
