import {
   useTable,
   useSortBy,
   useGlobalFilter,
   useFilters,
   usePagination,
} from "react-table";
import { useMemo, useState } from "react";
import Card from "@/Components/Card";
import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Finance from "@/Components/Icons/Finance";
import TableNav from "@/Components/Table/TableNav";
import TableHead from "@/Components/Table/TableHead";
import { transactionsGroup } from "@/utils/tableUtils/columns";
import TablePagination from "@/Components/Table/TablePagination";
import Dashboard from "@/Layouts/Dashboard";

const Transactions = (props) => {
   const [transactions, setTransactions] = useState(props.transactions);
   const data = useMemo(() => transactions.data, [transactions]);
   const columns = useMemo(() => transactionsGroup, []);

   const { rows, getTableProps, getTableBodyProps, headerGroups, prepareRow } =
      useTable(
         { columns, data },
         useFilters,
         useGlobalFilter,
         useSortBy,
         usePagination
      );

   return (
      <>
         <Head title="Transactions list" />
         <Breadcrumb Icon={Finance} title="Transactions list" />

         <Card className="shadow-card">
            <TableNav
               data={transactions}
               title="All Transactions"
               globalSearch={true}
               setSearchData={setTransactions}
               tablePageSizes={[10, 15, 20, 25]}
               searchPath={route("transaction.search")}
               exportPath={route("transaction.export")}
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
                                 const { column } = cell;
                                 return (
                                    <td
                                       {...cell.getCellProps()}
                                       className={`px-7 py-[18px] text-start last:text-end ${
                                          column.id !== "document" &&
                                          "whitespace-nowrap"
                                       }`}
                                    >
                                       {column.id === "price" ? (
                                          <span className="text-sm text-gray-700 font-medium">
                                             ${cell.render("Cell")}
                                          </span>
                                       ) : (
                                          <span
                                             className={`text-sm text-gray-700`}
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

            <TablePagination paginationInfo={transactions} className="p-7" />
         </Card>
      </>
   );
};

Transactions.layout = (page) => <Dashboard children={page} />;

export default Transactions;
