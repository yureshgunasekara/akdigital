import Card from "@/Components/Card";
import { useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";
import InputDropdown from "../InputDropdown";

const OpenAIModel = ({ model }) => {
   const { setData, post } = useForm({
      model: model,
   });

   const submit = (e) => {
      e.preventDefault();
      post(route("settings.openai-model"));
   };

   const models = [
      { key: "gpt-4-1106-preview", value: "gpt-4-1106-preview" },
      { key: "gpt-4-vision-preview", value: "gpt-4-vision-preview" },
      { key: "gpt-4", value: "gpt-4" },
      { key: "gpt-4-32k", value: "gpt-4-32k" },
      { key: "gpt-4-0613", value: "gpt-4-0613" },
      { key: "gpt-4-32k-0613", value: "gpt-4-32k-0613" },
      { key: "gpt-3.5-turbo-1106", value: "gpt-3.5-turbo-1106" },
      { key: "gpt-3.5-turbo", value: "gpt-3.5-turbo" },
      { key: "gpt-3.5-turbo-16k", value: "gpt-3.5-turbo-16k" },
   ];

   return (
      <Card className="max-w-[1000px] w-full mx-auto mb-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">Select Model</p>
            <p className="text-xs text-red-300 italic mt-1">
               Please select a model for text generation features like template
               content and ai-chat
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <InputDropdown
               fullWidth
               flexLabel
               itemList={models}
               label="Text Generation Model"
               defaultValue={model}
               onChange={(e) => setData("model", e.value)}
            />

            <div className="flex items-center mt-7 md:pl-[164px]">
               <Button
                  type="submit"
                  variant="text"
                  color="white"
                  className={`bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14`}
               >
                  Save Changes
               </Button>
            </div>
         </form>
      </Card>
   );
};

export default OpenAIModel;
