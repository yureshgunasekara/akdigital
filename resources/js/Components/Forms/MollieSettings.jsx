import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button, Card } from "@material-tailwind/react";
import Switch from "@/Components/Inputs/Switch";

const MollieSettings = (props) => {
   const { active, key } = props.mollie;
   const { data, setData, patch, errors, clearErrors } = useForm({
      allow_mollie: active,
      mollie_key: key,
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
      patch(route("settings.mollie"));
   };

   return (
      <Card className="shadow-card max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Mollie Payment Gateway
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="mollie"
                  name="allow_mollie"
                  label="Allow Mollie Payment Gateway"
                  onChange={onHandleChange}
                  defaultChecked={JSON.parse(data.allow_mollie)}
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="mollie_key"
                  value={data.mollie_key}
                  error={errors.mollie_key}
                  placeholder="Enter mollie key"
                  onChange={onHandleChange}
                  label="Mollie Key"
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

export default MollieSettings;
