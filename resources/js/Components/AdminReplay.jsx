import { Avatar } from "@material-tailwind/react";
import { formatDistanceToNow } from "date-fns";
import UserCircle from "./Icons/UserCircle";

const AdminReplay = ({ replay, user }) => {
   const { attachment, description, created_at } = replay;
   const replayTime = (time) => {
      const someDate = new Date(time);
      const text = formatDistanceToNow(someDate, { includeSeconds: true });
      return text.charAt(0).toUpperCase() + text.slice(1);
   };

   return (
      <div className="flex w-full mt-2 space-x-3 pr-20 md:pr-[160px]">
         <div className="flex-shrink-0 rounded-full">
            {user && user.image ? (
               <Avatar
                  src={`/${user.image}`}
                  alt="item-1"
                  size="xs"
                  variant="circular"
                  className="h-10 w-10"
               />
            ) : (
               <UserCircle className="h-10 w-10 text-blue-gray-500" />
            )}
         </div>
         <div>
            <div className="bg-gray-200  rounded-r-lg rounded-bl-lg overflow-hidden">
               {attachment && (
                  <img className="w-full" src={`/${attachment}`} alt="" />
               )}
               <p className="text-sm p-3">{description}</p>
            </div>
            <span className="text-xs text-gray-500 leading-none">
               {replayTime(created_at)} ago
            </span>
         </div>
      </div>
   );
};

export default AdminReplay;
