import Page from "@/Components/Icons/Page";
import Dashboard from "@/Layouts/Dashboard";
import { Head, Link, router } from "@inertiajs/react";
import Delete from "@/Components/Icons/Delete";
import Breadcrumb from "@/Components/Breadcrumb";
import EditFill from "@/Components/Icons/EditFill";
import { Button, Card, IconButton } from "@material-tailwind/react";

const Show = ({ custom_pages }) => {
   return (
      <>
         <Head title="Page Management" />
         <Breadcrumb Icon={Page} title="Page Management" />

         <Card className="!shadow-card p-7 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <div className="col-span-1 md:col-span-2 lg:col-span-3">
               <Link href={route("custom-page.create")}>
                  <Button
                     type="submit"
                     color="white"
                     className="float-right capitalize bg-primary-500 text-white text-sm !rounded-lg px-5"
                  >
                     Create New Page
                  </Button>
               </Link>
            </div>

            {custom_pages.map((item) => (
               <div
                  key={item.id}
                  class="shadow-card relative p-6 mt-10 rounded-lg border border-gray-100"
               >
                  <div className="mb-4">
                     <Link href={route("custom-page.update", item.id)}>
                        <IconButton
                           variant="text"
                           color="white"
                           className="w-7 h-7 rounded-full bg-primary-50 hover:bg-primary-50 text-primary-500"
                        >
                           <EditFill className="h-4 w-4" />
                        </IconButton>
                     </Link>

                     <IconButton
                        variant="text"
                        color="white"
                        className="w-7 h-7 rounded-full bg-red-50 hover:bg-red-50 text-red-500 ml-3"
                        onClick={() =>
                           router.delete(route("custom-page.delete", item.id))
                        }
                     >
                        <Delete className="h-4 w-4" />
                     </IconButton>
                  </div>

                  <p class="text18 font-medium mb-1.5">{item.name}</p>
                  <small class="text-gray-500  dark:text-gray-300">
                     {item.route}
                  </small>
               </div>
            ))}
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
