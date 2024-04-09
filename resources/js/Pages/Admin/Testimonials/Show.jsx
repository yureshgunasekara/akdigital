import Breadcrumb from "@/Components/Breadcrumb";
import Delete from "@/Components/Icons/Delete";
import EditFill from "@/Components/Icons/EditFill";
import Star from "@/Components/Icons/Star";
import Users from "@/Components/Icons/Users";
import Dashboard from "@/Layouts/Dashboard";
import { Head, Link, router } from "@inertiajs/react";
import { Button, Card, IconButton } from "@material-tailwind/react";
import React from "react";

const Show = ({ testimonials }) => {
   const rating = (value) => {
      let count = [];
      for (let i = 0; i < Math.round(value); i++) {
         count.push(i);
      }
      return count;
   };

   return (
      <>
         <Head title="Testimonials Management" />
         <Breadcrumb Icon={Users} title="Testimonials" />
         <Card className="!shadow-card p-7 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <div className="col-span-1 md:col-span-2 lg:col-span-3">
               <Link href={route("testimonial.create")}>
                  <Button
                     type="submit"
                     color="white"
                     className="float-right capitalize bg-primary-500 text-white text-sm !rounded-lg px-5"
                  >
                     Create New Testimonial
                  </Button>
               </Link>
            </div>
            {testimonials.map((item) => (
               <div
                  key={item.id}
                  class="shadow-card relative p-6 mt-10 rounded-lg border border-gray-100"
               >
                  <div className="mb-4">
                     <Link href={route("testimonial.get", item.id)}>
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
                           router.delete(route("testimonial.delete", item.id))
                        }
                     >
                        <Delete className="h-4 w-4" />
                     </IconButton>
                  </div>
                  <img
                     src={`/${item.image}`}
                     class="w-20 h-[90px] object-cover absolute -top-10 right-6 rounded-lg border border-white"
                     alt=""
                  />
                  <p class="text18 font-medium mb-1.5">{item.name}</p>
                  <small class="text-gray-500  dark:text-gray-300">
                     {item.designation}
                  </small>
                  <div class="flex items-center mt-4 mb-7">
                     <div class="flex items-center gap-1">
                        {rating(item.rating).map((item) => (
                           <Star
                              key={item}
                              className="w-4 h-4 text-warning-500"
                           />
                        ))}
                     </div>
                     <small class="text-gray-500 dark:text-gray-300 ml-1">
                        {item.rating}
                     </small>
                  </div>
                  <p class="text-gray-500 dark:text-white">{item.comment}</p>
               </div>
            ))}
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
