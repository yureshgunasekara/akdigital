import { useState } from "react";
import { format } from "date-fns";
import Input from "@/Components/Input";
import Image from "@/Components/Icons/Image";
import Breadcrumb from "@/Components/Breadcrumb";
import { Head, Link, useForm } from "@inertiajs/react";
import InputDropdown from "@/Components/InputDropdown";
import { Button, Card, Dialog } from "@material-tailwind/react";
import InfiniteScroll from "react-infinite-scroll-component";
import Dashboard from "@/Layouts/Dashboard";

const AiImages = (props) => {
   const { auth, images, todaysImages } = props;
   const [imageFilterModal, setImageFilterModal] = useState(false);

   const { data, setData, reset, post, processing } = useForm({
      title: "New Image",
      art: "None",
      lighting: "None",
      mood: "None",
      quantity: 1,
      size: "256x256",
      prompt: "",
   });

   const submit = (e) => {
      e.preventDefault();
      post(route("ai-images"));
   };

   const filterCancel = () => {
      setImageFilterModal(false);
      reset("title", "art", "lighting", "mood", "quantity", "size");
   };

   return (
      <>
         <Head title="Ai Images" />
         {auth.user.role === "admin" ? (
            <Breadcrumb Icon={Image} title="Ai Images" />
         ) : (
            <Breadcrumb
               Icon={Image}
               title="Ai Images"
               totalCount={todaysImages || 0}
               maxLimit={auth.user.subscription_plan.image_generation}
            />
         )}

         <Card className="shadow-card h-[calc(100vh-266px)] py-7 flex flex-col justify-between">
            <div
               id="scrollableDiv"
               className="flex flex-col-reverse overflow-auto h-[calc(100vh-396px)] px-7"
            >
               <InfiniteScroll
                  inverse={true} //
                  hasMore={false}
                  scrollableTarget="scrollableDiv"
                  dataLength={Object.keys(images).length}
                  style={{ display: "flex", flexDirection: "column-reverse" }}
                  endMessage={
                     <Link
                        className="text-center"
                        href="/saved-documents/generated-images"
                     >
                        Click here to view more images
                     </Link>
                  }
               >
                  <div className="flex flex-col justify-end overflow-auto">
                     {Object.entries(images).map(([key, value]) => {
                        const dateTime = format(
                           new Date(key),
                           "dd-MM-yyyy hh:mm:ss a"
                        );

                        return (
                           <div key={key} className="py-2">
                              <div className="flex items-center mb-1">
                                 <p className="text-gray-900 font-bold">
                                    Generated
                                 </p>
                                 <p className="text-gray-600 ml-1">
                                    {value.length} of 5
                                 </p>
                              </div>
                              <p className="text-sm text-gray-700">
                                 {dateTime}
                              </p>
                              <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-7 py-3.5">
                                 {value.map((image) => (
                                    <img
                                       key={image.id}
                                       src={image.img_url}
                                       alt={image.title}
                                       className="rounded-lg w-full"
                                    />
                                 ))}
                              </div>
                           </div>
                        );
                     })}
                  </div>
               </InfiniteScroll>
            </div>

            <div className="h-12 flex items-center px-7">
               <form onSubmit={submit} className="w-full">
                  <div className="relative">
                     <Input
                        name="title"
                        value={data.prompt}
                        onChange={(e) => setData("prompt", e.target.value)}
                        placeholder="e.g. describe about your image"
                        className="h-12 !rounded-lg"
                        required
                     />
                     <Button
                        type="submit"
                        color="white"
                        disabled={processing}
                        className="!absolute !top-0 !right-0 capitalize bg-primary-500 text-white text-sm !rounded-lg px-5 h-full mb-7"
                     >
                        Generate
                     </Button>
                  </div>
               </form>

               <div>
                  <Button
                     color="white"
                     variant="text"
                     onClick={() => setImageFilterModal(true)}
                     className="capitalize outline outline-1 outline-gray-200 text-gray-500 active:bg-white hover:bg-white text-sm !rounded-lg px-5 w-[90px] h-full ml-6"
                  >
                     Filter
                  </Button>

                  <Dialog
                     size="xs"
                     open={imageFilterModal}
                     handler={() => setImageFilterModal(false)}
                     className="p-7"
                  >
                     <p className="text-lg text-gray-900 font-bold mb-8">
                        Filter
                     </p>
                     <form action="">
                        <Input
                           label="Title"
                           name="title"
                           value={data.title}
                           onChange={(e) => setData("title", e.target.value)}
                           placeholder="Image title"
                           className="mb-5"
                           maxLength={100}
                           required
                        />

                        <div className="mb-5">
                           <InputDropdown
                              required
                              fullWidth
                              label="Art Style"
                              defaultValue={data.art}
                              itemList={artStyle}
                              onChange={(e) => setData("art", e.value)}
                           />
                        </div>
                        <div className="mb-5">
                           <InputDropdown
                              required
                              fullWidth
                              label="Lighting Style"
                              defaultValue={data.lighting}
                              itemList={lightingStyle}
                              onChange={(e) => setData("lighting", e.value)}
                           />
                        </div>
                        <div className="mb-5">
                           <InputDropdown
                              required
                              fullWidth
                              label="Mood Style"
                              defaultValue={data.mood}
                              itemList={moodStyle}
                              onChange={(e) => setData("mood", e.value)}
                           />
                        </div>
                        <div className="mb-5">
                           <InputDropdown
                              required
                              fullWidth
                              label="Image Size"
                              defaultValue={data.size}
                              itemList={[
                                 { key: "256x256", value: "256x256" },
                                 { key: "512x512", value: "512x512" },
                                 { key: "1024x1024", value: "1024x1024" },
                              ]}
                              onChange={(e) => setData("size", e.value)}
                           />
                        </div>

                        <InputDropdown
                           required
                           fullWidth
                           label="Number Of Images"
                           defaultValue={`${data.quantity}`}
                           itemList={[
                              { key: "1", value: "1" },
                              { key: "2", value: "2" },
                              { key: "3", value: "3" },
                              { key: "4", value: "4" },
                              { key: "5", value: "5" },
                           ]}
                           onChange={(e) =>
                              setData("quantity", parseInt(e.value))
                           }
                        />

                        <div className="flex items-center justify-end mt-10">
                           <Button
                              variant="outlined"
                              color="white"
                              onClick={filterCancel}
                              className="mr-4 capitalize text-gray-500 border-gray-200 text14"
                           >
                              Cancel
                           </Button>
                           <Button
                              variant="text"
                              color="white"
                              onClick={() => setImageFilterModal(false)}
                              className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
                           >
                              Confirm
                           </Button>
                        </div>
                     </form>
                  </Dialog>
               </div>
            </div>
         </Card>
      </>
   );
};

