import { Avatar } from "@material-tailwind/react";
import { formatDistanceToNow } from "date-fns";
import UserCircle from "./Icons/UserCircle";

const UserReplay = ({ replay, user }) => {
   const { attachment, description, created_at } = replay;
   const replayTime = (time) => {
      const someDate = new Date(time);
      const text = formatDistanceToNow(someDate, { includeSeconds: true });
      return text.charAt(0).toUpperCase() + text.slice(1);
   };

   return (
      <div className="flex w-full mt-2 space-x-3 ml-auto pl-20 md:pl-[160px] justify-end">
         <div>
            <div className="bg-blue-600 text-white rounded-l-lg rounded-br-lg overflow-hidden">
               {attachment && (
                  <img className="w-full" src={`/${attachment}`} alt="" />
               )}
               <p className="text-sm p-3">{description}</p>
            </div>
            <span className="text-xs text-gray-500 leading-none">
               {replayTime(created_at)} ago
            </span>
         </div>
         <div className="flex-shrink-0 h-10 w-10 rounded-full">
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
      </div>
   );
};

export default UserReplay;
