import { useEffect, useState } from "react";
import { Avatar, Button, Card, Dialog } from "@material-tailwind/react";
import CirclePlus from "./Icons/CirclePlus";
import { useForm } from "@inertiajs/react";
import UserCircle from "./Icons/UserCircle";
import Input from "./Input";
import UpdateSocialLink from "./UpdateSocialLinks";

const AddSocialLinks = ({ socials }) => {
   const [open, setOpen] = useState(false);
   const handleOpen = () => setOpen(!open);
   const [imageUrl, setImageUrl] = useState(null);

   const { data, setData, post, reset, errors, clearErrors, wasSuccessful } =
      useForm({
         name: "",
         link: "",
         logo: null,
      });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const handleImageChange = (e) => {
      const files = e.target.files;
      if (files && files[0]) {
         setData("logo", files[0]);
         setImageUrl(URL.createObjectURL(files[0]));
      }
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      post(route("settings.add-social"));
   };

   useEffect(() => {
      if (wasSuccessful) {
         reset();
         handleOpen();
      }
   }, [wasSuccessful]);

   return (
      <Card className="card-shadow max-w-[1000px] w-full mx-auto mt-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">
               App Social Link Manage
            </p>
         </div>

         <div className="flex items-center p-6">
            <div className="flex items-center border-r border-gray-300 pr-4">
               <p className="font-medium text-gray-700 mr-4">
                  Add Social Links
               </p>
               <CirclePlus
                  onClick={handleOpen}
                  className="w-7 h-7 text-blue-500 cursor-pointer"
               />
            </div>
            <div className="pl-6 flex items-center flex-wrap gap-6">
               {socials.map((social, ind) => (
                  <UpdateSocialLink key={ind} social={social} />
               ))}
            </div>
         </div>

         <Dialog
            open={open}
            size="sm"
            handler={handleOpen}
            className="p-6 max-h-[calc(100vh-80px)] overflow-y-auto"
         >
            <div className="flex items-center justify-between mb-6">
               <p className="text-xl font-medium">Social Links</p>
               <span
                  onClick={handleOpen}
                  className="text-3xl leading-none cursor-pointer"
               >
                  ×
               </span>
            </div>

            <form onSubmit={submit}>
               <div className="grid grid-cols-1 gap-6">
                  <div className="flex flex-col">
                     <p className="flex max-w-[164px] w-full font-medium text-gray-500 mb-1">
                        <span>Social Logo</span>
                        <span className="ml-1 block text-red-500">*</span>
                     </p>
                     <div>
                        {imageUrl ? (
                           <img
                              alt="social"
                              src={imageUrl}
                              className="h-[60px] w-[60px]"
                           />
                        ) : (
                           <UserCircle className="h-[60px] w-[60px] text-blue-gray-500" />
                        )}
                        <div className="mt-2 flex items-center">
                           <label
                              htmlFor="socialLinkForm"
                              className="text12 font-medium text-gray-900 px-2.5 py-1.5 border border-gray-700 bg-gray-100 whitespace-nowrap"
                           >
                              Choose Photo
                           </label>
                           <input
                              hidden
                              required
                              type="file"
                              id="socialLinkForm"
                              onChange={handleImageChange}
                           />
                           <small className="ml-3 text-gray-500">
                              JPG, JPEG, PNG File, Maximum 2MB
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
                     type="text"
                     name="name"
                     label="Social Name"
                     value={data.name}
                     error={errors.name}
                     onChange={onHandleChange}
                     placeholder="Enter your social name"
                     fullWidth
                     required
                  />

                  <Input
                     type="url"
                     name="link"
                     label="Social Link Url"
                     value={data.link}
                     error={errors.link}
                     onChange={onHandleChange}
                     placeholder="Enter your social link url"
                     fullWidth
                     required
                  />
               </div>

               <div className="flex items-center mt-7">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className={`bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14`}
                  >
                     Add Link
                  </Button>
               </div>
            </form>
         </Dialog>
      </Card>
   );
};

export default AddSocialLinks;
