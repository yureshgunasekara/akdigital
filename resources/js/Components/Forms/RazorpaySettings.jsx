import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import Switch from "@/Components/Inputs/Switch";
import { Button } from "@material-tailwind/react";

const RazorpaySettings = (props) => {
   const { active, key, secret } = props.razorpay;
   const { data, setData, patch, errors, clearErrors } = useForm({
      allow_razorpay: active,
      razorpay_key: key,
      razorpay_secret: secret,
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
      patch(route("settings.razorpay"));
   };

   return (
      <Card className="max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Razorpay Payment Gateway
            </p>
         </div>
         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="razorpay"
                  name="allow_razorpay"
                  label="Allow Razorpay Payment Gateway"
                  defaultChecked={JSON.parse(data.allow_razorpay)}
                  onChange={onHandleChange}
               />
            </div>
            <div className="mb-7">
               <Input
                  fullWidth
                  name="razorpay_key"
                  value={data.razorpay_key}
                  error={errors.razorpay_key}
                  placeholder="Enter your razorpay api key"
                  onChange={onHandleChange}
                  label="Razorpay Api Key"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="razorpay_secret"
                  value={data.razorpay_secret}
                  error={errors.razorpay_secret}
                  placeholder="Enter your razorpay api secret"
                  onChange={onHandleChange}
                  label="Razorpay Api Secret"
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

export default RazorpaySettings;
