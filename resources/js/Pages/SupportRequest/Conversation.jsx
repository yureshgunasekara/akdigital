import Card from "@/Components/Card";
import SimpleBar from "simplebar-react";
import Dashboard from "@/Layouts/Dashboard";
import TextArea from "@/Components/TextArea";
import Support from "@/Components/Icons/Support";
import Breadcrumb from "@/Components/Breadcrumb";
import { Head, useForm, usePage } from "@inertiajs/react";
import { Avatar, Button } from "@material-tailwind/react";
import UserReplay from "@/Components/UserReplay";
import AdminReplay from "@/Components/AdminReplay";
import UserCircle from "@/Components/Icons/UserCircle";
import { useEffect } from "react";

const Conversation = (props) => {
   const pageInfo = usePage();
   const routeType = pageInfo.url.split("/")[1];
   const { support, auth } = props;

   const { data, setData, post, reset, wasSuccessful } = useForm({
      support_id: support.id,
      replay_from: auth.user.role,
      attachment: "",
      description: "",
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = async (e) => {
      e.preventDefault();
      post(route("support-request.replay"));
   };
   useEffect(() => {
      if (wasSuccessful) {
         reset("attachment");
         reset("description");
      }
   }, [wasSuccessful]);

   return (
      <>
         <Head title="Support Conversation" />
         <Breadcrumb Icon={Support} title="Support Request Create" />

         <Card className="max-w-[1000px] w-full mx-auto mt-8">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <div className="flex flex-col md:flex-row md:items-end justify-between">
                  <div className="flex items-center">
                     {auth.user && auth.user.image ? (
                        <Avatar
                           src={`/${user.image}`}
                           alt="item-1"
                           size="xs"
                           variant="circular"
                           className={
                              auth.user.role === "admin"
                                 ? "h-12 w-12"
                                 : "h-10 w-10"
                           }
                        />
                     ) : (
                        <UserCircle
                           className={`text-blue-gray-500 ${
                              auth.user.role === "admin"
                                 ? "h-12 w-12"
                                 : "h-10 w-10"
                           }`}
                        />
                     )}

                     <div className="flex flex-col ml-2">
                        <small className="font-medium text-gray-900">
                           {auth.user.role === "admin"
                              ? auth.user.name
                              : "Admin"}
                        </small>
                        {auth.user.role === "admin" && (
                           <small className="font-medium text-gray-900 mt-2">
                              Ticket Id:{" "}
                              <span className="text-primary-500">
                                 {support.ticket_id}
                              </span>
                           </small>
                        )}
                     </div>
                  </div>

                  {auth.user.role === "admin" && (
                     <small className="font-medium text-gray-900 mt-3">
                        Document Subject:{" "}
                        <span className="text-primary-500">
                           {support.subject}
                        </span>
                     </small>
                  )}
               </div>
            </div>

            <SimpleBar className="flex flex-col flex-grow p-7 h-[500px] overflow-y-auto bg-gray-25">
               {support.replays.map((replay) => {
                  const { replay_from } = replay;
                  if (routeType === "admin") {
                     if (replay_from === "user") {
                        return <AdminReplay replay={replay} user={auth.user} />;
                     } else {
                        return <UserReplay replay={replay} user={auth.user} />;
                     }
                  } else {
                     if (replay_from === "user") {
                        return <UserReplay replay={replay} user={auth.user} />;
                     } else {
                        return <AdminReplay replay={replay} user={auth.user} />;
                     }
                  }
               })}
            </SimpleBar>

            <form
               onSubmit={submit}
               encType="multipart/form-data"
               className="p-7"
            >
               <div className="flex flex-col items-start md:flex-row md:items-center">
                  <small className="max-w-[164px] w-full mb-1 whitespace-nowrap font-medium text-gray-500">
                     <span className="mr-1">Attachment</span>
                  </small>
                  <input
                     type="file"
                     onChange={(e) => setData("attachment", e.target.files[0])}
                     className="relative m-0 block w-full min-w-0 flex-auto rounded-md border border-solid border-neutral-300 dark:border-neutral-600 bg-clip-padding py-[8px] px-2.5 text-sm font-normal text-neutral-700 dark:text-neutral-200 transition duration-300 ease-in-out file:-mx-3 file:-my-[8px] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 dark:file:bg-neutral-700 file:px-3 file:py-[8px] file:text-neutral-700 dark:file:text-neutral-100 file:transition file:duration-150 file:ease-in-out file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200 !border-gray-200 focus:!border-primary-500 focus:outline-0"
                  />
               </div>

               <div className="mt-8">
                  <TextArea
                     rows={4}
                     flexLabel
                     fullWidth
                     name="description"
                     value={data.description}
                     label="Message"
                     placeholder="Describe what we can do for you."
                     onChange={onHandleChange}
                     maxLength={400}
                     required
                  />
               </div>

               <div className="flex items-center mt-10 md:pl-[164px]">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md outline-primary-500"
                  >
                     Create
                  </Button>
                  <Button
                     variant="outlined"
                     color="red"
                     type="button"
                     className="ml-3 capitalize border-black text-gray-900"
                  >
                     <span>Cancel</span>
                  </Button>
               </div>
            </form>
         </Card>
      </>
   );
};

Conversation.layout = (page) => <Dashboard children={page} />;

export default Conversation;
