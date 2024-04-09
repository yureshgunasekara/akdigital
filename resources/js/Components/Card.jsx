import PropType from "prop-types";

const Card = ({ children, className }) => {
   return (
      <div className={`rounded-xl bg-white shadow-card ${className}`}>
         {children}
      </div>
   );
};

Card.propType = {
   children: PropType.node,
   className: PropType.string,
};

export default Card;
