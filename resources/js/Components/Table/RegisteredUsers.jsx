import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import PropType from "prop-types";
import React, { useMemo } from "react";
import { Link } from "@inertiajs/react";
import { parseISO, format } from "date-fns";
import EditFill from "@/Components/Icons/EditFill";
import TableHead from "@/Components/Table/TableHead";
import { Avatar, IconButton } from "@material-tailwind/react";
import { registeredUsers } from "@/utils/tableUtils/columns";
import UserCircle from "@/Components/Icons/UserCircle";
import User from "@/Components/Icons/User";

const UserManagement = ({ users }) => {
   const data = useMemo(() => users, []);
   const columns = useMemo(() => registeredUsers, []);

   const { rows, getTableProps, getTableBodyProps, headerGroups, prepareRow } =
      useTable(
         { data, columns },
         useFilters,
         useGlobalFilter,
         useSortBy,
         usePagination
      );

   const statusColor = (status) => {
      return status === "active"
         ? "text-success-500 bg-success-50"
         : "text-gray-500 bg-gray-100";
   };

   const typeColor = (type) => {
      return type === "Free"
         ? "text-warning-500 bg-warning-50"
         : type === "Standard"
         ? "text-blue-500 bg-blue-50"
         : "text-primary-500 bg-primary-50";
   };

   const stringToDate = (str) => {
      const time = format(parseISO(str), "hh:mm aa");
      const date = format(parseISO(str), "dd MMM, yyyy");
      return { date, time };
   };

   return (
      <div className="overflow-x-auto">
         <table {...getTableProps()} className="w-full min-w-[1000px]">
            <thead>
               <TableHead headerGroups={headerGroups} />
            </thead>
            <tbody {...getTableBodyProps()}>
               {rows.map((row) => {
                  prepareRow(row);
                  return (
                     <tr
                        {...row.getRowProps()}
                        className="border-b border-gray-200 dark:border-neutral-500"
                     >
                        {row.cells.map((cell) => {
                           const { row, column } = cell;
                           const {
                              id,
                              name,
                              email,
                              image,
                              status,
                              subscription_plan,
                              created_at,
                           } = row.original;
                           const imageUrl =
                              `/${image}` === "/null" ? null : `/${image}`;

                           return (
                              <td
                                 {...cell.getCellProps()}
                                 className={`px-7 py-[18px] text-start last:text-end ${
                                    column.id !== "document" &&
                                    "whitespace-nowrap"
                                 }`}
                              >
                                 {column.id === "user" ? (
                                    <div className="flex items-center">
                                       {imageUrl ? (
                                          <Avatar
                                             src={imageUrl}
                                             alt="item-1"
                                             variant="circular"
                                             className="h-10 w-10"
                                          />
                                       ) : (
                                          <UserCircle className="h-10 w-10 text-blue-gray-500" />
                                       )}
                                       <div className="ml-2">
                                          <p className="text-gray-900 font-bold">
                                             {name}
                                          </p>
                                          <small className="text-gray-500 mt-0.5">
                                             {email}
                                          </small>
                                       </div>
                                    </div>
                                 ) : column.id === "status" ? (
                                    <span
                                       className={`text12 py-0.5 px-2 rounded-full capitalize ${statusColor(
                                          status
                                       )}`}
                                    >
                                       {status}
                                    </span>
                                 ) : column.id === "type" ? (
                                    <span
                                       className={`text12 py-0.5 px-2 rounded-full capitalize ${typeColor(
                                          subscription_plan.type
                                       )}`}
                                    >
                                       {subscription_plan.title}
                                    </span>
                                 ) : column.id === "created" ? (
                                    <>
                                       <small className="font-bold text-gray-700">
                                          {stringToDate(created_at).date}
                                       </small>
                                       <p className="text12 text-gray-400 mt-1">
                                          {stringToDate(created_at).time}
                                       </p>
                                    </>
                                 ) : (
                                    <div className="flex justify-end items-center">
                                       <Link
                                          className="mr-3.5"
                                          href={route("users.profile", id)}
                                       >
                                          <IconButton
                                             variant="text"
                                             color="white"
                                             className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
                                          >
                                             <User className="h-4 w-4" />
                                          </IconButton>
                                       </Link>

                                       <Link href={route("users.edit", id)}>
                                          <IconButton
                                             variant="text"
                                             color="white"
                                             className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
                                          >
                                             <EditFill className="h-4 w-4" />
                                          </IconButton>
                                       </Link>
                                    </div>
                                 )}
                              </td>
                           );
                        })}
                     </tr>
                  );
               })}
            </tbody>
         </table>
      </div>
   );
};

UserManagement.propType = {
   users: PropType.array,
};

export default UserManagement;
