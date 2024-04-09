import { useEffect, useState } from "react";
import { Button, Dialog, IconButton } from "@material-tailwind/react";
import { router, useForm } from "@inertiajs/react";
import UserCircle from "./Icons/UserCircle";
import Input from "./Input";
import Delete from "./Icons/Delete";

const UpdateSocialLink = ({ social }) => {
   const { id, name, link, logo } = social;
   const [open, setOpen] = useState(false);
   const handleOpen = () => setOpen(!open);
   const [imageUrl, setImageUrl] = useState(
      `/${logo}` === "/null" ? null : `/${logo}`
   );

   const { data, setData, post, reset, errors, clearErrors, wasSuccessful } =
      useForm({
         name,
         link,
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
      post(route("settings.update-social", id));
   };

   useEffect(() => {
      if (wasSuccessful) {
         reset();
         handleOpen();
      }
   }, [wasSuccessful]);

   return (
      <>
         <img
            onClick={handleOpen}
            src={`/${social.logo}`}
            className="w-7 h-7 cursor-pointer"
            alt=""
         />

         <Dialog
            open={open}
            size="sm"
            handler={handleOpen}
            className="p-6 max-h-[calc(100vh-80px)] overflow-y-auto"
         >
            <div className="flex items-center justify-between mb-6">
               <p className="text-xl font-medium">Update Links</p>

               <div className="flex items-center">
                  <IconButton
                     variant="text"
                     color="white"
                     className="w-7 h-7 rounded-full bg-red-50 hover:bg-red-50 text-red-500 ml-3"
                     onClick={() =>
                        router.delete(route("settings.delete-social", id))
                     }
                  >
                     <Delete className="h-4 w-4" />
                  </IconButton>
                  <span
                     onClick={handleOpen}
                     className="text-3xl leading-none cursor-pointer ml-4"
                  >
                     ×
                  </span>
               </div>
            </div>

            <form onSubmit={submit}>
               <div className="grid grid-cols-1 gap-6">
                  <div className="flex flex-col">
                     <p className="flex max-w-[164px] w-full font-medium text-gray-500 mb-1">
                        <span>Social Logo</span>
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
      </>
   );
};

export default UpdateSocialLink;
