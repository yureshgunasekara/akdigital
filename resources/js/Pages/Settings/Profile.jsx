import { useState } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { Head, useForm } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import ProfileIcon from "@/Components/Icons/ProfileIcon";
import UserCircle from "@/Components/Icons/UserCircle";
import { Avatar, Button } from "@material-tailwind/react";
import Dashboard from "@/Layouts/Dashboard";

const Profile = (props) => {
   const { name, company, website, phone, image } = props.auth.user;
   const [imageUrl, setImageUrl] = useState(
      `/${image}` === "/null" ? null : `/${image}`
   );

   const { data, setData, post, errors, clearErrors } = useForm({
      name: name || "",
      phone: phone || "",
      image: image || "",
      company: company || "",
      website: website || "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("settings.profile.update"));
   };

   const handleImageChange = (e) => {
      const files = e.target.files;
      if (files && files[0]) {
         setData("image", files[0]);
         setImageUrl(URL.createObjectURL(files[0]));
      }
   };

   return (
      <>
         <Head title="Profile settings" />
         <Breadcrumb Icon={ProfileIcon} title="Profile Settings" />

         <Card className="max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">Edit Profile</p>
            </div>
            <form onSubmit={submit} className="p-7">
               <div className="flex flex-col md:flex-row mb-12">
                  <p className="max-w-[164px] w-full font-medium text-gray-500 mb-1">
                     Profile Picture
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
                     {errors.image && (
                        <p className="text-sm text-red-500 mt-1">
                           {errors.image}
                        </p>
                     )}
                  </div>
               </div>

               <div className="mb-6">
                  <Input
                     name="name"
                     fullWidth
                     value={data.name}
                     placeholder="Your full name"
                     onChange={onHandleChange}
                     label="Full Name"
                     flexLabel
                     required
                  />
                  {errors.name && (
                     <p className="text-sm text-red-500 mt-1">{errors.name}</p>
                  )}
               </div>

               <div className="mb-6">
                  <Input
                     fullWidth
                     name="phone"
                     value={data.phone}
                     placeholder="Your phone number"
                     onChange={onHandleChange}
                     label="Phone"
                     flexLabel
                  />
                  {errors.phone && (
                     <p className="text-sm text-red-500 mt-1">{errors.phone}</p>
                  )}
               </div>

               <div className="mb-6">
                  <Input
                     name="company"
                     fullWidth
                     value={data.company}
                     placeholder="Your company name"
                     onChange={onHandleChange}
                     label="Company"
                     flexLabel
                  />
                  {errors.company && (
                     <p className="text-sm text-red-500 mt-1">
                        {errors.company}
                     </p>
                  )}
               </div>

               <div className="mb-6">
                  <Input
                     fullWidth
                     name="website"
                     value={data.website}
                     placeholder="Your website address"
                     onChange={onHandleChange}
                     label="Website"
                     flexLabel
                  />
                  {errors.website && (
                     <p className="text-sm text-red-500 mt-1">
                        {errors.website}
                     </p>
                  )}
               </div>

               <div className="flex items-center mt-10 md:pl-[164px]">
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
      </>
   );
};

Profile.layout = (page) => <Dashboard children={page} />;

export default Profile;
