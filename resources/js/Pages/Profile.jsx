import { Head, Link } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Dollar from "@/Components/Icons/Dollar";
import EditIcon from "@/Components/Icons/EditIcon";
import ProfileIcon from "@/Components/Icons/ProfileIcon";
import UserCircle from "@/Components/Icons/UserCircle";
import { Avatar, Button, Card } from "@material-tailwind/react";
import Dashboard from "@/Layouts/Dashboard";

const Profile = (props) => {
   const {
      name,
      email,
      phone,
      role,
      image,
      company,
      website,
      subscription_plan,
   } = props.user;

   return (
      <>
         <Head title="Profile settings" />
         <Breadcrumb Icon={ProfileIcon} title="User Profile" />

         <div className="grid grid-cols-1 lg:grid-cols-3 gap-7">
            <div>
               <Card className="shadow-card h-[146px] relative flex flex-row items-center p-6">
                  {image ? (
                     <Avatar
                        src={image}
                        alt="item-1"
                        size="xs"
                        variant="circular"
                        className="h-[90px] w-[90px]"
                     />
                  ) : (
                     <UserCircle className="h-[90px] w-[90px] text-blue-gray-500" />
                  )}
                  <div className="pl-4 max-w-[188px]">
                     <p className="text18 font-medium text-gray-900">{name}</p>
                     <small className="text-gray-700 mt-2">{email}</small>
                  </div>

                  <Link
                     href="/settings/profile"
                     className="absolute top-5 right-5"
                  >
                     <Button
                        variant="text"
                        color="white"
                        className="font-medium text-gray-900 px-2.5 py-1.5 text-sm bg-gray-100 hover:bg-gray-200 capitalize flex items-center"
                     >
                        <EditIcon className="text-gray-900 w-3 h-3 mr-2" />
                        <span>Edit</span>
                     </Button>
                  </Link>
               </Card>
               <Card className="shadow-card h-[262px] flex justify-between p-7 mt-7">
                  <div className="flex items-center justify-between">
                     <div className="flex items-center">
                        <Dollar className="mr-2 text-primary-500" />
                        <p className="font-bold text-gray-700">Subscription</p>
                     </div>
                     <span className="text12 px-3 py-1 font-medium text-primary-500 bg-primary-50 rounded-full">
                        Current Plan
                     </span>
                  </div>
                  <div>
                     <h5 className="font-bold text-gray-900 mb-2">
                        {role === "admin" ? "Admin" : subscription_plan.title}
                     </h5>
                     <p className="font-medium text-gray-700">
                        {role === "admin"
                           ? "0"
                           : `$${subscription_plan.monthly_price} `}
                        /monthly
                     </p>
                  </div>
                  <Link href="/select-plan">
                     <Button
                        variant="outlined"
                        color="white"
                        className="capitalize w-full border-gray-900 text-gray-900 font-bold text-sm px-5 py-0 h-[46px]"
                     >
                        Update Plan
                     </Button>
                  </Link>
               </Card>
            </div>
            <Card className="shadow-card h-[436px] lg:col-span-2">
               <div className="flex items-center justify-between px-7 pt-7 pb-5 border-b border-b-gray-200">
                  <p className="text18 font-medium text-gray-900">
                     Personal Information
                  </p>
                  <Link href="/settings/profile">
                     <Button
                        variant="text"
                        color="white"
                        className="font-medium text-gray-900 px-2.5 py-1.5 text-sm bg-gray-100 hover:bg-gray-200 capitalize flex items-center"
                     >
                        <EditIcon className="text-gray-900 w-3 h-3 mr-2" />
                        <span>Edit</span>
                     </Button>
                  </Link>
               </div>
               <div className="px-7 pb-7 pt-[22px] h-full flex flex-col justify-between">
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        Full Name
                     </p>
                     <p className="text-gray-900 font-bold">{name}</p>
                  </div>
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        Email Address
                     </p>
                     <p className="text-gray-900">{email}</p>
                  </div>
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        Phone
                     </p>
                     <p className="text-gray-900">{phone ? phone : "empty"}</p>
                  </div>
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        User Role
                     </p>
                     <p className="text-gray-900 capitalize">{role}</p>
                  </div>
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        Company
                     </p>
                     <p className="text-gray-900">{company}</p>
                  </div>
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        Website
                     </p>
                     <p className="text-gray-900">{website}</p>
                  </div>
                  <div className="flex items-center">
                     <p className="text-gray-500 font-medium w-[164px]">
                        Country
                     </p>
                     <p className="text-gray-900">empty</p>
                  </div>
               </div>
            </Card>
         </div>
      </>
   );
};

Profile.layout = (page) => <Dashboard children={page} />;

export default Profile;
