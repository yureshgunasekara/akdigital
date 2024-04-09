import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const ProductNameIdeas = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="keywords"
            value={data.keywords}
            onChange={onHandleChange}
            label="Seed words"
            placeholder="e.g. fast, healthy, compact"
            maxLength={100}
            required
         />

         <TextArea
            rows={4}
            name="description"
            value={data.description}
            onChange={onHandleChange}
            label="Product Description"
            placeholder="e.g. Describe description"
            className="min-h-0"
            maxLength={400}
            required
         />
      </>
   );
};

export default ProductNameIdeas;
