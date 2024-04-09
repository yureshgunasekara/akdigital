import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const ProsAndCons = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <Input
            name="name"
            value={data.name}
            onChange={onHandleChange}
            label="Product Name"
            placeholder="e.g. iPhone, Samsung"
            maxLength={200}
            required
         />

         <TextArea
            rows={6}
            name="description"
            value={data.description}
            onChange={onHandleChange}
            label="What is your blog post about?"
            placeholder="e.g. What kind of cell phone you want to compare"
            className="min-h-0"
            maxLength={600}
            required
         />
      </>
   );
};

export default ProsAndCons;
