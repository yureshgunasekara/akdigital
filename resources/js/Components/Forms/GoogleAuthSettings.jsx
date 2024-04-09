import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import Switch from "@/Components/Inputs/Switch";

const GoogleAuthSettings = (props) => {
   const { active, client_id, client_secret, redirect_url } = props.google;
   const { data, setData, patch, errors, clearErrors } = useForm({
      google_login_allow: active,
      google_client_id: client_id,
      google_client_secret: client_secret,
      google_redirect: redirect_url,
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
      patch(route("settings.auth-google"));
   };

   return (
      <Card className="max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Google Auth Settings
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="mb-7 md:pl-[164px]">
               <Switch
                  switchId="google"
                  name="google_login_allow"
                  label="Allow Google Login"
                  onChange={onHandleChange}
                  defaultChecked={JSON.parse(data.google_login_allow)}
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="google_client_id"
                  value={data.google_client_id}
                  error={errors.google_client_id}
                  placeholder="Enter your google client id"
                  onChange={onHandleChange}
                  label="Google Client Id"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="google_client_secret"
                  value={data.google_client_secret}
                  error={errors.google_client_secret}
                  placeholder="Enter your google client secret"
                  onChange={onHandleChange}
                  label="Google Client Secret"
                  flexLabel
                  required
               />
            </div>

            <div className="mb-7">
               <Input
                  fullWidth
                  name="google_redirect"
                  value={data.google_redirect}
                  error={errors.google_redirect}
                  placeholder="Enter your google redirect url"
                  onChange={onHandleChange}
                  label="Google Redirect Url"
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

export default GoogleAuthSettings;
