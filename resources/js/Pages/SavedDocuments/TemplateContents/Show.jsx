import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import React, { useMemo, useState } from "react";
import { Head } from "@inertiajs/react";
import { parseISO, format } from "date-fns";
import Breadcrumb from "@/Components/Breadcrumb";
import { Link, router } from "@inertiajs/react";
import TableNav from "@/Components/Table/TableNav";
import DeleteIcon from "@/Components/Icons/Delete";
import TableHead from "@/Components/Table/TableHead";
import Documents from "@/Components/Icons/Documents";
import { IconButton } from "@material-tailwind/react";
import { groupHeader } from "@/utils/tableUtils/columns";
import SaveDocument from "@/Components/Icons/SaveDocument";
import TablePagination from "@/Components/Table/TablePagination";
import { Card } from "@material-tailwind/react";
import Dashboard from "@/Layouts/Dashboard";

const Show = (props) => {
   const [documents, setDocuments] = useState(props.documents);
   const data = useMemo(() => documents.data, [documents]);
   const columns = useMemo(() => groupHeader, []);

   const { getTableProps, getTableBodyProps, headerGroups, rows, prepareRow } =
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
      router.delete(route("template-content-delete", id));
   };

   return (
      <>
         <Head title="Saved Documents" />
         <Breadcrumb Icon={SaveDocument} title="Saved Documents" />
         <Card className="shadow-card">
            <TableNav
               title="All Documents"
               data={documents}
               globalSearch={true}
               setSearchData={setDocuments}
               tablePageSizes={[10, 15, 20, 25]}
               searchPath={route("template-contents.search")}
               exportPath={route("template-contents.export")}
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
                                 const { id, created_at } = row.original;
                                 return (
                                    <td
                                       {...cell.getCellProps()}
                                       className={`px-7 py-[18px] text-start last:text-end ${
                                          column.id !== "document" &&
                                          "whitespace-nowrap"
                                       }`}
                                    >
                                       {column.id === "action" ? (
                                          <div className="flex justify-end items-center">
                                             <Link
                                                href={`/saved-documents/template-contents/${id}`}
                                             >
                                                <IconButton
                                                   variant="text"
                                                   color="white"
                                                   className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
                                                >
                                                   <Documents className="h-4 w-4" />
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
                                             <small className="font-bold text-gray-700">
                                                {stringToDate(created_at).date}
                                             </small>
                                             <p className="text12 text-gray-400 mt-1">
                                                {stringToDate(created_at).time}
                                             </p>
                                          </>
                                       ) : (
                                          <span
                                             className={`text-sm text-gray-700 ${
                                                column.id === "document" &&
                                                "font-bold"
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

            <TablePagination paginationInfo={documents} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
