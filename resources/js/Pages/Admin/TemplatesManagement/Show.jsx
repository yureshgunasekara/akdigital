import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import { useMemo, useState } from "react";
import Card from "@/Components/Card";
import { Link } from "@inertiajs/react";
import { Head } from "@inertiajs/react";
import Breadcrumb from "@/Components/Breadcrumb";
import Template from "@/Components/Icons/Template";
import TableNav from "@/Components/Table/TableNav";
import EditFill from "@/Components/Icons/EditFill";
import TableHead from "@/Components/Table/TableHead";
import { IconButton } from "@material-tailwind/react";
import templatesIcon from "@/Components/Icons/template_icons";
import { templatesManagement } from "@/utils/tableUtils/columns";
import TablePagination from "@/Components/Table/TablePagination";
import Dashboard from "@/Layouts/Dashboard";

const Show = (props) => {
   const [templates, setTemplates] = useState(props.templates);
   const data = useMemo(() => templates.data, [templates]);
   const columns = useMemo(() => templatesManagement, []);

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

   return (
      <>
         <Head title="Templates Management" />
         <Breadcrumb Icon={Template} title="Templates Management" />

         <Card className="shadow-card">
            <TableNav
               data={templates}
               title="All Templates"
               globalSearch={true}
               setSearchData={setTemplates}
               searchPath={route("templates.search")}
               tablePageSizes={[10, 15, 20, 25]}
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
                                 const { id, access_plan, status, title } =
                                    row.original;
                                 const Icon = templatesIcon[row.original.icon];
                                 return (
                                    <td
                                       {...cell.getCellProps()}
                                       className={`px-7 py-[18px] text-start last:text-end ${
                                          column.id !== "document" &&
                                          "whitespace-nowrap"
                                       }`}
                                    >
                                       {column.id === "title" ? (
                                          <div className="flex items-center">
                                             <Icon className="w-5 h-5 text-primary-500 mr-3" />
                                             <span
                                                className={`text-sm text-gray-700 font-bold`}
                                             >
                                                {title}
                                             </span>
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
                                                access_plan
                                             )}`}
                                          >
                                             {access_plan}
                                          </span>
                                       ) : column.id === "action" ? (
                                          <Link
                                             href={`/admin/templates-management/${id}`}
                                          >
                                             <IconButton
                                                variant="text"
                                                color="white"
                                                className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500"
                                             >
                                                <EditFill className="h-4 w-4" />
                                             </IconButton>
                                          </Link>
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

            <TablePagination paginationInfo={templates} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
