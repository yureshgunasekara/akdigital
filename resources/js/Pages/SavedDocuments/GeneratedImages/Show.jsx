import {
   Card,
   SpeedDial,
   IconButton,
   SpeedDialHandler,
   SpeedDialContent,
   SpeedDialAction,
} from "@material-tailwind/react";
import { useState } from "react";
import More from "@/Components/Icons/More";
import Dashboard from "@/Layouts/Dashboard";
import Image from "@/Components/Icons/Image";
import Delete from "@/Components/Icons/Delete";
import { Head, router } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Download from "@/Components/Icons/Download";
import TableNav from "@/Components/Table/TableNav";
import TablePagination from "@/Components/Table/TablePagination";

const Show = (props) => {
   const [images, setImages] = useState(props.images);
   let totalPages = [];
   for (let i = 1; i <= images.last_page; i++) {
      totalPages.push(i);
   }

   const deleteHandler = (id) => {
      router.delete(route("generated-images-delete", id));
   };

   return (
      <>
         <Head title="Generated Images" />
         <Breadcrumb Icon={Image} title="Generated Images" />
         <Card className="shadow-card">
            <TableNav
               data={images}
               title="All Images"
               globalSearch={true}
               setSearchData={setImages}
               tablePageSizes={[20, 25, 30, 35]}
               searchPath={route("generated-images.search")}
               exportPath={route("generated-images.export")}
            />
            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 p-7">
               {images.data.map((image) => (
                  <div key={image.id} className="relative">
                     <img
                        src={`/${image.img_url}`}
                        className="w-full h-full rounded-lg"
                        alt={image.title}
                     />
                     <div className="absolute top-0 left-0 w-full h-full p-3 group hover:bg-[#181717] hover:bg-opacity-40 rounded-lg">
                        <div className="relative">
                           <div className="absolute top-0 right-0">
                              <SpeedDial placement="left" className="">
                                 <SpeedDialHandler>
                                    <IconButton
                                       size="lg"
                                       className="p-0 h-8 w-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center rounded-full bg-primary-100 hover:bg-primary-100 active:bg-primary-50 text-gray-900 hover:text-primary-500"
                                    >
                                       <More className="w-4 h-4" />
                                    </IconButton>
                                 </SpeedDialHandler>
                                 <SpeedDialContent className="flex-row">
                                    <div
                                       onClick={() => deleteHandler(image.id)}
                                    >
                                       <SpeedDialAction className="p-0 min-h-[32px] min-w-[32px] flex items-center justify-center bg-primary-50 hover:bg-primary-50 active:bg-primary-25 text-red-500 hover:text-red-500">
                                          <Delete className="w-4 h-4" />
                                       </SpeedDialAction>
                                    </div>

                                    <a
                                       href={`/${image.img_url}`}
                                       download={`/${image.img_url}`}
                                    >
                                       <SpeedDialAction className="relative z-10 p-0 min-h-[32px] min-w-[32px] flex items-center justify-center bg-primary-50 hover:bg-primary-50 active:bg-primary-25 text-primary-500 hover:text-primary-500">
                                          <Download className="w-4 h-4" />
                                       </SpeedDialAction>
                                    </a>
                                 </SpeedDialContent>
                              </SpeedDial>
                           </div>
                        </div>
                     </div>
                  </div>
               ))}
            </div>

            <TablePagination paginationInfo={images} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
