import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { Head, useForm } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Setting from "@/Components/Icons/Setting";
import { Button } from "@material-tailwind/react";
import InputDropdown from "@/Components/InputDropdown";
import Dashboard from "@/Layouts/Dashboard";

const SMTP = (props) => {
   const {
      host,
      port,
      username,
      password,
      sender_email,
      sender_name,
      encryption,
   } = props.smtp;

   const { data, setData, put, errors, clearErrors } = useForm({
      host: host,
      port: port,
      encryption: encryption,
      username: username,
      password: password,
      from_address: sender_email,
      from_name: sender_name,
      admin_email: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      put(route("settings.smtp-update"));
   };

   return (
      <>
         <Head title="SMTP Settings" />
         <Breadcrumb Icon={Setting} title="SMTP Settings" />

         <Card className="max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Setup SMTP Settings
               </p>
            </div>

            <form onSubmit={submit} className="p-7">
               <div className="grid grid-cols-1 gap-7">
                  <InputDropdown
                     required
                     flexLabel
                     fullWidth
                     name="mailer"
                     label="Mailer"
                     defaultValue="smtp"
                     itemList={[{ key: "SMTP", value: "smtp" }]}
                     onChange={(e) => e}
                  />

                  <Input
                     type="password"
                     name="host"
                     label="SMTP Host"
                     value={data.host}
                     error={errors.host}
                     onChange={onHandleChange}
                     placeholder="Your smtp host"
                     fullWidth
                     flexLabel
                     required
                  />
                  <Input
                     type="number"
                     name="port"
                     label="SMTP Port"
                     value={data.port}
                     error={errors.port}
                     onChange={onHandleChange}
                     placeholder="Your smtp port"
                     fullWidth
                     flexLabel
                     required
                  />

                  <Input
                     type="password"
                     name="username"
                     label="SMTP Username"
                     value={data.username}
                     error={errors.username}
                     onChange={onHandleChange}
                     placeholder="Your smtp username"
                     fullWidth
                     flexLabel
                     required
                  />

                  <Input
                     type="password"
                     name="password"
                     label="SMTP Password"
                     value={data.password}
                     error={errors.password}
                     onChange={onHandleChange}
                     placeholder="Your smtp password"
                     fullWidth
                     flexLabel
                     required
                  />

                  <Input
                     name="from_address"
                     label="Sender Email Address"
                     value={data.from_address}
                     error={errors.from_address}
                     onChange={onHandleChange}
                     placeholder="Sender email address"
                     fullWidth
                     flexLabel
                     required
                  />

                  <Input
                     name="from_name"
                     label="Sender Name"
                     value={data.from_name}
                     error={errors.from_name}
                     onChange={onHandleChange}
                     placeholder="Email seder name"
                     fullWidth
                     flexLabel
                     required
                  />

                  <InputDropdown
                     required
                     flexLabel
                     fullWidth
                     label="SMTP Encryption"
                     error={errors.encryption}
                     defaultValue={
                        data.encryption.length > 0 ? data.encryption : "tls"
                     }
                     itemList={[
                        { key: "TLS", value: "tls" },
                        { key: "SSL", value: "ssl" },
                     ]}
                     onChange={(e) => setData("encryption", e.value)}
                  />

                  <Input
                     type="email"
                     name="admin_email"
                     label="Admin Email"
                     value={data.admin_email}
                     error={errors.admin_email}
                     onChange={onHandleChange}
                     placeholder="Admin email for smtp connection check"
                     fullWidth
                     flexLabel
                     required
                  />
               </div>

               <div className="flex items-center mt-7 md:pl-[164px]">
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
      </>
   );
};

SMTP.layout = (page) => <Dashboard children={page} />;

export default SMTP;
