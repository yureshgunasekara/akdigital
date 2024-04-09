import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import { Head } from "@inertiajs/react";
import Code from "@/Components/Icons/Code";
import { useMemo, useState } from "react";
import { parseISO, format } from "date-fns";
import { Card } from "@material-tailwind/react";
import { Link, router } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import TableNav from "@/Components/Table/TableNav";
import DeleteIcon from "@/Components/Icons/Delete";
import { EyeIcon } from "@heroicons/react/20/solid";
import TableHead from "@/Components/Table/TableHead";
import { IconButton } from "@material-tailwind/react";
import { codesGroup } from "@/utils/tableUtils/columns";
import TablePagination from "@/Components/Table/TablePagination";
import Dashboard from "@/Layouts/Dashboard";

const Show = (props) => {
   const [codes, setCodes] = useState(props.codes);
   const data = useMemo(() => codes.data, [codes]);
   const columns = useMemo(() => codesGroup, []);

   const { rows, prepareRow, headerGroups, getTableProps, getTableBodyProps } =
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
      router.delete(route("generated-codes-delete", id));
   };

   return (
      <>
         <Head title="Generated Codes" />
         <Breadcrumb Icon={Code} title="Generated Codes" />
         <Card className="shadow-card">
            <TableNav
               data={codes}
               title="All Codes"
               globalSearch={true}
               setSearchData={setCodes}
               tablePageSizes={[10, 15, 20, 25]}
               searchPath={route("generated-codes.search")}
               exportPath={route("generated-codes.export")}
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
                                    title,
                                    code,
                                    description,
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
                                       {column.id === "title" ? (
                                          <p className="text-sm font-medium text-gray-700">
                                             {title.length > 30
                                                ? `${title.slice(0, 30)}...`
                                                : title}
                                          </p>
                                       ) : column.id === "description" ? (
                                          <p className="min-w-[300px] max-w-[400px] whitespace-normal text-sm text-gray-700">
                                             {description.length > 100
                                                ? `${description.slice(
                                                     0,
                                                     100
                                                  )}...`
                                                : description}
                                          </p>
                                       ) : column.id === "action" ? (
                                          <div className="flex justify-end items-center">
                                             <Link
                                                href={route(
                                                   "generated-code-view",
                                                   id
                                                )}
                                             >
                                                <IconButton
                                                   variant="text"
                                                   color="white"
                                                   className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
                                                >
                                                   <EyeIcon className="h-4 w-4" />
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
                                       ) : column.id === "word_count" ? (
                                          <span className="text-sm text-gray-700 font-medium">
                                             {code.length}
                                          </span>
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

            <TablePagination paginationInfo={codes} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
