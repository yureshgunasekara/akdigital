import Input from "@/Components/Input";
import TextArea from "@/Components/TextArea";

const ProblemAgitateSolution = ({ data, errors, onHandleChange }) => {
   return (
      <>
         <div className="grid grid-cols-2 gap-6">
            <Input
               name="name"
               value={data.name}
               onChange={onHandleChange}
               label="Product name"
               placeholder="e.g. VR, Toy"
               maxLength={100}
               required
            />
            <Input
               name="audience"
               value={data.audience}
               onChange={onHandleChange}
               label="Audience"
               placeholder="e.g. Freelancer, Businessman"
               maxLength={100}
               required
            />
         </div>

         <TextArea
            rows={4}
            name="description"
            value={data.description}
            onChange={onHandleChange}
            label="Product Description"
            placeholder="e.g. VR is a innovative device etc..."
            className="min-h-0"
            maxLength={400}
            required
         />
      </>
   );
};

export default ProblemAgitateSolution;
