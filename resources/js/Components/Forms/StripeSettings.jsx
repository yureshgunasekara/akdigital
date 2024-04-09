import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import Switch from "@/Components/Inputs/Switch";
import { Button } from "@material-tailwind/react";

const StripeSettings = (props) => {
   const { active, key, secret } = props.stripe;

   const { data, setData, patch, errors, clearErrors } = useForm({
      allow_stripe: active,
      stripe_key: key,
      stripe_secret: secret,
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
      patch(route("settings.stripe"));
   };

   return (
      <Card className="max-w-[1000px] w-full mx-auto">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Stripe Payment Gateway
            </p>
         </div>
         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="stripe"
                  name="allow_stripe"
                  label="Allow Stripe Payment Gateway"
                  defaultChecked={JSON.parse(data.allow_stripe)}
                  onChange={onHandleChange}
               />
            </div>
            <div className="mb-7">
               <Input
                  fullWidth
                  name="stripe_key"
                  value={data.stripe_key}
                  error={errors.stripe_key}
                  placeholder="Enter your stripe api key"
                  onChange={onHandleChange}
                  label="Stripe Api Key"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="stripe_secret"
                  value={data.stripe_secret}
                  error={errors.stripe_secret}
                  placeholder="Enter your stripe api secret"
                  onChange={onHandleChange}
                  label="Stripe Api Secret"
                  flexLabel
                  required
               />
            </div>

            <div className="flex items-center mt-6 md:pl-[164px]">
               <Button
                  type="submit"
                  variant="text"
                  color="white"
                  className={`bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14`}
               >
                  Save Changes
               </Button>
            </div>
         </form>
      </Card>
   );
};

export default StripeSettings;
