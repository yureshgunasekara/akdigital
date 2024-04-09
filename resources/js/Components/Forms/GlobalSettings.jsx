import { useState } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import timeZoneData from "@/utils/data/time-zone";
import { Avatar, Button } from "@material-tailwind/react";
import InputDropdown from "@/Components/InputDropdown";
import UserCircle from "@/Components/Icons/UserCircle";
import TextArea from "@/Components/TextArea";

const GlobalSettings = ({ app }) => {
   const { name, email, logo, timezone, description, copyright } = app;

   const [imageUrl, setImageUrl] = useState(
      `/${logo}` === "/null" ? null : `/${logo}`
   );

   const { data, setData, post, errors, clearErrors } = useForm({
      name,
      email,
      logo: null,
      timezone,
      description,
      copyright,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("settings.global-update"));
   };

   // time zone values
   const keys = Object.keys(timeZoneData);
   const values = Object.values(timeZoneData);
   const timezoneList = values.map((item, index) => ({
      key: item,
      value: keys[index],
   }));

   const handleImageChange = (e) => {
      const files = e.target.files;
      if (files && files[0]) {
         setData("logo", files[0]);
         setImageUrl(URL.createObjectURL(files[0]));
      }
   };

   return (
      <Card className="max-w-[1000px] w-full mx-auto mb-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               Setup Global Settings
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="grid grid-cols-1 gap-7">
               <div className="flex flex-col md:flex-row">
                  <p className="max-w-[164px] w-full font-medium text-gray-500 mb-1">
                     App Logo
                  </p>
                  <div>
                     {imageUrl ? (
                        <Avatar
                           src={imageUrl}
                           alt="item-1"
                           size="xs"
                           variant="circular"
                           className="h-[100px] w-[100px]"
                        />
                     ) : (
                        <UserCircle className="h-[100px] w-[100px] text-blue-gray-500" />
                     )}
                     <div className="mt-1 flex items-center">
                        <label
                           htmlFor="formFileSm"
                           className="text12 font-medium text-gray-900 px-2.5 py-1.5 border border-gray-700 bg-gray-100 whitespace-nowrap"
                        >
                           Choose Photo
                        </label>
                        <input
                           hidden
                           id="formFileSm"
                           type="file"
                           onChange={handleImageChange}
                        />
                        <small className="ml-3 text-gray-500">
                           JPG, JPEG, PNG, SVG File, Maximum 2MB
                        </small>
                     </div>
                     {errors.logo && (
                        <p className="text-sm text-red-500 mt-1">
                           {errors.logo}
                        </p>
                     )}
                  </div>
               </div>
               <Input
                  name="name"
                  label="App Name"
                  value={data.name}
                  error={errors.name}
                  onChange={onHandleChange}
                  placeholder="Enter your app name"
                  fullWidth
                  flexLabel
                  required
               />

               <Input
                  name="email"
                  label="App Email Address"
                  value={data.email}
                  error={errors.email}
                  onChange={onHandleChange}
                  placeholder="Enter your app email address"
                  fullWidth
                  flexLabel
                  required
               />

               <InputDropdown
                  required
                  flexLabel
                  fullWidth
                  label="App Timezone"
                  error={errors.timezone}
                  defaultValue={timezone}
                  itemList={timezoneList}
                  onChange={(e) => setData("timezone", e.value)}
               />

               <TextArea
                  rows={3}
                  cols={10}
                  name="description"
                  label="App Description"
                  value={data.description}
                  error={errors.description}
                  onChange={onHandleChange}
                  placeholder="Enter the description text. (Show on footer)"
                  maxLength={300}
                  fullWidth
                  flexLabel
                  required
               />

               <Input
                  name="copyright"
                  label="App Copyright"
                  value={data.copyright}
                  error={errors.copyright}
                  onChange={onHandleChange}
                  placeholder="Enter the copy right text. (Show on footer)"
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
   );
};

export default GlobalSettings;
