const Breadcrumb = ({ Icon, title, className, totalCount, maxLimit }) => {
   return (
      <div
         className={`flex items-center justify-between mt-4 mb-10 ${className}`}
      >
         <div className="flex items-center">
            <Icon className="text-primary-500 h-6 w-6" />
            <p className="text22 font-bold ml-2">{title}</p>
         </div>
         <div>
            {totalCount >= 0 && maxLimit ? (
               <p className="font-medium">
                  Generation {totalCount}/{maxLimit}
               </p>
            ) : null}
            {/* <p className="font-medium">Token left 0/10</p> */}
         </div>
      </div>
   );
};

export default Breadcrumb;
