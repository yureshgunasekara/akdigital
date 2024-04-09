import {
   useTable,
   useSortBy,
   useGlobalFilter,
   useFilters,
   usePagination,
} from "react-table";
import Card from "@/Components/Card";
import { Head } from "@inertiajs/react";
import { parseISO, format } from "date-fns";
import Breadcrumb from "@/Components/Breadcrumb";
import Finance from "@/Components/Icons/Finance";
import TableNav from "@/Components/Table/TableNav";
import TableHead from "@/Components/Table/TableHead";
import { subscribersGroup } from "@/utils/tableUtils/columns";
import TablePagination from "@/Components/Table/TablePagination";
import { useMemo, useState } from "react";
import Dashboard from "@/Layouts/Dashboard";

const Subscriptions = (props) => {
   const [subscriptions, setSubscriptions] = useState(props.subscriptions);
   const data = useMemo(() => subscriptions.data, [subscriptions]);
   const columns = useMemo(() => subscribersGroup, []);

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

   const frequencyColor = (frequency) => {
      return frequency === "Yearly"
         ? "text-warning-500 bg-warning-50"
         : "text-primary-500 bg-primary-50";
   };

   return (
      <>
         <Head title="Subscriptions list" />
         <Breadcrumb Icon={Finance} title="Subscriptions list" />

         <Card className="shadow-card">
            <TableNav
               data={subscriptions}
               title="All Subscriptions"
               globalSearch={true}
               setSearchData={setSubscriptions}
               tablePageSizes={[10, 15, 20, 25]}
               searchPath={route("subscription.search")}
               exportPath={route("subscription.export")}
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
                                    name,
                                    status,
                                    frequency,
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
                                       {column.id === "name" ? (
                                          <span className="text-sm text-gray-700 font-medium">
                                             {name}
                                          </span>
                                       ) : column.id === "status" ? (
                                          <span
                                             className={`text12 py-0.5 px-2 rounded-full capitalize ${statusColor(
                                                status
                                             )}`}
                                          >
                                             {status}
                                          </span>
                                       ) : column.id === "frequency" ? (
                                          <small
                                             className={`text12 py-0.5 px-2 rounded-full capitalize ${frequencyColor(
                                                frequency
                                             )}`}
                                          >
                                             {frequency}
                                          </small>
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

            <TablePagination paginationInfo={subscriptions} className="p-7" />
         </Card>
      </>
   );
};

Subscriptions.layout = (page) => <Dashboard children={page} />;

export default Subscriptions;
