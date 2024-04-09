import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import { useMemo, useState } from "react";
import { Head } from "@inertiajs/react";
import { parseISO, format } from "date-fns";
import Dashboard from "@/Layouts/Dashboard";
import Breadcrumb from "@/Components/Breadcrumb";
import Support from "@/Components/Icons/Support";
import TableNav from "@/Components/Table/TableNav";
import DeleteIcon from "@/Components/Icons/Delete";
import TableHead from "@/Components/Table/TableHead";
import { IconButton } from "@material-tailwind/react";
import { Button, Card } from "@material-tailwind/react";
import { Link, router, usePage } from "@inertiajs/react";
import { supportRequests } from "@/utils/tableUtils/columns";
import SupportRequest from "@/Components/Icons/SupportRequest";
import TablePagination from "@/Components/Table/TablePagination";

const Show = (props) => {
   const pageInfo = usePage();
   const routeType = pageInfo.url.split("/")[1];
   const [supports, setSupports] = useState(props.supports);

   const data = useMemo(() => supports.data, [supports]);
   const columns = useMemo(() => supportRequests, []);

   const { rows, getTableProps, getTableBodyProps, headerGroups, prepareRow } =
      useTable(
         { columns, data },
         useFilters,
         useGlobalFilter,
         useSortBy,
         usePagination
      );

   const stringToDate = (str) => {
      const time = format(parseISO(str), "hh:mm aa");
      const date = format(parseISO(str), "dd MMM, yyyy");
      return { date, time };
   };

   const handleDelete = (id) => {
      router.delete(`/support-request/delete/${id}`);
   };

   const statusColor = (status) => {
      return status === "Open"
         ? "text-warning-500 bg-warning-50"
         : status === "Replay"
         ? "text-success-500 bg-success-50"
         : status === "Resolved"
         ? "text-primary-500 bg-primary-50"
         : "text-red-500 bg-red-50";
   };

   const priorityColor = (priority) => {
      return priority === "Critical"
         ? "text-red-500 bg-red-50"
         : priority === "High"
         ? "text-warning-500 bg-warning-50"
         : priority === "Normal"
         ? "text-primary-500 bg-primary-50"
         : "text-gray-700 bg-gray-100";
   };

   return (
      <>
         <Head title="Support Requests" />
         <Breadcrumb Icon={Support} title="Support Request" />
         <Card className="shadow-card">
            <TableNav
               data={supports}
               title="All Support Requests"
               globalSearch={true}
               setSearchData={setSupports}
               searchPath={route("support-request.search")}
               exportPath={route("support-request.export")}
               tablePageSizes={[10, 15, 20, 25]}
               component={
                  routeType !== "admin" && (
                     <Link href="/support-request/create">
                        <Button
                           variant="text"
                           color="white"
                           className="whitespace-nowrap bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md py-2.5 px-5"
                        >
                           New Support Request
                        </Button>
                     </Link>
                  )
               }
            />

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
                                    status,
                                    priority,
                                    ticket_id,
                                    created_at,
                                 } = row.original;
                                 return (
                                    <td
                                       {...cell.getCellProps()}
                                       className={`px-7 py-[18px] text-start last:text-end ${
                                          column.id !== "document" &&
                                          "whitespace-nowrap"
                                       }`}
                                    >
                                       {column.id === "ticket" ? (
                                          <small className="font-medium text-primary-500">
                                             {ticket_id}
                                          </small>
                                       ) : column.id === "status" ? (
                                          <span
                                             className={`text12 py-0.5 px-2 rounded-full capitalize ${statusColor(
                                                status
                                             )}`}
                                          >
                                             {status}
                                          </span>
                                       ) : column.id === "priority" ? (
                                          <small
                                             className={`text12 py-0.5 px-2 rounded-full capitalize ${priorityColor(
                                                priority
                                             )}`}
                                          >
                                             {priority}
                                          </small>
                                       ) : column.id === "action" ? (
                                          <div className="flex justify-end items-center">
                                             <Link
                                                href={
                                                   routeType === "admin"
                                                      ? `/admin/support-requests/conversation/${id}`
                                                      : `/support-request/conversation/${id}`
                                                }
                                             >
                                                <IconButton
                                                   variant="text"
                                                   color="white"
                                                   className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
                                                >
                                                   <SupportRequest className="h-4 w-4" />
                                                </IconButton>
                                             </Link>

                                             <IconButton
                                                variant="text"
                                                color="white"
                                                className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500 ml-3"
                                                onClick={() => handleDelete(id)}
                                             >
                                                <DeleteIcon className="h-4 w-4" />
                                             </IconButton>
                                          </div>
                                       ) : column.id === "created" ? (
                                          <>
                                             <small className="text-gray-500">
                                                {stringToDate(created_at).date}{" "}
                                                {stringToDate(created_at).time}
                                             </small>
                                          </>
                                       ) : (
                                          <span
                                             className={`text-sm ${
                                                column.id === "category"
                                                   ? "font-medium text-gray-700"
                                                   : "text-gray-500"
                                             }`}
                                          >
                                             {cell.render("Cell")}
                                          </span>
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

            <TablePagination paginationInfo={supports} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
