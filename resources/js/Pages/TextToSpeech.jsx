import Card from "@/Components/Card";
import Input from "@/Components/Input";
import Spinner from "@/Components/Spinner";
import TextArea from "@/Components/TextArea";
import Breadcrumb from "@/Components/Breadcrumb";
import { Head, useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import InputDropdown from "@/Components/InputDropdown";
import { format, isToday, parseISO } from "date-fns";
import { voices, languages } from "@/utils/data/text-to-speech";
import Audio from "@/Components/Icons/Audio";
import Dashboard from "@/Layouts/Dashboard";
import SimpleBar from "simplebar-react";

const TextToSpeech = (props) => {
   const { auth, user, speeches, todaysSpeeches } = props;

   const { data, setData, post, processing, errors, clearErrors } = useForm({
      title: "",
      description: "",
      language: "english",
      voice: voices[0].value,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = async (e) => {
      e.preventDefault();
      clearErrors();
      post(route("text-to-speech-save"));
   };

   const groupedData = speeches.reduce((result, element) => {
      const date = format(parseISO(element.created_at), "yyyy-MM-dd");
      if (!result[date]) {
         result[date] = [];
      }
      result[date].push(element);
      return result;
   }, {});

   const grouped = [];
   Object.keys(groupedData).forEach((key) => {
      const item = { generation: key, audios: groupedData[key] };
      grouped.push(item);
   });

   let textLimit = null;
   if (user.role === "admin") {
      textLimit = false;
   } else {
      if (user.subscription_plan.text_character_length === "Unlimited") {
         textLimit = false;
      } else {
         textLimit = user.subscription_plan.text_character_length;
      }
   }

   return (
      <>
         <Head title="Text ot speech" />
         {auth.user.role === "admin" ? (
            <Breadcrumb Icon={Audio} title="Text ot speech" />
         ) : (
            <Breadcrumb
               Icon={Audio}
               title="Text ot speech"
               totalCount={todaysSpeeches || 0}
               maxLimit={auth.user.subscription_plan.text_to_speech_generation}
            />
         )}

         <div className="grid grid-cols-12 gap-7">
            <div className="col-span-12 lg:col-span-4">
               <Card>
                  <div className="p-5 border-b border-gray-100 flex items-center">
                     <Audio className="w-5 h-5 text-gray-400 mr-2" />
                     <p className="text18 text-gray-600">Text To Speech</p>
                  </div>
                  <form onSubmit={submit} className="p-5 flex flex-col gap-6">
                     <Input
                        name="title"
                        label="Title"
                        value={data.title}
                        error={errors.title}
                        onChange={onHandleChange}
                        placeholder="New Code"
                        maxLength={50}
                        required
                     />

                     <InputDropdown
                        fullWidth
                        label="Tone of Voice"
                        defaultValue={data.language}
                        itemList={languages}
                        onChange={(e) => setData("language", e.value)}
                     />

                     <InputDropdown
                        fullWidth
                        label="Tone of Voice"
                        defaultValue={data.voice}
                        itemList={voices}
                        onChange={(e) => setData("voice", e.value)}
                     />

                     <TextArea
                        rows={8}
                        name="description"
                        label="Description"
                        value={data.description}
                        error={errors.description}
                        onChange={onHandleChange}
                        placeholder="e.g. In publishing and graphic design, Lorem ipsum is..."
                        maxLength={textLimit}
                        className="min-h-0"
                        required
                     />

                     <Button
                        type="submit"
                        className="capitalize bg-primary-500 text-white text-sm px-5 py-0 h-10"
                        color="white"
                        fullWidth
                     >
                        {processing ? (
                           <Spinner className="text-white !w-6 !h-6 !border-2" />
                        ) : (
                           <span>Submit</span>
                        )}
                     </Button>
                  </form>
               </Card>
            </div>

            <div className="col-span-12 lg:col-span-8">
               <Card>
                  <SimpleBar
                     style={{ height: "628px" }}
                     className="col-span-12 lg:col-span-8 rounded-xl p-5"
                  >
                     {grouped.length > 0 &&
                        grouped.map((item, index) => (
                           <div key={index} className="mb-6">
                              <div className="flex items-center mb-1">
                                 <p className="text-lg font-bold text-gray-900">
                                    {isToday(parseISO(item.generation))
                                       ? "Today"
                                       : item.generation}
                                 </p>
                                 <p className="ml-1">
                                    {item.audios.length} of 6
                                 </p>
                              </div>
                              {item.audios.map((content) => (
                                 <audio
                                    key={content.id}
                                    className="w-full h-12 mt-4"
                                    src={content.audio}
                                    preload="auto"
                                    controls
                                 ></audio>
                              ))}
                           </div>
                        ))}
                  </SimpleBar>
               </Card>
            </div>
         </div>
      </>
   );
};

TextToSpeech.layout = (page) => <Dashboard children={page} />;

export default TextToSpeech;
