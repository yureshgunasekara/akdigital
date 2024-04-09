import { useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import Switch from "@/Components/Inputs/Switch";

const FacebookAuthSettings = (props) => {
   const { data, setData, patch, processing, errors, reset } = useForm({
      facebook_login_allow: props.facebookLoginAllow,
      facebook_client_id: props.facebookClientId,
      facebook_client_secret: props.facebookClientSecret,
      facebook_redirect: props.facebookRedirect,
   });

   const onHandleChange = (event) => {
      setData(
         event.target.name,
         event.target.type === "checkbox"
            ? `${event.target.checked}`
            : event.target.value
      );
   };

   const submit = (e) => {
      e.preventDefault();
      patch(route("settings.auth-facebook"));
   };

   return (
      <Card className="max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Facebook Auth Settings
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="facebook"
                  name="facebook_login_allow"
                  label="Allow Facebook Login"
                  onChange={onHandleChange}
                  defaultChecked={JSON.parse(data.facebook_login_allow)}
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="facebook_client_id"
                  value={data.facebook_client_id}
                  placeholder="Enter your facebook client id"
                  onChange={onHandleChange}
                  label="Facebook Client Id"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="facebook_client_secret"
                  value={data.facebook_client_secret}
                  placeholder="Enter your facebook client secret"
                  onChange={onHandleChange}
                  label="Facebook Client Secret"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="facebook_redirect"
                  value={data.facebook_redirect}
                  placeholder="Enter your facebook redirect url"
                  onChange={onHandleChange}
                  label="Facebook Redirect Url"
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

export default FacebookAuthSettings;
