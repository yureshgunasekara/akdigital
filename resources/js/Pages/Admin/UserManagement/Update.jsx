import { useState } from "react";
import Card from "@/Components/Card";
import Input from "@/Components/Input";
import Breadcrumb from "@/Components/Breadcrumb";
import { Head, Link, useForm } from "@inertiajs/react";
import ProfileIcon from "@/Components/Icons/ProfileIcon";
import UserCircle from "@/Components/Icons/UserCircle";
import { Avatar, Button } from "@material-tailwind/react";
import InputDropdown from "@/Components/InputDropdown";
import Dashboard from "@/Layouts/Dashboard";

const Update = ({ user }) => {
   const { id, name, status, company, website, phone, image, role } = user;
   const [imageUrl, setImageUrl] = useState(
      `/${image}` === "/null" ? null : `/${image}`
   );

   const { data, setData, post, errors } = useForm({
      name: name,
      phone: phone,
      image: image,
      new_image: false,
      company: company,
      website: website,
      status: status,
      role: role,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      post(route("users.update", id));
   };

   const handleImageChange = (e) => {
      const files = e.target.files;
      if (files && files[0]) {
         setData("image", files[0]);
         setData("new_image", true);
         setImageUrl(URL.createObjectURL(files[0]));
      }
   };

   return (
      <>
         <Head title="Update user" />
         <Breadcrumb Icon={ProfileIcon} title="Update User" />

         <Card className="max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Update User Account
               </p>
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
                           JPG, JPEG, PNG, PDF, SVG File, Maximum 5MB
                        </small>
                     </div>
                  </div>
               </div>

               <div className="mb-6">
                  <Input
                     name="name"
                     fullWidth
                     value={data.name}
                     error={errors["name"]}
                     placeholder="Your full name"
                     onChange={onHandleChange}
                     label="Full Name"
                     flexLabel
                     required
                  />
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
               </div>

               <div className="mb-6">
                  <InputDropdown
                     required
                     fullWidth
                     flexLabel
                     label="Status"
                     error={errors["status"]}
                     defaultValue={data.status}
                     onChange={(e) => setData("status", e.value)}
                     itemList={[
                        { key: "Active", value: "active" },
                        { key: "Deactive", value: "deactive" },
                     ]}
                  />
               </div>

               <div className="mb-6">
                  <InputDropdown
                     required
                     fullWidth
                     flexLabel
                     label="Role"
                     error={errors["role"]}
                     defaultValue={data.role}
                     onChange={(e) => setData("role", e.value)}
                     itemList={[
                        { key: "User", value: "user" },
                        { key: "Admin", value: "admin" },
                     ]}
                  />
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
                  <Link href={route("users.admin")}>
                     <Button
                        variant="outlined"
                        color="white"
                        className="ml-4 capitalize text-gray-900 border-gray-900 text14"
                     >
                        Cancel
                     </Button>
                  </Link>
               </div>
            </form>
         </Card>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
