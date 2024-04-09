import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const StartupNameIdeas = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="keywords"
            value={data.keywords}
            onChange={onHandleChange}
            label="Seed words"
            placeholder="e.g. flow, app, tech"
            maxLength={100}
            required
         />

         <TextArea
            rows={4}
            name="details"
            value={data.details}
            onChange={onHandleChange}
            label="What is your blog post about?"
            placeholder="e.g. Describe your blog post"
            className="min-h-0"
            maxLength={200}
            required
         />
      </>
   );
};

export default StartupNameIdeas;