const artStyle = [
   { key: "None", value: "None" },
   { key: "3D render", value: "3D render" },
   { key: "Pixel", value: "Pixel" },
   { key: "Sticker", value: "Sticker" },
   { key: "Realistic", value: "Realistic" },
   { key: "Isometric", value: "Isometric" },
   { key: "Cyberpunk", value: "Cyberpunk" },
   { key: "Line art", value: "Line art" },
   { key: "Pencil drawing", value: "Pencil drawing" },
   { key: "Ballpoint pen drawing", value: "Ballpoint pen drawing" },
   { key: "Watercolor", value: "Watercolor" },
   { key: "Origami", value: "Origami" },
   { key: "Carton", value: "Carton" },
   { key: "Retro", value: "Retro" },
   { key: "Anime", value: "Anime" },
   { key: "Clay", value: "Clay" },
   { key: "Vaporwave", value: "Vaporwave" },
   { key: "Steampunk", value: "Steampunk" },
   { key: "Glitchcore", value: "Glitchcore" },
   { key: "Bauhaus", value: "Bauhaus" },
   { key: "Vector", value: "Vector" },
   { key: "Low poly", value: "Low poly" },
   { key: "Ukiyo-e", value: "Ukiyo-e" },
   { key: "Cubism", value: "Cubism" },
   { key: "Modern", value: "Modern" },
   { key: "Pop", value: "Pop" },
   { key: "Contemporary", value: "Contemporary" },
   { key: "Impressionism", value: "Impressionism" },
   { key: "Pointillism", value: "Pointillism" },
   { key: "Minimalism", value: "Minimalism" },
];

const lightingStyle = [
   { key: "None", value: "None" },
   { key: "Warm", value: "Warm" },
   { key: "Cold", value: "Cold" },
   { key: "Golden Hour", value: "Golden Hour" },
   { key: "Blue Hour", value: "Blue Hour" },
   { key: "Ambient", value: "Ambient" },
   { key: "Studio", value: "Studio" },
   { key: "Neon", value: "Neon" },
   { key: "Dramatic", value: "Dramatic" },
   { key: "Cinematic", value: "Cinematic" },
   { key: "Natural", value: "Natural" },
   { key: "Foggy", value: "Foggy" },
   { key: "Backlight", value: "Backlight" },
   { key: "Hard", value: "Hard" },
];

const moodStyle = [
   { key: "None", value: "None" },
   { key: "Aggressive", value: "Aggressive" },
   { key: "Angry", value: "Angry" },
   { key: "Boring", value: "Boring" },
   { key: "Bright", value: "Bright" },
   { key: "Calm", value: "Calm" },
   { key: "Cheerful", value: "Cheerful" },
   { key: "Chilling", value: "Chilling" },
   { key: "Colorful", value: "Colorful" },
   { key: "Dark", value: "Dark" },
   { key: "Natural", value: "Natural" },
];

AiImages.layout = (page) => <Dashboard children={page} />;

export default AiImages;
