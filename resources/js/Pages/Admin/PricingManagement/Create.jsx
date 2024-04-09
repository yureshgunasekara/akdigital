import Input from "@/Components/Input";
import Dollar from "@/Components/Icons/Dollar";
import Breadcrumb from "@/Components/Breadcrumb";
import { Head, useForm } from "@inertiajs/react";
import InputDropdown from "@/Components/InputDropdown";
import { Button, Card, Checkbox } from "@material-tailwind/react";
import TextArea from "@/Components/TextArea";
import Dashboard from "@/Layouts/Dashboard";

const UnlimitedCheckBox = ({ onHandler, name }) => {
   return (
      <div className="flex items-center absolute top-0 right-0">
         <label className="text-sm whitespace-nowrap flex items-center font-medium text-gray-500 mr-2">
            Unlimited
         </label>
         <Checkbox
            ripple={false}
            color="indigo"
            name={name}
            className="hover:before:opacity-0 w-3.5 h-3.5 rounded"
            containerProps={{ className: "p-0" }}
            onChange={onHandler}
         />
      </div>
   );
};

const Create = ({ errors }) => {
   const { data, setData, post } = useForm({
      title: "",
      type: "Free",
      status: "active",
      description: "",
      monthly_price: null,
      yearly_price: null,
      currency: "USD",
      prompt_generation: null,
      image_generation: null,
      code_generation: null,
      content_token_length: null,
      text_to_speech_generation: null,
      text_character_length: null,
      speech_to_text_generation: null,
      speech_duration: 1,
      support_request: null,
      access_template: "Free",
      access_chat_bot: "Free",
   });

   const onHandleChange = (event) => {
      if (event.target.type === "checkbox") {
         if (event.target.checked) {
            setData(event.target.name, "Unlimited");
         } else {
            setData(event.target.name, null);
         }
      } else {
         setData(event.target.name, event.target.value);
      }
   };

   const submit = (e) => {
      e.preventDefault();
      post(route("plans.store"));
   };

   const planType = [
      { key: "Free", value: "Free" },
      { key: "Standard", value: "Standard" },
      { key: "Premium", value: "Premium" },
   ];

   const dropdownList = [
      { key: "Premium (All Templates Included)", value: "Premium" },
      { key: "Standard (Free Templates Included)", value: "Standard" },
      { key: "Free Only", value: "Free" },
   ];

   return (
      <>
         <Head title="New Subscription Plan" />
         <Breadcrumb Icon={Dollar} title="New Subscription Plan" />

         <Card className="shadow-card max-w-[1000px] w-full mx-auto">
            <div className="px-7 pt-7 pb-4 border-b border-b-gray-200">
               <p className="text18 font-bold text-gray-900">
                  Create New Subscription Plan
               </p>
            </div>
            <form onSubmit={submit} className="p-7">
               <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                  <div>
                     <Input
                        fullWidth
                        name="title"
                        label="Title"
                        value={data.title}
                        placeholder="Plan Title"
                        onChange={onHandleChange}
                        maxLength={50}
                        required
                     />
                     {errors.title && (
                        <p class="text-sm text-red-500 mt-1">{errors.title}</p>
                     )}
                  </div>
                  <div>
                     <InputDropdown
                        required
                        fullWidth
                        label="Plan Type"
                        defaultValue={data.type}
                        onChange={(e) => setData("type", e.value)}
                        itemList={planType}
                     />
                     {errors.type && (
                        <p class="text-sm text-red-500 mt-1">{errors.type}</p>
                     )}
                  </div>
                  <div>
                     <InputDropdown
                        required
                        fullWidth
                        label="Plan Status"
                        defaultValue={data.status}
                        onChange={(e) => setData("status", e.value)}
                        itemList={[
                           { key: "Active", value: "active" },
                           { key: "Deactive", value: "deactive" },
                        ]}
                     />
                     {errors.status && (
                        <p class="text-sm text-red-500 mt-1">{errors.status}</p>
                     )}
                  </div>
                  <div>
                     <Input
                        fullWidth
                        type="number"
                        name="monthly_price"
                        value={data.monthly_price}
                        placeholder="Monthly plan price"
                        onChange={onHandleChange}
                        label="Monthly Price"
                        required
                     />
                     {errors.monthly_price && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.monthly_price}
                        </p>
                     )}
                  </div>
                  <div>
                     <Input
                        fullWidth
                        type="number"
                        name="yearly_price"
                        value={data.yearly_price}
                        placeholder="Yearly plan price"
                        onChange={onHandleChange}
                        label="Yearly Price"
                        required
                     />
                     {errors.yearly_price && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.yearly_price}
                        </p>
                     )}
                  </div>
                  <div>
                     <InputDropdown
                        required
                        fullWidth
                        label="Currency"
                        defaultValue={data.currency}
                        onChange={(e) => setData("currency", e.value)}
                        itemList={[{ key: "USD", value: "USD" }]}
                     />
                     {errors.currency && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.currency}
                        </p>
                     )}
                  </div>
                  <div>
                     <TextArea
                        rows={3}
                        name="description"
                        value={data.description}
                        onChange={onHandleChange}
                        label="Plan Short Description"
                        placeholder="e.g. describe about your plan"
                        className="min-h-0"
                        maxLength={100}
                        required
                     />
                     {errors.description && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.description}
                        </p>
                     )}
                  </div>
               </div>

               <p className="text18 font-bold text-gray-900 mb-4">
                  Plan Features
               </p>
               <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                  <div className="relative">
                     <UnlimitedCheckBox
                        name={"prompt_generation"}
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        name="prompt_generation"
                        value={data.prompt_generation}
                        placeholder="Template contents generation limit per day"
                        onChange={onHandleChange}
                        label="Template Content"
                        required
                        type={
                           data.prompt_generation === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.prompt_generation === "Unlimited" ? true : false
                        }
                     />
                     {errors.prompt_generation && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.prompt_generation}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name={"code_generation"}
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="code_generation"
                        value={data.code_generation}
                        placeholder="Codes generation limit per day"
                        onChange={onHandleChange}
                        label="Code Generation"
                        type={
                           data.code_generation === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.code_generation === "Unlimited" ? true : false
                        }
                     />
                     {errors.code_generation && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.code_generation}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name={"text_to_speech_generation"}
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="text_to_speech_generation"
                        value={data.text_to_speech_generation}
                        placeholder="Text to speech generation limit per day"
                        onChange={onHandleChange}
                        label="Text To Speech"
                        type={
                           data.text_to_speech_generation === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.text_to_speech_generation === "Unlimited"
                              ? true
                              : false
                        }
                     />
                     {errors.text_to_speech_generation && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.text_to_speech_generation}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name="text_character_length"
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="text_character_length"
                        value={data.text_character_length}
                        placeholder="Text character length for text to speech generation"
                        onChange={onHandleChange}
                        label="Text Character Length"
                        type={
                           data.text_character_length === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.text_character_length === "Unlimited"
                              ? true
                              : false
                        }
                     />
                     {errors.text_character_length && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.text_character_length}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name={"speech_to_text_generation"}
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="speech_to_text_generation"
                        value={data.speech_to_text_generation}
                        placeholder="Speech to text generation limit per day"
                        onChange={onHandleChange}
                        label="Speech To Text"
                        type={
                           data.speech_to_text_generation === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.speech_to_text_generation === "Unlimited"
                              ? true
                              : false
                        }
                     />
                     {errors.speech_to_text_generation && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.speech_to_text_generation}
                        </p>
                     )}
                  </div>
                  <div>
                     <InputDropdown
                        required
                        fullWidth
                        defaultValue={`${data.speech_duration}`}
                        onChange={(e) =>
                           setData("speech_duration", parseInt(e.value))
                        }
                        itemList={[
                           { key: "1 minute", value: "1" },
                           { key: "3 minutes", value: "3" },
                           { key: "6 minutes", value: "6" },
                        ]}
                        label="Speech Duration"
                     />
                     {errors.speech_duration && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.speech_duration}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name={"image_generation"}
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="image_generation"
                        value={data.image_generation}
                        placeholder="Images generation limit per day"
                        onChange={onHandleChange}
                        label="Image Generation"
                        type={
                           data.image_generation === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.image_generation === "Unlimited" ? true : false
                        }
                     />
                     {errors.image_generation && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.image_generation}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name={"support_request"}
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="support_request"
                        value={data.support_request}
                        placeholder="Support requests sent limit per day"
                        onChange={onHandleChange}
                        label="Support Request"
                        type={
                           data.support_request === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.support_request === "Unlimited" ? true : false
                        }
                     />
                     {errors.support_request && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.support_request}
                        </p>
                     )}
                  </div>
                  <div>
                     <InputDropdown
                        required
                        fullWidth
                        defaultValue={data.access_template}
                        onChange={(e) => setData("access_template", e.value)}
                        itemList={dropdownList}
                        label="Access Template"
                     />
                     {errors.access_template && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.access_template}
                        </p>
                     )}
                  </div>
                  <div>
                     <InputDropdown
                        required
                        fullWidth
                        defaultValue={data.access_chat_bot}
                        onChange={(e) => setData("access_chat_bot", e.value)}
                        itemList={dropdownList}
                        label="Access Chat Bot"
                     />
                     {errors.access_chat_bot && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.access_chat_bot}
                        </p>
                     )}
                  </div>
                  <div className="relative">
                     <UnlimitedCheckBox
                        name="content_token_length"
                        onHandler={onHandleChange}
                     />
                     <Input
                        fullWidth
                        required
                        name="content_token_length"
                        value={data.content_token_length}
                        placeholder="Max token limit for template, code and chat"
                        onChange={onHandleChange}
                        label="Max Token"
                        type={
                           data.content_token_length === "Unlimited"
                              ? "text"
                              : "number"
                        }
                        disabled={
                           data.content_token_length === "Unlimited"
                              ? true
                              : false
                        }
                     />
                     {errors.content_token_length && (
                        <p class="text-sm text-red-500 mt-1">
                           {errors.content_token_length}
                        </p>
                     )}
                  </div>
               </div>

               <div className="flex items-center">
                  <Button
                     type="submit"
                     variant="text"
                     color="white"
                     className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14"
                  >
                     Save
                  </Button>
                  <Button
                     variant="outlined"
                     color="white"
                     className="ml-4 capitalize text-gray-900 border-gray-900 text14"
                  >
                     Cancel
                  </Button>
               </div>
            </form>
         </Card>
      </>
   );
};

Create.layout = (page) => <Dashboard children={page} />;

export default Create;
