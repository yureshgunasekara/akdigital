import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";
import Switch from "@/Components/Inputs/Switch";

const PaypalSettings = (props) => {
   const { active, key, secret } = props.paypal;
   const { data, setData, patch, errors, clearErrors } = useForm({
      allow_paypal: active,
      paypal_client_id: key,
      paypal_client_secret: secret,
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
      patch(route("settings.paypal"));
   };

   return (
      <Card className="shadow-card max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Paypal Payment Gateway
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="paypal"
                  name="allow_paypal"
                  label="Allow Paypal Payment Gateway"
                  onChange={onHandleChange}
                  defaultChecked={JSON.parse(data.allow_paypal)}
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="paypal_client_id"
                  value={data.paypal_client_id}
                  error={errors.paypal_client_id}
                  placeholder="Enter paypal client id"
                  onChange={onHandleChange}
                  label="Paypal Client Id"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="paypal_client_secret"
                  value={data.paypal_client_secret}
                  error={errors.paypal_client_secret}
                  placeholder="Enter your paypal client secret"
                  onChange={onHandleChange}
                  label="Paypal Client Secret"
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

export default PaypalSettings;
