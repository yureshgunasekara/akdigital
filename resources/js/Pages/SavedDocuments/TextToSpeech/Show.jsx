import {
   useTable,
   useSortBy,
   useFilters,
   usePagination,
   useGlobalFilter,
} from "react-table";
import { Head } from "@inertiajs/react";
import { useMemo, useState } from "react";
import { router } from "@inertiajs/react";
import Code from "@/Components/Icons/Code";
import { parseISO, format } from "date-fns";
import { Card } from "@material-tailwind/react";
import Breadcrumb from "@/Components/Breadcrumb";
import TableNav from "@/Components/Table/TableNav";
import DeleteIcon from "@/Components/Icons/Delete";
import TableHead from "@/Components/Table/TableHead";
import { IconButton } from "@material-tailwind/react";
import { textToSpeechGroup } from "@/utils/tableUtils/columns";
import TablePagination from "@/Components/Table/TablePagination";
import { voices, languages } from "@/utils/data/text-to-speech";
import AudioPlayer from "@/Components/AudioPlayer";
import Dashboard from "@/Layouts/Dashboard";

const Show = (props) => {
   const [speeches, setSpeeches] = useState(props.speeches);
   const data = useMemo(() => speeches.data, [speeches]);
   const columns = useMemo(() => textToSpeechGroup, []);

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
      router.delete(route("text-to-speech-delete", id));
   };

   return (
      <>
         <Head title="Generated Codes" />
         <Breadcrumb Icon={Code} title="Generated Codes" />
         <Card className="shadow-card">
            <TableNav
               data={speeches}
               title="All Speeches"
               globalSearch={true}
               setSearchData={setSpeeches}
               tablePageSizes={[10, 15, 20, 25]}
               searchPath={route("text-to-speech.search")}
               exportPath={route("text-to-speech.export")}
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
                                    language,
                                    voice,
                                    audio,
                                    created_at,
                                 } = row.original;

                                 const lan = languages.find(
                                    (item) => item.value === language
                                 );
                                 const voi = voices.find(
                                    (item) => item.value === voice
                                 );

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
                                       ) : column.id === "language" ? (
                                          <p className="text-sm text-gray-700">
                                             {lan.key}
                                          </p>
                                       ) : column.id === "voice" ? (
                                          <p className="text-sm text-gray-700">
                                             {voi.key}
                                          </p>
                                       ) : column.id === "created" ? (
                                          <>
                                             <small className="font-bold text-gray-700">
                                                {stringToDate(created_at).date}
                                             </small>
                                             <p className="text12 text-gray-400 mt-1">
                                                {stringToDate(created_at).time}
                                             </p>
                                          </>
                                       ) : column.id === "audio" ? (
                                          <span className="text-sm text-gray-700 font-medium">
                                             <AudioPlayer
                                                audioSrc={`/${audio}`}
                                             />
                                          </span>
                                       ) : column.id === "action" ? (
                                          <div className="flex justify-end items-center">
                                             <IconButton
                                                variant="text"
                                                color="white"
                                                className="w-7 h-7 rounded-full hover:bg-primary-50 text-gray-500 hover:text-primary-500 ml-3"
                                                onClick={() => handleDelete(id)}
                                             >
                                                <DeleteIcon className="h-4 w-4" />
                                             </IconButton>
                                          </div>
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

            <TablePagination paginationInfo={speeches} className="p-7" />
         </Card>
      </>
   );
};

Show.layout = (page) => <Dashboard children={page} />;

export default Show;
