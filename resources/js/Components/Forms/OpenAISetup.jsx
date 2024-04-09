import Card from "@/Components/Card";
import Input from "@/Components/Input";
import { useForm } from "@inertiajs/react";
import { Button } from "@material-tailwind/react";

const OpenAISetup = ({ openaiKey }) => {
   const { data, setData, patch, errors, clearErrors } = useForm({
      openai_key: openaiKey,
   });

   const onHandleChange = (event) => {
      setData(event.target.name, event.target.value);
   };

   const submit = (e) => {
      e.preventDefault();
      clearErrors();
      patch(route("settings.openai-update"));
   };

   return (
      <Card className="max-w-[1000px] w-full mx-auto mb-7">
         <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
            <p className="text18 font-bold text-gray-900">OpenAI Key Setup</p>
            <p className="text-xs text-red-300 italic mt-1">
               AI features like Template, AI Image, AI Chats, AI Code, Speech To
               Text and Text To Speech will not active without OpenAI key
            </p>
         </div>

         <form onSubmit={submit} className="p-7">
            <div className="grid grid-cols-1 gap-7">
               <Input
                  type="password"
                  name="openai_key"
                  label="Open AI API Key"
                  value={data.openai_key}
                  error={errors.openai_key}
                  onChange={onHandleChange}
                  placeholder="Enter your open ai api key"
                  fullWidth
                  flexLabel
               />
            </div>

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

export default OpenAISetup;
