import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import { useMemo } from "react";
import { Link } from "@inertiajs/react";
import { Head } from "@inertiajs/react";
import { parseISO, format } from "date-fns";
import Dollar from "@/Components/Icons/Dollar";
import { Card } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import { Button } from "@material-tailwind/react";
import TableNav from "@/Components/Table/TableNav";
import TableHead from "@/Components/Table/TableHead";
import PlanStatusChange from "@/Components/PlanStatusChange";
import { subscriptionPlans } from "@/utils/tableUtils/columns";
import TablePagination from "@/Components/Table/TablePagination";
import Dashboard from "@/Layouts/Dashboard";

const Show = ({ plans }) => {
   const data = useMemo(() => plans.data, [plans]);
   const columns = useMemo(() => subscriptionPlans, []);

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

   return (
      <>
         <Head title="Subscription Plans" />
         <Breadcrumb Icon={Dollar} title="Subscription Plans" />

         <Card className="shadow-card">
            <TableNav
               data={plans}
               title="All Plans"
               globalSearch={false}
               tablePageSizes={[10, 15, 20, 25]}
               component={
                  <Link href={route("plans.create")}>
                     <Button
                        variant="text"
                        color="white"
                        className="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md py-3 px-5 ml-3"
                     >
                        Create New Subscription
                     </Button>
                  </Link>
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
                                 const { id, title, status, type, created_at } =
                                    row.original;
                                 return (
                                    <td
                                       {...cell.getCellProps()}
                                       className={`px-7 py-[18px] text-start last:text-end ${
                                          column.id !== "document" &&
                                          "whitespace-nowrap"
                                       }`}
                                    >
                                       {column.id === "title" ? (
                                          <span className="text-sm text-gray-700 font-semibold">
                                             {title}
                                          </span>
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
                                                type
                                             )}`}
                                          >
                                             {type}
                                          </span>
                                       ) : column.id === "action" ? (
                                          <PlanStatusChange
                                             id={id}
                                             status={status}
                                          />
                                       ) : column.id === "created" ? (
                                          <>
                                             <small className="font-medium text-gray-700">
                                                {stringToDate(created_at).date}
                                             </small>
                                             <p className="text12 text-gray-400 mt-1">
                                                {stringToDate(created_at).time}
                                             </p>
                                          </>
                                       ) : (
                                          <span
                                             className={`text-sm text-gray-700`}
                                          >
                                             ${cell.render("Cell")}
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

            <TablePagination paginationInfo={plans} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
