import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const SocialMediaPostBusiness = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="name"
            value={data.name}
            onChange={onHandleChange}
            label="Company name"
            placeholder="e.g. XYZ"
            maxLength={100}
            required
         />

         <TextArea
            rows={4}
            name="description"
            value={data.description}
            onChange={onHandleChange}
            label="Provide company description"
            placeholder="e.g. XYZ is a leading toy making company"
            className="min-h-0"
            maxLength={400}
            required
         />

         <TextArea
            rows={4}
            name="details"
            value={data.details}
            onChange={onHandleChange}
            label="What is the post about?"
            placeholder="e.g. we released a new version of kids favorite toy"
            className="min-h-0"
            maxLength={400}
            required
         />
      </>
   );
};

export default SocialMediaPostBusiness;
