import Breadcrumb from "@/Components/Breadcrumb";
import UserCircle from "@/Components/Icons/UserCircle";
import Users from "@/Components/Icons/Users";
import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";
import Dashboard from "@/Layouts/Dashboard";
import { Head, useForm } from "@inertiajs/react";
import { Avatar, Button, Card } from "@material-tailwind/react";
import React, { useState } from "react";

const Update = ({ testimonial }) => {
   const { id, name, image, designation, rating, comment } = testimonial;
   const [imageUrl, setImageUrl] = useState(
      `/${image}` === "/null" ? null : `/${image}`
   );

   const { data, setData, post, errors, clearErrors } = useForm({
      image: null,
      name: name || "",
      designation: designation || "",
      rating: rating || "",
      comment: comment || "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("testimonial.update", id));
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
         <Head title="Testimonial Update" />
         <Breadcrumb Icon={Users} title="Testimonial Update" />

         <Card className="max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Add New Testimonial
               </p>
            </div>
            <form onSubmit={submit} className="p-7">
               <div className="flex flex-col md:flex-row mb-12">
                  <p className="max-w-[164px] w-full font-medium text-gray-500 mb-1">
                     Profile Image
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
                           type="file"
                           id="formFileSm"
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
                     fullWidth
                     name="name"
                     value={data.name}
                     error={errors.name}
                     placeholder="Name of client or customer"
                     onChange={onHandleChange}
                     label="Full Name"
                     flexLabel
                     required
                  />
               </div>

               <div className="mb-6">
                  <Input
                     fullWidth
                     name="designation"
                     value={data.designation}
                     error={errors.designation}
                     placeholder="Designation of client or customer"
                     onChange={onHandleChange}
                     label="Designation"
                     flexLabel
                     required
                  />
               </div>

               <div className="mb-6">
                  <Input
                     fullWidth
                     type="number"
                     name="rating"
                     value={data.rating}
                     error={errors.rating}
                     placeholder="Rating of client or customer"
                     onChange={onHandleChange}
                     label="Rating"
                     flexLabel
                     required
                  />
               </div>

               <div className="mb-6">
                  <TextArea
                     rows={4}
                     fullWidth
                     name="comment"
                     value={data.comment}
                     error={errors.comment}
                     placeholder="Review of customer or client"
                     onChange={onHandleChange}
                     label="Review"
                     maxLength={180}
                     flexLabel
                     required
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
               </div>
            </form>
         </Card>
      </>
   );
};

Update.layout = (page) => <Dashboard children={page} />;

export default Update;
