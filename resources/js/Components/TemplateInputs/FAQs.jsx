import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const FAQs = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="name"
            value={data.name}
            onChange={onHandleChange}
            label="Product Name"
            placeholder="e.g. Google, Amazon"
            maxLength={100}
            required
         />

         <TextArea
            rows={4}
            name="description"
            value={data.description}
            onChange={onHandleChange}
            label="Product Description"
            placeholder="e.g. Describe what your website or business do"
            className="min-h-0"
            maxLength={400}
            required
         />
      </>
   );
};

export default FAQs;
